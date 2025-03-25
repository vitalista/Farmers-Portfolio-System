<?php
include '../backend/functions.php';

if (!isset($_SESSION['resourceItems'])) {
    $_SESSION['resourceItems'] = [];
}

if (isset($_POST['addItem'])) {
    $farmerId = validate($_POST['farmer_id']);
    $resourcesId = validate($_POST['resources_id']);
    $quantity = validate($_POST['quantity']);

    $checkResource = mysqli_query($conn, "SELECT * FROM resources WHERE id='$resourcesId' AND is_archived = 0 LIMIT 1");
    if (!$checkResource || mysqli_num_rows($checkResource) == 0) {
        redirect('distribution-multiple-add.php', 404, 'No Item Found');
        return;
    }

    $checkReFarmer = mysqli_query($conn, "SELECT * FROM farmers WHERE id='$farmerId' AND is_archived = 0 LIMIT 1");
    if (!$checkReFarmer || mysqli_num_rows($checkReFarmer) == 0) {
        redirect('distribution-multiple-add.php', 404, 'Farmer Not Found');
        return;
    }

    $row = mysqli_fetch_assoc($checkResource);
    $farmer = mysqli_fetch_assoc($checkReFarmer);

    $quantities = array_column($_SESSION['resourceItems'], 'quantity');
    $totalQuantity = array_sum($quantities);
    $totalQuantity += $quantity;
    $totalFarmers = count($_SESSION['resourceItems']);
    if ($row['quantity_available'] < $quantity || $totalQuantity > $row['quantity_available']) {
        redirect('distribution-multiple-add.php', 404, 'Only ' . $row['quantity_available'] . ' quantity available');
        return;
    }

    $program = getById('programs', $row['program_id']);
    if ($program['status'] != 200) {
        redirect('distribution-multiple-add.php', 500, 'Program Not Found');
        return;
    }

    

    $resourceData = [
        'farmer_id' => $farmerId,
        'ffrs_code' => $farmer['ffrs_system_gen'],
        'farmer_name' => $farmer['first_name'] . ' ' . $farmer['last_name'],
        'brgy' => $farmer['farmer_brgy_address'],
        'program_id' => $row['program_id'],
        'program' => $program['data']['program_name'],
        'program_total_beneficiaries' => $program['data']['total_beneficiaries'],
        'program_available_beneficiaries' => $program['data']['beneficiaries_available'],
        'quantity' => $quantity,
        'resource_name' => $row['resources_name'],
        'resource_type' => $row['resource_type'],
        'unit_of_measure' => $row['unit_of_measure'],
        'resources_available' => $row['quantity_available'],
        'total' => $row['total_quantity'],
        'resource_id' => $row['id'],
    ];

    foreach ($_SESSION['resourceItems'] as $key => $sessItem) {
        if (isset($sessItem['resource_id']) && $sessItem['resource_id'] == $row['id'] && $sessItem['farmer_id'] == $farmerId) {
            $resourceData['quantity'] += $sessItem['quantity'];
            $_SESSION['resourceItems'][$key] = $resourceData;
            redirect('distribution-multiple-add.php', 200, 'Farmer Updated');
            return;
        }
    }

    if ($program['data']['beneficiaries_available'] <= $totalFarmers) {
        redirect('distribution-multiple-add.php', 404, 'Only ' . $program['data']['beneficiaries_available'] . ' beneficiaries available');
    }

    $_SESSION['resourceItems'][] = $resourceData;
    redirect('distribution-multiple-add.php', 200, 'Farmer Added');
}

