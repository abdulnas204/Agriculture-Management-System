<?php
include("dbconnection.php");
$sql3 = "SELECT * FROM produce where status='Active' AND category_id='$_GET[q]'";
$qsql3=mysqli_query($con,$sql3);
?>
<select name="produce" id="produce" onchange="showUser1(this.value)">
<option value="">Select</option>
<?php
while($rssql3 = mysqli_fetch_array($qsql3))
{
  if($rssql3[produce_id] == $rsedit[produce_id] )
  {
  echo "<option value='$rssql3[produce_id]' selected>$rssql3[produce]</option>";
  }
  else
  {
  echo "<option value='$rssql3[produce_id]'>$rssql3[produce]</option>";
  }
}
?>
</select>