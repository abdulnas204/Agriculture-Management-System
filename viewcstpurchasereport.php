<?php
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[customerid] != "" && $_SESSION[sellerid] != "")
{
	echo "<script>window.location='customerloginpanel.php';</script>";
}
?>
		<div id="featured">
			<div class="container">
				<div class="row">
				<?php include("leftsidebar.php"); ?>				
					<div class="9u">
						<section>
							<header>
								<h2>Agro Products Purchase Report</h2>
							</header>
                            <?php
							  if(isset($_SESSION[customerid]))
							  {
							  $sql = "SELECT * FROM product_purchase_bill where customer_id='$_SESSION[customerid]' ORDER BY product_purchase_bill_id DESC ";
							  }
							  if(isset($_SESSION[sellerid]))
							  {
							  $sql = "SELECT * FROM product_purchase_bill where seller_id='$_SESSION[sellerid]' ORDER BY product_purchase_bill_id DESC ";
							  }
							  $qsql = mysqli_query($con,$sql);
									if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Purchase Report to display!!</center>";
									}
									else
									{
							?>
                             
							<table width="947" height="49" border="0" class="tftable">
  <tbody>
    <tr>
      <th width="129" height="45"><strong>Bill No.</strong></th>
      <th width="401"><strong>Address</strong></th>
      <th width="130"><strong>Purchase Date</strong></th>
      <th width="105"><strong>Total Amount</strong></th>
      <th width="70"><strong>Status</strong></th>
      <th width="86"><strong>View</strong></th>
    </tr>
<?php							
		  while($rs = mysqli_fetch_array($qsql))
		  {
			  $sqlsum = "select sum(cost * quantity)  from product_purchase_record where product_purchase_bill_id='$rs[product_purchase_bill_id]'";
			  $qsqlsum = mysqli_query($con,$sqlsum);
			  $rssum = mysqli_fetch_array($qsqlsum);
		 
			 		echo "<tr>
				  			<td>&nbsp;$rs[product_purchase_bill_id]</td>
							<td>&nbsp;$rs[customer_address]</td>
				  			<td>&nbsp;$rs[purchase_date]</td>
				  			<td>&nbsp;$rupeesymbol " . $rssum[0]  . "</td>
				  			<td>&nbsp;$rs[status]</td>
				  			<td>&nbsp; <a href='printbill.php?billid=$rs[0]'>View Bill</a></td>
						</tr> ";
		  }
?>
  </tbody>
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