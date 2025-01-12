<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../system/local-cdn/alertify.min.css">
    <title>OTP</title>
</head>
<body style="
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url('');">

<?php

session_start();

if(!isset($_SESSION['otp'])){
    unset($_SESSION['otp_attempts']);
    unset($_SESSION['otp']);
    unset($_SESSION['otpTime']);
    echo "<script>window.location.href = '../login';</script>";
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
        unset($_SESSION['otp']);
        unset($_SESSION['otpTime']);
        unset($_SESSION['otp_attempts']);
        echo '<script>alert("You have been used 3 attempts you will be redirect back to Login Page"); window.location.href = "../login";</script>';
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
echo '<script>alert("WRONG OTP"); window.location.href = "../otp";</script>';
}
    
} else {
    unset($_SESSION['otp_attempts']);
    unset($_SESSION['otp']);
    unset($_SESSION['otpTime']);
   echo '<script>alert("INVALID REQUEST"); window.location.href = "../login";</script>';
}
?>

<script src="../system/local-cdn/alertify.min.js"></script>
</body>
</html>
