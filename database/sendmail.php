<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '\PHPMailer\vendor\phpmailer\phpmailer\src\Exception.php';
require_once __DIR__ . '\PHPMailer\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require_once __DIR__ . '\PHPMailer\vendor\phpmailer\phpmailer\src\SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'networkedappetite@gmail.com'; // YOUR gmail email
    $mail->Password = 'M5A2TAMZx.7HbF_'; // YOUR gmail password

    $sendingFrom = "networkedappetite@gmail.com";
    // Sender and recipient settings
    $mail->setFrom($sendingFrom, 'Dns Electronics');
    $mail->addAddress($email, $name);
    //$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

    $message = "
    <h2>Thank you for Registering With Dns Electronics.</h2>    
    <p>Please click the link below to activate your account.</p>
    <a href='http://localhost/ecommerceproject/database/verifyemail.php?vkey=$verificationkey'>Activate Account!</a>
";

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Registered Successfully.";
    $mail->Body = $message;
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
    $mail->send();    
} catch (Exception $e) {
    echo json_encode(array("statusCode"=>"emailfailed"));
}
?>