<?php
if(isset($_POST['email']))
{
session_cache_limiter( 'nocache' );
$subject = $_POST['subject']; // Subject of your email
$to = "support@themerole.com";  //Recipient's E-mail

$subject_reply = "Re:".$_POST['subject'];
$to_reply = $_POST['email'];


$headers = "From: " . $_POST['name']."<".$_POST['email'].">"."\r\n"; 


$headers_reply = "From: " . $to ."\r\n";

$message = $_POST['message'];   
$message_reply = "Thank you very much for email us."."\r\n"."We will reply you within shortest possible time."."\r\n"."\r\n"."ThemeRole Team"; 
    
if (@mail($to, $subject, $message, $headers))
{
	mail($to_reply, $subject_reply, $message_reply, $headers_reply);
	// Transfer the value 'sent' to ajax function for showing success message.
	echo 'sent';
}
else
{
	// Transfer the value 'failed' to ajax function for showing error message.
	echo 'failed';
}

}
?>