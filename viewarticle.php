<?php 
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM article WHERE article_id='$_GET[deleteid]'";
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
								<h2>View Articles</h2>
							</header>
                            <?php
							 $sql = "SELECT * FROM article";
							  $qsql = mysqli_query($con,$sql);
							if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Article to display!!</center>";
									}
									else
									{
										?>
							<table width="563" height="68" border="1" class="tftable">
							  <tr>
							    <th><strong>Article Type</strong></th>
							    <th><strong>Publish Date</strong></th>
							    <th><strong>Title</strong></th>
							    <th><strong>Description</strong></th>
							    <th><strong>Image1</strong></th>
							    <th><strong>Image2</strong></th>
							    <th><strong>Image3</strong></th>
							    <th><strong>Image4</strong></th>
							    <th><strong>Image5</strong></th>
                               	<th><strong>Action</strong></th>
						      </tr>
                                <?php
							 
							  while($rs = mysqli_fetch_array($qsql))
							  {
							  echo "
							  <tr>
							    <td>&nbsp;$rs[article_type]</td>
							    <td>&nbsp;$rs[publish_date]</td>
							    <td>&nbsp;$rs[title]</td>
							    <td>&nbsp;$rs[article_description]</td>
							    <td>&nbsp;
								<img src='imgarticle/$rs[article_img1]' width='25' height='25'>
								</td>
							    <td>&nbsp;
								<img src='imgarticle/$rs[article_img2]' width='25' height='25'>
								</td>
							    <td>&nbsp;
								<img src='imgarticle/$rs[article_img3]' width='25' height='25'>
								</td>
							    <td>&nbsp;
							    <img src='imgarticle/$rs[article_img4]' width='25' height='25'>
								</td>
                                <td>&nbsp;
								<img src='imgarticle/$rs[article_img5]' width='25' height='25'>
								</td>
								<td>&nbsp; <a href='article.php?editid=$rs[article_id]'>Edit</a> | <a href='viewarticle.php?deleteid=$rs[article_id]' onclick='return delconfirm()'>Delete</a></td>
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