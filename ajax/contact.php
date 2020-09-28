<?php

$name = strip_tags($_POST["name"]);
$email = strip_tags($_POST["email"]);
$text = htmlentities($_POST["message"]);


$to = 'idea@innocoder.tech';

$subject = 'Contact Message';

$headers = "From: " . $name . "\r\n";
$headers .= "Reply-To: ". $email . "\r\n";
$headers .= "CC: temitopebdms@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
$message .= '<img src="../assets/img/logo.png" alt="logo" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
$message .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";

if (($text) != '') {
    $message.= "<tr><td><strong>Message:</strong> </td><td>" . $text . "</td></tr>";
}
$message .= "</table>";
$message .= "</body></html>";

if(! mail($to, $subject, $message, $headers)){
  exit(0);
}
echo 1;

?>
