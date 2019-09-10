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
								<h2>Purchase Order</h2>
							</header>
                            <?php
							 $sql = "SELECT * FROM `purchase_order` WHERE seller_id='$_SESSION[sellerid]' ORDER BY purchase_order_id DESC ";
							  $qsql = mysqli_query($con,$sql);
                            if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Purchase Order to display!!</center>";
									}
									else
									{
							?>
						  <table width="850" height="51" border="1" class="tftable">
						    <tr>
						      <th><strong>Product</strong></th>
						      <th><strong>Customer Name</strong></th>
						      <th><strong>Request Date</strong></th>
						      <th><strong>Amount</strong></th>
						      <th><strong>Quantity</strong></th>
						      <th><strong>Status</strong></th>
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
								  
							  echo "
						    <tr>
						      <td>&nbsp;$rs1[title]</td>
						      <td>&nbsp;$rs2[customer_name]</td>
						      <td>&nbsp;$rs[purchase_order_date]</td>
						      <td>&nbsp;$rupeesymbol $rs[purchase_amt]</td>
						      <td>&nbsp;$rs[quantity] $rs1[quantity_type]	</td>
						      <td>&nbsp;$rs[status]</td>
					        </tr>";
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