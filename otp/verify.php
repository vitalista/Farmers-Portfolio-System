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
    date_default_timezone_set('Asia/Manila');
    $current_time = microtime(true);

    $time_diff = $current_time - $_SESSION['otpTime'];

    if ($time_diff > 60) {
        unsetSessions();
        redirect('../login/index.php', 404, 'Your OTP has expired. Please relogin.');
    }

    if (!isset($_SESSION['otp_attempts'])) {
        $_SESSION['otp_attempts'] = 1;
    } else {
        $_SESSION['otp_attempts']++;
    }

    if ($_SESSION['otp_attempts'] > 2) {
        unsetSessions();
        redirect('../login/index.php?error=wrongOTP', 500, 'You have been used 3 attempts, Please relogin.');
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
    $_SESSION["LAST_ACTIVITY"] = time();
    setLastAct();  
    redirect('../dashboard/dashboard.php?success=validOTP', 200, 'Welcome');
}else{
redirect('index.php?error=wrongOTP', 500, 'Please check if your OTP is correct.');
}
    
} else {
    unsetSessions();
    redirect('index.php?error=405', 500, 'Something went wrong.');

}
?>