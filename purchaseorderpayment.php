<?php 
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM purchase_request WHERE purchase_request_id='$_GET[deleteid]'";
	if(!mysqli_query($con,$sql))
	{
		echo "<script>alert('Failed to delete record'); </script>";
	}
	else
	{
		echo "<script>alert('This record deleted successfully..'); </script>";
	}
}
if(isset($_POST[submit]))
{
	$sql = "SELECT * FROM purchase_order WHERE purchase_order_id='$_GET[purchaseorderid]'";
	$qsql = mysqli_query($con,$sql);
	$rspurchase_order = mysqli_fetch_array($qsql);
 	$purchase_request_id = $rspurchase_order[purchase_request_id];

	$sql = "UPDATE purchase_request SET status='Paid' WHERE purchase_order_id='$purchase_request_id'";
	mysqli_query($con,$sql);
		
	$sql = "UPDATE purchase_order SET status='Paid' WHERE purchase_order_id='$_GET[purchaseorderid]'";
	mysqli_query($con,$sql);
	
 	$sql = "UPDATE product SET quantity= quantity - $rspurchase_order[quantity] WHERE product_id='$rspurchase_order[product_id]'";
	mysqli_query($con,$sql);
	
	$sql = "INSERT INTO `purchase_order_bill`(purchase_order_id, `payment_type`, `payment_description`, `paid_date`, `paid_amt`, `status`) VALUES ('$_GET[purchaseorderid]','$_POST[paymenttype]','Card Holder name: $_POST[txtcardholdname] Card Number: $_POST[txtcardnumb] Expiry date: $_POST[txtexpirydate] CVV No.$_POST[txtcvv]','$dt','$_POST[txtpayment]','Active')";
	if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query". mysqli_error($con);
	}
	else
	{
		
		$sqlsellerproduct = "SELECT * FROM product WHERE product_id='$rspurchase_order[product_id]'";
		$qsqlsellerproduct = mysqli_query($con,$sqlsellerproduct);
		$rssellerproduct = mysqli_fetch_array($qsqlsellerproduct);
		
		$sqlseller = "SELECT * FROM seller WHERE seller_id='$rssellerproduct[seller_id]'";
		$qsqlseller = mysqli_query($con,$sqlseller);
		$rsseller = mysqli_fetch_array($qsqlseller);
?>
<iframe src="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=iagro&password=825848045&sendername=iiagro&mobileno=<?php echo $rsseller[mobile_no]; ?>&message=<?php echo "Your payment bill for the produce $rssellerproduct[title] has been made." ; ?>"></iframe>
<?php
		echo "<script>alert('Payment Done successfully...');</script>";
		$insid = mysqli_insert_id($con);
		echo "<script>window.location='salesprintbill.php?purchase_order_bill_id=$insid';</script>";
	}
	
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;

?><div id="featured">
			<div class="container">
				<div class="row">
