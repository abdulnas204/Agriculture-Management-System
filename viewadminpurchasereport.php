<?php
session_start();
include("header.php");
include("dbconnection.php");
if(!isset($_SESSION[adminid]))
{
	echo "<script>window.location='adminloginpanel.php';</script>";
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
								<h2>Product Purchase Bill Report</h2>
							</header>
                             <?php
							   $sql = "SELECT * FROM product_purchase_bill ";
							  $qsql = mysqli_query($con,$sql);
							  if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Purchase Report to display!!</center>";
									}
									else
									{
							 ?>
							<table width="893" height="252" border="0"  class="tftable">
  <tbody>
    <tr>
      <th><strong>Bill Number</strong></th>
      <th><strong>Address</strong></th>
      <th><strong>Purchase Date</strong></th>
      <th><strong>Total Amount</strong></th>
      <th><strong>Status</strong>></th>
      <th><strong>View</strong></th>
    </tr>
     <?php
							
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  $sqlsum = "select sum(cost) from product_purchase_record where product_purchase_bill_id='$rs[product_purchase_bill_id]'";
								  $qsqlsum = mysqli_query($con,$sqlsum);
								  $rssum = mysqli_fetch_array($qsqlsum);
 echo "  <tr>
      <td>&nbsp;$rs[product_purchase_bill_id]</td>
      <td>&nbsp;$rs[customer_address]</td>
      <td>&nbsp;$rs[purchase_date]</td>
      <td>&nbsp;$rssum[0]</td>
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