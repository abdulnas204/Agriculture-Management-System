<?php 
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM selling_product WHERE selling_prod_id='$_GET[deleteid]'";
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
								<h2>View Agro Products</h2>
							</header>
                            <?php
							  $sql = "SELECT * FROM selling_product";
							  $qsql = mysqli_query($con,$sql);
							if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Agro Product to display!!</center>";
									}
									else
									{
										?>
						  <table width="930" height="161" border="1"class="tftable">
						    <tr>
						      <th><strong>Category</strong></th>
						      <th><strong>Product Name</strong></th>
						      <th><strong>Product Description</strong></th>
						      <th><strong>Image1</strong></th>
						      <th><strong>Image2</strong></th>
						      <th><strong>Image3</strong></th>
						      <th><strong>Image4</strong></th>
						      <th><strong>Image5</strong></th>
                              <th><strong>Quantity Type</strong></th>
						      <th><strong>Cost</strong></th>
						      <th><strong>Status</strong></th>
                              <th><strong>Action</strong></th>
					        </tr>
                              <?php
							
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  $sql1 = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
							  echo "
						    <tr>
						      <td>&nbsp;$rs1[category]</td>
						      <td>&nbsp;$rs[product_name]</td>
						      <td>&nbsp;$rs[product_description]</td>
						      <td>&nbsp;
								<img src='imgsellingproduct/$rs[product_img1]' width='25' height='25'>
								</td>
							    <td>&nbsp;
								<img src='imgsellingproduct/$rs[product_img2]' width='25' height='25'>
								</td>
							    <td>&nbsp;
								<img src='imgsellingproduct/$rs[product_img3]' width='25' height='25'>
								</td>
							    <td>&nbsp;
							    <img src='imgsellingproduct/$rs[product_img4]' width='25' height='25'>
								</td>
                                <td>&nbsp;
								<img src='imgsellingproduct/$rs[product_img5]' width='25' height='25'>
								</td>
								<td>&nbsp;$rs[quantity_type]</td>
						      <td>&nbsp;$rs[cost]</td>
						      <td>&nbsp;$rs[status]</td>
							  <td>&nbsp; <a href='sellingproduct.php?editid=$rs[selling_prod_id]'>Edit</a> | <a href='viewsellingproduct.php?deleteid=$rs[selling_prod_id]' onclick='return delconfirm()'>Delete</a></td>
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