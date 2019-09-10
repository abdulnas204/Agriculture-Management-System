<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE purchase_request SET customer_id='$_SESSION[customerid]', product_id='$_POST[product]', quantity='$_POST[quantity]', request_date='$_POST[requestdate]', request_date_expire='$_POST[expirydate]', note='$_POST[note]', status='$_POST[status]' WHERE purchase_request_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Purchase Request Updated Successfully...');</script>";
		}
	}
	else
	{	
$sql="INSERT INTO purchase_request( customer_id, product_id, quantity, request_date, request_date_expire, note, status) VALUES ('$_SESSION[customerid]','$_POST[productid]','$_POST[quantity]','$_POST[requestdate]','$_POST[expirydate]','$_POST[note]','Pending')";

	if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Purchase Request Sent Successfully...');</script>";


$sqlproduct = "SELECT * FROM product WHERE product_id='$_POST[productid]'";
$qsqlproduct = mysqli_query($con,$sqlproduct);
$rsproduct = mysqli_fetch_array($qsqlproduct);

$sqlseller = "SELECT * FROM seller WHERE seller_id='$rsproduct[seller_id]'";
$qsqlseller = mysqli_query($con,$sqlseller);
$rsseller = mysqli_fetch_array($qsqlseller);

$sqlcustomer = "SELECT * FROM customer WHERE customer_id='$_SESSION[customerid]'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
$rscustomer = mysqli_fetch_array($qsqlcustomer);

$sql1country = "SELECT * FROM country WHERE country_id='$rsseller[country_id]'";
$qsql1country = mysqli_query($con,$sql1country);
$rs1country = mysqli_fetch_array($qsql1country);

$sql2state = "SELECT * FROM state WHERE state_id='$rsseller[state_id]'";
$qsql2state = mysqli_query($con,$sql2state);
$rs12state = mysqli_fetch_array($qsql2state);

$sql3city = "SELECT * FROM city WHERE city_id='$rsseller[city_id]'";
$qsql3city = mysqli_query($con,$sql3city);
$rs13city = mysqli_fetch_array($qsql3city);

$msgtoseller = "You have got purchase request for your produce $rsproduct[title]. You can contact your customer $rscustomer[customer_name] at $rscustomer[mobile_no].";
$msgcustomer = "You have sent purchase request for - $rsproduct[title]. To check the quality of the produce, you can contact $rsseller[seller_name] at $rsseller[mobile_no]. Farmer's Address: $rsseller[seller_address], $rs13city[city], $rs12state[state], $rs1country[country].  ";
?>
<!--Message for seller -->
<iframe style="display: none;" src="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=iagro&password=825848045&sendername=iiagro&mobileno=<?php echo $rsseller[mobile_no]; ?>&message=<?php echo $msgtoseller; ?>"></iframe>
<!--Message for customer -->
<iframe style="display: none;" src="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=iagro&password=825848045&sendername=iiagro&mobileno=<?php echo $rscustomer[mobile_no]; ?>&message=<?php echo $msgcustomer; ?>"></iframe>
<?php			
		}
	}
}

	$sqlproduct = "SELECT * FROM product WHERE product_id='$_GET[prodid]'";
	$qsqlproduct = mysqli_query($con,$sqlproduct);
	$rsproduct = mysqli_fetch_array($qsqlproduct);

?>

<div id="featured">
			<div class="container">
				<div class="row">
					<div class="9u">
                    
   <?php
	$sql = "SELECT * FROM product WHERE product_id='$_GET[productid]'";
  	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
		
			$sqlseller = "SELECT * FROM seller WHERE seller_id='$rs[seller_id]'";
			$qsqlseller = mysqli_query($con,$sqlseller);
			$rsseller = mysqli_fetch_array($qsqlseller);
			
			$sqlcategory = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
			$qsqlcategory = mysqli_query($con,$sqlcategory);
			$rscategory = mysqli_fetch_array($qsqlcategory);
			
			$sqlproduce = "SELECT * FROM produce WHERE produce_id='$rs[produce_id]'";
			$qsqlproduce = mysqli_query($con,$sqlproduce);
			$rsproduce = mysqli_fetch_array($qsqlproduce);
			
			$sqlvariety = "SELECT * FROM variety WHERE variety_id='$rs[variety_id]'";
			$qsqlvariety = mysqli_query($con,$sqlvariety);
			$rsvariety = mysqli_fetch_array($qsqlvariety);
		
   ?>
						<section>
							<header>
								<h2><?php echo $rs[title]; ?></h2>
							</header>
