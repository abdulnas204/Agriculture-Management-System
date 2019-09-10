<?php 
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM admin WHERE admin_id='$_GET[deleteid]'";
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
								<h2>View Admins</h2>
							</header>
							<?php
							  $sql = "SELECT * FROM admin";
							  $qsql = mysqli_query($con,$sql);
							 if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Admin to display!!</center>";
									}
									else
									{
										?>
							<table width="402" height="38" border="1" class="tftable">
							  <tr>
							    <th><strong>Admin</strong></th>
							    <th><strong>Login ID</strong></th>
							    <th><strong>Status</strong></th>
							    <th><strong>Action</strong></th>
						      </tr>
                               <?php
							
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
							  echo "
							  <tr>
							    <td>&nbsp;$rs[admin_name]</td>
							    <td>&nbsp;$rs[login_id]</td>
							    <td>&nbsp;$rs[status]</td>
								 <td>&nbsp; <a href='admin.php?editid=$rs[admin_id]'>Edit</a> |<a href='viewadmin.php?deleteid=$rs[admin_id]' onclick='return delconfirm()'>Delete</a></td>
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