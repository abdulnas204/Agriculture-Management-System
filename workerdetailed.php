<?php
session_start();
include("header.php");
include("dbconnection.php");

if(isset($_GET[workerid]))
{
	$sql = "SELECT * FROM worker WHERE worker_id='$_GET[workerid]'";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
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
								<h2>Worker Profile</h2>
							</header>
                             <form method="post" action="" enctype="multipart/form-data"  name="frmworkreg" onSubmit="return validateworkreg()">
						  <table width="991" height="556" border="2" class="tftable">
						    <tbody>
						      <tr>
						        <th width="139" align="right"><div align="left"><strong>Name:</strong></div></th>
						        <td width="834"><?php echo $rsedit[name]; ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>Address:</strong></div></th>
						        <td><?php echo $rsedit[address]; ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>Country:</strong></div></th>
						        <td>
                                  <?php
								  $sql1 = "SELECT * FROM country where status='Active'";
									$qsql1 =mysqli_query($con,$sql1);
								  while($rssql1 = mysqli_fetch_array($qsql1))
								  {
									  if($rssql1[country_id] == $rsedit[country_id] )
									  {
									  echo "<option value='$rssql1[country_id]' selected>$rssql1[country]</option>";
									  }
								  }
								  ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>State:</strong></div></th>
						        <td>
                                  <?php
								  $sql2 = "SELECT * FROM state where status='Active'";
									$qsql2 =mysqli_query($con,$sql2);
								  while($rssql2 = mysqli_fetch_array($qsql2))
								  {
									  if($rssql2[state_id] == $rsedit[state_id] )
									  {
									  echo "<option value='$rssql2[state_id]' selected>$rssql2[state]</option>";
									  }
								  }
								  ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>City:</strong></div></th>
		                               <td>
                                  <?php
								  $sql3= "SELECT * FROM city where status='Active'";
									$qsql3 =mysqli_query($con,$sql3);
								  while($rssql3 = mysqli_fetch_array($qsql3))
								  {
									  if($rssql3[city_id] == $rsedit[city_id] )
									  {
									  echo "<option value='$rssql3[city_id]' selected>$rssql3[city]</option>";
									  }
								  }
								  ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>Pincode:</strong></div></th>
						        <td><?php echo $rsedit[pincode]; ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>Work Profile:</strong></div></th>
						        <td><?php echo $rsedit[work_profile]; ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>Biodata:</strong></div></th>
						        <td>
                                <a href='imgworker/<?php echo $rsedit[biodata]; ?>' target="_blank" >Download Biodata</a>
                                </td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>Date of Birth:</strong></div></th>
						        <td><?php echo $rsedit[date_of_birth]; ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>Email ID:</strong></div></th>
						        <td><?php echo $rsedit[login_id]; ?></td>
					          </tr>
						      <tr>
						        <th align="right"><div align="left"><strong>Expected Payment:</strong></div></th>
						        <td><?php echo $rupeesymbol; ?><?php echo $rsedit[expected_salary]; ?></td>
					          </tr>
					        </tbody>
					      </table>
                          </form>
						  <p>&nbsp;
                        <?php
						  if(isset($_SESSION[sellerid]))
						  {
						?>
<h2><a   class="button" href="workerrequest.php?workerid=<?php echo $_GET[workerid]; ?>">Send Request</a></h2>                        
                        <?php
						  }
						  else
						  {
						?>
                          <h2><a class="button" href="sellerloginpanel.php?redirectlink=<?php echo "workerrequest.php"; ?>&workerid=<?php echo $_GET[workerid]; ?>">Send request</a></h2>
                          
    	                  <?php
						  }
						  ?>
                          </p>							
						</section>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php");?>