<?php include("leftsidebar.php");
?>				
					<div class="9u">
					  <section>
					    <header>
								<h2>Purchase Order Payment</h2>
						  </header>
						  <table width="850" height="31" border="1" class="tftable">
						    <tr>
						      <th height="25"><strong>Product</strong></th>
						      <th><strong>Customer Name</strong></th>
						      <th><strong>Request Date</strong></th>
						      <th><strong>Amount</strong></th>
						      <th><strong>Quantity</strong></th>
						      <th><strong>Status</strong></th>                           
					        </tr>
                            <?php
							  $sql = "SELECT * FROM `purchase_order` WHERE customer_id='$_SESSION[customerid]' AND purchase_order_id='$_GET[purchaseorderid]'";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
								  $sql1 = "SELECT * FROM product WHERE product_id='$rs[product_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  								  
								  $sql2= "SELECT * FROM customer WHERE customer_id='$rs[customer_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs2 = mysqli_fetch_array($qsql2);
								  
								  $purchaseamt = $rs[purchase_amt];
									echo "
									<tr>
									  <td>&nbsp;$rs1[title]</td>
									  <td>&nbsp;$rs2[customer_name]</td>
									  <td>&nbsp;$rs[purchase_order_date]</td>
									  <td>&nbsp;$rupeesymbol $rs[purchase_amt]</td>
									  <td>&nbsp;$rs[quantity] $rs1[quantity_type]</td>
									  <td>&nbsp;$rs[status]</td>									  
									</tr>";
							  }
							  ?>
					      </table>
						  <p>&nbsp;</p>
                        <form method="post" action="" name="frmorderpayment" onSubmit="return validateorderpayment()">
                        <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
						  <table width="477" height="213" border="3">
  <tbody>
    <tr>
      <td width="149" align="right">Payment Type: <font color="#FF0004"> * </font></td>
      <td width="308"><select name="paymenttype" id="select" autofocus>
  
                                  <option value="">Select</option>
                                  <?php
								  $arr= array("Visa","Master Card","Rupay");
								  foreach($arr as $val)
								  {
									  echo "<option value='$val'>$val</option>";
								  }
								  ?>
        </select></td>
    </tr>
    <tr>
      <td align="right">Card Holder Name: <font color="#FF0004"> * </font></td>
      <td><input type="text" name="txtcardholdname" id="txtcardholdname"></td>
    </tr>
    <tr>
      <td align="right">Card Number: <font color="#FF0004"> * </font></td>
      <td><input type="number" name="txtcardnumb" id="txtcardnumb" size="16"></td>
    </tr>
    <tr>
      <td align="right">Expiry Date: <font color="#FF0004"> * </font></td>
      <td><input type="month" name="txtexpirydate" min="<?php echo date("Y-m"); ?>" id="txtexpirydate"></td>
    </tr>
    <tr>
      <td align="right">CVV Number: <font color="#FF0004"> * </font></td>
      <td><input type="number" name="txtcvv" id="txtcvv" min="100" max="999"></td>
    </tr>
    <tr>
      <td align="right">Payment Amount: <font color="#FF0004"> * </font></td>
      <td><input type="text" name="txtpayment" id="txtpayment" value="<?php echo $purchaseamt; ?>" readonly></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Make Payment"></td>
      </tr>
  </tbody>
</table>
</form>

						</section>
					</div>
				</div>
			</div>
		</div>


	<?php include("footer.php");?>
	<script type="application/javascript">
	function validateorderpayment()
	{
		
	var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers

 if(document.frmorderpayment.paymenttype.value == "")
	{
		alert("Kindly select a Payment Type..");
		document.frmorderpayment.paymenttype.focus();
		return false;
	}	
	else if(document.frmorderpayment.txtcardholdname.value == "")
	{
		alert("Card holder name should not be empty..");
		document.frmorderpayment.txtcardholdname.focus();
		return false;
	}
	else if(!document.frmorderpayment.txtcardholdname.value.match(alphaspaceExp))
	{
		alert("Please enter only letters for the Card Holder name..");
		document.frmorderpayment.txtcardholdname.focus();
		return false;
	}
	else if(document.frmorderpayment.txtcardnumb.value == "")
	{
		alert("Kindly enter Card Number..");
		document.frmorderpayment.txtcardnumb.focus();
		return false;
	}	
	else if(document.frmorderpayment.txtcardnumb.value.length < 16)
	{
		alert("Kindly enter a valid 16 digit Card Number...");
		document.frmorderpayment.txtcardnumb.focus();
		return false;
	}	
		
	else if(document.frmorderpayment.txtcardnumb.value.length > 16)
	{
		alert("Kindly enter a valid 16 digit Card Number...");
		document.frmorderpayment.txtcardnumb.focus();
		return false;
	}	
		else if(document.frmorderpayment.txtexpirydate.value == "")
	{
		alert("Kindly select the Expiry Date...");
		document.frmorderpayment.txtexpirydate.focus();
		return false;
	}	
		else if(document.frmorderpayment.txtcvv.value == "")
	{
		alert("Kindly enter CVV Number..");
		document.frmorderpayment.txtcvv.focus();
		return false;
	}	
	else if(document.frmorderpayment.txtpayment.value == "")
	{
		alert("Kindly enter Payment Amount..");
		document.frmorderpayment.txtpayment.focus();
		return false;
	}	
	else
	{
		return true;
	}
	}


	</script>