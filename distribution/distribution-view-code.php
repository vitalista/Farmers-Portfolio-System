<?php
// Include necessary files or database connections
require_once '../backend/functions.php';

// Check if the form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize the input data

    $distributionId = isset($_POST['id']) ? $_POST['id'] : null;

    $farmerId = isset($_POST['farmer_id']) ? $_POST['farmer_id'] : null;
    $resourcesId = isset($_POST['resources_id']) ? $_POST['resources_id'] : null;
    $programId = isset($_POST['program_id']) ? $_POST['program_id'] : null;
    $quantityDistributed = isset($_POST['quantity_distributed']) ? $_POST['quantity_distributed'] : null;
    $distributionDate = isset($_POST['distribution_date']) ? $_POST['distribution_date'] : null;
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : null;

    // Check if all required fields are provided
    if ($farmerId && $resourcesId && $programId && $quantityDistributed && $distributionDate) {
        // Update the distribution in the database (Assuming a function `updateDistribution` exists)

        $modifiedTimes;
        $checkId = getById('distributions', $_POST['id']);
        if($checkId['status']== 200){
            $modifiedTimes = $checkId['data']['modified_times'] + 1;
        }

        $user_id = isset($_SESSION['LoggedInUser']['id']) ? $_SESSION['LoggedInUser']['id'] : 0;
        $modifiedAt =  date('Y-m-d h:i:s A');

        $updateQuery = "UPDATE distributions SET 
                        farmer_id = ?, 
                        resource_id = ?, 
                        program_id = ?, 
                        quantity_distributed = ?, 
                        distribution_date = ?,
                        remarks = ?,
                        modified_times = ?
                        WHERE id = ?";

        // Prepare and execute the SQL query
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("iiisssii", $farmerId, $resourcesId, $programId, $quantityDistributed, $distributionDate, 
        $remarks,
        $modifiedTimes,
        $distributionId);

        if ($stmt->execute()) {
            echo "<h5>Distribution updated successfully.</h5>";
        } else {
            echo "<h5>Error updating distribution. Please try again later.</h5>";
        }

        $stmt->close();
    } else {
        echo "<h5>All fields are required. Please fill in all fields.</h5>";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo '<h2>Submitted POST Data:</h2>';
        
        // Loop through and echo all POST values
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }

 redirect('distribution-view.php?id='.$_POST['id'], 200, 'Successfully Updated');

}

?>