<?php
require_once "Mail.php";

/* INSTRUCTIONS:
(1) Change username@YourDomain.com to your valid email address that is hosted on our server. Our Email server requiries SMTP Authentication and will not send emails on behalf of random people, so this is why the Sender of the email must match EXACTLY the email address that is used for SMTP authentication.
(2) Put the password for your email in the specified location below.  Modify only the following 4 lines of code.  
(3) For $host replace "smtp.YourDomain.com" with your own domain's SMTP address.
(4) That is all. Upload it to your website and enjoy! */

$from = "BUTH Webpage <admin@buth.edu.ng>";
$to = "BUTH ADMINISTRATION <admin@buth.edu.ng>";
$username = "admin@buth.edu.ng";
$password = "Administration12#";
$host = "smtp.buth.edu.ng";  // replace this with your domain's SMTP address.

$email = $_POST['email'] ;
$title = $_POST['title'] ;
$name = $_POST['Name'] ;
$phoneno = $_POST['phoneno'] ;
$message = $_POST['Comments'];
$message .= "\n\n ";
$message .= $title;
$message .= $name;
$message .= $phoneno;
$subject = $_POST['Subject'];

/*The message is assembled for sending */
$name = $_POST['Name'] ;
$subject = $_POST['Subject'];
$message = $_POST['Comments'];
$message .= "\n\n ";
$message .= $title . "\n";
$message .= $name . "\n";
$message .= $phoneno . "\n";
$message .= $_POST['email'];
$headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'auth' => true,
    'username' => $username,
    'password' => $password));

$mail = $smtp->send($to, $headers, $message);

if (PEAR::isError($mail)) 
{
  echo("<p>" . $mail->getMessage() . "</p>");
} 
else 
{
	/*This is were you redirect your customers after he/she feels out the form.*/
header("location: success.php");
	
 }
?>
