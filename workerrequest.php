<?php
session_start();
if(isset($_GET[workerid]))
{
	$_SESSION[Workerids] = $_GET[workerid];
}
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
	if(isset($_POST[submit]))
	{	
	 	$sqlworkrq = "SELECT * FROM  worker_request WHERE (('$_POST[fromdate]' BETWEEN  from_date AND  to_date) OR ('$_POST[tilldate]' BETWEEN  from_date AND  to_date )) AND worker_id='$_SESSION[Workerids]' AND worker_status='Approved'"; 
		$qsqlworkrq = mysqli_query($con,$sqlworkrq);
		$countreq = mysqli_num_rows($qsqlworkrq);
		if($countreq >= 1)
		{
			echo "<script>alert('You can`t send work request on this date..');</script>";
		}
		else
		{
			if(isset($_GET[editid]))
			{
				$sql ="UPDATE worker_request SET seller_id='$_SESSION[sellerid]', from_date='$_POST[fromdate]', to_date='$_POST[tilldate]', task='$_POST[task]', country_id='$_POST[country]', state_id='$_POST[state]', city_id='$_POST[city]', salary='$_POST[salary]', salary_type='$_POST[salarytype]', seller_status='Pending', worker_status='', seller_comment='$_POST[retruitercomment]', worker_comment=''";
				if(!mysqli_query($con,$sql))
				{
					echo "Error in mysqli query";
				}
				else
				{
					echo "<script>alert('Worker request  updated successfully...');</script>";
				}
			}
			else
			{
			$sql = "INSERT INTO worker_request( worker_id,seller_id, from_date, to_date, task, country_id, state_id, city_id, salary, salary_type, seller_status, worker_status, seller_comment, worker_comment) VALUES ('$_POST[workerid]','$_SESSION[sellerid]','$_POST[fromdate]','$_POST[tilldate]','$_POST[task]','$_POST[country]','$_POST[state]','$_POST[city]','$_POST[salary]','$_POST[salarytype]','Approved','','$_POST[retruitercomment]','')";
				if(!mysqli_query($con,$sql))
				{
					echo "Error in mysqli query";
				}
				else
				{
					echo "<script>alert('Worker request  sent successfully...');</script>";

$sqlseller = "SELECT * FROM seller WHERE seller_id='$_SESSION[sellerid]'";
$qsqlseller = mysqli_query($con,$sqlseller);
$rsseller = mysqli_fetch_array($qsqlseller);
$sqlworker = "SELECT * FROM worker WHERE worker_id='$_POST[workerid]'";
$qsqlworker = mysqli_query($con,$sqlworker);
$rsworker = mysqli_fetch_array($qsqlworker);
?>
<iframe src="http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=iagro&password=825848045&sendername=iiagro&mobileno=<?php echo $rsworker[contactno]; ?>&message=<?php echo "You have got work request from $rsseller[seller_name] for $_POST[task] from $_POST[fromdate] to  $_POST[tilldate] . Kindly login the website to approve/reject the request.." ; ?>"></iframe>
<?php
					echo "<script>window.location='viewworkerrequest.php';</script>";
				}
			}
			
		}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM worker_request WHERE worker_id='$_GET[editid]'";
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
								<h2>Worker Request</h2>
							</header>

<?Php
//// Settings, change this to match your requirment //////
$start_year=2000; // Starting year for dropdown list box
$end_year=2020;  // Ending year for dropdown list box
////// end of settings ///////////
?>
<?Php
include("calendarscript.php");
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
$adj=str_repeat("<td>&nbsp;</td>",$j);  // Blank starting cells of the calendar 
$blank_at_end=42-$j-$no_of_days; // Days left after the last day of the month
if($blank_at_end >= 7){$blank_at_end = $blank_at_end - 7 ;} 
$adj2=str_repeat("<td >&nbsp;</td>",$blank_at_end); // Blank ending cells of the calendar

/// Starting of top line showing year and month to select ///////////////

echo "<table class='main tftable1'><td colspan=7 align='center' >
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
	if($year==$i)
	{
	echo "<option value='$i' selected>$i</option>";
	}
	else
	{
	echo "<option value='$i'>$i</option>";
	}
}
echo "</select>";

