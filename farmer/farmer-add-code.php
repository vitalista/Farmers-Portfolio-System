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
if (isset($_POST['farms_data'])) {
    $data = json_decode($_POST['farms_data'], true);
?>
<script>
    console.log(<?php echo json_encode($data);?>);
</script>
<?php
    $user_id = 0;
    $farmerId = isset($data[0]['farmer']['farmer_id']) ? $data[0]['farmer']['farmer_id'] : null;
    date_default_timezone_set('Asia/Taipei');
    $modifiedAt =  date('Y-m-d h:i:s A');

    if (!isset($farmerId) &&isset($data[0]['farmer'])) {
        $farmer = $data[0]['farmer'];
        $sql = "INSERT INTO farmers (
        ffrs_system_gen, 
        farmer_brgy_address, 
        farmer_municipality_address, 
        farmer_province_address, 
        first_name, 
        middle_name,
        last_name, 
        ext_name, gender, 
        birthday, 
        is_deceased, 
        is_active,

        modified_by,
        modified_at
        )VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            echo "Error preparing farmer insert query: " . $conn->error;
            exit;
        }
        
        $stmt->bind_param("sssssssssssiis", 
        $farmer['ffrs'], 
        $farmer['brgy'], 
        $farmer['municipality'], 
        $farmer['province'], 
        $farmer['firstName'], 
        $farmer['middleName'], 
        $farmer['lastName'], 
        $farmer['extName'], 
        $farmer['gender'], 
        $farmer['bday'], 
        $farmer['deceased'],
        $farmer['active'],
        $user_id,
        $modifiedAt
    );
        
        if ($stmt->execute()) {
            $farmerId = $stmt->insert_id;
        } else {
            echo "Error executing farmer insert query: " . $stmt->error;
            exit;
        }
    }

    if (isset($farmerId) && isset($data[0]['farmer'])) {
        $farmer = $data[0]['farmer'];
        $sql = "UPDATE farmers SET
            ffrs_system_gen = ?, 
            farmer_brgy_address = ?, 
            farmer_municipality_address = ?, 
            farmer_province_address = ?, 
            first_name = ?, 
            middle_name = ?,
            last_name = ?, 
            ext_name = ?, 
            gender = ?, 
            birthday = ?, 
            is_deceased = ?, 
            is_active = ?, 
            modified_by = ?, 
            modified_at = ?
            WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            echo "Error preparing farmer update query: " . $conn->error;
            exit;
        }
    
        // Bind the parameters
        $stmt->bind_param("sssssssssssiisi", 
            $farmer['ffrs'], 
            $farmer['brgy'], 
            $farmer['municipality'], 
            $farmer['province'], 
            $farmer['firstName'], 
            $farmer['middleName'], 
            $farmer['lastName'], 
            $farmer['extName'], 
            $farmer['gender'], 
            $farmer['bday'], 
            $farmer['deceased'],
            $farmer['active'],
            $user_id,
            $modifiedAt,
            $farmerId  // Pass the farmer ID to identify the record to update
        );
    
        // Execute the query
        if ($stmt->execute()) {
            echo '<div style="position: fixed; top: 80px; right: 20px; padding: 10px 20px; background-color: yellow; color: black; font-size: 16px; border-radius: 5px;">Farmer updated successfully!</div>';
        } else {
            echo "Error executing farmer update query: " . $stmt->error;
            exit;
        }
    }
    
    
    // Insert parcel data
    $parcelIds = []; // Initialize an empty array to store parcelNum and corresponding insert_id.
    foreach ($data as $item) {

    if (isset($item['parcel'])) {
        $parcel = $item['parcel'];

        if (!isset($parcel['parcel_id'])) {


            $sql = "INSERT INTO parcels (
                      farmer_id, 
                      parcel_no, 
                      owner_first_name, 
                      owner_last_name, 
                      ownership_type, 
                      parcel_brgy_address, 
                      parcel_municipality_address, 
                      parcel_province_address, 
                      parcel_area, 
                      farm_type,

                      modified_by,
                      modified_at
                  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                  ?, ?)";
    
            $stmt = $conn->prepare($sql);
            
            if ($stmt === false) {
                echo "Error preparing parcel insert query: " . $conn->error;
                exit;
            }
    
            $stmt->bind_param(
                "iissssssssis",
                $farmerId,
                $parcel['parcelNum'],
                $parcel['ofName'],
                $parcel['olName'],
                $parcel['ownership'],
                $parcel['farmLocationBrgy'],
                $parcel['farmLocationMunicipality'],
                $parcel['farmLocationProvince'],
                $parcel['farmSize'],
                $parcel['farmType'],
                $user_id,
                $modifiedAt
            );
            
            if ($stmt->execute()) {
                $parcelIds[$parcel['parcelNum']] = $stmt->insert_id;
            } else {
                echo "Error executing parcel insert query: " . $stmt->error;
                exit;
            }
        }

        if (isset($parcel['parcel_id'])) {
        
            $sql = "UPDATE parcels SET
                        farmer_id = ?, 
                        parcel_no = ?, 
                        owner_first_name = ?, 
                        owner_last_name = ?, 
                        ownership_type = ?, 
                        parcel_brgy_address = ?, 
                        parcel_municipality_address = ?, 
                        parcel_province_address = ?, 
                        parcel_area = ?, 
                        farm_type = ?, 
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
                "iissssssssisi", 
                $farmerId,
                $parcel['parcelNum'],
                $parcel['ofName'],
                $parcel['olName'],
                $parcel['ownership'],
                $parcel['farmLocationBrgy'],
                $parcel['farmLocationMunicipality'],
                $parcel['farmLocationProvince'],
                $parcel['farmSize'],
                $parcel['farmType'],
                $user_id,
                $modifiedAt,
                $parcel['parcel_id']
            );
        
            // Execute the query
            if ($stmt->execute()) {
                // Parcel updated successfully
                $parcelIds[$parcel['parcelNum']] = $parcel['parcel_id'];
                echo '<div style="position: fixed; top: 140px; right: 20px; padding: 10px 20px; background-color: yellow; color: black; font-size: 16px; border-radius: 5px;">Parcel updated successfully!</div>';
                
            } else {
                echo "Error executing parcel update query: " . $stmt->error;
                exit;
            }
        }
    }   
    }

        
    // Insert crop data
    foreach ($data as $item) {
        if (isset($item['crop'])) {
            if (!isset($item['crop']['crop_id'])) {
                $crop = $item['crop'];
            $parcelId = $parcelIds[$crop['parcelNum']] ?? null;
            if ($parcelId) {
                $sql = "INSERT INTO crops (
                farmer_id, 
                parcel_id, 
                hvc, 
                crop_area, 
                classification,

                modified_by,
                modified_at
                ) VALUES (?, ?, ?, ?, ?,
                ?, ?)";
                $stmt = $conn->prepare($sql);
                
                if ($stmt === false) {
                    echo "Error preparing crop insert query: " . $conn->error;
                    exit;
                }
    
                $stmt->bind_param("iiissis", 
                $farmerId, 
                $parcelId, 
                $crop['hvc'], 
                $crop['cropArea'], 
                $crop['classification'],
                $user_id,
                $modifiedAt
                );
                
                if (!$stmt->execute()) {
                    echo "Error executing crop insert query: " . $stmt->error;
                    exit;
                }
            }
            }

            if (isset($item['crop']['crop_id'])) {
                $crop = $item['crop'];
                $cropId = $crop['crop_id']; // Assuming crop_id is provided in the item array
                $parcelId = $parcelIds[$crop['parcelNum']] ?? null;
            
                if ($parcelId) {
                    // Update query for the existing crop
                    $sql = "UPDATE crops SET 
                            farmer_id = ?, 
                            parcel_id = ?, 
                            hvc = ?, 
                            crop_area = ?, 
                            classification = ?, 
                            modified_by = ?, 
                            modified_at = ? 
                            WHERE id = ?";
                            
                    $stmt = $conn->prepare($sql);
            
                    if ($stmt === false) {
                        echo "Error preparing crop update query: " . $conn->error;
                        exit;
                    }
            
                    // Bind parameters for the update query
                    $stmt->bind_param("iiissisi", 
                        $farmerId, 
                        $parcelId, 
                        $crop['hvc'], 
                        $crop['cropArea'], 
                        $crop['classification'], 
                        $user_id, 
                        $modifiedAt, 
                        $cropId // Crop ID to identify the record to update
                    );
            
                    if (!$stmt->execute()) {
                        echo "Error executing crop update query: " . $stmt->error;
                        exit;
                    }
                }
            }
        }
    }
    
    // Insert livestock data
    foreach ($data as $item) {
        if (isset($item['livestock'])) {
           if (!isset($item['livestock']['livestock_id'])) {
            $livestock = $item['livestock'];
            $parcelId = $parcelIds[$livestock['parcelNum']] ?? null;
            
            if ($parcelId) {
                $sql = "INSERT INTO livestocks (
                farmer_id, 
                parcel_id, 
                no_of_heads, 
                animal_name,
                
                modified_by,
                modified_at
                ) VALUES (?, ?, ?, ?,
                ?, ?
                )";
                $stmt = $conn->prepare($sql);
                
                if ($stmt === false) {
                    echo "Error preparing livestock insert query: " . $conn->error;
                    exit;
                }
    
                $stmt->bind_param("iiisis",
                 $farmerId, 
                 $parcelId, 
                 $livestock['numberOfHeads'], 
                 $livestock['livestockType'],
                 $user_id,
                 $modifiedAt
                );
                
                if (!$stmt->execute()) {
                    echo 'Error executing livestock insert query: ' . $stmt->error;
                    exit;
                }
            }
           }
           if (isset($item['livestock']['livestock_id'])) {
            $livestock = $item['livestock'];
            $livestockId = $livestock['livestock_id']; // Assuming livestock_id is provided
            $parcelId = $parcelIds[$livestock['parcelNum']] ?? null;
            
            if ($parcelId) {
                // Update query for existing livestock
                $sql = "UPDATE livestocks SET
                        farmer_id = ?, 
                        parcel_id = ?, 
                        no_of_heads = ?, 
                        animal_name = ?, 
                        modified_by = ?, 
                        modified_at = ? 
                        WHERE id = ?";
        
                $stmt = $conn->prepare($sql);
        
                if ($stmt === false) {
                    echo "Error preparing livestock update query: " . $conn->error;
                    exit;
                }
        
                // Bind parameters for the update query
                $stmt->bind_param("iiisisi", 
                    $farmerId, 
                    $parcelId, 
                    $livestock['numberOfHeads'], 
                    $livestock['livestockType'], 
                    $user_id, 
                    $modifiedAt, 
                    $livestockId // Livestock ID to identify the record to update
                );
        
                if (!$stmt->execute()) {
                    echo "Error executing livestock update query: " . $stmt->error;
                    exit;
                }
            }
        }
        
        }
    }
    
    echo '<div style="position: fixed; top: 20px; right: 20px; padding: 10px 20px; background-color: green; color: white; font-size: 16px; border-radius: 5px;">Data inserted successfully!</div>';
    

    if ($data) {
    foreach ($data as $item) {
        if (isset($item['farmer'])) {
            echo '<div class="farmer"><h3>Farmer Information:</h3>';
            echo '<pre style="color: green; font-weight: bold;">';
            print_r($item['farmer']);
            echo '</pre></div>';
        }

        if (isset($item['parcel'])) {
            echo '<div class="parcel"><h3>Parcel Information:</h3>';
            echo '<pre style="color: red; font-weight: bold;">';
            print_r($item['parcel']);
            echo '</pre></div>';
        }

        if (isset($item['crop'])) {
            echo '<div class="crop"><h3>Crop Information:</h3>';
            echo '<pre style="color: blue; font-weight: bold;">';
            print_r($item['crop']);
            echo '</pre></div>';
        }

        if (isset($item['livestock'])) {
            echo '<div class="livestock"><h3>Livestock Information:</h3>';
            echo '<pre style="font-weight: bold;">';
            print_r($item['livestock']);
            echo '</pre></div>';
        }
    }
} else {
    echo "Failed to decode JSON data.";
}

    $conn->close();
}
// Check if decoding was successful


    echo '<pre style="color: red; font-weight: bold;">';
    print_r($parcelIds);
    echo '</pre></div>';
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
let crop = document.querySelector('.crop');
let livestock = document.querySelector('.livestock');

let divs = container.querySelectorAll('div');
divs.forEach(function(div) {
  if (div.className === 'farmer') {
    farmer.appendChild(div);
  }

  if (div.className === 'parcel') {
    parcel.appendChild(div);
  }

  if (div.className === 'crop') {
    crop.appendChild(div);
  }

  if (div.className === 'livestock') {
    livestock.appendChild(div);
  }
});

</script>
