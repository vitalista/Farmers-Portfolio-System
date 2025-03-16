<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" style="display: flex;">
        <div class="farmer" style="margin-right: 50px;">

        </div>
        <div class="parcel" style="margin-right: 50px; background-color: #E8E8E8; padding: 20px;">

        </div>
        <div class="crop" style="margin-right: 50px;">

        </div>
        <div class="livestock" style="margin-right: 50px; background-color: #E8E8E8; padding: 20px;">

        </div>
    </div>
<div class="unsorted">
<?php
include '../backend/functions.php';
// Decode JSON data
if (isset($_POST['program_data'])) {
    $data = json_decode($_POST['program_data'], true);
?>
<!-- <script>
    console.log(<?//php echo json_encode($data);?>);
</script> -->
<?php
    $user_id = isset($_SESSION['LoggedInUser']['id']) ? $_SESSION['LoggedInUser']['id'] : 0;
    $programId = isset($data[0]['program']['program_id']) ? $data[0]['program']['program_id'] : null;
    date_default_timezone_set('Asia/Taipei');

    if (!isset($programId) &&isset($data[0]['program'])) {
        $program = $data[0]['program'];
        
        $filteredFarmer = array_filter($program, function($value) {
            return !empty($value);
        });
    
        $requiredFields = [
            'nameOfProgram', 
            'programType', 
            'startDate', 
            'endDate', 
            'totalBeneficiaries', 
            'totalBeneficiaries', 
            'sourcingAgency'
            ];
    
        foreach ($requiredFields as $field) {
            if (!isset($filteredFarmer[$field]) || empty($filteredFarmer[$field])) {
                redirect('program-add.php', 404, 'Please fill in all required fields.');
                exit;
            }
        }

        $sql = "INSERT INTO programs (
        program_name, 
        program_type, 
        description, 
        start_date, 
        end_date, 
        total_beneficiaries,
        beneficiaries_available,
        sourcing_agency,
        color
        )VALUES (?, ?, ?, ?, ?, ?,
        ?, ?, ?
        )";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            echo "Error preparing program insert query: " . $conn->error;
            redirect('programs-list.php', 500, 'Something Went Wrong');
            exit;
        }
        
        $stmt->bind_param("sssssiiss", 
        $program['nameOfProgram'], 
        $program['programType'], 
        $program['description'], 
        $program['startDate'], 
        $program['endDate'], 
        $program['totalBeneficiaries'], 
        $program['totalBeneficiaries'], 
        $program['sourcingAgency'], 
        $program['programColor']
    );
        
        if ($stmt->execute()) {
            $programId = $stmt->insert_id;
            addFpsCode('programs', $programId);
            if (!insertActivityLog($programId, $user_id, 'programs', 'INSERT')) {
                redirect('programs-list.php', 500, 'Something Went Wrong');
                exit;
            }
        } else {
            echo "Error executing program insert query: " . $stmt->error;
            redirect('programs-list.php', 500, 'Something Went Wrong');
            exit;
        }
    }

    if (isset($programId) && isset($data[0]['program']) && isset($data[0]['program']['program_id'])) {
        $program = $data[0]['program'];

        $filteredFarmer = array_filter($program, function($value) {
            return !empty($value);
        });
        
        $requiredFields = [
            'nameOfProgram', 
            'programType', 
            'startDate', 
            'endDate', 
            'totalBeneficiaries', 
            'totalBeneficiaries', 
            'sourcingAgency'
            ];
    
        foreach ($requiredFields as $field) {
            if (!isset($filteredFarmer[$field]) || empty($filteredFarmer[$field])) {
                redirect('program-view.php?id='.$programId, 404, 'Please fill in all required fields.');
                exit;
            }
        }

         
        $modifiedTimes;
        $checkId = getById('programs', $programId);
        if($checkId['status']== 200){
            $modifiedTimes = $checkId['data']['modified_times'] + 1;
        }

                     
        $changeKeyName = [
            'nameOfProgram' => 'program_name',
            'programType' => 'program_type',
            'startDate' => 'start_date',
            'endDate' => 'end_date',
            'totalBeneficiaries' => 'total_beneficiaries',
            'beneficiaries' => 'beneficiaries_available',
            'sourcingAgency' => 'sourcing_agency'
              ];
  
          $dbrecord= getRecordsById('programs', $programId, ['id', 'modified_times', 'is_archived', 'created_at', 'updated_at', 'fps_code']);
          $userRecord = removeAndCustomizeKeys($program, ['program_id'], $changeKeyName);

        //   echo '<pre>';
        //   print_r($dbrecord);
        //   print_r($userRecord);
        //   print_r(compareArrays($dbrecord, $userRecord));
        //   echo '</pre>';

          if (!compareArrays($dbrecord, $userRecord)){
             if (!insertActivityLog($programId, $user_id, 'programs', 'UPDATE')) {
                redirect('programs-list.php', 500, 'Something Went Wrong');
                exit;
            }
          }

        $sql = "UPDATE programs SET
            program_name = ?, 
            program_type = ?, 
            description = ?, 
            start_date = ?, 
            end_date = ?, 
            total_beneficiaries = ?, 
            beneficiaries_available = ?, 
            sourcing_agency = ?, 
            modified_times = ?,
            color = ?

            WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            echo "Error preparing program update query: " . $conn->error;
            redirect('programs-list.php', 500, 'Something Went Wrong');
            exit;
        }
    
        // Bind the parameters
        $stmt->bind_param("sssssiisisi", 
            $program['nameOfProgram'], 
            $program['programType'], 
            $program['description'], 
            $program['startDate'], 
            $program['endDate'], 
            $program['totalBeneficiaries'], 
            $program['beneficiaries'], 
            $program['sourcingAgency'], 
            $modifiedTimes,
            $program['programColor'], 
            $programId 
        );
    
        // Execute the query
        if (!$stmt->execute()){
            echo "Error executing farmer update query: " . $stmt->error;
            redirect('programs-list.php', 500, 'Something Went Wrong');
            exit;
        }
    }
    
    
    // Insert resources data
    foreach ($data as $item) {

    if (isset($item['resources'])) {
        $resources = $item['resources'];

        $filteredFarmer = array_filter($resources, function($value) {
            return !empty($value);
        });
        
        $requiredFields = [
            'resourcesName',
            'resourcesType',
            'resourcesNumber',
            'unitOfMeasure'
            ];
    
        foreach ($requiredFields as $field) {
            if (!isset($filteredFarmer[$field]) || empty($filteredFarmer[$field])) {
                redirect('program-view.php?id='.$programId, 404, 'Please fill in all required fields.');
                exit;
            }
        }

        if (!isset($resources['resources_id'])) {


            $sql = "INSERT INTO resources (
                      program_id,
                      resources_name,
                      resource_type, 
                      total_quantity, 
                      quantity_available,
                      unit_of_measure
                  ) VALUES (?, ?, ?, ?, ?, ?)";
    
            $stmt = $conn->prepare($sql);
            
            if ($stmt === false) {
                echo "Error preparing resources insert query: " . $conn->error;
                redirect('programs-list.php', 500, 'Something Went Wrong');
                exit;
            }
    
            $stmt->bind_param(
                "issiis",
                $programId,
                $resources['resourcesName'],
                $resources['resourcesType'],
                $resources['resourcesNumber'],
                $resources['resourcesNumber'],
                $resources['unitOfMeasure'],
            );
            
           if($stmt->execute()){
            addFpsCode('resources', $stmt->insert_id);
            if (!insertActivityLog($stmt->insert_id, $user_id, 'resources', 'INSERT', 'programs')) {
                redirect('programs-list.php', 500, 'Something Went Wrong');
                exit;
            }

            } else {
            echo "Error executing resources update query: " . $stmt->error;
            redirect('programs-list.php', 500, 'Something Went Wrong');
            exit;
            }
        }

        // echo $resources['resources_id'];

        if (isset($resources['resources_id'])) {

            $modifiedTimes;
            $checkId = getById('resources', $resources['resources_id']);
            if($checkId['status']== 200){
                $modifiedTimes = $checkId['data']['modified_times'] + 1;
            }

            $changeKeyName = [
                'resourcesName' => 'resources_name',
                'unitOfMeasure' => 'unit_of_measure',
                'resourcesType' => 'resource_type',
                'resourcesAvailable' => 'quantity_available',
                'resourcesNumber' => 'total_quantity',
                  ];
      
              $dbrecord= getRecordsById('resources', $resources['resources_id'], ['id', 'modified_times', 'program_id','is_archived', 'created_at', 'updated_at', 'fps_code']);
              $userRecord = removeAndCustomizeKeys($resources, ['program_id', 'resources_id'], $changeKeyName);
    
            //   echo '<pre>';
            //   print_r($dbrecord);
            //   print_r($userRecord);
            //   print_r(compareArrays($dbrecord, $userRecord));
            //   echo '</pre>';
    
              if (!compareArrays($dbrecord, $userRecord)){
               if (!insertActivityLog($resources['resources_id'], $user_id, 'resources', 'UPDATE', 'programs')) {
                    redirect('programs-list.php', 500, 'Something Went Wrong');
                    exit;
                }
              }    
        
            $sql = "UPDATE resources SET

                        program_id = ?, 
                        resources_name = ?, 
                        resource_type = ?, 
                        total_quantity = ?, 
                        quantity_available = ?, 
                        unit_of_measure = ?,
                        modified_times = ?
                    WHERE id = ?"; 
        
            $stmt = $conn->prepare($sql);
        
            if ($stmt === false) {
                echo "Error preparing parcel update query: " . $conn->error;
                redirect('programs-list.php', 500, 'Something Went Wrong');
                exit;
            }
        
            // Bind parameters for the update query
            $stmt->bind_param(
                "issiisii", 
                $programId,
                $resources['resourcesName'],
                $resources['resourcesType'],
                $resources['resourcesNumber'],
                $resources['resourcesAvailable'],
                $resources['unitOfMeasure'],
                $modifiedTimes,
                $resources['resources_id']
            );
        
            // Execute the query
            if (!$stmt->execute()){
                echo "Error executing resources update query: " . $stmt->error;
                redirect('programs-list.php', 500, 'Something Went Wrong');
                exit;
            }
        }
    }   
    }
    
    if(isset($_POST['add']) && $_POST['add'] == 0){
        redirect('programs-list.php', 200, 'Program Successfully Inserted');
    }

    if(isset($_POST['update']) && $_POST['update'] == 1){
        redirect('programs-list.php', 200, 'Program Successfully Updated');
    }
    

    if ($data) {
    foreach ($data as $item) {
        if (isset($item['program'])) {
            echo '<div class="farmer"><h3>Program Information:</h3>';
            echo '<pre style="color: green; font-weight: bold;">';
            print_r($item['program']);
            echo '</pre></div>';
        }

        if (isset($item['resources'])) {
            echo '<div class="parcel"><h3>Resources Information:</h3>';
            echo '<pre style="color: red; font-weight: bold;">';
            print_r($item['resources']);
            echo '</pre></div>';
        }
    }
} else {
    echo "Failed to decode JSON data.";
}

    $conn->close();
}
// Check if decoding was successful

?>
</div>
</body>
</html>

<!-- ======================================== Format JSON ======================================== -->
<script>
    // Get the container with the unsorted divs
let container = document.querySelector('.unsorted'); // Replace with your container selector

// Get the new parent div where matching divs will be appended
let farmer = document.querySelector('.farmer');
let parcel = document.querySelector('.parcel');

let divs = container.querySelectorAll('div');
divs.forEach(function(div) {
  if (div.className === 'farmer') {
    farmer.appendChild(div);
  }

  if (div.className === 'parcel') {
    parcel.appendChild(div);
  }

});

</script>
