<?php
include '../backend/functions.php';

if (!isset($_SESSION['resourceItems'])) {
    $_SESSION['resourceItems'] = [];
}

if (isset($_POST['addItem'])) {
    // Get the data from the form submission
    $farmerId = validate($_POST['farmer_id']);
    $resourcesId = validate($_POST['resources_id']);
    $quantity = validate($_POST['quantity']);

    // Check if the resource exists for the given farmer
    $checkResource = mysqli_query($conn, "SELECT * FROM resources WHERE id='$resourcesId' LIMIT 1");
    $checkReFarmer = mysqli_query($conn, "SELECT * FROM farmers WHERE id='$farmerId' LIMIT 1");

    if ($checkResource && $checkReFarmer) {
        if (mysqli_num_rows($checkResource) > 0) {
            $row = mysqli_fetch_assoc($checkResource);
            $farmer = mysqli_fetch_assoc($checkReFarmer);

            // Check if the available quantity is sufficient
            if ($row['quantity_available'] < $quantity) {
                redirect('distribution-multiple-add.php', 404, 'Only ' . $row['quantity_available'] . ' quantity available');
            } else {
                $program = getById('programs', $row['program_id']);

                // Initialize the resource data
                if ($program['status'] == 200) {
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
                        'resource_id' => $row['id'], // Add resource_id to ensure consistency
                    ];
                }

                // Debug: Print the resource data
                echo '<pre>';
                print_r($resourceData); // This will print all resource data before adding to the session
                echo '</pre>';

                // Check if the resource is already in the session
                $resourceExists = false;
                foreach ($_SESSION['resourceItems'] as $key => $sessItem) {
                    if (isset($sessItem['resource_id']) && $sessItem['resource_id'] == $row['id'] && $sessItem['farmer_id'] == $farmerId) {
                        // Update existing resource quantity in session
                        $newQuantity = $sessItem['quantity'] + $quantity;
                        $resourceData['quantity'] = $newQuantity; // Set the new quantity

                        // Update the session item
                        $_SESSION['resourceItems'][$key] = $resourceData;
                        $resourceExists = true;
                        break; // Exit the loop once updated
                    }
                }

                // If resource does not exist, add it to the session
                if (!$resourceExists) {
                    array_push($_SESSION['resourceItems'], $resourceData);
                }

                // Redirect with success message
                // First, print session data and log it to the console
                echo '<pre>';
                echo 'Session Resource Data: ';
                print_r($_SESSION['resourceItems']); // This will print all session resource items
                echo '</pre>';

                // Add JavaScript to log session data to the console
                echo '<script>';
                echo 'console.log("Session Resource Data:", ' . json_encode($_SESSION['resourceItems']) . ');'; // Log session resource data in console
                echo '</script>';

                // Now perform the redirect
                redirect('distribution-multiple-add.php', 200, 'Farmer added');
            }
        } else {
            redirect('distribution-multiple-add.php', 404, 'No Item Found');
        }
    } else {
        redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
    }
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

