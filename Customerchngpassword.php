<?php
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	$sql = "UPDATE customer SET password='$_POST[newpassword]' WHERE email_id='$_POST[loginid]' AND password='$_POST[oldpassword]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password updated successfully...');</script>";
	}
	else
	{
		echo "<script>alert('Failed to update password...');</script>";
	}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
 ?>
	

		<div id="featured">
			<div class="container">
				<div class="row">
<?php
include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
							<header>
								<h2>Reset Your Password</h2>
							</header>
                            <form method="post" action="" name="frmcstchngpasswrd" onSubmit="return validatecstchngpasswrd()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="983" height="238" border="2">
							  <tbody>
							    <tr>
							      <td width="132" align="right">Login ID <font color="#FF0000">*</font></td>
							      <td width="833"><input type="text" name="loginid" id="loginid" autofocus></td>
						        </tr>
							    <tr>
							      <td align="right">Old Password  <font color="#FF0000">*</font></td>
							      <td><input type="password" name="oldpassword" id="oldpassword"></td>
						        </tr>
							    <tr>
							      <td align="right">New Password  <font color="#FF0000">*</font></td>
							      <td><input type="password" name="newpassword" id="newpassword"> <font color="#FF0000"> (Password must be of Minimum 8 Characters and Maximum 16 Characters in length)</font></td>
						        </tr>
							    <tr>
							      <td align="right">Confirm Password  <font color="#FF0000">*</font></td>
							      <td><input type="password" name="password3" id="password3"></td>
						        </tr>
							    <tr>
							      <td>&nbsp;</td>
							      <td><input type="submit" name="submit" id="submit" value="Change Password"></td>
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
	function validatecstchngpasswrd()
	{
		

		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 
 if(document.frmcstchngpasswrd.loginid.value == "")
	{
		alert("Kindly enter Login ID..");
		document.frmcstchngpasswrd.loginid.focus();
		return false;
	}		
	else if(!document.frmcstchngpasswrd.loginid.value.match(emailExp))
	{
		alert("Kindly enter a Valid Login ID.");
		document.frmcstchngpasswrd.loginid.focus();
		return false;
	}	
	else if(document.frmcstchngpasswrd.oldpassword.value == "")
	{
		alert(" Enter your old password....");
		document.frmcstchngpasswrd.oldpassword.focus();
		return false;
	}	
	 else if(document.frmcstchngpasswrd.newpassword.value == "")
	{
		alert("Enter a new password..");
		document.frmcstchngpasswrd.newpassword.focus();
		return false;
	}	
	else if(document.frmcstchngpasswrd.newpassword.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmcstchngpasswrd.newpassword.focus();
		return false;
	}
	else if(document.frmcstchngpasswrd.newpassword.value.length > 16)
	{
		alert("Password length should be less than 16 characters...");
		document.frmcstchngpasswrd.newpassword.focus();
		return false;
	}		
	else if(document.frmcstchngpasswrd.password3.value == "")
	{
		alert("Confirm password should not be empty..");
		document.frmcstchngpasswrd.password3.focus();
		return false;
	}		
	else if(document.frmcstchngpasswrd.newpassword.value != document.frmcstchngpasswrd.password3.value)
	{
		alert("Password and confirm password not matching...");
		document.frmcstchngpasswrd.password3.focus();
		return false;
	}	
	else
	{
		return true;
	}
	
	}
	</script>