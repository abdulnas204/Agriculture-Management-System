<?php 
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM state WHERE state_id='$_GET[deleteid]'";
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
								<h2>View States</h2>
						  </header>
                          <?php
						   $sql = "SELECT * FROM state";
							  $qsql = mysqli_query($con,$sql);
						  if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no State to display!!</center>";
									}
									else
									{
										?>
						  <table width="470" height="81" border="1" class="tftable">
						    <tr>
							    <th><strong>Country</strong></th>
							    <th><strong>State</strong></th>
							    <th><strong>Description</strong></th>
							    <th><strong>Status</strong></th>
                                <th><strong>Action</strong></th>
						      </tr>
                              <?php
							 
							  while($rs = mysqli_fetch_array($qsql))
							  {
								    $sql1 = "SELECT * FROM country WHERE country_id='$rs[country_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
							  echo "
							  <tr>
							    <td>&nbsp;$rs1[country]</td>
							    <td>&nbsp;$rs[state]</td>
							    <td>&nbsp;$rs[description]</td>
							    <td>&nbsp;$rs[status]</td>
								 <td>&nbsp; <a href='state.php?editid=$rs[state_id]'>Edit</a> |<a href='viewstate.php?deleteid=$rs[state_id]' onclick='return delconfirm()'>Delete</a></td>
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