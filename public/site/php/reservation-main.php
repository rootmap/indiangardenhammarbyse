<?php
if(isset($_POST['mail']))
{
session_cache_limiter( 'nocache' );
$subject = "Reservation Request From ".$_POST['name']; // Subject of your email
$to = "support@uysys.com";  //Recipient's E-mail

$subject_reply = "Re:".$subject;
$to_reply = $_POST['mail'];


$headers = "From: " . $_POST['name']."<".$_POST['mail'].">"."\r\n"; 


$headers_reply = "From: " . $to ."\r\n";

$message = "Name:". $_POST['name']."\r\n"."Date:".$_POST['date']."\r\n"."Time:".$_POST['time']."\r\n"."No of Person:".$_POST['person-no']."\r\n"."Phone No:".$_POST['phone']."\r\n".$_POST['message'];   
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