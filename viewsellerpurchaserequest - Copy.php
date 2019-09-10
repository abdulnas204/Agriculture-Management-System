<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	
	$sqlproduct = "SELECT * FROM purchase_request WHERE purchase_request_id='$_GET[deleteid]'";
	$qsqlproduct = mysqli_query($con,$sqlproduct);
	$rsproduct = mysqli_fetch_array($qsqlproduct);
	$purchasecustid = $rsproduct[customer_id];
	$produceid = $rsproduct[product_id];

	$sql = "DELETE FROM purchase_request WHERE purchase_request_id='$_GET[deleteid]'";
	if(!mysqli_query($con,$sql))
	{
		echo "<script>alert('Failed to delete record'); </script>";
	}
	else
	{
		echo "<script>alert('This record deleted successfully..'); </script>";
		
		$sqlcustomer = "SELECT * FROM customer WHERE customer_id='$purchasecustid'";
		$qsqlcustomer = mysqli_query($con,$sqlcustomer);
		$rscustomer = mysqli_fetch_array($qsqlcustomer);
		
		$sqlproduce = "SELECT * FROM product WHERE product_id='$produceid'";
		$qsqlproduce = mysqli_query($con,$sqlproduce);
		$rsproduce = mysqli_fetch_array($qsqlproduce);		
		
		$mobno = $rscustomer[mobile_no];
		$msg = "Sorry.. Your purchase request for the produce - $rsproduce[title] has been cancelled..";
		include("msgpanel.php");
	}
}

?>
	

		<div id="featured">
			<div class="container">
				<div class="row">
<?php
include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
						  <header>
								<h2>Purchase Request</h2>
							</header>
<?php
 $sql = "SELECT * FROM `purchase_request` INNER JOIN product ON product.product_id=purchase_request.product_id  WHERE product.seller_id='$_SESSION[sellerid]'";
  $qsql = mysqli_query($con,$sql);
		if(mysqli_num_rows($qsql)  == 0)
		{
			echo "<center>There is no Purchase Request to display!!</center>";
		}
		else
		{
?>
						  <table width="947" height="39" border="1" class="tftable">
						    <tr>
						      <td width="103" height="33"><strong>Product</strong></td>
						      <td width="106"><strong>Quantity</strong></td>
						      <td width="101"><strong>Request Date</strong></td>
						      <td width="108"><strong>Expiry Date</strong></td>
						      <td width="106"><strong>Note</strong></td>
						      <td width="95"><strong>Status</strong></td>
						      <td width="86"><strong>Cost</strong></td>                              
                                <td width="190"><strong>Action</strong></td>
					        </tr>
                            <?php
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
								  $sql1 = "SELECT * FROM product WHERE product_id='$rs[product_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  
								  $sqlpurchase_order = "SELECT * FROM purchase_order WHERE purchase_request_id='$rs[purchase_request_id]'";
								  $qsqlpurchase_order = mysqli_query($con,$sqlpurchase_order);
								  $rspurchase_order = mysqli_fetch_array($qsqlpurchase_order);								  
							  echo "
						    <tr>
						      <td>&nbsp;$rs1[title]</td>
						      <td>&nbsp;$rs[3]</td>
						      <td>&nbsp;$rs[request_date]</td>
						      <td>&nbsp;$rs[request_date_expire]</td>
						      <td>&nbsp;$rs[note]</td>
						      <td>&nbsp;$rs[7] ";
							  echo "</td><td>$rspurchase_order[purchase_amt]</td><td>";
$dt = date("Y-m-d");
$date1 = new DateTime($dt);
$date2 = new DateTime($rs[request_date_expire]); 
if ($date1 > $date2)
{
	echo "Exprired";
}
else
{
	 if($rs[7] == "Pending")
	{
	echo "&nbsp;  <a href='viewpurchaseorderbill.php?purchaserequestid=$rs[0]'>Send Purchase order</a>";
	}
	else
	{
	echo "&nbsp;  ";								 
	}
}	
							  if($rs[7] == "Pending")
							  {
							   echo " | ";
							  echo "<a href='viewsellerpurchaserequest.php?deleteid=$rs[0]'>Delete</a>";
							  }				 							 
					        	echo "</td></tr>";
							  }
							  ?>
					      </table>
                          <?php
									}
						?>
						</section>
					</div>
				</div>
			</div>
		</div>


	<?php include("footer.php");?>