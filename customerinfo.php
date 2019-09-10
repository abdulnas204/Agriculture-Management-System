<?php 
session_start();
include("header.php");
include("dbconnection.php");

?>
	

		<div id="featured">
			<div class="container">
				<div class="row">
<?php include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
							<header>
								<h2>Customer Information</h2>
							</header>
							<table width="610" height="395" border="3">
							  <tbody>
							    <tr>
							      <th width="170" scope="row">Customer Name</th>
							      <td width="117"> <?php
							  $sql = "SELECT * FROM customer where customer_id=2";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
							  echo "
							  &nbsp;$rs[customer_name]";
							  }
							  ?></td>
						        </tr>
							    <tr>
							      <th scope="row">Address</th>
							      <td><p><?php
							  $sql = "SELECT * FROM customer  where customer_id=2";
							  $qsql = mysqli_query($con,$sql);
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
							 
							    &nbsp;$rs[address],<br>  
								&nbsp;$rs3[city],<br>  
								&nbsp;$rs[pincode],<br>  
								&nbsp;$rs2[state],<br>  
								&nbsp;$rs1[country].
                            ";
							  }
							  ?></p></td>
						        </tr>
							    <tr>
							      <th scope="row">Contact Number</th>
							      <td><?php
							  $sql = "SELECT * FROM customer  where customer_id=2";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
							  echo "<td>&nbsp;$rs[contact_no]</td>";
							  }
							  ?></td>
						        </tr>
							    <tr>
							      <th scope="row">Mobile Number</th>
							      <td><?php
							  $sql = "SELECT * FROM customer  where customer_id=2";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
							  echo " <td>&nbsp;$rs[mobile_no]</td>";
							  }
							  ?></td>
						        </tr>
							    <tr>
							      <th scope="row">Email ID</th>
							      <td><?php
							  $sql = "SELECT * FROM customer  where customer_id=2";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  
							  echo " <td>&nbsp;$rs[email_id]</td>";
							  }
							  ?></td>
						        </tr>
						      </tbody>
						  </table>
							<p>&nbsp;</p>
						</section>
					</div>
				</div>
			</div>
		</div>
		<?php include("footer.php");?>