<?php 
include("header.php");
include("dbconnection.php");
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

?>
	

		<div id="featured">
			<div class="container">
				<div class="row">
<?php include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
						  <header>
								<h2>Farm Produce Purchase Order</h2>
							</header>
                            <?php
							 $sql = "SELECT * FROM `purchase_order` WHERE customer_id='$_SESSION[customerid]'";
							  $qsql = mysqli_query($con,$sql);
                                    if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Purchase Order to display!!</center>";
									}
									else
									{
							?>
						  <table width="850" height="48" border="1" class="tftable">
						    <tr>
						      <th height="42"><strong>Product</strong></th>
						      <th><strong>Customer Name</strong></th>
						      <th><strong>Request Date</strong></th>
						      <th><strong>Expiry Date</strong></th>
						      <th><strong>Amount</strong></th>
						      <th><strong>Quantity</strong></th>
						      <th><strong>Status</strong></th>
						      <th><strong>Action</strong></th>                              
					        </tr>
                            <?php
							 
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
								  $sql1 = "SELECT * FROM product WHERE product_id='$rs[product_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  								  
								  $sql2= "SELECT * FROM customer WHERE customer_id='$rs[customer_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs2 = mysqli_fetch_array($qsql2);
								  $dexdate = date('Y-m-d', strtotime($rs[purchase_order_date]. ' + 7 day')) ;
								   
$dt = date("Y-m-d");
$date1 = new DateTime($dt);
$date2 = new DateTime($dexdate); 
								  
									echo "
									<tr>
									  <td>&nbsp;$rs1[title]</td>
									  <td>&nbsp;$rs2[customer_name]</td>
									  <td>&nbsp;$rs[purchase_order_date]</td>
									  <td>".$dexdate ."</td>
									  <td>&nbsp;$rupeesymbol $rs[purchase_amt]</td>
									  <td>&nbsp;$rs[quantity] $rs1[quantity_type]</td>
									  <td>&nbsp;";
									  if($rs[status] == "Pending")
									  {
										  if ($date1 > $date2)
											{
												echo "Order cancelled";
											}
									  		else
											{
												echo $rs[status];
											}
									  }
									  else
									  {
										  echo $rs[status];
									  }
									  
									  echo "</td>";

									  if($rs[status] == "Pending")
									  {
if ($date1 > $date2)
{
	echo "<td>Expired</td>";
}
else
{
					echo "<td>&nbsp;<a href='purchaseorderpayment.php?purchaseorderid=$rs[purchase_order_id]'>Make Payment</a></td>";
}
									  }
									  else
									  {
					echo "<td>&nbsp;</td>";	  
									  }
								echo "</tr>";
							  }
							  ?>
					      </table>
                           <?php
									}
?>
						  <p>&nbsp;</p>
							
						</section>
					</div>
				</div>
			</div>
		</div>


	<?php include("footer.php");?>