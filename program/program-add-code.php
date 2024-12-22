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
// Database connection
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "baliwag_agriculture_office"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Decode JSON data
if (isset($_POST['program_data'])) {
    $data = json_decode($_POST['program_data'], true);
?>
<script>
    console.log(<?php echo json_encode($data);?>);
</script>
<?php
    $user_id = 0;
    $programId = isset($data[0]['program']['program_id']) ? $data[0]['program']['program_id'] : null;
    date_default_timezone_set('Asia/Taipei');
    $modifiedAt =  date('Y-m-d h:i:s A');

    if (!isset($programId) &&isset($data[0]['program'])) {
        $program = $data[0]['program'];
        $sql = "INSERT INTO programs (
        program_name, 
        program_type, 
        description, 
        start_date, 
        end_date, 
        total_beneficiaries,
        beneficiaries_available, 
        sourcing_agency, 

        modified_by,
        modified_at
        )VALUES (?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?
        )";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            echo "Error preparing program insert query: " . $conn->error;
            exit;
        }
        
        $stmt->bind_param("sssssiisss", 
        $program['nameOfProgram'], 
        $program['programType'], 
        $program['description'], 
        $program['startDate'], 
        $program['endDate'], 
        $program['totalBeneficiaries'], 
        $program['totalBeneficiaries'], 
        $program['sourcingAgency'], 
        $user_id,
        $modifiedAt
    );
        
        if ($stmt->execute()) {
            $programId = $stmt->insert_id;
        } else {
            echo "Error executing program insert query: " . $stmt->error;
            exit;
        }
    }

    if (isset($programId) && isset($data[0]['program'])) {
        $program = $data[0]['program'];
        $sql = "UPDATE programs SET
            program_name = ?, 
            program_type = ?, 
            description = ?, 
            start_date = ?, 
            end_date = ?, 
            total_beneficiaries = ?, 
            beneficiaries_available = ?, 
            sourcing_agency = ?, 

            modified_by = ?, 
            modified_at = ?
            WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            echo "Error preparing program update query: " . $conn->error;
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
            
            $user_id,
            $modifiedAt,
            $programId 
        );
    
        // Execute the query
        if ($stmt->execute()) {
            echo '<div style="position: fixed; top: 80px; right: 20px; padding: 10px 20px; background-color: yellow; color: black; font-size: 16px; border-radius: 5px;">Program updated successfully!</div>';
        } else {
            echo "Error executing farmer update query: " . $stmt->error;
            exit;
        }
    }
    
    
    // Insert resources data
    foreach ($data as $item) {

    if (isset($item['resources'])) {
        $resources = $item['resources'];

        if (!isset($resources['resources_id'])) {


            $sql = "INSERT INTO resources (
                      program_id,
                      resources_name,
                      resource_type, 
                      total_quantity, 
                      quantity_available,
                      unit_of_measure,

                      modified_by,
                      modified_at
                  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
            $stmt = $conn->prepare($sql);
            
            if ($stmt === false) {
                echo "Error preparing resources insert query: " . $conn->error;
                exit;
            }
    
            $stmt->bind_param(
                "issiisis",
                $programId,
                $resources['resourcesName'],
                $resources['resourcesType'],
                $resources['resourcesNumber'],
                $resources['resourcesNumber'],
                $resources['unitOfMeasure'],

                $user_id,
                $modifiedAt
            );
            
           $stmt->execute();
        }

        // echo $resources['resources_id'];

        if (isset($resources['resources_id'])) {
        
            $sql = "UPDATE resources SET

                        program_id = ?, 
                        resources_name = ?, 
                        resource_type = ?, 
                        total_quantity = ?, 
                        quantity_available = ?, 
                        unit_of_measure = ?,

                        modified_by = ?, 
                        modified_at = ?
                    WHERE id = ?"; 
        
            $stmt = $conn->prepare($sql);
        
            if ($stmt === false) {
                echo "Error preparing parcel update query: " . $conn->error;
                exit;
            }
        
            // Bind parameters for the update query
            $stmt->bind_param(
                "issiisisi", 
                $programId,
                $resources['resourcesName'],
                $resources['resourcesType'],
                $resources['resourcesNumber'],
                $resources['resourcesAvailable'],
                $resources['unitOfMeasure'],

                $user_id,
                $modifiedAt,
                $resources['resources_id']
            );
        
            // Execute the query
            if ($stmt->execute()) {
                // Parcel updated successfully
                echo '<div style="position: fixed; top: 140px; right: 20px; padding: 10px 20px; background-color: yellow; color: black; font-size: 16px; border-radius: 5px;">Resources updated successfully!</div>';
                
            } else {
                echo "Error executing resources update query: " . $stmt->error;
                exit;
            }
        }
    }   
    }
    
    echo '<div style="position: fixed; top: 20px; right: 20px; padding: 10px 20px; background-color: green; color: white; font-size: 16px; border-radius: 5px;">Data inserted successfully!</div>';
    

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
