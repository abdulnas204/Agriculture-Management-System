<?php include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM customer WHERE customer_id='$_GET[deleteid]'";
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
								<h2>Registered Customers</h2>
							</header>
                            <?php
							
							  $sql = "SELECT * FROM customer";
							  $qsql = mysqli_query($con,$sql);

							 if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<center>There is Customer to display!!</center>";
									}
									else
									{
							?>
							<table width="946" height="38" border="1" class="tftable">
							  <tr>
							    <th height="32"><strong>Customer Name</strong></th>
							    <th><strong>Address</strong></th>
							    <th><strong>Contact Number</strong></th>
							    <th><strong>Mobile Number</strong></th>
		                        <th><strong>Customer Type</strong></th>
							    <th><strong>Status</strong></th>
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
								  $rs2 = mysqli_fetch_array($qsql2);
								  
								  $sql3 = "SELECT * FROM city WHERE city_id='$rs[city_id]'";
								  $qsql3 = mysqli_query($con,$sql3);
								  $rs3 = mysqli_fetch_array($qsql3);
								  
							  echo "
							  <tr>
							    <td>&nbsp;$rs[customer_name]</td>
							    <td>&nbsp;$rs[address],<br>
&nbsp;$rs1[country],<br>
&nbsp;$rs2[state],<br>
&nbsp;$rs3[city]<br>
PIN code: &nbsp;$rs[pincode]</td>
							    <td>&nbsp;$rs[contact_no]</td>
							    <td>&nbsp;$rs[mobile_no]</td>
							    <td>&nbsp;$rs[customer_type]</td>
							    <td>&nbsp;$rs[status]</td>
							    <td>&nbsp; <a href='customerReg.php?editid=$rs[customer_id]'>Edit</a>| <a href='viewcustomerReg.php?deleteid=$rs[customer_id]' onclick='return delconfirm()'>Delete</a></td>
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