echo " </td>";
/*echo "<td align='center'> <a href=# onClick='self.close();'>X</a></td>"; */
echo " </tr><tr>";
echo "<th><strong>Sun</strong></th><th><strong>Mon</strong></th><th><strong>Tue</strong></th><th><strong>Wed</strong></th><th><strong>Thu</strong></th><th><strong>Fri</strong></th><th><strong>Sat</strong></th></tr><tr>";

////// End of the top line showing name of the days of the week//////////

//////// Starting of the days//////////
for($i=1;$i<=$no_of_days;$i++){
$pv="'$month'".","."'$i'".","."'$year'";
if(isset($_GET[month]))
{
	$imonth = $_GET[month];
}
else
{
	$imonth = date(m);
}

if(isset($_GET[year]))
{
	$iyear = $_GET[year];
}
else
{
	$iyear = date(Y);
}
$dtmnyr = $iyear . "-" . $imonth . "-" . $i ;
$sqlworkrq = "SELECT * FROM  worker_request WHERE ( '$dtmnyr' BETWEEN  from_date AND  to_date ) AND  worker_id='$_SESSION[Workerids]' AND worker_status != 'Rejected' AND worker_status!=''"; 
$qsqlworkrq = mysqli_query($con,$sqlworkrq);

if(mysqli_num_rows($qsqlworkrq) >=1 )
{
	$changecolor= " style='background-color:#FFEB99;'";
}
else
{
	$changecolor= " style='style='background-color:!important;'";
}

echo $adj."<td height='50' $changecolor><a href='#' onclick=\"post_value($pv);\"><strong>$i</strong></a><br>"; 
// This will display the date inside the calendar cell
while($rsworkq = mysqli_fetch_array($qsqlworkrq))
{
		$sqlseller = "SELECT * FROM seller WHERE seller_id='$rsworkq[seller_id]'";
		$qsqlseller = mysqli_query($con,$sqlseller);
		$rsseller = mysqli_fetch_array($qsqlseller);										  						  

		$sqlworker = "SELECT * FROM worker WHERE worker_id='$rsworkq[worker_id]'";
		$qsqlworker = mysqli_query($con,$sqlworker);
		$rsworker = mysqli_fetch_array($qsqlworker);										

	if($rsworkq[worker_status] != "")
	{
		if($rsworkq[worker_status] == "Pending")
		{
		echo "<font style='color:green;'>".$rsworkq[worker_status]."</font>";
		}
		else
		{
		echo "Not available";
		}
	}
	else
	{
		echo "Pending";
	}
	echo "<br>";
}

echo " </td>";
$adj='';
$j ++;
if($j==7){echo "</tr><tr>"; // start a new row
$j=0;}

}
echo $adj2;   // Blank the balance cell of calendar at the end 
echo "</tr></table>";
?>
                            <form method="post" action="" name="frmworkrequest" onSubmit="return validateworkrequest()">
                           <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
                           <input type="hidden" name="workerid" value="<?php echo $_GET[workerid]; ?>" >
						  <table  width="373" height="346" border="2" class="tftable">
						    <tbody>
						      <tr>
						        <td width="105" align="right">From Date <font color="#FF0000">*</font></td>
						        <td width="250"><input type="date" name="fromdate" min="<?php echo $dt; ?>" id="fromdate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $rsedit[from_date]; ?>" autofocus></td>
					          </tr>
						      <tr>
						        <td align="right">Till Date <font color="#FF0000">*</font></td>
						        <td><input type="date" name="tilldate" min="<?php echo $dt; ?>" id="tilldate" min="<?php echo date("Y-m-d"); ?>"  value="<?php echo $rsedit[to_date]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Task <font color="#FF0000">*</font></td>
						        <td><textarea name="task" id="task"><?php echo $rsedit[task]; ?></textarea></td>
					          </tr>
						      <tr>
						        <td align="right">Country <font color="#FF0000">*</font></td>
						        <td><select name="country" id="country" onChange="loadstate(this.value)">
                                 <option value="">Select</option>
                                <?php
								  $sql1 = "SELECT * FROM country where status='Active'";
									$qsql1 =mysqli_query($con,$sql1);
								  while($rssql1 = mysqli_fetch_array($qsql1))
								  {
									  if($rssql1[country_id] == $rsedit[country_id] )
									  {
									  echo "<option value='$rssql1[country_id]' selected>$rssql1[country]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql1[country_id]'>$rssql1[country]</option>";
									  }
								  }
								  ?>
					            </select></td>
					          </tr>
						      <tr>
						        <td align="right">State <font color="#FF0000">*</font></td>
						        <td><span id='loadstate'><select></select></span></td>
					          </tr>
						      <tr>
						        <td align="right">City <font color="#FF0000">*</font></td>
						        <td><span id='loadcity'><select></select></span></td>
					          </tr>
						      <tr>
						        <td align="right">Payment Amount <font color="#FF0000">*</font></td>
						        <td><input type="number" name="salary" id="salary" value="<?php echo $rsedit[salary]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Incentive Type <font color="#FF0000">*</font></td>
						        <td><select name="salarytype" id="salarytype">
                                 <option value="">Select</option>
                                 <?php
								  $arr= array("Wage","Salary");
								  foreach($arr as $val)
								  {
									  if($rsedit[salary_type] == $val)
									  {
									  echo "<option value='$val' selected >$val</option>";
									  }
									  else
									  {
									  echo "<option value='$val'>$val</option>";
									  }
								  }
								 ?>
					            </select></td>
					          </tr>
						      <tr>
						        <td align="right">Recruiter Comment</td>
						        <td><textarea name="retruitercomment" id="sellercomment"><?php echo $rsedit[seller_comment]; ?></textarea></td>
					          </tr>
						      <tr>
						        <td>&nbsp;</td>
						        <td><input type="submit" name="submit" id="submit" value="Submit"></td>
					          </tr>
					        </tbody>
					      </table>
                          </form>
						  <p>&nbsp;</p>
							
						</section>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php");?>
