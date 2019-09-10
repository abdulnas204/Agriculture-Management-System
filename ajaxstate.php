<?php
include("dbconnection.php");
?>
<select name="state" id="state" onChange="loadcity(this.value)"   
<?php
if($_GET[profile] != "set")
{
	echo ' class="search_categories" ';
}
?> >
<option value="">Select</option>
<?php
$sql2 = "SELECT * FROM state where status='Active' AND country_id='$_GET[id]'";
$qsql2 =mysqli_query($con,$sql2);
while($rssql2 = mysqli_fetch_array($qsql2))
{
if($rssql2[state_id] == $rsedit[state_id] )
{
echo "<option value='$rssql2[state_id]' selected>$rssql2[state]</option>";
}
else
{
echo "<option value='$rssql2[state_id]'>$rssql2[state]</option>";
}
}
?>
</select>