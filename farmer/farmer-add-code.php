<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON</title>
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
if (isset($_POST['farms_data'])) {
    $data = json_decode($_POST['farms_data'], true);
?>
<script>
    console.log(<?php echo json_encode($data);?>);
</script>
<?php
    $user_id = isset($_SESSION['LoggedInUser']['id']) ? $_SESSION['LoggedInUser']['id'] : 0;
    $farmerId = isset($data[0]['farmer']['farmer_id']) ? $data[0]['farmer']['farmer_id'] : null;
    date_default_timezone_set('Asia/Taipei');
    $modifiedAt =  date('Y-m-d h:i:s A');

    if (!isset($farmerId) && isset($data[0]['farmer'])) {   
        $farmer = $data[0]['farmer'];

        $filteredFarmer = array_filter($farmer, function($value) {
            return !empty($value);
        });
    
        $requiredFields = [
            'brgy', 
            'municipality', 
            'province', 
            'firstName', 
            'middleName', 
            'lastName', 
            'gender', 
            'bday',
            'govIdType',
            'govIdNumber',
            'hbp',
            'sss',
            'region'
        ];
    
        foreach ($requiredFields as $field) {
            if (!isset($filteredFarmer[$field]) || empty($filteredFarmer[$field])) {
                redirect('farmer-add.php', 404, 'Please fill in all required fields.');
                exit;
            }
        }

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
        no_of_parcels,
        modified_by,
        modified_at,

        gov_id_number,
        gov_id_type,
        region,
        sss,
        hbp

        )VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?
        )";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            echo "Error preparing farmer insert query: " . $conn->error;
            redirect('farmer-list.php', 500, 'Something Went Wrong');
            exit;
        }
        
        $stmt->bind_param("sssssssssssiiissssss", 
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
        $farmer['num_of_parcels'],
        $user_id,
        $modifiedAt,
        $farmer['govIdNumber'],
        $farmer['govIdType'],
        $farmer['region'],
        $farmer['sss'],
        $farmer['hbp']
    );
        
        if ($stmt->execute()) {
            $farmerId = $stmt->insert_id;

            if (!insertActivityLog($farmerId, $user_id, 'farmers', 'INSERT')) {
                echo "Error inserting log entry.";
                redirect('farmer-list.php', 500, 'Something Went Wrong');
                exit;
            }

        } else {
            echo "Error executing farmer insert query: " . $stmt->error;
            redirect('farmer-list.php', 500, 'Something Went Wrong');
            exit;
        }
    }

    // echo $farmer['num_of_parcels'];

    if (isset($farmerId) && isset($data[0]['farmer']) && array_key_exists('farmer_id', $data[0]['farmer'])) {
        $farmer = $data[0]['farmer'];

        $filteredFarmer = array_filter($farmer, function($value) {
            return !empty($value);
        });
    
        $requiredFields = [
            'brgy', 
            'municipality', 
            'province', 
            'firstName', 
            'middleName', 
            'lastName', 
            'gender', 
            'bday',
            'govIdType',
            'govIdNumber',
            'hbp',
            'sss',
            'region'
        ];
    
        foreach ($requiredFields as $field) {
            if (!isset($filteredFarmer[$field]) || empty($filteredFarmer[$field])) {
                redirect('farmer-view.php?id='.$farmerId, 404, 'Please fill in all required fields.');
                exit;
            }
        }

        $modifiedTimes;
        $checkId = getById('farmers',$farmerId);
        if($checkId['status']== 200){
            $modifiedTimes = $checkId['data']['modified_times'] + 1;
        }

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
            no_of_parcels = ?, 
            modified_by = ?, 
            modified_at = ?,
            modified_times = ?,

            gov_id_number = ?,
            gov_id_type = ?,
            region = ?,
            sss = ?,
            hbp = ?

            WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            echo "Error preparing farmer update query: " . $conn->error;
            redirect('farmer-list.php', 500, 'Something Went Wrong');
            exit;
        }
    
        // Bind the parameters
        $stmt->bind_param("sssssssssssiiisiisssss", 
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
            $farmer['num_of_parcels'],
            $user_id,
            $modifiedAt,
            $modifiedTimes,
              // Pass the farmer ID to identify the record to update
            $farmer['govIdNumber'],
            $farmer['govIdType'],
            $farmer['region'],
            $farmer['sss'],
            $farmer['hbp'],
            $farmerId
        );
    
        // Execute the query
        if ($stmt->execute()) {

            if (!insertActivityLog($farmerId, $user_id, 'farmers', 'UPDATE')) {
                echo "Error inserting log entry.";
                redirect('farmer-list.php', 500, 'Something Went Wrong');
                exit;
            }

           
        } else {
            echo "Error executing farmer update query: " . $stmt->error;
            redirect('farmer-list.php', 500, 'Something Went Wrong');
            exit;
        }
    }

