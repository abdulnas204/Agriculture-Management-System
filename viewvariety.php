<?php 
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM variety WHERE variety_id='$_GET[deleteid]'";
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
								<h2><?php echo "View ". $_GET[varietytype]." Variety"; ?></h2>
							</header>
						  <table width="955" height="55" border="1" class="tftable">
						    <tr>
						      <th width="155"><strong>Category</strong></th>
						      <th width="133"><strong>Produce</strong></th>
						      <th width="121"><strong>Variety</strong></th>
						      <th width="232"><strong>Description</strong></th>
						      <th width="81"><strong>Image</strong></th>
						      <th width="88"><strong>Status</strong></th>
                              <th width="99"><strong>Action</strong></th>
					        </tr>
                              <?php
							  $sql = "SELECT * FROM variety INNER JOIN category ON variety.category_id=category.category_id WHERE category_type='$_GET[varietytype]'";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  	$sqlcategory = "SELECT * FROM category where category_id='$rs[category_id]'";
							  		$qsqlcategory = mysqli_query($con,$sqlcategory);
							  		$rscategory = mysqli_fetch_array($qsqlcategory);
							  
							  		$sqlproduce = "SELECT * FROM produce where produce_id='$rs[produce_id]'";
							  		$qsqlproduce = mysqli_query($con,$sqlproduce);
							  		$rsproduce = mysqli_fetch_array($qsqlproduce);
							  echo "
						    <tr>
						      <td>&nbsp;$rscategory[category]</td>
						      <td>&nbsp;$rsproduce[produce]</td>
						      <td>&nbsp;$rs[variety]</td>
						      <td>&nbsp;$rs[4]</td>
						       <td>&nbsp;
								<img src='imgvariety/$rs[5]' width='25' height='25'>
								</td>
						      <td>&nbsp;$rs[status]</td>
							  <td>&nbsp;<a href='variety.php?editid=$rs[variety_id]'>Edit</a> |  <a href='viewvariety.php?deleteid=$rs[variety_id]' onclick='return delconfirm()'>Delete</a></td>
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