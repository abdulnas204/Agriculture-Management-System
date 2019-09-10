<?php
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_SESSION[customerid]))
{
	echo "<script>window.location='Location: customerpanel.php'</script>";
}
if(isset($_POST[submit]))
{
	$sql = "SELECT * FROM customer WHERE email_id='$_POST[emailid]' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin = mysqli_fetch_array($qsql);
$to = "$rslogin[email_id]";
$subject = "Login credentials";
$message = "Hello $rslogin[customer_name], \n your password is : $rslogin[password]";
$from = "aravinda@technopulse.in";
$headers = "From: $from";
	sendemailmsg($to,$subject,$message);
		echo "<script>alert('Check Your E-Mail For Your Password...');</script>";	

	}
	else
	{
		echo "<script>alert('Email ID does not exist..');</script>";	
	}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
?>
	

		<div id="featured">
			<div class="container">
				<div class="row">
<?php include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
							<header>
								<h2>Recover Password</h2>
							</header>
                            <form method="post" action="" name="frmrrecoverpasswrd" onSubmit="return validaterecoverpasswrd()">
                             <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="502" height="86" border="2">
							  <tbody>
							    <tr>
							      <td width="74" height="40" align="right">E-Mail ID</td>
							      <td width="410"><input name="emailid" type="text" id="emailid" size="40" autofocus></td>
						        </tr>
							    <tr>
							      <td>&nbsp;</td>
							      <td><input type="submit" name="submit" id="submit" value="Recover Password"></td>
						        </tr>
						      </tbody>
						  </table>
                          </form>
							<p>&nbsp;</p>
							
						</section>
					</div>
				</div>
			</div>
		</div>
	<?php include("footer.php");?>
	<script type="application/javascript">
	function validaterecoverpasswrd()
	{
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID


	    if(document.frmrrecoverpasswrd.emailid.value == "")
		{
			alert("E-Mail ID should not be left blank..");
			document.frmrecoverpasswrd.emailid.focus();
			return false;
		}		
		else if(!document.frmrrecoverpasswrd.emailid.value.match(emailExp))
	{
		alert("Kindly enter Valid Email ID.");
		document.frmrecoverpasswrd.emailid.focus();
		return false;
	}	
		else 
		{
			return true;
		}	
		}
	</script><?php
function sendemailmsg($emailid,$emailsubject,$emailmsg)
{
	require 'PHPMailer-master/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.dentaldiary.in';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'sendmail@dentaldiary.in';                 // SMTP username
	$mail->Password = 'q1w2e3r4/';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
	$mail->Port = 587;                                    // TCP port to connect to
	
	$mail->From = 'sendmail@dentaldiary.in';
	$mail->FromName = 'iAgro';
	$mail->addAddress($emailid, 'Joe User');     // Add a recipient
	$mail->addAddress($emailid);               // Name is optional
	$mail->addReplyTo('rdsrini94@gmail.com', 'Information');
	$mail->addCC('aravinda@technopulse.in');
	$mail->addBCC('bcc@example.com');
	
	$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = $emailsubject;
	$mail->Body    = $emailmsg;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		//echo 'Message has been sent';
	}
}

?>