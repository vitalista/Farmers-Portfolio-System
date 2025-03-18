<?php
require '../backend/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

  // Sanitize user inputs
  $email = validate($_POST['email']);
  $password = validate($_POST['password']);

  if (empty($email) || empty($password)) {
    redirect('index.php?error=emptyfields', 404, 'Please fill in all required fields.');
    exit();
  }

  // Prepare query to get the user based on email
  $query = "SELECT * FROM users WHERE email=? LIMIT 1";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $email);  // 's' for string type
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) != 1) {
    redirect('index.php?error=invalidcredentials', 500, 'Please check your username and password.');
    header('Location: index.php?error=invalidcredentials');
    exit();
  }

  $row = mysqli_fetch_assoc($result);
  $hashedPassword = $row['password'];

  // Verify the password
  if (!password_verify($password, $hashedPassword)) {
    redirect('index.php?error=invalidcredentials', 500, 'Please check your username and password.');
    exit();
  }

  // Check if the user is banned
  if ($row['is_banned'] == 1) {
    redirect('index.php?error=banned', 500, 'Your account is banned, please contact your admin.');
    exit();
  }

  // Start session and set user data
  $_SESSION['LoggedIn'] = false;
  $_SESSION['LoggedInUser'] = [
    'id' => $row['id'],
    'full_name' => $row['full_name'],
    'email' => $row['email'],
    'role' => $row['role'],
    'can_create' => $row['can_create'],
    'can_edit' => $row['can_edit'],
    'can_archive' => $row['can_archive'],
    'can_export' => $row['can_export'],
  ];
  
  if (!isset($_SESSION['otp'])) {
    $_SESSION['otp'] = rand(100000, 999999);
  }

header('Location: ../otp/');
exit();

} else {
  // If the request method is not POST or login is not set, handle it
  redirect('index.php?error=405', 500, 'Something went wrong.');
  exit();
}
?>
