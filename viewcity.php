<?php include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM city WHERE city_id='$_GET[deleteid]'";
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
								<h2>View Cities</h2>
							</header>
                            
                            <?php
                              $sql = "SELECT * FROM city";
							  $qsql = mysqli_query($con,$sql);
							 if(mysqli_num_rows($qsql)  == 0)
																		{
										echo "<center>There is no City to display!!</center>";
									}
									else
									{
                                    ?>
							<table width="646" height="43" border="1" class="tftable">
							  <tr>
							    <th height="37"><strong>Country</strong></th>
							    <th><strong>State</strong></th>
							    <th><strong>City</strong></th>
							    <th><strong>Description</strong></th>
                                    <th><strong>Action</strong></th>
						      </tr>
                              <?php
							 
							  while($rs = mysqli_fetch_array($qsql))
							  {
							  echo "
							  <tr>
							    <td>&nbsp;$rs[country_id]</td>
							    <td>&nbsp;$rs[state_id]</td>
							    <td>&nbsp;$rs[city]</td>
							    <td>&nbsp;$rs[description]</td>
								<td>&nbsp; <a href='city.php?editid=$rs[city_id]'>Edit</a>| <a href='viewcity.php?deleteid=$rs[city_id]' onclick='return delconfirm()'>Delete</a></td>
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