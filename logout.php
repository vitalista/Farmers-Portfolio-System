<?php
include 'backend/functions.php';
// Prepare SQL query to update login status
$updateQuery = "UPDATE users 
                  SET is_logged_in = 0, 
                  logout_timestamp = NOW() 
                  WHERE id = ?";
$updateStmt = mysqli_prepare($conn, $updateQuery);
mysqli_stmt_bind_param($updateStmt, "i", $_SESSION['LoggedInUser']['id']);  // 'i' for integer type

mysqli_stmt_execute($updateStmt);

unset($_SESSION['LoggedIn']);
unset($_SESSION['LoggedInUser']);
unset($_SESSION['otp']);
unset($_SESSION['otp_attempts']);
unset($_SESSION['otpTime']);
session_destroy();

if (!isset($_SESSION['LoggedIn'])) {
    session_destroy();
    unset($_SESSION['LoggedIn']);
    unset($_SESSION['LoggedInUser']);
    unset($_SESSION['otp']);
    unset($_SESSION['otp_attempts']);
    unset($_SESSION['otpTime']);
    header('Location: login/');
}

header('Location: login/');
?>
