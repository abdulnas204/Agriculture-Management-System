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
								<h2>Farm Produce Purchase Request</h2>
							</header>
                            <?php
							 $sql = "SELECT * FROM purchase_request";
							  $qsql = mysqli_query($con,$sql);
							  if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Purchase Request to display!!</center>";
									}
									else
									{
							?>
						  <table width="850" height="132" border="1" class="tftable">
						    <tr>
						      <th><strong>Product</strong></th>
						      <th><strong>Quantity</strong></th>
						      <th><strong>Request Date</strong></th>
						      <th><strong>Expiry Date</strong></th>
						      <th><strong>Note</strong></th>
						      <th><strong>Status</strong></th>
                               
					        </tr>
                            <?php
							  $sql = "SELECT * FROM purchase_request";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
								  $sql1 = "SELECT * FROM product WHERE product_id='$rs[product_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
							  echo "
						    <tr>
						      <td>&nbsp;$rs1[title]</td>
						      <td>&nbsp;$rs[quantity]</td>
						      <td>&nbsp;$rs[request_date]</td>
						      <td>&nbsp;$rs[request_date_expire]</td>
						      <td>&nbsp;$rs[note]</td>
						      <td>&nbsp;$rs[status]</td>
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
	<script type="application/javascript">
function delconfirm()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>	