if (isset($_FILES['farmerImage']) || isset($_FILES['govIdPhotoBack']) || isset($_FILES['govIdPhotoFront'])) {
        $farmerExt = $govIdPhotoBackExt = $govIdPhotoFrontExt = null;
        $farmerPath = $govIdPhotoBackPath = $govIdPhotoFrontPath = null;
        $farmerImageBlob = $govIdPhotoBackBlob = $govIdPhotoFrontBlob = null;

        // Function to get image data as BLOB
        function getImageBlob($file) {
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                echo "File uploaded successfully: " . $file['name'] . "<br>";
                return file_get_contents($file['tmp_name']);
            }
            echo "Error uploading file: " . $file['error'] . "<br>";
            return null;
        }

        function getFileExtension($file) {
            // Get the file's extension
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            return strtolower($fileExtension);
        }

        // Get image blobs for each file
        if (isset($_FILES['farmerImage'])) {
            $farmerImageBlob = getImageBlob($_FILES['farmerImage']);
            $farmerExt = getFileExtension($_FILES['farmerImage']);
            $timestamp = date('Y-m-d_H-i-s');
            $farmerPath = "../assets/img/" . $timestamp . "_farmer." . $farmerExt; // Add extension to path
        }

        if (isset($_FILES['govIdPhotoBack'])) {
            $govIdPhotoBackBlob = getImageBlob($_FILES['govIdPhotoBack']);
            $govIdPhotoBackExt = getFileExtension($_FILES['govIdPhotoBack']);
            $timestamp = date('Y-m-d_H-i-s');
            $govIdPhotoBackPath = "../assets/img/" . $timestamp . "_govIdBack." . $govIdPhotoBackExt; // Add extension to path
        }

        if (isset($_FILES['govIdPhotoFront'])) {
            $govIdPhotoFrontBlob = getImageBlob($_FILES['govIdPhotoFront']);
            $govIdPhotoFrontExt = getFileExtension($_FILES['govIdPhotoFront']);
            $timestamp = date('Y-m-d_H-i-s');
            $govIdPhotoFrontPath = "../assets/img/" . $timestamp . "_govIdFront." . $govIdPhotoFrontExt; // Add extension to path
        }

        $lastInsertedFarmerId = $farmerId; // Make sure $farmerId is initialized correctly

        // Insert images into the images table
        $imageTypes = ['farmerImage', 'govIdPhotoBack', 'govIdPhotoFront'];
        $imageBlobs = [$farmerImageBlob, $govIdPhotoBackBlob, $govIdPhotoFrontBlob];
        $imagePaths = [$farmerPath, $govIdPhotoBackPath, $govIdPhotoFrontPath];
        $imageExt = [$farmerExt, $govIdPhotoBackExt, $govIdPhotoFrontExt];

        $imageSql = "INSERT INTO images (farmer_id, image_type, image_path, image_data) VALUES (?, ?, ?, ?)";
        $imageStmt = $conn->prepare($imageSql);
        if (!$imageStmt) {
            echo "Error preparing SQL statement: " . $conn->error . "<br>";
        }

        foreach ($imageTypes as $index => $type) {
            if ($imageBlobs[$index]) {
                $finalPath = $imagePaths[$index]; 
                $imageStmt->bind_param('isss', $lastInsertedFarmerId, $type, $finalPath, $imageBlobs[$index]);
                if ($imageStmt->execute()) {
                    
                    $imageId = $imageStmt->insert_id;
                    if (!insertActivityLog($imageId, $user_id, 'images', 'INSERT', $lastInsertedFarmerId, 'farmers')) {
                        echo "Error inserting log entry.";
                        redirect('farmer-list.php', 500, 'Something Went Wrong');
                        exit;
                    }

                } else {
                    echo "Error inserting image: " . $imageStmt->error . "<br>";
                }
            }
        }

        // echo "Farmer Image Size: " . $_FILES['farmerImage']['size'] . " bytes<br>";
        // echo "Gov ID Photo Back Size: " . $_FILES['govIdPhotoBack']['size'] . " bytes<br>";
        // echo "Gov ID Photo Front Size: " . $_FILES['govIdPhotoFront']['size'] . " bytes<br>";

    } else {
                echo "No files uploaded.<br>";
}

    
    // Insert parcel data
    $parcelIds = []; // Initialize an empty array to store parcelNum and corresponding insert_id.
    foreach ($data as $item) { 

    if (isset($item['parcel'])) {
        $parcel = $item['parcel'];

        $filteredFarmer = array_filter($parcel, function($value) {
            return !empty($value);
        });
    
        $requiredFields = [
            'parcelNum',
            // 'ofName',
            // 'olName',
            // 'ownership',
            'farmLocationBrgy',
            'farmLocationMunicipality',
            'farmLocationProvince',
            // 'farmSize',
            // 'farmType'
        ];
    
        foreach ($requiredFields as $field) {
            if (!isset($filteredFarmer[$field]) || empty($filteredFarmer[$field])) {
                redirect('farmer-view.php?id='.$farmerId, 404, 'Please fill in all required fields.');
                exit;
            }
        }

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
                redirect('farmer-list.php', 500, 'Something Went Wrong');
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

                    if (!insertActivityLog($stmt->insert_id, $user_id, 'parcels', 'INSERT', $farmerId, 'farmers')) {
                        echo "Error inserting log entry.";
                        redirect('farmer-list.php', 500, 'Something Went Wrong');
                        exit;
                    }

            } else {
                echo "Error executing parcel insert query: " . $stmt->error;
                redirect('farmer-list.php', 500, 'Something Went Wrong');
                exit;
            }
        }

        if (isset($parcel['parcel_id'])) {

            $modifiedTimes;
            $checkId = getById('parcels', $parcel['parcel_id']);
            if($checkId['status']== 200){
                $modifiedTimes = $checkId['data']['modified_times'] + 1;
            }
        
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
                        modified_at = ?,
                        modified_times = ?
                    WHERE id = ?"; 
        
            $stmt = $conn->prepare($sql);
        
            if ($stmt === false) {
                echo "Error preparing parcel update query: " . $conn->error;
                redirect('farmer-list.php', 500, 'Something Went Wrong');
                exit;
            }
        
            // Bind parameters for the update query
            $stmt->bind_param(
                "iissssssssisii", 
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
                $modifiedTimes,
                $parcel['parcel_id']
            );
        
            // Execute the query
            if ($stmt->execute()) {
                // Parcel updated successfully
                $parcelIds[$parcel['parcelNum']] = $parcel['parcel_id'];
                if (!insertActivityLog($parcel['parcel_id'], $user_id, 'parcels', 'UPDATE', $farmerId, 'farmers')) {
                    echo "Error inserting log entry.";
                    redirect('farmer-list.php', 500, 'Something Went Wrong');
                    exit;
                }
            } else {
                echo "Error executing parcel update query: " . $stmt->error;
                redirect('farmer-list.php', 500, 'Something Went Wrong');
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

                $filteredFarmer = array_filter($crop, function($value) {
                    return !empty($value);
                });
            
                $requiredFields = [
                    'cropArea', 
                    'cropName', 
                    'classification'
                ];
            
                foreach ($requiredFields as $field) {
                    if (!isset($filteredFarmer[$field]) || empty($filteredFarmer[$field])) {
                        redirect('farmer-view.php?id='.$farmerId, 404, 'Please fill in all required fields.');
                        exit;
                    }
                }

            $parcelId = $parcelIds[$crop['parcelNum']] ?? null;
            if ($parcelId) {
                $sql = "INSERT INTO crops (
                farmer_id, 
                parcel_id, 
                hvc, 
                crop_area,
                crop_name, 
                classification,

                modified_by,
                modified_at
                ) VALUES (?, ?, ?, ?, ?, ?,
                ?, ?)";
                $stmt = $conn->prepare($sql);
                
                if ($stmt === false) {
                    echo "Error preparing crop insert query: " . $conn->error;
                    exit;
                }
    
                $stmt->bind_param("iiidsiis", 
                $farmerId, 
                $parcelId, 
                $crop['hvc'], 
                $crop['cropArea'], 
                $crop['cropName'], 
                $crop['classification'],
                $user_id,
                $modifiedAt
                );
                
                if ($stmt->execute()) {
                    if (!insertActivityLog($stmt->insert_id, $user_id, 'crops', 'INSERT', $farmerId, 'farmers, parcels')) {
                        echo "Error inserting log entry.";
                        redirect('farmer-list.php', 500, 'Something Went Wrong');
                        exit;
                    }
                }else{
                    echo "Error executing crop insert query: " . $stmt->error;
                    redirect('farmer-list.php', 500, 'Something Went Wrong');
                    exit;
                }
            }
            }

            if (isset($item['crop']['crop_id'])) {
                $crop = $item['crop'];
                $cropId = $crop['crop_id']; // Assuming crop_id is provided in the item array
                $parcelId = $parcelIds[$crop['parcelNum']] ?? null;

                $modifiedTimes;
                $checkId = getById('crops', $cropId);
                if($checkId['status']== 200){
                    $modifiedTimes = $checkId['data']['modified_times'] + 1;
                }
            
                if ($parcelId) {
                    // Update query for the existing crop
                    $sql = "UPDATE crops SET 
                            farmer_id = ?, 
                            parcel_id = ?, 
                            hvc = ?, 
                            crop_area = ?, 
                            crop_name = ?,
                            classification = ?, 
                            modified_by = ?, 
                            modified_at = ?, 
                            modified_times = ?
                            WHERE id = ?";
                            
                    $stmt = $conn->prepare($sql);
            
                    if ($stmt === false) {
                        echo "Error preparing crop update query: " . $conn->error;
                        redirect('farmer-list.php', 500, 'Something Went Wrong');
                        exit;
                    }
            
                    // Bind parameters
                    $stmt->bind_param("iiidsiisii", 
                        $farmerId, 
                        $parcelId, 
                        $crop['hvc'], 
                        $crop['cropArea'], 
                        $crop['cropName'], 
                        $crop['classification'], 
                        $user_id, 
                        $modifiedAt,
                        $modifiedTimes, 
                        $cropId // Crop ID to identify the record to update
                    );
            
                    if ($stmt->execute()) {
                        if (!insertActivityLog($crop, $user_id, 'crops', 'UPDATE', $farmerId, 'farmers, parcels')) {
                            echo "Error inserting log entry.";
                            redirect('farmer-list.php', 500, 'Something Went Wrong');
                            exit;
                        }
                    }else{
                        echo "Error executing crop update query: " . $stmt->error;
                        redirect('farmer-list.php', 500, 'Something Went Wrong');
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

                $filteredFarmer = array_filter($livestock, function($value) {
                    return !empty($value);
                });
            
                $requiredFields = [
                    'numberOfHeads', 
                    'livestockType' 
                ];
            
                foreach ($requiredFields as $field) {
                    if (!isset($filteredFarmer[$field]) || empty($filteredFarmer[$field])) {
                        redirect('farmer-view.php?id='.$farmerId, 404, 'Please fill in all required fields.');
                        exit;
                    }
                }

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
                    redirect('farmer-list.php', 500, 'Something Went Wrong');
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
                
                if ($stmt->execute()) {

                    if (!insertActivityLog($stmt->insert_id, $user_id, 'livestocks', 'INSERT', $farmerId, 'farmers, parcels')) {
                        echo "Error inserting log entry.";
                        redirect('farmer-list.php', 500, 'Something Went Wrong');
                        exit;
                    }
                  
                }else{
                    echo 'Error executing livestock insert query: ' . $stmt->error;
                    redirect('farmer-list.php', 500, 'Something Went Wrong');
                    exit;
                }
            }
           }
           if (isset($item['livestock']['livestock_id'])) {
            $livestock = $item['livestock'];
            $livestockId = $livestock['livestock_id']; // Assuming livestock_id is provided
            $parcelId = $parcelIds[$livestock['parcelNum']] ?? null;

            $modifiedTimes;
                $checkId = getById('livestocks', $livestockId);
                if($checkId['status']== 200){
                    $modifiedTimes = $checkId['data']['modified_times'] + 1;
                }
            
            if ($parcelId) {
                // Update query for existing livestock
                $sql = "UPDATE livestocks SET
                        farmer_id = ?, 
                        parcel_id = ?, 
                        no_of_heads = ?, 
                        animal_name = ?, 
                        modified_by = ?, 
                        modified_at = ?,
                        modified_times = ?
                        WHERE id = ?";
        
                $stmt = $conn->prepare($sql);
        
                if ($stmt === false) {
                    echo "Error preparing livestock update query: " . $conn->error;
                    redirect('farmer-list.php', 500, 'Something Went Wrong');
                    exit;
                }
        
                // Bind parameters for the update query
                $stmt->bind_param("iiisisii", 
                    $farmerId, 
                    $parcelId, 
                    $livestock['numberOfHeads'], 
                    $livestock['livestockType'], 
                    $user_id, 
                    $modifiedAt, 
                    $modifiedTimes,
                    $livestockId // Livestock ID to identify the record to update
                );
        
                if ($stmt->execute()) {
                    if (!insertActivityLog($livestockId, $user_id, 'livestocks', 'UPDATE', $farmerId, 'farmers, parcels')) {
                        echo "Error inserting log entry.";
                        redirect('farmer-list.php', 500, 'Something Went Wrong');
                        exit;
                    }
                }else{
                    echo "Error executing livestock update query: " . $stmt->error;
                    redirect('farmer-list.php', 500, 'Something Went Wrong');
                    exit;
                }
            }
        }
        
        }
    }

    
    
    if(isset($_POST['add']) && $_POST['add'] == 0){
        redirect('farmer-list.php', 200, 'Information Successfully Inserted');
    }

    if(isset($_POST['update']) && $_POST['update'] == 1){
        redirect('farmer-list.php', 200, 'Information Successfully Updated');
    }

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
}else{
    redirect('farmer-list.php', 404, 'Invalid Request');
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
