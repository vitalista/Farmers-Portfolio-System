<?php
require 'database.php';

$sql = "SELECT farmer_name, latitude, longitude FROM locations";
$result = $conn->query($sql);

$locations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($locations);
?>