<?php
include("salesslider.php");
?>
<br />
							<h2><strong>Seller Information:</strong></h2>
                            <strong>Seller name:  </strong><?php echo $rsseller[seller_name]; ?><br />
                            <strong>Category: </strong><?php echo $rscategory[category]; ?><br />
                            <strong>Produce: </strong><?php echo $rsproduce[produce]; ?><br />
                            <strong>Variety: </strong><?php echo $rsvariety[variety]; ?><br />                                                                               
                            <p><strong style="font-size:14px;">Quantity</strong>: <?php echo $rs[quantity]; ?> <?php echo $rs[quantity_type]; ?> 
                            </p>
							<p><?php echo "<strong>Description: </strong>".$rs[description]; ?></p>
                            
								
                                <h2><strong>Send A Purchase Request</strong></h2>
						
                           <?php
				if(isset($_POST[submit]))
				{
					echo "<h2>Purchase request sent successfully..</h2><h3><a href='viewpurchaserequest.php'>View purchase request</a></h3>";
				}
				else
				{
						   if(isset($_SESSION[customerid]))
						   {						   				   
						   ?>
                            <form method="post" action="" name="frmpurchaserequest" onSubmit="return validatepurchaserequest()">
                            <input type="hidden" name="productid" value="<?php echo $rs[product_id]; ?>" />
						  <table width="738" height="248" border="2">
						    <tbody>
						      <tr>
						        <td width="139" align="right">Purchase Quantity<font color="#FF0000">*</font></td>
						        <td width="581"><input type="number" max="<?php echo $rs[quantity]; ?>" name="quantity" id="quantity" value="<?php echo $rsedit[quantity]; ?>" autofocus> <font color="#FF0000">  (in <?php echo $rs[quantity_type]; ?> ) </font></td>
					          </tr>
						      <tr>
						        <td align="right">Request Date  <font color="#FF0000">*</font></td>
						        <td><input type="date" name="requestdate" id="requestdate" readonly value="<?php echo date("Y-m-d"); ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Expiry Date  <font color="#FF0000">*</font></td>
						        <td><input type="date" name="expirydate" id="expirydate" readonly value="<?php echo date('Y-m-d', strtotime(date("Y-m-d"). ' + 7 day')); ?>" ></td>
					          </tr>
						      <tr>
						        <td align="right">Note</td>
						        <td><textarea name="note" id="note"><?php echo $rsedit[note]; ?></textarea></td>
					          </tr>
						      <tr>
						        <td height="15">&nbsp;</td>
						        <td><input type="submit" name="submit" id="submit" value="Submit"></td>
					          </tr>
					        </tbody>
					      </table>
                          </form>
							<?php
						   }
						   else
						   {
							?>
                             <h2><a href='customerloginpanel.php?pagename=<?php echo basename($_SERVER['PHP_SELF']); ?>&productid=<?php echo $rs[product_id]; ?>'>Login to send purchase request..</a></h2>  
                           <?php
						   }
				}
						   ?>
						</section>
					</div>
					
                    
                    	
				</div>
			</div>
		</div>
<?php include("footer.php");?>
	<script type="application/javascript">
	
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	function validatepurchaserequest()
	{
		if(document.frmpurchaserequest.quantity.value == "")
		{
			alert("Kindly enter quantity..");
			document.frmpurchaserequest.quantity.focus();
			return false;
		}	
		else if(document.frmpurchaserequest.requestdate.value == "")
		{
			alert("Select the request date..");
			document.frmpurchaserequest.requestdate.focus();
			return false;
		}
		else if(document.frmpurchaserequest.expirydate.value == "")
		{
			alert("Select the expiry date..");
			document.frmpurchaserequest.expirydate.focus();
			return false;
		}	
		else
		{
			return true;
		}
	}
	</script>
		