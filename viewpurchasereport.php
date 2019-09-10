<?php
session_start();
include("header.php");
include("dbconnection.php");
?>
		<div id="featured">
			<div class="container">
				<div class="row">
<?php include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
						  <header>
								<h2>Farm Produce Purchase Bill Report</h2>
							</header>
                            <?php
							$sqlbill = "SELECT * FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order.purchase_order_id = purchase_order_bill.purchase_order_id ";
									if(isset($_SESSION[sellerid]))
									{
									$sqlbill = $sqlbill . " WHERE purchase_order.seller_id='$_SESSION[sellerid]' ORDER BY purchase_order_bill_id DESC";
									}
									if(isset($_SESSION[customerid]))
									{
									$sqlbill = $sqlbill . " WHERE purchase_order.customer_id='$_SESSION[customerid]' ORDER BY purchase_order_bill_id DESC";
									}
									$qsqlbill = mysqli_query($con,$sqlbill);
									
									if(mysqli_num_rows($qsqlbill)  == 0)
									{
										echo "<center>There is no Purchase Report to display!!</center>";
									}
									else
									{
							?>
                            
						  <table width="850" height="41" border="1" class="tftable">
						    <tr>
						      <th height="35"><strong>Bill No.</strong></th>
						      <th><strong>Product</strong></th>
						      <th><strong>Payment Type</strong></th>
						      <th><strong>Paid Date</strong></th>
                              <th><strong>Quantity</strong></th>
						      <th><strong>Paid Amount</strong></th>
						      <th><strong>Action</strong></th>
					        </tr>
                            <?php
								    							
									 while($rsbill = mysqli_fetch_array($qsqlbill))
									 {								
									 	 	$sqlproduct = "SELECT * FROM product WHERE product_id='$rsbill[8]'";
											$qsqlproduct = mysqli_query($con,$sqlproduct);									
									 		$rsproduct = mysqli_fetch_array($qsqlproduct);
							  echo "
						    <tr>
						      <td>&nbsp;$rsbill[0]</td>
						      <td>&nbsp;$rsproduct[title]</td>
						      <td>&nbsp;$rsbill[payment_type]</td>
						      <td>&nbsp;$rsbill[paid_date]</td>
						      <td>&nbsp;$rsbill[15] $rsproduct[quantity_type]</td>
						      <td>&nbsp;$rupeesymbol $rsbill[paid_amt]</td>
						      <td>&nbsp;<a href='salesprintbill.php?purchase_order_bill_id=$rsbill[0]'>Print</a></td>
					        </tr>";
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