if (isset($_POST['addItems'])) {

    // Declarations
    $farmerAddComparison = validate($_POST['farmerAddComparison']);
    $farmerAdd = validate($_POST['farmerAdd']);
    $resourcesId = validate($_POST['resources_id']);
    $quantity = validate($_POST['quantity']);
    $resourceData = [];

    if (count($_SESSION['resourceItems']) > $_SESSION['resourceItems'][0]['program_available_beneficiaries']) {
        redirect('distribution-multiple-add.php', 404, 'Please lower the number of beneficiaries to continue.');
        exit;
    }

    // Fail fast: Check if the resource exists
    $checkResource = mysqli_query($conn, "SELECT * FROM resources WHERE id='$resourcesId' AND is_archived = 0 LIMIT 1");
    if (!$checkResource || mysqli_num_rows($checkResource) == 0) {
        redirect('distribution-multiple-add.php', 404, 'No Resource Found');
        return;
    }

    $row = mysqli_fetch_assoc($checkResource);

    // Fail fast: Check if farmers exist
    $checkReFarmers = mysqli_query($conn, "SELECT * FROM farmers WHERE $farmerAddComparison LIKE '$farmerAdd' AND is_archived = 0");
    if (!$checkReFarmers || mysqli_num_rows($checkReFarmers) == 0) {
        redirect('distribution-multiple-add.php', 404, 'No Farmers Found');
        return;
    }

    $farmers = [];
    while ($farmer = mysqli_fetch_assoc($checkReFarmers)) {
        $farmers[] = $farmer;
    }

    // Fail fast: Check resource quantity
    $quantities = array_column($_SESSION['resourceItems'], 'quantity');
    $totalQuantity = array_sum($quantities) + $quantity;
    if ($row['quantity_available'] < $quantity || $totalQuantity > $row['quantity_available']) {
        redirect('distribution-multiple-add.php', 404, 'Only ' . $row['quantity_available'] . ' quantity available');
        return;
    }

    // Fail fast: Check program existence
    $program = getById('programs', $row['program_id']);
    if ($program['status'] != 200) {
        redirect('distribution-multiple-add.php', 500, 'Program not found');
        return;
    }

    // Fail fast: Check if resource can be distributed
    $quotient = floor($row['quantity_available'] / $quantity);
    if ($quotient <= 0) {
        redirect('distribution-multiple-add.php', 404, 'Insufficient resource quantity for distribution');
        return;
    }

    // Logic
    $farmersToDistribute = array_slice($farmers, 0, $quotient);
    foreach ($farmersToDistribute as $farmer) {
        $resourceData[] = [
            'farmer_id' => $farmer['id'],
            'farmer_name' => $farmer['first_name'] . ' ' . $farmer['last_name'],
            'ffrs_code' => $farmer['ffrs_system_gen'],
            'program_id' => $row['program_id'],
            'program' => $program['data']['program_name'],
            'program_total_beneficiaries' => $program['data']['total_beneficiaries'],
            'program_available_beneficiaries' => $program['data']['beneficiaries_available'],
            'quantity' => $quantity,
            'resource_name' => $row['resources_name'],
            'resource_type' => $row['resource_type'],
            'unit_of_measure' => $row['unit_of_measure'],
            'resources_available' => $row['quantity_available'],
            'total' => $row['total_quantity'],
            'resource_id' => $row['id']
        ];
    }

    $totalFarmers = count($_SESSION['resourceItems']);
    if ($program['data']['beneficiaries_available'] < $totalFarmers) {
        redirect('distribution-multiple-add.php', 404, 'Sorry, only ' . $program['data']['beneficiaries_available'] . ' beneficiaries available');
        return;
    }

    foreach ($resourceData as $data) {
        $isUpdated = false;

        // Update existing farmer's quantity or add new farmer
        foreach ($_SESSION['resourceItems'] as $key => $sessItem) {
            if ($sessItem['farmer_id'] == $data['farmer_id']) {
                $_SESSION['resourceItems'][$key]['quantity'] += $data['quantity'];
                $isUpdated = true;
            }
        }

        if (!$isUpdated && $program['data']['beneficiaries_available'] != $totalFarmers) {
            $_SESSION['resourceItems'][] = $data;
        }

        if ($program['data']['beneficiaries_available'] < $totalFarmers) {
            break;
        }
    }

    redirect('distribution-multiple-add.php', 200, 'Farmers added');
}


