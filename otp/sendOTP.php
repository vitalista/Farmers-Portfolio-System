<?php
session_start();
require_once '../backend/functions.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// Set up PHPMailer
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = getenv('EMAIL_HOST');
$mail->Password = getenv('APP_SCRIPT_PASSWORD'); // App script password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
try {
    // Generate OTP
    if (!isset($_SESSION['otpTime'])) {
        $otp = $_SESSION['otp'];
        
        date_default_timezone_set('Asia/Manila');
        $_SESSION['otpTime'] = microtime(true);
    
    
    // Email content
    $mail->setFrom(getenv('EMAIL_HOST'), getenv('EMAIL_NAME'));
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP for Verification';
    $message = "Your OTP for verification is: <strong>$otp</strong> Please note that you only have 3 attempts and it's valid for 5 minutes. Use it wisely.";

    $mail->Body = $message;

    $mail->send(); // Send email to users
    }
    
    if(isset($_POST['email']) && isset($_POST['resend'])){
       try{
            $_SESSION['otp'] = rand(100000, 999999);
            $otp = $_SESSION['otp'];
            
            date_default_timezone_set('Asia/Manila');
            $_SESSION['otpTime'] = microtime(true);
            $mail->setFrom(getenv('EMAIL_HOST'), getenv('EMAIL_NAME'));
            $mail->addAddress($_POST['email']);
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Verification';
            $message = "Your OTP for verification is: <strong>$otp</strong> Please note that you only have 3 attempts and it's valid for 5 minutes. Use it wisely.";
            $mail->Body = $message;
            $mail->send();
            redirect('index.php', 200, 'OTP resent.');
       }catch(Exception $e){
            redirect('index.php', 404, 'OTP not sent, Something went wrong.');
       }
    }
    
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>
