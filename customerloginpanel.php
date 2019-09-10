<?php
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_SESSION[customerid]))
{
	echo "<script>window.location='customerpanel.php';</script>";
}
if(isset($_POST[submit]))
{
	$sql = "SELECT * FROM customer WHERE email_id='$_POST[emailid]' AND password='$_POST[password]' AND status='Active' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin = mysqli_fetch_array($qsql);
		$_SESSION[customerid] = $rslogin[customer_id]; 
		if(isset($_GET[pagename]))
		{
			echo "<script>window.location='" . $_GET[pagename] . "?productid=" . $_GET[productid] . "';</script>";
		}
		else
		{
			echo "<script>window.location='customerpanel.php';</script>";
		}
	}
	else
	{
		echo "<script>alert('Login ID and password not valid..');</script>";	
	}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
?>
	

		<div id="featured">
			<div class="container">
				<div class="row">
<div class="3u">
						<section>
							<header>
								<h2>New User</h2>
                                <h3><a href="customerReg.php" > Click here to Register</a><br />	<br />
                                <a href="customerReg.php"><img src="images/register.jpg" width="186" height="56" alt=""/></a> </h3>                   
							</header>
						</section>
</div>                        
					
				  <div class="9u">
						<section>
							<header>
								<h2>Customer Login Panel</h2>
							</header>
                            <form method="post" action="" name="frmcstlogin" onSubmit="return validatecstlogin()">
                             <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
                             <table width="502" height="148" border="2">
							  <tbody>
							    <tr>
							      <td width="65" align="right">E-Mail ID</td>
							      <td width="419"><input type="text" name="emailid" id="emailid" autofocus></td>
						        </tr>
							    <tr>
							      <td align="right">Password</td>
							      <td><input type="password" name="password" id="password">&nbsp;<a href="customerforgotpassword.php">Forgot Password?</a><br></td>
						        </tr>
							    <tr>
							      <td>&nbsp;</td>
							      <td><input type="submit" name="submit" id="submit" value="Login"></td>
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
function validatecstlogin()
{
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

	if(document.frmcstlogin.emailid.value == "")
	{
		alert("E-Mail ID should not be empty..");
		document.frmcstlogin.emailid.focus();
		return false;
	}	
	else if(!document.frmcstlogin.emailid.value.match(emailExp))
	{
		alert("Kindly enter Valid Email ID.");
		document.frmcstlogin.emailid.focus();
		return false;
	}
	else if(document.frmcstlogin.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmcstlogin.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>