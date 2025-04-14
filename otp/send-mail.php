<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../backend/functions.php';
// Include the PHPMailer autoload file
require 'vendor/autoload.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    if(empty($name) || empty($email) || empty($message)){
        redirect('../index.php?form=Incomplete#contact', 404, 'Please kindly provide the details, thank you.');
    }
    
    if(is_numeric($name)){
        redirect('../index.php?invalid=Name#contact', 404, 'Please kindly provide your name, thank you.');
    }
    
    $pattern = "/^[a-zA-Z0-9._%+-]+@gmail\.com$/";
    if (!preg_match($pattern, $email)) {
        redirect('../index.php?invalid=Email#contact', 404, 'Sorry we only accept gmail.');
    } 
        
    

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your mail server (e.g., smtp.gmail.com for Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = getenv('EMAIL_HOST'); // Your email address
        $mail->Password = getenv('APP_SCRIPT_PASSWORD');
        $mail->Port = 587; // Typically 587 for TLS

        // Recipients
        $mail->setFrom(getenv('EMAIL_HOST'), getenv('EMAIL_NAME'));
        $mail->addAddress(getenv('FORWARD_TO'), getenv('FORWARD_TO_NAME')); // The recipient's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Us Form';
        $mail->Body    = "You have received a new message from <b>$name</b>.<br><br>" .
                         "<b>Email:</b> $email<br>" .
                         "<b>Message:</b><br>" . nl2br($message);

        // Send the email
        if($mail->send()){
            redirect('../index.php?message=Sent#contact', 200, 'Message sent successfully');
        }
      
        
    } catch (Exception $e) {
        
        redirect('../index.php?message=!Sent#contact', 500, 'Message not sent');
    }
} else {
    echo 'Please fill out the form.';
    redirect('../index.php?message=!Sent#contact', 500, 'Message not sent');
}
?>
