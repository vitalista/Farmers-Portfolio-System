<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// Set up PHPMailer
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '';
$mail->Password = ''; // App script password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
try {
    // Generate OTP
    
    if (!isset($_SESSION['otp']) && !isset($_SESSION['otpTime'])) {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['otpTime'] = time();
    
    // Email content
    $mail->setFrom('', 'Baliwag Agriculture Office');
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP for Verification';
    $message = "Your OTP for verification is: <strong>$otp</strong> Please note that you only have 3 attempts and it's valid for 1 minute. Use it wisely.";

    $mail->Body = $message;

    // $mail->send();
    }
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

// echo $_POST['email'];

?>
