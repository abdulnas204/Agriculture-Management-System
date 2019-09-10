<?php 
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM product WHERE product_id='$_GET[deleteid]'";
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
								<h2>View Farm Produce</h2>
							</header>
                            <?php
							 $sql = "SELECT * FROM product";
							  if(isset($_SESSION[sellerid]))
							  {
								  $sql = $sql . " WHERE seller_id='$_SESSION[sellerid]'";
							  }
							  $qsql = mysqli_query($con,$sql);
							if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Selling Produce to display!!</center>";
									}
									else
									{
							?>
						  <table width="961" height="44" border="1" class="tftable">
						    <tr>
						      <th width="113"><strong>Seller Name</strong></th>
						      <th width="81"><strong>Category</strong></th>
						      <th width="80"><strong>Produce</strong></th>
						      <th width="69"><strong>Variety</strong></th>
						      <th width="60"><strong>Title</strong></th>
						      <th width="72"><strong>Images</strong></th>
						      <th width="76"><strong>Quantity</strong></th>
						      <th width="118"><strong>Description</strong></th>
						      <th width="99"><strong>Upload Date</strong></th>
						      <th width="70"><strong>Status</strong></th>
                              <th width="92"><strong>Action</strong></th>
					        </tr>
                              <?php
							 
							  while($rs = mysqli_fetch_array($qsql))
							  {
								   $sql1 = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  
								   $sql2 = "SELECT * FROM produce WHERE produce_id='$rs[produce_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs2= mysqli_fetch_array($qsql2);
								  
								   $sql3 = "SELECT * FROM variety WHERE variety_id='$rs[variety_id]'";
								  $qsql3 = mysqli_query($con,$sql3);
								  $rs3 = mysqli_fetch_array($qsql3);
								  
								$sqlseller = "SELECT * FROM seller WHERE seller_id='$rs[seller_id]'";
								$qsqlseller = mysqli_query($con,$sqlseller);
								$rsseller = mysqli_fetch_array($qsqlseller);
								  
							  echo "
						    <tr>
						      <td>&nbsp;$rsseller[seller_name]</td>
						      <td>&nbsp;$rs1[category]</td>							  
						      <td>&nbsp;$rs2[produce]</td>
						      <td>&nbsp;$rs3[variety]</td>
						      <td>&nbsp;$rs[title]</td>
						       <td>&nbsp;
								<img src='imgproduct/$rs[img_1]' width='25' height='25'>
								&nbsp;
								<img src='imgproduct/$rs[img_2]' width='25' height='25'>
								&nbsp;
								<img src='imgproduct/$rs[img_3]' width='25' height='25'>
								&nbsp;
							    <img src='imgproduct/$rs[img_4]' width='25' height='25'>
								&nbsp;
								<img src='imgproduct/$rs[img_5]' width='25' height='25'>
								</td>
						      <td>&nbsp;$rs[quantity] &nbsp; $rs[quantity_type]</td>
						      <td>&nbsp;$rs[description]</td>
						      <td>&nbsp;$rs[uploaded_date]</td>
						      <td>&nbsp;$rs[status]</td>
							   <td>&nbsp; <a href='Product.php?editid=$rs[product_id]'>Edit</a>| <a href='viewProduct.php?deleteid=$rs[product_id]'>Delete</a></td>
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