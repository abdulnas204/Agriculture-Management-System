<?php 
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM product_purchase_bill WHERE product_purchase_bill_id='$_GET[deleteid]'";
	if(!mysqli_query($con,$sql))
	{
		echo "<script>alert('Failed to delete record'); </script>";
	}
	else
	{
		if(mysqli_affected_rows($con)  >= 1)
		{
		echo "<script>alert('This record deleted successfully..'); </script>";
		}
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
								<h2>Product Purchase Bill</h2>
							</header>
						  <table width="954" height="224" border="1" class="tftable">
						    <tr>
						      <th><strong>Customer Name</strong></th>
						      <th><strong>Customer Address</strong></th>
						      <th><strong>Country</strong></th>
						      <th><strong>State</strong></th>
						      <th><strong>City</strong></th>
						      <th><strong>Pincode</strong></th>
						      <th><strong>Contact Number</strong></th>
                               <th><strong>Action</strong></th>
					        </tr>
                              <?php
							  $sql = "SELECT * FROM product_purchase_bill";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								   $sql1 = "SELECT * FROM country WHERE country_id='$rs[country_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  
							      $sql2 = "SELECT * FROM state WHERE state_id='$rs[state_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs2 = mysqli_fetch_array($qsql2);
								  
								  $sql3 = "SELECT * FROM city WHERE city_id='$rs[city_id]'";
								  $qsql3 = mysqli_query($con,$sql3);
								  $rs3 = mysqli_fetch_array($qsql3);
							  echo "
						    <tr>
						      <td>&nbsp;$rs[customer_name]</td>
						      <td>&nbsp;$rs[customer_address]</td>
						      <td>&nbsp;$rs1[country]</td>
						      <td>&nbsp;$rs2[state]</td>
						      <td>&nbsp;$rs3[city]</td>
						      <td>&nbsp;$rs[pincode]</td>
						      <td>&nbsp;$rs[customer_contact_number]</td>
							    <td>&nbsp;  <a href='Productpurchasebill.php?editid=$rs[product_purchase_bill_id]'>Edit</a> |  <a href='viewProductpurchasebill.php?deleteid=$rs[product_purchase_bill_id]'onclick='return delconfirm()'>Delete</a></td>
					        </tr>";
							  }
							  ?>
					      </table>
						  <p>&nbsp;</p>
							
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