<?php 
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
		$sql ="UPDATE seller SET seller_name='$_POST[sellername]', seller_address='$_POST[selleraddress]', state_id='$_POST[state]', country_id='$_POST[country]', city_id='$_POST[city]', pincode='$_POST[pincode]', contact_number='$_POST[contactnumber]', mobile_no='$_POST[mbnumber]', email_id='$_POST[emailid]', bank_name='$_POST[bankname]', bank_branch='$_POST[branch]', bank_IFSC='$_POST[ifsccode]', bank_acno='$_POST[bankacnumber]', status='Active' WHERE seller_id='$_SESSION[sellerid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Seller record updated successfully...');</script>";
		}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_SESSION[sellerid]))
{
	$sql = "SELECT * FROM seller WHERE seller_id='$_SESSION[sellerid]'";
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
								<h2>Update Seller Information</h2>
							</header>
                            <form method="post" action="" name="frmsellprofile" onSubmit="return validatesellprofile()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
						  <table width="451" height="564" border="2">
						    <tbody>
						      <tr>
						        <td width="246" align="right">Seller Name <font color="#FF0000">*</font></td>
						        <td width="187"><input type="text" name="sellername" id="sellername" value="<?php echo $rsedit[seller_name]; ?>" autofocus></td>
					          </tr>
						      <tr>
						        <td align="right">Seller Address  <font color="#FF0000">*</font></td>
						        <td><textarea name="selleraddress" id="selleraddress"><?php echo $rsedit[seller_address]; ?></textarea></td>
					          </tr>
						      <tr>
						        <td align="right">Country  <font color="#FF0000">*</font></td>
						        <td><select name="country" id="country" onClick="loadstate(this.value)">
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
						        <td align="right">State <font color="#FF0000">*</font></td>
						        <td><span id='loadstate'><select></select></span></td>
					          </tr>
						      <tr>
						        <td align="right">City <font color="#FF0000">*</font></td>
						        <td><span id='loadcity'><select></select></span></td>
					          </tr>
						      <tr>
						        <td align="right">Pincode  <font color="#FF0000">*</font></td>
						        <td><input type="number" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Contact Number <font color="#FF0000">*</font></td>
						        <td><input type="number" name="contactnumber" id="contactnumber" value="<?php echo $rsedit[contact_number]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Mobile Number  <font color="#FF0000">*</font></td>
						        <td><input type="number" name="mbnumber" id="mbnumber" value="<?php echo $rsedit[mobile_no]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Email ID  <font color="#FF0000">*</font></td>
						        <td><input type="text" name="emailid" id="emailid" value="<?php echo $rsedit[email_id]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Bank Name  <font color="#FF0000">*</font> </td>
						        <td><input type="text" name="bankname" id="bankname" value="<?php echo $rsedit[bank_name]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Branch  <font color="#FF0000">*</font></td>
						        <td><input type="text" name="branch" id="branch" value="<?php echo $rsedit[bank_branch]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">IFSC Code  <font color="#FF0000">*</font></td>
						        <td><input type="text" name="ifsccode" id="ifsccode" value="<?php echo $rsedit[bank_IFSC]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Bank Account Number  <font color="#FF0000">*</font></td>
						        <td><input type="text" name="bankacnumber" id="bankacnumber" value="<?php echo $rsedit[bank_acno]; ?>"></td>
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
      function validatesellprofile()
	  {
				var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
				var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
				var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
				var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

		  if(document.frmsellprofile.sellername.value == "")
		  {
			alert("Seller name should not be empty..");
			document.frmsellprofile.sellername.focus();
			return false;
		  }
		  else if(!document.frmsellprofile.sellername.value.match(alphaspaceExp))
		{
			alert("Please enter only letters for Seller name..");
			document.frmsellprofile.sellername.focus();
			return false;
		}
			  else if(document.frmsellprofile.selleraddress.value == "")
		  {
			alert("Seller address should not be empty..");
			document.frmsellprofile.selleraddress.focus();
			return false;
		  }
		  else if(document.frmsellprofile.country.value == "")
		  {
			alert("Kindly select the country..");
			document.frmsellprofile.country.focus();
			return false;
		  }
		    else if(document.frmsellprofile.state.value == "")
		  {
			alert("Kindly select the state...");
			document.frmsellreg.state.focus();
			return false;
		  }
		    else if(document.frmsellprofile.city.value == "")
		  {
			alert("Kindly select the city..");
			document.frmsellprofile.city.focus();
			return false;
		  }
		   else if(document.frmsellprofile.pincode.value == "")
		  {
			alert("Kindly enter the pincode..");
			document.frmsellprofile.pincode.focus();
			return false;
		  }
		   else if(document.frmsellprofile.emailid.value == "")
		  {
			alert("Kindly enter the E-Mail ID..");
			document.frmsellprofile.emailid.focus();
			return false;
		  }
		  	else if(!document.frmsellprofile.emailid.value.match(emailExp))
	{
		alert("Kindly enter Valid Email ID.");
		document.frmsellprofile.emailid.focus();
		return false;
	}	
		   else if(document.frmsellprofile.bankname.value == "")
		  {
			alert("Kindly enter the name of the bank...");
			document.frmsellprofile.bankname.focus();
			return false;
		  }
		    else if(!document.frmsellprofile.bankname.value.match(alphaspaceExp))
		{
			alert("Please enter only letters..");
			document.frmsellprofile.bankname.focus();
			return false;
		}
		    else if(document.frmsellprofile.branch.value == "")
		  {
			alert("Kindly enter the branch of the bank...");
			document.frmsellprofile.branch.focus();
			return false;
		  }
		    else if(!document.frmsellprofile.branch.value.match(alphaspaceExp))
		{
			alert("Please enter only letters ..");
			document.frmsellprofile.branch.focus();
			return false;
		}
		   else if(document.frmsellprofile.ifsccode.value == "")
		  {
			alert("Kindly enter the IFSC Code of the bank...");
			document.frmsellprofile.ifsccode.focus();
			return false;
		  }
		   else if(document.frmsellprofile.ifsccode.value.length > 11)
		  {
			alert("Kindly enter a valid 11 Characters IFSC Code...");
			document.frmsellprofile.ifsccode.focus();
			return false;
		  }
		   else if(document.frmsellprofile.ifsccode.value.length < 11)
		  {
			alert("Kindly enter a valid 11 Characters IFSC Code...");
			document.frmsellprofile.ifsccode.focus();
			return false;
		  }
		  else if(document.frmsellprofile.bankacnumber.value == "")
		  {
			alert("Kindly enter the A/c number of the bank...");
			document.frmsellprofile.bankacnumber.focus();
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
        xmlhttp.open("GET","ajaxstate.php?id="+id+"&profile=set",true);
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
        xmlhttp.open("GET","ajaxcity.php?id="+id+"&profile=set",true);
        xmlhttp.send();
    }
}
	  </script>