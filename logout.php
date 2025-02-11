<?php
include 'backend/functions.php';

if (!isset($_SESSION['LoggedIn']) || empty($_SESSION['LoggedInUser'])) {
    header('Location: login/');
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
    header('Location: login/');

}
?>
