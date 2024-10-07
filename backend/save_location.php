<?php

require 'database.php';

$data = json_decode(file_get_contents('php://input'), true);
$lat = $data['lat'];
$lng = $data['lng'];

$sql = "INSERT INTO locations (latitude, longitude) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("dd", $lat, $lng);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Location saved successfully.']);
} else {
    echo json_encode(['message' => 'Error saving location.']);
}

$stmt->close();
$conn->close();
?>
