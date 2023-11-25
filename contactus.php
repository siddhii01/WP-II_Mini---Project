<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/Applications/XAMPP/xamppfiles/htdocs/WP/PHPMailer-master/src/Exception.php';
require '/Applications/XAMPP/xamppfiles/htdocs/WP/PHPMailer-master/src/PHPMailer.php';
require '/Applications/XAMPP/xamppfiles/htdocs/WP/PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true); // Create a new PHPMailer instance
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server address
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'contact.furnijourney@gmail.com'; // SMTP username
        $mail->Password   = 'kger szin nexz xkee'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `ssl` also accepted
        $mail->Port       = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom('contact.furnijourney@gmail.com'); // Sender's email address and name
        $mail->addAddress($email); // Recipient's email address

        //Content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = 'Contact Us Form Submission';
        $mail->Body    = "Thank you for reaching out to FurniJourney's Support & Contact Desk. We shall get back to you at the earliest.";

        $mail->send();
        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo "Failed to send email. Error: {$mail->ErrorInfo}";
    }
}
?>