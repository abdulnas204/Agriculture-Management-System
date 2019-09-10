<?php
session_start();
include("header.php");
include("sidebar.php");
include("databaseconnection.php");
if(isset($_POST[btnlogin]))
{
	$hsqlcustomer="SELECT * from customer where email='$_POST[emailid]'";
	$hrescustomer=mysqli_query($con,$hsqlcustomer);
	$hres1customer=mysqli_fetch_array($hrescustomer);
	$message = "<strong>Dear $hres1customer[custfname] $hres1customer[custlname],</strong><br />
				<strong>Your Email ID is :</strong> $hres1customer[email]<br />
				<strong>Your Password is :</strong> $hres1customer[c_password]
				";
	if(mysqli_num_rows($hrescustomer) == 1)
	{
	sendmail($hres1customer[email],"WebMall Login Credentials",$message);
	}
}
?>
<div id="content" class="float_r">
	<h2>EMAIL</h2>
	  <h5><strong>Enter the Email address here</strong></h5>
		<div class="content_half float_l checkout">
		<form method="post" action="forgotpassword.php">
			<p>Email ID
			<input name="emailid" type="text" id="email id"  style="width:300px;"  />
			  <br />
		  </p>
		
			 
			  <input type="submit" name="btnlogin" id="btnlogin" value="Submit" />
		  </p> 
		  </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="Back"><a href="login.php"><b>BACK</b></a></label><br />
		  
		</div>
		
		<div class="content_half float_r checkout"></div>
		
		<div class="cleaner h50"></div>
</div> 
	<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<?php
include("footer.php");
function sendmail($toaddress,$subject,$message)
{
	require 'PHPMailer-master/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.dentaldiary.in';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'sendmail@dentaldiary.in';                 // SMTP username
	$mail->Password = 'q1w2e3r4/';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
	
	$mail->From = 'sendmail@dentaldiary.in';
	$mail->FromName = 'Web Mall';
	$mail->addAddress($toaddress, 'Joe User');     // Add a recipient
	$mail->addAddress($toaddress);               // Name is optional
	$mail->addReplyTo('aravinda@technopulse.in', 'Information');
	$mail->addCC('cc@example.com');
	$mail->addBCC('bcc@example.com');
	
	$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->AltBody = $subject;
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo '<center><strong><font color=green>Login credentails sent to your Email ID.</font></strong></center>';
	}
}
?>
  