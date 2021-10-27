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

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
    if($mail->send()){
        $emailSent = true;
    }    
} catch (Exception $e) {
    if(isset($isUpdateProfile)){
        echo json_encode(array("statusCode" => 202));
    }
    else{
        $output['statusCode'] = 202;
    }    
    
}
?>