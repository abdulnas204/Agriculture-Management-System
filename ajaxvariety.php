<?php
include("dbconnection.php");
?>
<select name="variety" id="variety">
                                 <option value="">Select</option>
                                  <?php
								  $sql4 = "SELECT * FROM variety where status='Active' AND produce_id='$_GET[q]'";
									$qsql4=mysqli_query($con,$sql4);
								  while($rssql4 = mysqli_fetch_array($qsql4))
								  {
									  if($rssql4[variety_id] == $rsedit[variety_id] )
									  {
									  echo "<option value='$rssql4[variety_id]' selected>$rssql4[variety]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql4[variety_id]'>$rssql4[variety]</option>";
									  }
								  }
								  ?>
</select>