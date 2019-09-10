<?Php
//***************************************
// This is downloaded from www.plus2net.com //
// You can distribute this code with the link to www.plus2net.com ///
// Please don't  remove the link to www.plus2net.com ///
// This is for your learning only not for commercial use. ///////
// The author is not responsible for any type of loss or problem or damage on using this script.//
// You can use it at your own risk. /////
//*****************************************


//// Settings, change this to match your requirment //////
$start_year=2000; // Starting year for dropdown list box
$end_year=2020;  // Ending year for dropdown list box
////// end of settings ///////////
?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>plus2net Calendar</title>
<link rel="canonical" href="http://www.plus2net.com/php_tutorial/cal2.php"/>
<script langauge="javascript">
function post_value(mm,dt,yy){
opener.document.f1.p_name.value = mm + "/" + dt + "/" + yy;
/// cheange the above line for different date format
self.close();
}

function reload(form){
var month_val=document.getElementById('month').value; // collect month value
var year_val=document.getElementById('year').value;      // collect year value
self.location='cal2.php?month=' + month_val + '&year=' + year_val ; // reload the page
}
</script>
<style type="text/css">
table.main {
  width: 100%; 
border: 1px solid black;
	background-color: #9dffff;
}
table.main td {

font-family: verdana,arial, helvetica,  sans-serif;
font-size: 11px;
}
table.main th {
	border-width: 1px 1px 1px 1px;
	padding: 0px 0px 0px 0px;
 background-color: #ccb4cd;
}
table.main a{TEXT-DECORATION: none;}
table,td{ border: 1px solid #ffffff }
</style>
</head>
<body>
<?Php
@$month=$_GET['month'];
@$year=$_GET['year'];

if(!($month <13 and $month >0)){
$month =date("m");  // Current month as default month
}

if(!($year <=$end_year and $year >=$start_year)){
$year =date("Y");  // Set current year as default year 
}

$d= 2; // To Finds today's date
//$no_of_days = date('t',mktime(0,0,0,$month,1,$year)); //This is to calculate number of days in a month
$no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);//calculate number of days in a month

$j= date('w',mktime(0,0,0,$month,1,$year)); // This will calculate the week day of the first day of the month
//echo $j;
$adj=str_repeat("<td bgcolor='#ffff00'>*&nbsp;</td>",$j);  // Blank starting cells of the calendar 
$blank_at_end=42-$j-$no_of_days; // Days left after the last day of the month
if($blank_at_end >= 7){$blank_at_end = $blank_at_end - 7 ;} 
$adj2=str_repeat("<td bgcolor='#ffff00'>*&nbsp;</td>",$blank_at_end); // Blank ending cells of the calendar

/// Starting of top line showing year and month to select ///////////////

echo "<table class='main'><td colspan=6 >

<select name=month value='' onchange=\"reload(this.form)\" id=\"month\">
<option value=''>Select Month</option>";
for($p=1;$p<=12;$p++){

$dateObject   = DateTime::createFromFormat('!m', $p);
$monthName = $dateObject->format('F');
if($month==$p){
echo "<option value=$p selected>$monthName</option>";
}else{
echo "<option value=$p>$monthName</option>";
}
}
echo "</select>
<select name=year value='' onchange=\"reload(this.form)\" id=\"year\">Select Year</option>
";
for($i=$start_year;$i<=$end_year;$i++){
if($year==$i){
echo "<option value='$i' selected>$i</option>";
}else{
echo "<option value='$i'>$i</option>";
}
}
echo "</select>";

echo " </td><td align='center'><a href=# onClick='self.close();'>X</a></td></tr><tr>";
echo "<th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>";

////// End of the top line showing name of the days of the week//////////

//////// Starting of the days//////////
for($i=1;$i<=$no_of_days;$i++){
$pv="'$month'".","."'$i'".","."'$year'";
echo $adj."<td><a href='#' onclick=\"post_value($pv);\">$i</a>"; // This will display the date inside the calendar cell
echo " </td>";
$adj='';
$j ++;
if($j==7){echo "</tr><tr>"; // start a new row
$j=0;}

}
echo $adj2;   // Blank the balance cell of calendar at the end 

echo "<tr><td colspan=7 align=center><a href='http://www.plus2net.com'><b>plus2net.com Calendar</b></a></td></tr>"; 
echo "</tr></table>";
echo "<center><a href=cal2.php>Reset PHP Calendar</a></center>";

?>
</body>
</html>
