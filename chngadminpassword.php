<?php include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{

if(isset($_POST[changepassword]))
{
	$sql = "UPDATE admin SET password='$_POST[newpassword]' WHERE login_id='$_POST[loginid]' AND password='$_POST[oldpassword]'";
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
								<h2>Change Admin Password</h2>
							</header>
                            <form method="post" action="" name="frmchngadminpasswrd" onSubmit="return validateadminchngpassword()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="994" height="223" border="2">
							  <tbody>
							    <tr>
							      <th width="132" scope="row" align="right">Login ID <font color="#F5070B">*</font></th>
							      <td width="844"><input type="text" name="loginid" id="loginid" autofocus></td>
						        </tr>
							    <tr>
							      <th scope="row" align="right">Old Password <font color="#F5070B">*</font></th>
							      <td><input type="password" name="oldpassword" id="oldpassword"></td>
						        </tr>
							    <tr>
							      <th scope="row" align="right">New Password <font color="#F5070B">*</font></th>
							      <td><input type="password" name="newpassword" id="newpassword"> <font color="#FF0000""> (Password must be of Minimum 8 Characters and Maximum 16 Characters in length) </font> </td>
						        </tr>
							    <tr>
							      <th scope="row" align="right">Confirm Password <font color="#F5070B">*</font></th>
							      <td><input type="password" name="cpassword" id="cpassword"></td>
						        </tr>
							    <tr>
							      <th scope="row">&nbsp;</th>
							      <td><input type="submit" name="changepassword" id="changepassword" value="Change Password"></td>
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
	function validateadminchngpassword()
	{
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 
 if(document.frmchngadminpasswrd.loginid.value == "")
	{
		alert("Kindly enter Login ID..");
		document.frmchngadminpasswrd.loginid.focus();
		return false;
	}		
	else if(!document.frmchngadminpasswrd.loginid.value.match(emailExp))
	{
		alert("Kindly enter a Valid Login ID.");
		document.frmchngadminpasswrd.loginid.focus();
		return false;
	}	
	else if(document.frmchngadminpasswrd.oldpassword.value == "")
	{
		alert(" Enter your old password....");
		document.frmchngadminpasswrd.oldpassword.focus();
		return false;
	}	
	else if(document.frmchngadminpasswrd.newpassword.value == "")
	{
		alert("Enter a new password..");
		document.frmchngadminpasswrd.newpassword.focus();
		return false;
	}	
	else if(document.frmchngadminpasswrd.newpassword.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmchngadminpasswrd.newpassword.focus();
		return false;
	}
	else if(document.frmchngadminpasswrd.newpassword.value.length > 16)
	{
		alert("Password length should be less than 16 characters...");
		document.frmchngadminpasswrd.newpassword.focus();
		return false;
	}		
	else if(document.frmchngadminpasswrd.cpassword.value == "")
	{
		alert("Confirm password should not be empty..");
		document.frmchngadminpasswrd.cpassword.focus();
		return false;
	}		
	else if(document.frmchngadminpasswrd.newpassword.value != document.frmchngadminpasswrd.cpassword.value)
	{
		alert("Password and confirm password not matching...");
		document.frmchngadminpasswrd.cpassword.focus();
		return false;
	}	
	else
	{
		return true;
	}
	}
    </script>