<?php 
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	$sql = "UPDATE worker SET password='$_POST[newpassword]' WHERE login_id='$_POST[loginid]' AND password='$_POST[oldpassword]'";
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
<?php include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
						  <header>
								<h2>Reset Your Password</h2>
							</header>
                           <form method="post" action="" name="frmworkchngpassword" onSubmit="return validateworkchngpassword()">
                         <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
						  <table width="1013" height="245" border="2">
						    <tbody>
						      <tr>
						        <td width="119" align="right">Login ID  <font color="#FF0000">*</font></td>
						        <td width="876"><input type="text" name="loginid" id="loginid" autofocus></td>
					          </tr>
						      <tr>
						        <td align="right">Old Password <font color="#FF0000">*</font></td>
						        <td><input type="password" name="oldpassword" id="oldpassword"></td>
					          </tr>
						      <tr>
						        <td align="right">New Password <font color="#FF0000">*</font></td>
						        <td><input type="password" name="newpassword" id="newpassword">  <font color="#FF0000"> (Password must be of Minimum 8 Characters and Maximum 16 Characters in length) </font></td>
					          </tr>
						      <tr>
						        <td align="right">Confirm Password</td>
						        <td><input type="password" name="cpassword" id="cpassword"></td>
					          </tr>
						      <tr>
						        <td height="35">&nbsp;</td>
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
	function validateworkchngpassword()
	{
		

		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 
 if(document.frmworkchngpassword.loginid.value == "")
	{
		alert("Kindly enter Login ID..");
		document.frmworkchngpassword.loginid.focus();
		return false;
	}		
	else if(!document.frmworkchngpassword.loginid.value.match(emailExp))
	{
		alert("Kindly enter a Valid Login ID.");
		document.frmworkchngpassword.loginid.focus();
		return false;
	}	
	else if(document.frmworkchngpassword.oldpassword.value == "")
	{
		alert(" Enter your old password....");
		document.frmworkchngpassword.oldpassword.focus();
		return false;
	}	
	 else if(document.frmworkchngpassword.newpassword.value == "")
	{
		alert("Enter a new password..");
		document.frmworkchngpassword.newpassword.focus();
		return false;
	}	
	else if(document.frmworkchngpassword.newpassword.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmworkchngpassword.newpassword.focus();
		return false;
	}
	else if(document.frmworkchngpassword.newpassword.value.length > 16)
	{
		alert("Password length should be less than 16 characters...");
		document.frmworkchngpassword.newpassword.focus();
		return false;
	}		
	else if(document.frmworkchngpassword.cpassword.value == "")
	{
		alert("Confirm password should not be empty..");
		document.frmworkchngpassword.cpassword.focus();
		return false;
	}		
	else if(document.frmworkchngpassword.newpassword.value != document.frmworkchngpassword.cpassword.value)
	{
		alert("Password and confirm password not matching...");
		document.frmworkchngpassword.cpassword.focus();
		return false;
	}	
	else
	{
		return true;
	}
	
	}
	</script>