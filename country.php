<?php 
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE country SET `country`='$_POST[country]', `description`='$_POST[description]', `status`='$_POST[status]' WHERE country_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Country record updated successfully...');</script>";
		}
	}
	else
	{
$sql="INSERT INTO `country`(`country_id`, `country`, `description`, `status`) VALUES ('','$_POST[country]','$_POST[description]','$_POST[status]')";	

if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query";
	}
	else
	{
		echo "<script>alert('Country record inserted successfully...');</script>";
	}
	}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM country WHERE country_id='$_GET[editid]'";
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
								<h2>Add A Country</h2>
							</header>
                            <form method="post" action="" name="frmcountry" onSubmit="return validatecountry()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="431" height="170" border="2">
							  <tbody>
							    <tr>
							      <td width="69" height="29" align="right">Country  <font color="#FF0000">*</font></td>
							      <td width="344"><input type="text" name="country" id="country" value="<?php echo $rsedit[country]; ?>" autofocus></td>
						        </tr>
							    <tr>
							      <td height="41" align="right">Description</td>
							      <td><textarea name="description" id="description"><?php echo $rsedit[description]; ?></textarea></td>
						        </tr>
							    <tr>
							      <td height="37" align="right">Status  </td>
							      <td><select name="status" id="status">
                                   <option value="">Select</option>
                                  <?php
								  $arr= array("Active","Inactive");
								  foreach($arr as $val)
								  {
									  if($rsedit[status] == $val)
									  {
									  echo "<option value='$val' selected >$val<option>";
									  }
									  else
									  {
									  echo "<option value='$val'>$val<option>";
									  }
								  }
								  ?>
						          </select></td>
						        </tr>
							    <tr>
							      <td>&nbsp;</td>
							      <td><input type="submit" name="submit" id="submit" value="Submit"></td>
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
	function validatecountry()
	{
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		if(document.frmcountry.country.value == "")
	{
		alert("Country name should not be empty..");
		document.frmcountry.country.focus();
		return false;
	}
	else if(!document.frmcountry.country.value.match(alphaspaceExp))
	{
		alert("Please enter only letters for country ..");
		document.frmcountry.country.focus();
		return false;
	}
	else
	{
		return true;
	}
	}
	</script>