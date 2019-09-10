<?php 
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE state SET `country_id`='$_POST[country]', `state`='$_POST[state]', `description`='$_POST[description]', `status`='Active' where state_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('State record updated successfully...');</script>";
		}
	}
	else
	{
$sql="INSERT INTO `state`(`state_id`, `country_id`, `state`, `description`, `status`) VALUES ('','$_POST[country]','$_POST[state]','$_POST[description]','Active')";	
if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query";
	}
	else
	{
		echo "<script>alert('State record inserted successfully...');</script>";
	}
}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM state WHERE state_id='$_GET[editid]'";
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
								<h2>Add A State</h2>
							</header>
                            <form method="post" action="" name="frmstate" onSubmit="return validatestate()">
                             <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="400" height="196" border="2">
							  <tbody>
							    <tr>
							      <td width="73" align="right">Country <font color="#FF0000">*</font></td>
							      <td width="309"><select name="country" id="country" autofocus>
                                   <option value="">Select</option>
                                  <?php
								  $sql2 = "SELECT * FROM country where status='Active'";
									$qsql2 =mysqli_query($con,$sql2);
								  while($rssql2 = mysqli_fetch_array($qsql2))
								  {
									  if($rssql2[country_id] == $rsedit[country_id] )
									  {
									  echo "<option value='$rssql2[country_id]' selected>$rssql2[country]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql2[country_id]'>$rssql2[country]</option>";
									  }
								  }
								  ?>
						          </select></td>
						        </tr>
							    <tr>
							      <td align="right">State <font color="#FF0000">*</font></td>
							      <td><input type="text" name="state" id="state" value="<?php echo $rsedit[state]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="43" align="right">Description</td>
							      <td><textarea name="description" id="description"><?php echo $rsedit[description]; ?></textarea></td>
						        </tr>
							    <tr>
							      <td align="right">Status</td>
							      <td><select name="status" id="status">
							        <option value="Active">Active</option>
							        <option value="Inactive">Inactive</option>
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
	function validatestate()
	{
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space

		if(document.frmstate.country.value == "")
	{
		alert("Kindly select the country..");
		document.frmstate.country.focus();
		return false;
	}
	else if(document.frmstate.state.value == "")
	{
		alert("State should not be blank..");
		document.frmstate.state.focus();
		return false;
	}
	else if(!document.frmstate.state.value.match(alphaspaceExp))
	{
		alert("Please enter only letters for state..");
		document.frmstate.state.focus();
		return false;
	}
	else
	{
		return true;
	}
	}
	</script>