<?php
// Load Composer's autoloader
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$name = strip_tags($_POST["name"]);
$email = strip_tags($_POST["email"]);
$text = htmlentities($_POST["message"]);

$to = 'idea@innocoder.tech';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


//Server settings
$mail->SMTPDebug  = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
$mail->isSMTP();                                              // Send using SMTP
$mail->Host       = $_ENV['EMAIL_HOST'];                    // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = $_ENV['EMAIL_ADDRESS'];                     // SMTP username
$mail->Password   = $_ENV['EMAIL_PASSWORD'];                                // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//Recipients
$mail->setFrom($email, $name);
$mail->addAddress($to, 'Innocoder');     // Add a recipient

$mail->addReplyTo($email, $name);
$mail->addCC($_ENV['EMAIL_ADDRESS']);//$mygmail_address

// Attachments
// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Contact Message';

$message = '<html><body>';
$message .= '<img src="https://innocoder.s3.amazonaws.com/img/logo.png" alt="logo" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
$message .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
$message .= "<tr><td><strong>Message:</strong> </td><td>" . $text . "</td></tr>";
$message .= "</table>";
$message .= "</body></html>";



$mail->Body = $message;

if(! $mail->send()) {
    echo 0;
} else {
    echo 1;
}
?>
