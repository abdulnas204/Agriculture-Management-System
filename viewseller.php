<?php 
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM seller WHERE seller_id='$_GET[deleteid]'";
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
								<h2>Registered Farmers</h2>
							</header>
                            <?php
							 $sql = "SELECT * FROM seller";
							  $qsql = mysqli_query($con,$sql);
							  if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Seller to display!!</center>";
									}
									else
									{
							?>
						  <table width="943" height="65" border="1" class="tftable">
						    <tr>
						      <th width="98" height="60"><strong>Name</strong></th>
						      <th width="130"><strong>Address</strong></th>
						      <th width="104"><strong>Contact No.</strong></th>
						      <th width="104"><strong>Mobile No.</strong></th>
						      <th width="115"><strong>Email ID</strong></th>
						      <th width="138"><strong>Bank Details</strong></th>
						      <th width="98"><strong>Status</strong></th>
                               <th width="104"><strong>Action</strong></th>
					        </tr>
                              <?php
							 
							  while($rs = mysqli_fetch_array($qsql))
							  {
								   $sql1 = "SELECT * FROM country WHERE country_id='$rs[country_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								
								  $sql2 = "SELECT * FROM state WHERE state_id='$rs[state_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs12 = mysqli_fetch_array($qsql2);
								 
								  $sql3 = "SELECT * FROM city WHERE city_id='$rs[city_id]'";
								  $qsql3 = mysqli_query($con,$sql3);
								  $rs13 = mysqli_fetch_array($qsql3);
							  echo "
						    <tr>
						      <td>&nbsp;$rs[seller_name]</td>
						      <td>&nbsp;$rs[seller_address],
						      &nbsp;$rs13[city],
						      &nbsp;$rs12[state],
						      &nbsp;$rs1[country],
						      PIN Code:&nbsp;$rs[pincode].
						      <td>&nbsp;$rs[contact_number]</td>
						      <td>&nbsp;$rs[mobile_no]</td>
						      <td>&nbsp;$rs[email_id]</td>
						      <td> <strong>Bank A/c No.:</strong>&nbsp;$rs[bank_acno],<br>"."
							  <strong>IFSC Code:</strong>&nbsp;$rs[bank_IFSC],<br>"."
							  <strong>Bank Name:</strong>&nbsp;$rs[bank_name],<br>"."
						      <strong>Branch:</strong>&nbsp;$rs[bank_branch].
						     </td>
						      <td>&nbsp;$rs[status]</td>
						      <td>&nbsp;  <a href='seller.php?editid=$rs[seller_id]'>Edit</a> | <a href='viewseller.php?deleteid=$rs[seller_id]' onclick='return delconfirm()'>Delete</a></td>
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