if (isset($_POST['saveItem'])) {

    $user_id = isset($_SESSION['LoggedInUser']['id']) ? $_SESSION['LoggedInUser']['id'] : 0;
    $modifiedAt = date('Y-m-d h:i:s A');

    if (empty($_SESSION['resourceItems'])) {
        redirect('distribution-multiple-add.php', 404, 'Nothing Found');
        return;
    }

    if (count($_SESSION['resourceItems']) > $_SESSION['resourceItems'][0]['program_available_beneficiaries']) {
        redirect('distribution-multiple-add.php', 404, 'Please lower the number of beneficiaries to continue.');
        exit;
    }

    $farmerCountByProgram = [];

    foreach ($_SESSION['resourceItems'] as $entry) {
        $program_id = $entry["program_id"];
        $farmer_id = $entry["farmer_id"];

        if (!isset($farmerCountByProgram[$program_id])) {
            $farmerCountByProgram[$program_id] = [];
        }

        $farmerCountByProgram[$program_id][$farmer_id] = 1;
    }

    $result = [];
    foreach ($farmerCountByProgram as $program_id => $farmers) {
        $result[] = [
            'program_id' => $program_id,
            'farmer_count' => count($farmers)
        ];
    }

    foreach ($result as $item) {
        $updateQuery = "UPDATE programs SET beneficiaries_available = beneficiaries_available - ? WHERE id = ?";
        if ($updateStmt = mysqli_prepare($conn, $updateQuery)) {
            mysqli_stmt_bind_param(
                $updateStmt,
                'ii',
                $item['farmer_count'],
                $item['program_id']
            );

            if (!mysqli_stmt_execute($updateStmt)) {
                mysqli_stmt_close($updateStmt);
                redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
                return;
            }

            mysqli_stmt_close($updateStmt);
        } else {
            redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
            return;
        }
    }

    foreach ($_SESSION['resourceItems'] as $item) {
        $query = "INSERT INTO distributions (
            farmer_id,  
            program_id, 
            resource_id,
            quantity_distributed,
            distribution_date
        ) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param(
                $stmt,
                'iiids',
                $item['farmer_id'],
                $item['program_id'],
                $item['resource_id'],
                $item['quantity'],
                $modifiedAt
            );

            if (!mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
                return;
            }

            addFpsCode('distributions', $stmt->insert_id, $item['brgy']);
            if (!insertActivityLog($stmt->insert_id, $user_id, 'distributions', 'DISTRIBUTE', 'farmers')) {
                mysqli_stmt_close($stmt);
                redirect('programs-list.php', 500, 'Something Went Wrong');
                return;
            }

            $updateQuery = "UPDATE resources SET quantity_available = quantity_available - ? WHERE id = ?";
            if ($updateStmt = mysqli_prepare($conn, $updateQuery)) {
                mysqli_stmt_bind_param(
                    $updateStmt,
                    'dd',
                    $item['quantity'],
                    $item['resource_id']
                );

                if (!mysqli_stmt_execute($updateStmt)) {
                    mysqli_stmt_close($updateStmt);
                    mysqli_stmt_close($stmt);
                    redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
                    return;
                }

                mysqli_stmt_close($updateStmt);
            } else {
                mysqli_stmt_close($stmt);
                redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
                return;
            }

            mysqli_stmt_close($stmt);
        } else {
            redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
            return;
        }
    }

    unset($_SESSION['resourceItems']);
    redirect('distribution-multiple-add.php', 200, 'Successfully Distributed');
}

$paramResult = checkParamId('index');
if (is_numeric($paramResult)) {

    $indexValue = validate($paramResult);
    if (isset($_SESSION['resourceItems'])) {

        $farmer_id_to_remove = $indexValue;

        foreach ($_SESSION['resourceItems'] as $key => $item) {
            if (isset($item['farmer_id']) && $item['farmer_id'] == $farmer_id_to_remove) {
                unset($_SESSION['resourceItems'][$key]);
                break;
            }
        }

        redirect('distribution-multiple-add.php', 200, 'Removed');
    } else {

        redirect('distribution-multiple-add.php', 404, 'Not Found');
    }
}

if(checkParamId('clear')){
    unset($_SESSION['resourceItems']);
    redirect('distribution-multiple-add.php', 200, 'Removed');
}
