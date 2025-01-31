<?php
include '../backend/functions.php';
function unsetSessions() {
    unset($_SESSION['otp_attempts']);
    unset($_SESSION['otp']);
    unset($_SESSION['otpTime']);
}

if(!isset($_SESSION['otp'])){
    unsetSessions();
    redirect('index.php?error=500', 500, 'Something went wrong.');
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["verify"])) {

    // $timestamp = strtotime($_SESSION['otpTime']);

    // $current_time = time();

    // $time_diff = $current_time - $timestamp;

    // if ($time_diff > 600) {
    //     echo "More than 10 minutes have passed.";
    // }

    if (!isset($_SESSION['otp_attempts'])) {
        $_SESSION['otp_attempts'] = 1;
    } else {
        $_SESSION['otp_attempts']++;
    }

    if ($_SESSION['otp_attempts'] > 2) {
        unsetSessions();
        redirect('index.php?error=wrongOTP', 500, 'You have been used 3 attempts you will be redirect back to Login.');
        exit();
    }

    
$otpRan = $_SESSION['otp'];

$num1 = $_POST['1'];
$num2 = $_POST['2'];
$num3 = $_POST['3'];
$num4 = $_POST['4'];
$num5 = $_POST['5'];
$num6 = $_POST['6'];

$otpInput = $num1.$num2.$num3.$num4.$num5.$num6;  
$otpNumber = intval($otpInput);

if($otpRan === $otpNumber){
    header('Location: ../dashboard/dashboard.php');
}else{
redirect('index.php?error=wrongOTP', 500, 'Please check if your OTP is correct.');
}
    
} else {
    unsetSessions();
    redirect('index.php?error=405', 500, 'omething went wrong.');

}
?>