<?php 
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
		$sql ="UPDATE customer SET  `customer_name`='$_POST[customername]', `address`='$_POST[address]', `country_id`='$_POST[country]', `state_id`='$_POST[state]', `city_id`='$_POST[city]', `pincode`='$_POST[pincode]', `contact_no`='$_POST[cntctnum]', `mobile_no`='$_POST[mblnum]', `email_id`='$_POST[emailid]', `password`='$_POST[password]', `customer_type`='$_POST[customertype]', `status`='$_POST[status]' WHERE customer_id='$_SESSION[customerid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Customer record updated successfully...');</script>";
		}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_SESSION[customerid]))
{
	$sql = "SELECT * FROM customer WHERE customer_id='$_SESSION[customerid]'";
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
								<h2>Keep Your Profile Updated Here..</h2>
							</header>
                            <form method="post" action="" name="frmcstupdate" onsubmit="return validatecstupdate()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="1028" height="590" border="2">
							  <tbody>
							    <tr>
							      <td width="136" height="34" align="right">Customer Name <font color="#FF0000">*</font></td>
							      <td width="874"><input type="text" name="customername" id="customername" value="<?php echo $rsedit[customer_name]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="48" align="right">Address <font color="#FF0000">*</font></td>
							      <td><textarea name="address" id="address"><?php echo $rsedit[address]; ?></textarea></td>
						        </tr>
							    <tr>
							      <td height="38" align="right">Country <font color="#FF0000">*</font></td>
							      <td><select name="country" id="country"> <option value="">Select</option>
                                  <?php
								  $sql1 = "SELECT * FROM country where status='Active'";
									$qsql1 =mysqli_query($con,$sql1);
								  while($rssql1 = mysqli_fetch_array($qsql1))
								  {
									  if($rssql1[country_id] == $rsedit[country_id] )
									  {
									  echo "<option value='$rssql1[country_id]' selected>$rssql1[country]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql1[country_id]'>$rssql1[country]</option>";
									  }
								  }
								  ?>
						          </select></td>
						        </tr>
							    <tr>
							      <td height="38" align="right">State <font color="#FF0000">*</font></td>
							      <td><select name="state" id="state">
                                   <option value="">Select</option>
                                  <?php
								  $sql2 = "SELECT * FROM state where status='Active'";
									$qsql2 =mysqli_query($con,$sql2);
								  while($rssql2 = mysqli_fetch_array($qsql2))
								  {
									  if($rssql2[state_id] == $rsedit[state_id] )
									  {
									  echo "<option value='$rssql2[state_id]' selected>$rssql2[state]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql2[state_id]'>$rssql2[state]</option>";
									  }
								  }
								  ?>
						          </select></td>
						        </tr>
							    <tr>
							      <td height="40" align="right">City <font color="#FF0000">*</font> </td>
							      <td><select name="city" id="city">
                                   <option value="">Select</option>
                                  <?php
								  $sql3 = "SELECT * FROM city where status='Active'";
									$qsql3 =mysqli_query($con,$sql3);
								  while($rssql3 = mysqli_fetch_array($qsql3))
								  {
									  if($rssql3[city_id] == $rsedit[city_id] )
									  {
									  echo "<option value='$rssql3[city_id]' selected>$rssql3[city]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql3[city_id]'>$rssql3[city]</option>";
									  }
								  }
								  ?>
						          </select></td>
						        </tr>
							    <tr>
							      <td height="36" align="right">Pincode <font color="#FF0000">*</font></td>
							      <td><input type="number" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="39" align="right">Contact Number <font color="#FF0000">*</font></td>
							      <td><input type="number" name="cntctnum" id="cntctnum" value="<?php echo $rsedit[contact_no]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="35" align="right">Mobile Number <font color="#FF0000">*</font></td>
							      <td><input type="number" name="mblnum" id="mblnum" value="<?php echo $rsedit[mobile_no]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="39" align="right">Email ID <font color="#FF0000">*</font></td>
							      <td><input type="text" name="emailid" id="emailid" value="<?php echo $rsedit[email_id]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="33" align="right">Customer Type <font color="#FF0000">*</font></td>
							      <td><select name="customertype" id="customertype">
                                  <option value="">Select</option>
                                   <?php
								  $arr= array("Wholesaler","Retailer","Consumer");
								  foreach($arr as $val)
								  {
									  if($rsedit[customer_type] == $val)
									  {
									  echo "<option value='$val' selected >$val</option>";
									  }
									  else
									  {
									  echo "<option value='$val'>$val</option>";
									  }
								  }
								  ?>
						          </select></td>
						        </tr>
                                <?php
								if(isset($_SESSION[adminid]))
								{
								?>
							    <tr>
							      <td height="35" align="right">Status</td>
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
                                <?php
								}
								else
								{
								?>
                              <input type="hidden" name="status" value="Active" >
                                <?php
								}
								?>                                
							    <tr>
							      <td height="72">&nbsp;</td>
							      <td><input type="submit" name="submit" id="submit" value="Submit" autofocus></td>
						        </tr>
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
	function validatecstupdate()
	{
		
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphaExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

	if(document.frmcstupdate.customername.value == "")
	{
		alert("Customer name should not be empty..");
		document.frmcstupdate.customername.focus();
		return false;
	}
	else if(!document.frmcstupdate.customername.value.match(alphaspaceExp))
	{
		alert("Please enter only letters for Customer name..");
		document.frmcstupdate.customername.focus();
		return false;
	}
	else if(document.frmcstupdate.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmcstupdate.address.focus();
		return false;
	}
	else if(document.frmcstupdate.country.value == "")
	{
		alert("Kindly select the country..");
		document.frmcstupdate.country.focus();
		return false;
	}	
	else if(document.frmcstupdate.state.value == "")
	{
		alert("Kindly select the state..");
		document.frmcstupdate.state.focus();
		return false;
	}	
	else if(document.frmcstupdate.city.value == "")
	{
		alert("Kindly select the city..");
		document.frmcstupdate.city.focus();
		return false;
	}
	else if(document.frmcstupdate.pincode.value == "")
	{
		alert("Kindly enter PIN Code..");
		document.frmcstupdate.pincode.focus();
		return false;
	}	
	else if(document.frmcstupdate.cntctnum.value == "")
	{
		alert("Kindly enter Contact number..");
		document.frmcstupdate.cntctnum.focus();
		return false;
	}
	else if(document.frmcstupdate.mblnum.value == "")
	{
		alert("Kindly enter Mobile number..");
		document.frmcstupdate.mblnum.focus();
		return false;
	}			
	else if(document.frmcstupdate.emailid.value == "")
	{
		alert("Kindly enter Email ID..");
		document.frmcstupdate.emailid.focus();
		return false;
	}		
	else if(!document.frmcstupdate.emailid.value.match(emailExp))
	{
		alert("Kindly enter Valid Email ID.");
		document.frmcstupdate.emailid.focus();
		return false;
	}	
	else if(document.frmcstupdate.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmcstupdate.password.focus();
		return false;
	}			
	else if(document.frmcstupdate.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmcstupdate.password.focus();
		return false;
	}
	else if(document.frmcstupdate.password.value.length > 16)
	{
		alert("Password length should be less than 16 characters...");
		document.frmcstupdate.password.focus();
		return false;
	}		
	else if(document.frmcstupdate.cpassword.value == "")
	{
		alert("Confirm password should not be empty..");
		document.frmcstupdate.cpassword.focus();
		return false;
	}		
	else if(document.frmcstupdate.password.value != document.frmcstupdate.cpassword.value)
	{
		alert("Password and confirm password not matching...");
		document.frmcstupdate.cpassword.focus();
		return false;
	}				
	else if(document.frmcstupdate.customertype.value == "")
	{
		alert("Kindly select the customer type..");
		document.frmcstupdate.customertype.focus();
		return false;
	}
	else
	{
		return true;
	}
	}
	</script>