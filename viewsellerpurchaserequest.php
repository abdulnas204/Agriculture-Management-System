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
		if(mysqli_affected_rows($con)  >= 1)
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
						  <table width="1083" height="39" border="1" class="tftable">
						    <tr>
						      <th width="154" height="33"><strong>Product</strong></th>
						      <th width="137"><strong>Quantity</strong></th>
						      <th width="94"><strong>Request Date</strong></th>
						      <th width="100"><strong>Expiry Date</strong></th>
						      <th width="165"><strong>Note</strong></th>
						      <th width="50"><strong>Status</strong></th>
						      <th width="101"><strong>Cost</strong></th>                              
                                <th width="230"><strong>Action</strong></th>
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
						      <td>&nbsp;$rs[3] $rs1[quantity_type]</td>
						      <td>&nbsp;$rs[request_date]</td>
						      <td>&nbsp;$rs[request_date_expire]</td>
						      <td>&nbsp;$rs[note]</td>";
$dt = date("Y-m-d");
$date1 = new DateTime($dt);
$date2 = new DateTime($rs[request_date_expire]); 
						if ($date1 > $date2)
							 {
							 echo "<td>&nbsp;Inactive</td>";
							 }
							 else
							 {
						     echo "<td>&nbsp;$rs[7]</td>";
							 }
							 echo "<td>";
							 if($rspurchase_order[purchase_amt] != "")
							 {
							 	echo $rupeesymbol;
							 }
							 echo "$rspurchase_order[purchase_amt]</td><td>";

if ($date1 > $date2 && $rspurchase_order[purchase_amt]== "")
{
	echo "<center>Expired</center>";
}
else
{
	 if($rs[7] == "Pending")
	{
	echo "<a href='viewpurchaseorderbill.php?purchaserequestid=$rs[0]'>Send Purchase order</a>";
	}
	else
	{
		if($rspurchase_order[status] == "Pending")
		{
			echo "&nbsp; Payment not done yet ";	
		}
		else
		{
			echo "&nbsp; Transaction done";			
		}
								 
	}
}	
if(($rs[7] == "Pending") && $date1 < $date2)
{
echo " | ";
echo "<a href='viewsellerpurchaserequest.php?deleteid=$rs[0]' onclick='return delconfirm()'>Delete</a>";
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
	<script type="application/javascript">
function delconfirm()
{
	if(confirm("Are you sure you want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>	