<?php
// Include necessary files or database connections
require_once '../backend/functions.php';

// Check if the form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize the input data

    $distributionId = isset($_POST['id']) ? $_POST['id'] : null;
    $distributions = [];
    $farmerId = isset($_POST['farmer_id']) ? (int) $_POST['farmer_id'] : null;
    $resourcesId = isset($_POST['resources_id']) ? (int) $_POST['resources_id'] : null;
    $programId = isset($_POST['program_id']) ? (int) $_POST['program_id'] : null;
    $quantityDistributed = isset($_POST['quantity_distributed']) ? (int) $_POST['quantity_distributed'] : null;
    $distributionDate = isset($_POST['distribution_date']) ? $_POST['distribution_date'] : null;
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : null;

    $distributions['farmer_id'] = $farmerId;
    $distributions['resource_id'] = $resourcesId;
    $distributions['program_id'] = $programId;
    $distributions['quantity_distributed'] = $quantityDistributed;
    $distributions['distribution_date'] = $distributionDate;
    $distributions['remarks'] = $remarks;

    // Check if all required fields are provided
    if ($farmerId && $resourcesId && $programId && $quantityDistributed && $distributionDate) {
        // Update the distribution in the database (Assuming a function `updateDistribution` exists)

        $checkId = getById('distributions', $_POST['id']);
        if($checkId['status'] > 200){
            redirect('distributions-list.php', 500, 'Something Went Wrong');
        }
        $modifiedTimes = $checkId['data']['modified_times'];

        $user_id = isset($_SESSION['LoggedInUser']['id']) ? $_SESSION['LoggedInUser']['id'] : 0;
        $modifiedAt =  date('Y-m-d h:i:s A');

        
          $changeKeyName = [];
          $dbrecord= getRecordsById('distributions', $distributionId, ['id', 'modified_times', 'is_archived', 'created_at', 'updated_at', 'fps_code']);
          $userRecord = removeAndCustomizeKeys($distributions, ['id'], $changeKeyName);

          echo '<pre>';
          print_r($dbrecord);
          print_r($userRecord);
          print_r(compareArrays($dbrecord, $userRecord));
          echo '</pre>';

          if (!compareArrays($dbrecord, $userRecord)){
            $modifiedTimes += 1;
           if (!insertActivityLog($distributionId, $user_id, 'distributions', 'EDIT DISTRIBUTION', 'farmers')) {
                echo "Error inserting log entry.";
                redirect('distributions-list.php', 500, 'Something Went Wrong');
                exit;
            }
          }   

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

        if (!$stmt->execute()) {
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