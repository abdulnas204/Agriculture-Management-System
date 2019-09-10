<?php
session_start();
echo $_SESSION[sellerid];
include("dbconnection.php");
if(!isset($_SESSION[sellerid]))
{
	echo "<script>window.location='sellerloginpanel.php';</script>";
}
include("header.php");
if(isset($_SESSION[sellerid]))
{
	$sql = "SELECT * FROM seller WHERE seller_id='$_SESSION[sellerid]'";
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
							      <td width="874"><?php echo $rsdisp[seller_name]; ?></td>
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
								 <?php echo $rsdisp[seller_address]; ?><br />
                                 <?php echo $rs3[city]; ?><br />
                                 <?php echo $rsdisp[pincode]; ?><br />
                                 <?php echo $rs2[state]; ?> <br />
                                 <?php echo $rs1[country]; ?><br />
                                 </td>
						        </tr>  
							    <tr>
							      <th height="39" align="left"><strong>Contact Number:</strong></th>
							      <td><?php echo $rsdisp[contact_number]; ?></td>
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
							      <th height="33" align="left"><strong>Bank Details:</strong></th>
							      <td>
								  Account No.:<?php echo $rsdisp[bank_acno]; ?><br />
                                  Bank IFSC Code:<?php echo $rsdisp[bank_IFSC]; ?><br />
                                  Bank Name:<?php echo $rsdisp[bank_name]; ?><br />
                                  Branch:<?php echo $rsdisp[bank_branch]; ?> <br />
								</td>
						        </tr>
						      </table>
                          </form>
							<hr />
							
				<?Php
                //// Settings, change this to match your requirment //////
                $start_year=2000; // Starting year for dropdown list box
                $end_year=2020;  // Ending year for dropdown list box
                ////// end of settings ///////////
                ?>
                <br />
                                              <header>
                                                <h2>Worker Request Calendar</h2>
                                            </header>
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
                if($year==$i){
                echo "<option value='$i' selected>$i</option>";
                }else{
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
                $sqlworkrq = "SELECT * FROM  worker_request WHERE ( '$dtmnyr' BETWEEN  from_date AND  to_date) AND  seller_id='$_SESSION[sellerid]' "; 
                $qsqlworkrq = mysqli_query($con,$sqlworkrq);
                if(mysqli_num_rows($qsqlworkrq) >=1 )
                {
                    $changecolor= " style='background-color:#FFEB99;'";
                }
                else
                {
                    $changecolor= " style='background-color:#d4e3e5;'";
                }
                
                echo $adj."<td height='50' $changecolor><a href='#' onclick=\"post_value($pv);\"><strong>$i</strong></a><br>"; // This will display the date inside the calendar cell
                while($rsworkq = mysqli_fetch_array($qsqlworkrq))
                {
                        $sqlworker = "SELECT * FROM worker WHERE worker_id='$rsworkq[worker_id]'";
                        $qsqlworker = mysqli_query($con,$sqlworker);
                        $rsworker = mysqli_fetch_array($qsqlworker);										  						  
                
                        $sqlseller = "SELECT * FROM seller WHERE seller_id='$rsworkq[seller_id]'";
                        $qsqlseller = mysqli_query($con,$sqlseller);
                        $rsseller = mysqli_fetch_array($qsqlseller);										  						  
                    echo "<a href='viewworkerrequestdetailed.php?viewid=$rsworkq[0]' title='$rsworkq[task] \n Worker-$rsworker[name] \n Seller-$rsseller[seller_name]' >";
                
                    if($rsworkq[worker_status] != "")
                    {
                        if($rsworkq[worker_status] == "Pending")
                        {
                        echo "<font style='color:green;'>".$rsworkq[worker_status]."</font>";
                        }
                        else
                        {
                        echo $rsworkq[worker_status];
                        }
                    }
                    else
                    {
                        echo "Pending";
                    }
                    echo "</a><br>";
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
							
						</section>
					</div>
				</div>
			</div>
		</div>
	<?php include("footer.php");?>