if (isset($_POST['addItems'])) {

    // Ensure the POST data is not empty
    if (empty($_POST)) {
        return;  // Exit early if no POST data
    }

    // Debugging: Print POST data
    foreach ($_POST as $key => $value) {
        echo "Key: " . $key . " - Value: " . $value . "<br>";
    }

    // Validate input fields
    $farmerAddComparison = validate($_POST['farmerAddComparison']);
    $farmerAdd = validate($_POST['farmerAdd']);
    $resourcesId = validate($_POST['resources_id']);
    $quantity = validate($_POST['quantity']);

    // Initialize an empty array for resource data
    $resourceData = [];

    // Check if the resource exists
    $checkResource = mysqli_query($conn, "SELECT * FROM resources WHERE id='$resourcesId' LIMIT 1");
    if (!$checkResource || mysqli_num_rows($checkResource) == 0) {
        redirect('distribution-multiple-add.php', 404, 'No Resource Found');
        return;  // Early return if no resource is found
    }
    $row = mysqli_fetch_assoc($checkResource);  // Get resource data

    // Check if farmers exist based on the provided comparison
    $checkReFarmers = mysqli_query($conn, "SELECT * FROM farmers WHERE $farmerAddComparison LIKE '$farmerAdd'");
    if (!$checkReFarmers || mysqli_num_rows($checkReFarmers) == 0) {
        redirect('distribution-multiple-add.php', 404, 'No Farmers Found');
        return;  // Early return if no farmers found
    }

    // Store the farmers in an array
    $farmers = [];
    while ($farmer = mysqli_fetch_assoc($checkReFarmers)) {
        $farmers[] = $farmer;
    }

    // Check available quantity
    if ($row['quantity_available'] < $quantity) {
        redirect('distribution-multiple-add.php', 404, 'Only ' . $row['quantity_available'] . ' quantity available');
        return;  // Early return if quantity is insufficient
    }

    // Get the program data
    $program = getById('programs', $row['program_id']);
    if ($program['status'] != 200) {
        redirect('distribution-multiple-add.php', 500, 'Program not found');
        return;  // Early return if program is invalid
    }

    // Calculate how many times we can distribute the resource
    $quotient = floor($row['quantity_available'] / $quantity);
    if ($quotient <= 0) {
        redirect('distribution-multiple-add.php', 404, 'Insufficient resource quantity for distribution');
        return;  // Early return if distribution is not possible
    }

    // Limit the number of farmers to the quotient value (the number of distributions possible)
    $farmersToDistribute = array_slice($farmers, 0, $quotient);

    // Process each selected farmer and add resource data
    foreach ($farmersToDistribute as $farmer) {
        // Add farmer and resource info to the resource data array
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

    // Debugging: Output farmers and resource data
    // echo '<pre>';
    // print_r($farmersToDistribute);
    // echo '</pre>';

    // echo '<pre>';
    // print_r($resourceData);
    // echo '</pre>';

    // Store resource data in session
    foreach ($resourceData as $data) {
        $_SESSION['resourceItems'][] = $data;
    }

    redirect('distribution-multiple-add.php', 200, 'Farmers added');

    // Debugging: Log session data to the console
    // echo '<script>';
    // echo 'console.log("Session Resource Data:", ' . json_encode($_SESSION['resourceItems']) . ');';
    // echo '</script>';
    // Redirect to success page
}


if (isset($_POST['saveItem'])) {

    $user_id = isset($_SESSION['LoggedInUser']['id']) ? $_SESSION['LoggedInUser']['id'] : 0;
    $modifiedAt =  date('Y-m-d h:i:s A');

    if (!empty($_SESSION['resourceItems']) && isset($_SESSION['resourceItems'])) {
        // echo '<pre>';
        // echo print_r($_SESSION['resourceItems']);
        // echo '</pre>';
        
        
        $farmerCountByProgram = [];

        foreach ($_SESSION['resourceItems'] as $entry) {
            $program_id = $entry["program_id"];
            $farmer_id = $entry["farmer_id"];
            
            // If program_id does not exist yet, initialize it as an empty array
            if (!isset($farmerCountByProgram[$program_id])) {
                $farmerCountByProgram[$program_id] = [];
            }
            
            // Add farmer_id to the program_id array (avoiding duplicates for each program)
            $farmerCountByProgram[$program_id][$farmer_id] = 1; // Use '1' to indicate farmer presence
        }
        
        // Prepare the result as an array of associative arrays
        $result = [];
        foreach ($farmerCountByProgram as $program_id => $farmers) {
            $result[] = [
                'program_id' => $program_id,
                'farmer_count' => count($farmers) // Count unique farmers
            ];
        }
        
        // Output the result for debugging purposes
        // echo '<pre>';
        // print_r($result);
        // echo '</pre><br>';
        
        // Iterate through the result to update each program
        foreach ($result as $item) {
            $updateQuery = "UPDATE programs SET beneficiaries_available = beneficiaries_available - ? WHERE id = ?";
            if ($updateStmt = mysqli_prepare($conn, $updateQuery)) {
                mysqli_stmt_bind_param(
                    $updateStmt,
                    'ii',
                    $item['farmer_count'], // Quantity to subtract
                    $item['program_id'] // Resource ID to update
                );
        
                // Execute the update query
                if (mysqli_stmt_execute($updateStmt)) {
                    echo "Program total quantity successfully updated.<br>";
                    // redirect('distribution-multiple-add.php', 200, 'Distribution Successfully Added');
                } else {
                    echo "Error updating resource quantity: " . mysqli_error($conn) . "<br>";
                    redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
                }
                // Close the update statement
                mysqli_stmt_close($updateStmt);
            }
        }
        
        // Assuming $_SESSION['resourceItems'] is already populated
        foreach ($_SESSION['resourceItems'] as $item) {

            // Prepare the SQL query to insert each item into the table
            $query = "INSERT INTO distributions (
            farmer_id,  
            program_id, 
            resource_id,
            quantity_distributed,
            distribution_date
            )
              VALUES (?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param(
                    $stmt,
                    'iiiis',
                    $item['farmer_id'],
                    $item['program_id'],
                    $item['resource_id'],
                    $item['quantity'],
                    $modifiedAt
                );

                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "Item successfully inserted into the database.<br>";
                    addFpsCode('distributions', $stmt->insert_id, $item['brgy']);
                    if (!insertActivityLog($stmt->insert_id, $user_id, 'distributions', 'DISTRIBUTE', 'farmers')) {
                        redirect('programs-list.php', 500, 'Something Went Wrong');
                        exit;
                    }

                    // redirect('distribution-multiple-add.php', 200, 'Distribution Successfully Added');
                    // Now update the resource's quantity by subtracting the distributed quantity
                    $updateQuery = "UPDATE resources SET quantity_available = quantity_available - ? WHERE id = ?";
                    if ($updateStmt = mysqli_prepare($conn, $updateQuery)) {
                        mysqli_stmt_bind_param(
                            $updateStmt,
                            'ii',
                            $item['quantity'], // Quantity to subtract
                            $item['resource_id'] // Resource ID to update
                        );

                        // Execute the update query
                        if (mysqli_stmt_execute($updateStmt)) {
                            echo "Resource quantity successfully updated.<br>";
                            // redirect('distribution-multiple-add.php', 200, 'Distribution Successfully Added');
                        } else {
                            echo "Error updating resource quantity: " . mysqli_error($conn) . "<br>";
                            redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
                        }
                        // Close the update statement
                        mysqli_stmt_close($updateStmt);
                    } else {
                        echo "Error preparing the update query: " . mysqli_error($conn) . "<br>";
                        redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
                    }
                } else {
                    echo "Error inserting item: " . mysqli_error($conn) . "<br>";
                    redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
                }

                // Close the prepared statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing the query: " . mysqli_error($conn) . "<br>";
                redirect('distribution-multiple-add.php', 500, 'Something Went Wrong');
            }
        }

        // sleep(5);
        unset($_SESSION['resourceItems']);
        if (empty($_SESSION['resourceItems'])) {
            redirect('distribution-multiple-add.php', 200, 'Successfully Distributed');
        }
    } else {
        redirect('distribution-multiple-add.php', 404, 'Nothing Found');
    }
}
