<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_GET[deleteid]))
{
	$sql = "DELETE FROM worker_request WHERE  worker_request_id='$_GET[deleteid]'";
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
<?php
include("leftsidebar.php");
?>
					
					<div class="9u">
						<section>
						  <header>
								<h2>Recruitment Details</h2>
							</header>
<?php
		  $sql = "SELECT * FROM worker_request";
		  if(isset($_SESSION[sellerid]))
			{
				$sql = $sql . " WHERE seller_id='$_SESSION[sellerid]' ORDER BY worker_request_id DESC";
			}
		  if(isset($_SESSION[workerid]))
			{
				$sql = $sql . " WHERE worker_id='$_SESSION[workerid]' ORDER BY worker_request_id DESC";
			}								
		  $qsql = mysqli_query($con,$sql);
?>							     
<?php
if(mysqli_num_rows($qsql) == 0)
{
 echo "<center>No Worker Request to display</center>";       
}
else
{
?>
						  <table width="1031" height="47" border="2" class="tftable">
						    <tbody>
						      <tr>
						        <th width="192" height="39"><strong>Profile</strong>
						        <th width="153" height="39"><strong>Date</strong>
						        <th width="175"><strong>Task Allotted</strong></th>
						        <th width="189"><strong>Work Location</strong></th>
						        <th width="102"><strong>Status</strong></th>                                                               
                               <?php 
								  	if(!isset($_SESSION[sellerid]))
									{                           
								?>
                                <th width="86"><strong>Action</strong></td>
                               <?php
									}
									else
									{                           
								?>
                                <th width="86"><strong>View</strong></td>
                               <?php
									}
								?>
					          </tr>
                              <?php
							  while($rs = mysqli_fetch_array($qsql))
							  {
								  $sqlcountry = "SELECT * FROM country WHERE country_id='$rs[country_id]'";
								  $qsqlcountry = mysqli_query($con,$sqlcountry);
								  $rscountry = mysqli_fetch_array($qsqlcountry);								  

								  $sqlstate = "SELECT * FROM state WHERE state_id='$rs[state_id]'";
								  $qsqlstate = mysqli_query($con,$sqlstate);
								  $rsstate = mysqli_fetch_array($qsqlstate);								  

								  $sqlcity = "SELECT * FROM city WHERE city_id='$rs[city_id]'";
								  $qsqlcity = mysqli_query($con,$sqlcity);
								  $rscity = mysqli_fetch_array($qsqlcity);		

								  $sqlworker = "SELECT * FROM worker WHERE worker_id='$rs[worker_id]'";
								  $qsqlworker = mysqli_query($con,$sqlworker);
								  $rsworker = mysqli_fetch_array($qsqlworker);										  						  

								  $sqlseller = "SELECT * FROM seller WHERE seller_id='$rs[seller_id]'";
								  $qsqlseller = mysqli_query($con,$sqlseller);
								  $rsseller = mysqli_fetch_array($qsqlseller);										  						  

							  echo "
						      <tr>
						        <td> Worker - &nbsp;$rsworker[name]<br>
Farmer - &nbsp;$rsseller[seller_name]</td>								
						        <td>&nbsp;$rs[from_date]"." to " ." &nbsp;$rs[to_date]</td>
						        <td>&nbsp;$rs[task]</td>
						        <td>&nbsp;$rscity[city],<br>"."&nbsp;$rsstate[state],<br>"."&nbsp;$rscountry[country]"." </td>
						        <td>Seller - &nbsp;";
								if($rs[seller_status] == "")
								{
									echo "No updates yet";
								}
								else
								{
									echo $rs[seller_status];
								}
								echo "<br>Worker - &nbsp;";
								if($rs[worker_status] == "")
								{
									echo "No updates yet";
								}
								else
								{
									echo $rs[worker_status];
								}
								echo "</td>";
									if(isset($_SESSION[sellerid]))
									{
$dt = date("Y-m-d");
$date1 = new DateTime($dt);
$date2 = new DateTime($rs[to_date]); 

								   echo  "<td>";
								   if($date2 > $date1)
								   {
								   echo "<a href='workerrequest.php?editid=$rs[worker_request_id]'>Edit</a> | ";
								   }
								   echo "<a href='viewworkerrequestdetailed.php?viewid=$rs[worker_request_id]'>View</a></td></tr>";
									}
									else if(isset($_SESSION[workerid]))
									{ 
								   echo " <td><a href='viewworkerrequestdetailed.php?viewid=$rs[worker_request_id]'>View</a></td></tr>";
									}
									else
									{										
								   echo " <td>&nbsp;";
								   if($date2 > $date1)
								   {
								   echo "<a href='workerrequest.php?editid=$rs[worker_request_id]'>Edit</a> | ";
								   }
								   echo "<a href='viewworkerrequest.php?deleteid=$rs[worker_request_id]' onclick='return delconfirm()'>Delete</a> | <a href='viewworkerrequestdetailed.php?viewid=$rs[worker_request_id]'>View</a></td></tr>";
									}
							   }
							  ?>
					        </tbody>
					      </table>
<?php
}
?>
						  <p>&nbsp;</p>
							
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