<script type="application/javascript">
function validateworkrequest()
{
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	if(document.frmworkrequest.fromdate.value == "")
	{
		alert("Kindly select date of commencement of work..");
		document.frmworkrequest.fromdate.focus();
		return false;
	}	
	else if(document.frmworkrequest.tilldate.value == "")
	{
		alert("Kindly select date of termination of work..");
		document.frmworkrequest.tilldate.focus();
		return false;
	}
	else if(document.frmworkrequest.task.value == "")
	{
		alert("Task should not be blank..");
		document.frmworkrequest.task.focus();
		return false;
	}	
	else if(document.frmworkrequest.country.value == "")
	{
		alert("Kindly select the country..");
		document.frmworkrequest.country.focus();
		return false;
	}	
	else if(document.frmworkrequest.state.value == "")
	{
		alert("Kindly select the state..");
		document.frmworkrequest.state.focus();
		return false;
	}	
	else if(document.frmworkrequest.city.value == "")
	{
		alert("Kindly select the city..");
		document.frmworkrequest.city.focus();
		return false;
	}
	else if(document.frmworkrequest.salary.value == "")
	{
		alert("Salary should not be blank..");
		document.frmworkrequest.salary.focus();
		return false;
	}	
	else if(document.frmworkrequest.salarytype.value == "")
	{
		alert("Kindly select the incentive type..");
		document.frmworkrequest.salarytype.focus();
		return false;
	}
	else
	{
		return true;
	}
}


function loadstate(id) {
    if (id == "") {
        document.getElementById("loadstate").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loadstate").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxstate.php?id="+id+"&profile=set",true);
        xmlhttp.send();
    }
}
function loadcity(id) {
    if (id == "") {
        document.getElementById("loadcity").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loadcity").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxcity.php?id="+id+"&profile=set",true);
        xmlhttp.send();
    }
}
</script>