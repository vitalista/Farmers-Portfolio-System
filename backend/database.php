<?php
require_once 'env.php';

$servername = getenv('DB_HOST'); 
$username = getenv('DB_USER'); 
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME'); 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}