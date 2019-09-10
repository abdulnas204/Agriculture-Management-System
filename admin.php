<?php include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE admin SET  `admin_name`='$_POST[adminname]', `login_id`='$_POST[loginid]', `password`='$_POST[password]', `status`='$_POST[status]' where admin_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Admin record updated successfully...');</script>";
		}
	}
	else
	{
$sql="INSERT INTO `admin`(`admin_id`, `admin_name`, `login_id`,`password`,`status`) VALUES ('','$_POST[adminname]','$_POST[loginid]','$_POST[password]','$_POST[status]')";
if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query". mysqli_error($con);
	}
	else
	{
		echo "<script>alert(' Admin record inserted successfully...');</script>";
	}	
}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM admin WHERE admin_id='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
}
?>
	

		<div id="featured">
			<div class="container">
				<div class="row">
<?php include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
							<header>
								<h2>Add An Admin</h2>
							</header>
							<form method=POST action="" name="frmadminreg" onSubmit="return validateadminreg()">
                             <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
                            <table width="1108" height="207" border="2">
							  <tbody>
							    <tr>
							      <th width="132" height="27" scope="row" align="right">Admin Name  <font color="#FF0000">*</font></th>
							      <td width="958"><input type="text" name="adminname" id="adminname" value="<?php echo $rsedit[admin_name]; ?>" autofocus></td>
						        </tr>
							    <tr>
							      <th height="35" scope="row" align="right">Login ID  <font color="#FF0000">*</font></th>
							      <td><input type="text" name="loginid" id="loginid" value="<?php echo $rsedit[login_id]; ?>"></td>
						        </tr>
							    <tr>
							      <th height="33" scope="row" align="right">Password  <font color="#FF0000">*</font> </th>
							      <td><input type="password" name="password" id="password" value="<?php echo $rsedit[password]; ?>"> 
							        <font color="#FF0000"> (Password must be of Minimum 8 Characters and Maximum 16 Characters in length)</font>         </td>
						        </tr>
							    <tr>
							      <th height="29" scope="row" align="right">Confirm Password  <font color="#FF0000">*</font></th>
							      <td><input type="password" name="cpassword" id="cpassword" value="<?php echo $rsedit[password]; ?>"></td>
						        </tr>
							    <tr>
							      <th height="33" scope="row" align="right">Status  </th>
							      <td><select name="status" id="status">
                                    <?php
									$arr = array("Active","Inactive");
									foreach($arr as $val)
									{
										if($val == $rsedit[status])
										{
										echo "<option value='$val' selected>$val</option>";
										}
										else
										{
										echo "<option value='$val'>$val</option>";										
										}
									}
									?>
						          </select></td>
						        </tr>
							    <tr>
							      <th colspan="2" scope="row" align="center"><input type="submit" name="submit" id="submit" value="Submit"></th>
						        </tr>
						      </tbody>
						  </table></form>
							<p>&nbsp;</p>
							
						</section>
					</div>
				</div>
			</div>
		</div>
	<?php include("footer.php");?>
	<script type="application/javascript">
	function validateadminreg()
	{
		
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

		if(document.frmadminreg.adminname.value == "")
	{
		alert("Admin name should not be empty..");
		document.frmadminreg.adminname.focus();
		return false;
	}
	else if(!document.frmadminreg.adminname.value.match(alphaspaceExp))
	{
		alert("Please enter only letters for Admin name..");
		document.frmadminreg.adminname.focus();
		return false;
	}
	else if(document.frmadminreg.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmadminreg.loginid.focus();
		return false;
	}
	else if(!document.frmadminreg.loginid.value.match(emailExp))
	{
		alert("Kindly enter Valid Login ID.");
		document.frmadminreg.loginid.focus();
		return false;
	}
	else if(document.frmadminreg.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmadminreg.password.focus();
		return false;
	}
	else if(document.frmadminreg.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmadminreg.password.focus();
		return false;
	}
	else if(document.frmadminreg.password.value.length > 16)
	{
		alert("Password length should be less than 16 characters...");
		document.frmadminreg.password.focus();
		return false;
	}
	else if(document.frmadminreg.cpassword.value == "")
	{
		alert("Confirm password should not be empty..");
		document.frmadminreg.cpassword.focus();
		return false;
	}
	else if(document.frmadminreg.password.value != document.frmadminreg.cpassword.value)
	{
		alert("Password and confirm password not matching...");
		document.frmadminreg.password.focus();
		return false;
	}
	else
	{
	
	return true;
	}
	}
	</script>