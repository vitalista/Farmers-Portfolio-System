<?php
include '../backend/functions.php';

// Initialize session variables if they are not set
if (!isset($_SESSION['resourceItemIds'])) {
    $_SESSION['resourceItemIds'] = [];
}
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
                redirect('', 'Only ' . $row['quantity_available'] . ' quantity available');
            } else {
                $program = getById('programs', $row['program_id']);

                // Initialize the resource data
                if ($program['status'] == 200) {
                    $resourceData = [
                        'farmer_id' => $farmerId,
                        'ffrs_code' => $farmer['ffrs_system_gen'],
                        'farmer_name' => $farmer['first_name'].' '.$farmer['last_name'],
                        'program' => $program['data']['program_name'],
                        'program_total_beneficiaries' => $program['data']['total_beneficiaries'],
                        'program_available_beneficiaries' => $program['data']['beneficiaries_available'],
                        'quantity' => $quantity,
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
                if (!in_array($row['id'], $_SESSION['resourceItemIds'])) {
                    // Add new resource to session
                    array_push($_SESSION['resourceItemIds'], $row['id']);
                    array_push($_SESSION['resourceItems'], $resourceData);
                } else {
                    // Update existing resource quantity in session
                    foreach ($_SESSION['resourceItems'] as $key => $sessItem) {
                        if (isset($sessItem['resource_id']) && $sessItem['resource_id'] == $row['id']) {
                            // Update the resource quantity
                            $newQuantity = $sessItem['quantity'] + $quantity;
                            $resourceData['quantity'] = $newQuantity; // Set the new quantity

                            // Update the session item
                            $_SESSION['resourceItems'][$key] = $resourceData;
                            break; // Exit the loop once updated
                        }
                    }
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
                redirect('', 'Resource added: ' . $row['resources_name']);
            }
        } else {
            redirect('', 'No Resource Found');
        }
    } else {
        redirect('', 'Something Went Wrong');
    }
}
?>
