<?php 
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE product_purchase_bill SET `country_id`='$_POST[country]', `state_id`='$_POST[state]', `city_id`='$_POST[city]', `customer_name`='$_POST[customername]', `customer_address`='$_POST[customeraddress]', `pincode`='$_POST[pincode]', `customer_contact_number`='$_POST[contactnumber]', `purchase_date`='', `status`='$_POST[status]' WHERE product_purchase_bill_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Product Purchase Bill record updated successfully...');</script>";
		}
	}
	else
	{
$sql="INSERT INTO `product_purchase_bill`(`product_purchase_bill_id`, `country_id`, `state_id`, `city_id`, `customer_name`, `customer_address`, `pincode`, `customer_contact_number`, `purchase_date`, `status`) VALUES ('','$_POST[country]','$_POST[state]','$_POST[city]','$_POST[customername]','$_POST[customeraddress]','$_POST[pincode]','$_POST[contactnumber]','','$_POST[status]')";
if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query";
	}
	else
	{
		echo "<script>alert('Product Purchase Bill record inserted successfully...');</script>";
	}	
}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM product_purchase_bill WHERE product_purchase_bill_id='$_GET[editid]'";
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
								<h2>Product Purchase Bill</h2>
							</header>
                            <form method="post" action="" name="frmprodpurchasebill" onSubmit="return validateprodpurchasebill()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
						  <table width="326" height="232" border="2">
						    <tbody>
						      <tr>
						        <td width="140" align="right">Customer Name  <font color="#FF0000">*</font></td>
						        <td width="168"><input type="text" name="customername" id="customername" value="<?php echo $rsedit[customer_name]; ?>" autofocus ></td>
					          </tr>
						      <tr>
						        <td align="right">Customer Address <font color="#FF0000">*</font></td>
						        <td><textarea name="customeraddress" id="customeraddress"><?php echo $rsedit[customer_address]; ?> </textarea></td>
					          </tr>
						      <tr>
						        <td align="right">Country <font color="#FF0000">*</font></td>
						        <td><select name="country" id="country">
                                <option value="">Select</option>
                                  <?php
								  $sql4 = "SELECT * FROM country where status='Active'";
									$qsql4 =mysqli_query($con,$sql4);
								  while($rssql4= mysqli_fetch_array($qsql4))
								  {
									  if($rssql4[country_id] == $rsedit[country_id] )
									  {
									  echo "<option value='$rssql4[country_id]' selected>$rssql4[country]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql4[country_id]'>$rssql4[country]</option>";
									  }
								  }
								  ?>
					            </select></td>
					          </tr>
						      <tr>
						        <td align="right">State <font color="#FF0000">*</font></td>
						        <td><select name="state" id="state">
                                <option value="">Select</option>
                                  <?php
								  $sql3 = "SELECT * FROM state where status='Active'";
									$qsql3 =mysqli_query($con,$sql3);
								  while($rssql3= mysqli_fetch_array($qsql3))
								  {
									  if($rssql3[state_id] == $rsedit[state_id] )
									  {
									  echo "<option value='$rssql3[state_id]' selected>$rssql3[state]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql3[state_id]'>$rssql3[state]</option>";
									  }
								  }
								  ?>
					            </select></td>
					          </tr>
						      <tr>
						        <td align="right">City <font color="#FF0000">*</font></td>
						        <td><select name="city" id="city">
                                 <option value="">Select</option>
                                  <?php
								  $sql2 = "SELECT * FROM city where status='Active'";
									$qsql2 =mysqli_query($con,$sql2);
								  while($rssql2 = mysqli_fetch_array($qsql2))
								  {
									  if($rssql2[city_id] == $rsedit[city_id] )
									  {
									  echo "<option value='$rssql2[city_id]' selected>$rssql2[city]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql2[city_id]'>$rssql2[city]</option>";
									  }
								  }
								  ?>
					            </select></td>
					          </tr>
						      <tr>
						        <td align="right">Pincode <font color="#FF0000">*</font></td>
						        <td><input type="number" name="pincode" id="pincode"  value="<?php echo $rsedit[pincode]; ?>" ></td>
					          </tr>
						      <tr>
						        <td align="right">Contact Number <font color="#FF0000">*</font></td>
						        <td><input type="number" name="contactnumber" id="contactnumber" value="<?php echo $rsedit[customer_contact_number]; ?>"  ></td>
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
	function validateprodpurchasebill()
	{
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers

		if(document.frmprodpurchasebill.customername.value == "")
		{
			alert("Customer name should not be empty..");
			document.frmprodpurchasebill.customername.focus();
			return false;
		}
		else if(!document.frmprodpurchasebill.customername.value.match(alphaspaceExp))
		{
			alert("Please enter only letters Customer name..");
			document.frmprodpurchasebill.customername.focus();
			return false;
		}
		else if(document.frmprodpurchasebill.customeraddress.value == "")
		{
			alert("Customer address should not be empty..");
			document.frmprodpurchasebill.customeraddress.focus();
			return false;
		}
		else if(document.frmprodpurchasebill.country.value == "")
		{
			alert("Kindly select the country..");
			document.frmprodpurchasebill.country.focus();
			return false;
		}	
		else if(document.frmprodpurchasebill.state.value == "")
		{
			alert("Kindly select the state..");
			document.frmprodpurchasebill.state.focus();
			return false;
		}	
		else if(document.frmprodpurchasebill.city.value == "")
		{
			alert("Kindly select the city..");
			document.frmprodpurchasebill.city.focus();
			return false;
		}
		else if(document.frmprodpurchasebill.pincode.value == "")
		{
			alert("Kindly enter PIN Code..");
			document.frmprodpurchasebill.pincode.focus();
			return false;
		}	
		else if(document.frmprodpurchasebill.contactnumber.value == "")
		{
			alert("Kindly enter Contact number..");
			document.frmprodpurchasebill.contactnumber.focus();
			return false;
		}		
		else
		{
			return true;
		}
	}
	</script>