<?php

$name = $_POST["name"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$from = $_POST["from"];
$verif_box = $_POST["verif_box"];

$name = stripslashes($name);
$name=mysql_real_escape_string($name);
$message = stripslashes($message);
$message=mysql_real_escape_string($message); 
$subject = stripslashes($subject); 
$subject=mysql_real_escape_string($subject);
$from = stripslashes($from); 
$from=mysql_real_escape_string($from);


	
	$message = "Name: ".$name."\n".$message;
	$message = "From: ".$from."\n".$message;
	$sent=mail("habnarmtech@gmail.com", 'Online Form: '.$subject, $_SERVER['REMOTE_ADDR']."\n\n".$message, "From: $from");	
	


	if($sent)
	{ 
	header ("Location: sent.php");
	}
	
	else {
	header ("Location: notsent.php");
	    exit;

}
?>
