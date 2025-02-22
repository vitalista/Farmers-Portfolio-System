<?php
// Your database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baliwag_agriculture_office";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$data = json_decode($_POST['farmsData'], true);
$farmer = $data[0]['farmer'];

$ffrs = $farmer['ffrs'] === '----' ? '' : $farmer['ffrs'];
$firstName = $farmer['firstName'];
$middleName = $farmer['middleName'];
$lastName = $farmer['lastName'];
$extName = $farmer['extName'];
$gender = $farmer['gender'];
$bday = $farmer['bday'];
$hbp = $farmer['hbp'];
$sss = $farmer['sss'];
$brgy = $farmer['brgy'];
$municipality = $farmer['municipality'];
$province = $farmer['province'];
$region = $farmer['region'];
$govIdType = $farmer['govIdType'];
$govIdNumber = $farmer['govIdNumber'];
$selectedEnrollment = $farmer['selectedEnrollment'];
$num_of_parcels = $farmer['num_of_parcels'];

print_r($data);

$farmerExt = $govIdPhotoBackExt = $govIdPhotoFrontExt = null;
$farmerPath = $govIdPhotoBackPath = $govIdPhotoFrontPath = null;
$farmerImageBlob = $govIdPhotoBackBlob = $govIdPhotoFrontBlob = null;
$lastInsertedFarmerId = null;

// Function to get image data as BLOB
function getImageBlob($file) {
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        return file_get_contents($file['tmp_name']);
    }
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
    $farmerPath = "../assets/img/" . $timestamp;
}

if (isset($_FILES['govIdPhotoBack'])) {
    $govIdPhotoBackBlob = getImageBlob($_FILES['govIdPhotoBack']);
    $govIdPhotoBackExt = getFileExtension($_FILES['govIdPhotoBack']);
    $timestamp = date('Y-m-d_H-i-s');
    $govIdPhotoBackPath = "../assets/img/" . $timestamp;
}

if (isset($_FILES['govIdPhotoFront'])) {
    $govIdPhotoFrontBlob = getImageBlob($_FILES['govIdPhotoFront']);
    $govIdPhotoFrontExt = getFileExtension($_FILES['govIdPhotoFront']);
    $timestamp = date('Y-m-d_H-i-s');
    $govIdPhotoFrontPath = "../assets/img/" . $timestamp;
}

$sql = "INSERT INTO farmers
        (
        ffrs_system_gen,
        first_name,
        middle_name,
        last_name, 
        ext_name, 
        gender, 
        birthday, 
        hbp, 
        sss, 
        farmer_brgy_address, 
        farmer_municipality_address, 
        farmer_province_address, 
        region, 
        gov_id_type,
        gov_id_number,
        selected_enrollment,
        no_of_parcels) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    'ssssssssssssssssi',
    $ffrs, 
    $firstName, 
    $middleName, 
    $lastName, 
    $extName, 
    $gender, 
    $bday, 
    $hbp,
    $sss, 
    $brgy, 
    $municipality, 
    $province, 
    $region, 
    $govIdType, 
    $govIdNumber, 
    $selectedEnrollment,
    $num_of_parcels,
);

if ($stmt->execute()) {
    $lastInsertedFarmerId = $conn->insert_id;
    // Insert images into the images table
    $imageTypes = ['farmerImage', 'govIdPhotoBack', 'govIdPhotoFront'];
    $imageBlobs = [$farmerImageBlob, $govIdPhotoBackBlob, $govIdPhotoFrontBlob];
    $imagePaths = [$farmerPath, $govIdPhotoBackPath, $govIdPhotoFrontPath];
    $imageExt = [$farmerExt, $govIdPhotoBackExt, $govIdPhotoFrontExt];

    $imageSql = "INSERT INTO images (farmer_id, image_type, image_path, image_data) VALUES (?, ?, ?, ?)";
    $imageStmt = $conn->prepare($imageSql);

    foreach ($imageTypes as $index => $type) {
        if ($imageBlobs[$index]) {
            $finalPath = $imagePaths[$index]. $type. ".".$imageExt[$index]; 
            $imageStmt->bind_param('isss', $lastInsertedFarmerId, $type, $finalPath, $imageBlobs[$index]);
            $imageStmt->execute();
        }
    }

    echo 'Registration and image upload successful!';
} else {
    echo 'Error occurred during registration: ' . $stmt->error;
}

$parcelIds = [];
foreach ($data as $item) { 

    if (isset($item['parcel'])) {
    $parcel = $item['parcel'];
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
              farm_type
          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?,
          ?, ?)";

    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        echo "Error preparing parcel insert query: " . $conn->error;
        redirect('farmer-list.php', 500, 'Something Went Wrong');
        exit;
    }

    $stmt->bind_param(
        "iissssssss",
        $lastInsertedFarmerId,
        $parcel['parcelNum'],
        $parcel['ofName'],
        $parcel['olName'],
        $parcel['ownership'],
        $parcel['farmLocationBrgy'],
        $parcel['farmLocationMunicipality'],
        $parcel['farmLocationProvince'],
        $parcel['farmSize'],
        $parcel['farmType'],
    );
    
    if ($stmt->execute()) {
        $parcelIds[$parcel['parcelNum']] = $stmt->insert_id;
        // addFpsCode('parcels', $stmt->insert_id, $farmer['brgy']);
    } else {
        echo "Error executing parcel insert query: " . $stmt->error;
        exit;
    }
}
}

foreach ($data as $item) {
    if (isset($item['crop'])) {
            $crop = $item['crop'];

        $parcelId = $parcelIds[$crop['parcelNum']] ?? null;
        if ($parcelId) {
            $sql = "INSERT INTO crops (
            farmer_id, 
            parcel_id, 
            hvc, 
            crop_area,
            crop_name, 
            classification
            ) VALUES (?, ?, ?, ?,
            ?, ?)";
            $stmt = $conn->prepare($sql);
            
            if ($stmt === false) {
                echo "Error preparing crop insert query: " . $conn->error;
                exit;
            }

            $stmt->bind_param("iiidsi", 
            $lastInsertedFarmerId, 
            $parcelId, 
            $crop['hvc'], 
            $crop['cropArea'], 
            $crop['cropName'], 
            $crop['classification']
            );
            
            if ($stmt->execute()) {
                // addFpsCode('crops', $stmt->insert_id, $farmer['brgy']);
            }else{
                echo "Error executing crop insert query: " . $stmt->error;
                exit;
            }
        }
        }
    }

    foreach ($data as $item) {
        if (isset($item['livestock'])) {
            $livestock = $item['livestock'];

            $parcelId = $parcelIds[$livestock['parcelNum']] ?? null;
            
            if ($parcelId) {
                $sql = "INSERT INTO livestocks (
                farmer_id, 
                parcel_id, 
                no_of_heads, 
                animal_name
                ) VALUES (?, ?,
                ?, ?
                )";
                $stmt = $conn->prepare($sql);
                
                if ($stmt === false) {
                    echo "Error preparing livestock insert query: " . $conn->error;
                    exit;
                }
    
                $stmt->bind_param("iiis",
                 $lastInsertedFarmerId, 
                 $parcelId, 
                 $livestock['numberOfHeads'], 
                 $livestock['livestockType']
                );
                
                if ($stmt->execute()) {
                    // addFpsCode('livestocks', $stmt->insert_id, $farmer['brgy']);
                  
                }else{
                    echo 'Error executing livestock insert query: ' . $stmt->error;
                    exit;
                }
            }
        }
    }

$stmt->close();
$conn->close();

