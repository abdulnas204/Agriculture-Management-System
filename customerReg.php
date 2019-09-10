<?php 
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE customer SET  `customer_name`='$_POST[customername]', `address`='$_POST[address]', `country_id`='$_POST[country]', `state_id`='$_POST[state]', `city_id`='$_POST[city]', `pincode`='$_POST[pincode]', `contact_no`='$_POST[cntctnum]', `mobile_no`='$_POST[mblnum]', `email_id`='$_POST[emailid]', `password`='$_POST[password]', `customer_type`='$_POST[customertype]', `status`='$_POST[status]' WHERE customer_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Customer record updated successfully...');</script>";
		}
	}
	else
	{
$sql="INSERT INTO `customer`(`customer_id`, `customer_name`, `address`, `country_id`, `state_id`, `city_id`, `pincode`, `contact_no`, `mobile_no`, `email_id`, `password`, `customer_type`, `status`) VALUES ('','$_POST[customername]','$_POST[address]','$_POST[country]','$_POST[state]','$_POST[city]','$_POST[pincode]','$_POST[cntctnum]','$_POST[mblnum]','$_POST[emailid]','$_POST[password]','$_POST[customertype]','$_POST[status]')";	
if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query".mysqli_error($con);
	}
	else
	{
				echo "<script>alert('Customer Registred successfully...');</script>";
				echo "<script>window.location='customerloginpanel.php';</script>";				
	}
}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM customer WHERE customer_id='$_GET[editid]'";
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
								<h2>Customer Registration</h2>
							</header>
                            <form method="post" action="" name="frmcstreg" onSubmit="return validatecstreg()">
                             <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="965" height="585" border="2">
							  <tbody>
							    <tr>
							      <td width="136" height="34" align="right">Customer Name <font color="#FF0000">*</font></td>
							      <td width="811"><input type="text" name="customername" id="customername" value="<?php echo $rsedit[customer_name]; ?>" autofocus></td>
						        </tr>
							    <tr>
							      <td height="48" align="right">Address <font color="#FF0000">*</font></td>
							      <td><textarea name="address" id="address"><?php echo $rsedit[address]; ?></textarea></td>
						        </tr>
							    <tr>
							      <td height="38" align="right">Country <font color="#FF0000"> *</font></td>
							      <td><select name="country" id="country" onChange="loadstate(this.value)">
                                  <option value="">Select</option>
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
							      <td height="38" align="right">State <font color="#FF0000"> *</font></td>
							      <td><span id='loadstate'><select></select></span></td>
						        </tr>
							    <tr>
							      <td height="40" align="right">City <font color="#FF0000"> *</font></td>
							      <td><span id='loadcity'><select></select></span></td>
						        </tr>
							    <tr>
							      <td height="36" align="right">Pincode <font color="#FF0000"> *</font></td>
							      <td><input type="number" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="39" align="right">Contact Number <font color="#FF0000"> *</font></td>
							      <td><input type="number" name="cntctnum" id="cntctnum" value="<?php echo $rsedit[contact_no]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="35" align="right">Mobile Number <font color="#FF0000"> *</font></td>
							      <td><input type="number" name="mblnum" id="mblnum" value="<?php echo $rsedit[mobile_no]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="39" align="right">Email ID <font color="#FF0000"> *</font></td>
							      <td><input type="text" name="emailid" id="emailid" value="<?php echo $rsedit[email_id]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="36" align="right">Password <font color="#FF0000"> *</font></td>
							      <td><input type="password" name="password" id="password" value="<?php echo $rsedit[password]; ?>"> <font color="#FF0000"> (Password must be of Minimum 8 Characters and Maximum 16 Characters in length)</font></td>
						        </tr>
							    <tr>
							      <td height="35" align="right">Confirm Password <font color="#FF0000"> *</font></td>
							      <td><input type="password" name="cpassword" id="cpassword" value="<?php echo $rsedit[password]; ?>"></td>
						        </tr>
							    <tr>
							      <td height="33" align="right">Customer Type <font color="#FF0000"> *</font></td>
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
							      <td height="35" align="right">Status <font color="#FF0000"> *</font></td>
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
function validatecstreg()
{

var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

	if(document.frmcstreg.customername.value == "")
	{
		alert("Customer name should not be empty..");
		document.frmcstreg.customername.focus();
		return false;
	}
	else if(!document.frmcstreg.customername.value.match(alphaspaceExp))
	{
		alert("Please enter only letters for Customer name..");
		document.frmcstreg.customername.focus();
		return false;
	}
	else if(document.frmcstreg.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmcstreg.address.focus();
		return false;
	}
	else if(document.frmcstreg.country.value == "")
	{
		alert("Kindly select the country..");
		document.frmcstreg.country.focus();
		return false;
	}	
	else if(document.frmcstreg.state.value == "")
	{
		alert("Kindly select the state..");
		document.frmcstreg.state.focus();
		return false;
	}	
	else if(document.frmcstreg.city.value == "")
	{
		alert("Kindly select the city..");
		document.frmcstreg.city.focus();
		return false;
	}
	else if(document.frmcstreg.pincode.value == "")
	{
		alert("Kindly enter PIN Code..");
		document.frmcstreg.pincode.focus();
		return false;
	}
	else if(document.frmcstreg.cntctnum.value == "")
	{
		alert("Kindly enter Contact number..");
		document.frmcstreg.cntctnum.focus();
		return false;
	}
	else if(document.frmcstreg.mblnum.value == "")
	{
		alert("Kindly enter Mobile number..");
		document.frmcstreg.mblnum.focus();
		return false;
	}
	else if(document.frmcstreg.emailid.value == "")
	{
		alert("Kindly enter Email ID..");
		document.frmcstreg.emailid.focus();
		return false;
	}		
	else if(!document.frmcstreg.emailid.value.match(emailExp))
	{
		alert("Kindly enter Valid Email ID.");
		document.frmcstreg.emailid.focus();
		return false;
	}	
	else if(document.frmcstreg.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmcstreg.password.focus();
		return false;
	}			
	else if(document.frmcstreg.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmcstreg.password.focus();
		return false;
	}
	else if(document.frmcstreg.password.value.length > 16)
	{
		alert("Password length should be less than 16 characters...");
		document.frmcstreg.password.focus();
		return false;
	}		
	else if(document.frmcstreg.cpassword.value == "")
	{
		alert("Confirm password should not be empty..");
		document.frmcstreg.cpassword.focus();
		return false;
	}		
	else if(document.frmcstreg.password.value != document.frmcstreg.cpassword.value)
	{
		alert("Password and confirm password not matching...");
		document.frmcstreg.cpassword.focus();
		return false;
	}				
	else if(document.frmcstreg.customertype.value == "")
	{
		alert("Kindly select the customer type..");
		document.frmcstreg.customertype.focus();
		return false;
	}
	else
	{
		return true;
	}
}

function loadstate(id) {
    if (id == "") {
        document.getElementById("loadstate").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loadstate").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxstate.php?id="+id,true);
        xmlhttp.send();
    }
}
function loadcity(id) {
    if (id == "") {
        document.getElementById("loadcity").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loadcity").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxcity.php?id="+id,true);
        xmlhttp.send();
    }
}
</script>