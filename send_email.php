<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
try {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(strip_tags(trim($_POST['form_name'])));
    $email = htmlspecialchars(strip_tags(trim($_POST['form_email'])));
    $subject = htmlspecialchars(strip_tags(trim($_POST['form_subject'])));
    $phone = htmlspecialchars(strip_tags(trim($_POST['form_phone'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['form_message'])));

    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '292bf80f4526e8'; 
        $mail->Password = 'ac0a1165026e85'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587; 

      
        $mail->setFrom($email, $name);
        $mail->addAddress('abc@gmail.com');
        $mail->addReplyTo($email, $name); 

        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

        $mail->send();
        echo json_encode(['status' => 'true', 'message' => 'Message sent successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'false', 'message' => 'Failed to send message. Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'false', 'message' => 'Invalid request.']);
}
} catch (Exception $e) {
    echo json_encode(['status' => 'false', 'message' => 'Failed to send message. Mailer Error: ' . $mail->ErrorInfo]);
}

?>
