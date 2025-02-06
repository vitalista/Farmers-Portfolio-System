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

$ffrs = $_POST['ffrs'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$extName = $_POST['extName'];
$gender = $_POST['gender'];
$bday = $_POST['bday'];
$hbp = $_POST['hbp'];
$sss = $_POST['sss'];
$brgy = $_POST['brgy'];
$municipality = $_POST['municipality'];
$province = $_POST['province'];
$region = $_POST['region'];
$govIdType = $_POST['govIdType'];
$govIdNumber = $_POST['govIdNumber'];
$selectedEnrollment = $_POST['selectedEnrollment'];

$created_at = date("Y-m-d H:i:s");

$farmerExt = $govIdPhotoBackExt = $govIdPhotoFrontExt = null;
$farmerPath = $govIdPhotoBackPath = $govIdPhotoFrontPath = null;
$farmerImageBlob = $govIdPhotoBackBlob = $govIdPhotoFrontBlob = null;

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

$sql = "INSERT INTO farmers_registration 
        (
        ffrs_system_gen,
        first_name,
        middle_name,
        last_name, 
        ext_name, 
        gender, 
        bday, 
        hbp, 
        sss, 
        brgy, 
        municipality, 
        province, 
        region, 
        gov_id_type,
        gov_id_number, 
        created_at,
        selected_enrollment) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    'sssssssssssssssss',
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
    $created_at, 
    $selectedEnrollment
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

$stmt->close();
$conn->close();
?>
