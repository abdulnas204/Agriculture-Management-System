<?php
session_start();
if(!isset($_SESSION[customerid]))
{
	echo "<script>window.location='customerpanel.php';</script>";
}
include("header.php");
if(isset($_SESSION[customerid]))
{
	$sql = "SELECT * FROM customer WHERE customer_id='$_SESSION[customerid]'";
	$qsql = mysqli_query($con,$sql);
	$rsdisp = mysqli_fetch_array($qsql);
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
								<h2>Profile</h2>
							</header>
					
                            <form method="post" action="" name="frmcstview">
							<table width="900" height="350" border="10" class="tftable">
							  <tbody>
							    <tr>
							      <th width="136" height="34" align="right"><strong>Your Name:</strong></th>
							      <td width="874"><?php echo $rsdisp[customer_name]; ?></td>
						        </tr>
							    <tr>
							      <th height="48" align="right"><strong>Your Address:</strong></th>
							     
                                 <?php
								
								  $sql1 = "SELECT * FROM country WHERE country_id='$rsdisp[country_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  
								  $sql2 = "SELECT * FROM state WHERE state_id='$rsdisp[state_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs2 = mysqli_fetch_array($qsql2);
								  
								  $sql3 = "SELECT * FROM city WHERE city_id='$rsdisp[city_id]'";
								  $qsql3 = mysqli_query($con,$sql3);
								  $rs3 = mysqli_fetch_array($qsql3); ?>
								  <td>
								 <?php echo $rsdisp[address]; ?><br />
                                 <?php echo $rs3[city]; ?><br />
                                 <?php echo $rsdisp[pincode]; ?><br />
                                 <?php echo $rs2[state]; ?> <br />
                                 <?php echo $rs1[country]; ?><br />
                                 </td>
						        </tr>  
							    <tr>
							      <th height="39" align="left"><strong>Contact Number:</strong></th>
							      <td><?php echo $rsdisp[contact_no]; ?></td>
						        </tr>
							    <tr>
							      <th height="35" align="left"><strong>Mobile Number:</strong></th>
							      <td><?php echo $rsdisp[mobile_no]; ?></td>
						        </tr>
							    <tr>
							      <th height="39" align="left"><strong>Email ID:</strong></th>
							      <td><?php echo $rsdisp[email_id]; ?></td>
						        </tr>
							    <tr>
							      <th height="33" align="left"><strong>Customer Type:</strong></th>
							      <td><?php echo $rsdisp[customer_type]; ?>
								</td>
						        </tr>
						      </table>
                          </form>
							
						</section>
					</div>
				</div>
			</div>
		</div>
	

	
	<?php include("footer.php");?>