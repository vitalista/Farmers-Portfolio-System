<?php
// Database connection
$host = 'localhost';
$dbname = 'baliwag_agriculture_office';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch the image path and data
$id = 1; // Example ID, change based on your requirements
$sql = "SELECT image_path, image_data FROM images WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imgData = $row['image_data'];  // The binary image data
    $imgPath = $row['image_path'];  // The original image path (optional)

    // Determine the MIME type of the image
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_buffer($finfo, $imgData);
    finfo_close($finfo);

    $string = $row['image_path'];
    preg_match('/\/(\d{4}-\d{2}-\d{2}_\d{2}-\d{2}-\d{2}[a-zA-Z0-9_-]+)(?=\.\w+)/', $string, $matches);

    switch ($mimeType) {
        case 'image/jpeg':
            $ext = 'jpg';
            break;
        case 'image/png':
            $ext = 'png';
            break;
        case 'image/gif':
            $ext = 'gif';
            break;
        case 'image/bmp':
            $ext = 'bmp';
            break;
        default:
            echo "Unsupported image type!";
            exit;
    }

    // Save the binary image data to a file with the correct extension
    $imageFilePath = '../assets/img/' . $matches[1] . '.' . $ext; // Create a unique file name
    file_put_contents($imageFilePath, $imgData);

} else {
    echo "Image not found!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Image</title>
</head>
<body>
    <h1>Image from Database (Stored)</h1>
    <!-- Display the image from the stored file -->
    <img src="<?php echo $imgPath; ?>" alt="Image from Database">
</body>
</html>
