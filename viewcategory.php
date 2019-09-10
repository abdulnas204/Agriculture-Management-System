<?php include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM category WHERE category_id='$_GET[deleteid]'";
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
                            <?php
							if($_GET[cattype]=="Produce")
							{
								echo "<h2>View or Delete Produce Category</h2>";
                                }
                                else
                                {
                                echo "<h2>View or Delete Product Category</h2>";
                                }
                                ?>
							</header>
                            <?php
							  $sql = "SELECT * FROM category where category_type='$_GET[cattype]'";
							  $qsql = mysqli_query($con,$sql);
							         if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Category to display!!</center>";
									}
									else
									{
							?>
							<table width="767" height="44" border="1" class="tftable">
							  <tr>
							    <th height="38"><strong>Category</strong></th>
							     <th><strong>Description</strong></th>
							    <th><strong>Image</strong></th>
							    <th><strong>Status</strong></th>
                                   <th><strong>Action</strong></th>
						      </tr>
                               <?php
							
							  while($rs = mysqli_fetch_array($qsql))
							  {
							  echo "
							  <tr>
							    <td>&nbsp;$rs[category]</td>
							    <td>&nbsp;$rs[description]</td>
							   <td>&nbsp;
								<img src='imgcategory/$rs[img]' width='25' height='25'>
								</td>
							    <td>&nbsp;$rs[status]</td>
								 <td>&nbsp; <a href='category.php?editid=$rs[category_id]&cattype=$rs[category_type]'>Edit</a> | 
								 <a href='viewcategory.php?deleteid=$rs[category_id]' onclick='return delconfirm()'>Delete</a></td>
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