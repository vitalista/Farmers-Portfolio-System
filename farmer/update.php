<?php
include '../backend/functions.php';

if (isset($_POST['id']) && isset($_POST['ffrs'])) {
    $id = $_POST['id'];
    $name = $_POST['ffrs'];

    echo "Received ID: " . $id . "<br>";
    echo "Received Name: " . $name . "<br>";
    echo json_encode(['status' => 'success', 'message' => 'Data received successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Required data not received']);
}


if(isset($_POST['id']) && isset($_POST['ffrs'])){
$id = $_POST['id'];
$name = $_POST['ffrs'];

echo $id;
echo $name;

$sql1 = "SELECT modified_times FROM farmers WHERE id = ?";

$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $id);
$stmt1->execute();
$stmt1->bind_result($modifiedTimes);
$stmt1->fetch();
$stmt1->close();

$modifiedTimes++;
date_default_timezone_set('Asia/Taipei');
$modifiedAt = date('Y-m-d h:i:s A');

$sql = "UPDATE farmers SET ffrs_system_gen = ?, modified_times = ?, modified_at = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisi", $name, $modifiedTimes, $modifiedAt, $id);

// Execute the query
if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();

}

$conn->close();

?>
