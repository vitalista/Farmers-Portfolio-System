<?php
include 'backend/functions.php';

if (!isset($_SESSION['LoggedIn']) || empty($_SESSION['LoggedInUser'])) {
    redirect('login/', 500, 'Something went wrong. Redirecting to login page...');
    exit;
}

if(isset($_SESSION['LoggedIn']) || !empty($_SESSION['LoggedInUser'])){
    setLastAct();
    session_unset(); 
    unset($_SESSION['LoggedIn']);
    unset($_SESSION['LoggedInUser']);
    unset($_SESSION['otp']);
    unset($_SESSION['otp_attempts']);
    unset($_SESSION['otpTime']);
    session_destroy();
    session_start();
    redirect('login/', 500, "You're now logged out.");
}
?>
