<?php 
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM worker WHERE worker_id='$_GET[deleteid]'";
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
								<h2>Registered Workers</h2>
							</header>
                            <?php
							 $sql = "SELECT * FROM worker";
							  $qsql = mysqli_query($con,$sql);
							if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is no Worker to display!!</center>";
									}
									else
									{
							?>
						  <table width="955" height="43" border="1" class="tftable">
						    <tr>
						      <th><strong>Name</strong></th>
						      <th><strong>Address</strong></th>
                                 <th><strong>Contact Number</strong></th>
						      <th><strong>Work Profile</strong></th>						    
						      <th><strong>Date of Birth</strong></th>
						      <th><strong>Login ID</strong></th>
						      <th><strong>Expected Salary</strong></th>
                               <th><strong>Action</strong></th>
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
						      <td>&nbsp;$rs[name]</td>
						      <td>&nbsp;$rs[address], <br>
						      &nbsp;$rs13[city],<br>
							  &nbsp;$rs12[state],<br>
							  &nbsp;$rs1[country],<br>
						      PIN Code: &nbsp;$rs[pincode].</td>
							   <td>&nbsp;$rs[contactno]</td>
						      <td>&nbsp;$rs[work_profile]</td>
						      <td>&nbsp;$rs[date_of_birth]</td>
						      <td>&nbsp;$rs[login_id]</td>
						      <td>&nbsp;$rs[expected_salary]</td>
						      <td>&nbsp; 
							  <a href='worker.php?editid=$rs[worker_id]'>Edit</a> | 
							  <a href='viewworker.php?deleteid=$rs[worker_id]' onclick='return delconfirm()'>Delete</a><br>
<a href='imgworker/$rs[biodata]'>Download Bio data</a>							  
							  </td>
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