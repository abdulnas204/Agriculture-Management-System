<?php
session_start();
include("header.php");
include("dbconnection.php");
?>
<div id="featured">
			<div class="container">
				<div class="row">
					<div class="12u">
						<section>
							<header>
								<h2>Search worker</h2>
							</header>
				
<form method="get" action="" name="frmworkersearch" onSubmit="return validateworksearch()">
<table width="1096" border="3" >
  <tbody>
    <tr>
      <td width="274" height="40">&nbsp;<select name="country" id="country" onChange="loadstate(this.value)" autofocus class="search_categories">
                                <option value="">Select Country</option>
                                  <?php
								  $sql1 = "SELECT * FROM country where status='Active'";
									$qsql1 =mysqli_query($con,$sql1);
								  while($rssql1 = mysqli_fetch_array($qsql1))
								  {
									  if($rssql1[country_id] == $_GET[country] )
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
      <td width="275">&nbsp;<span id='loadstate'><select name="state" class="search_categories"><option value="">Select</option></select></span></td>
      <td width="250">&nbsp;<span id='loadcity'><select name="city" class="search_categories"><option value="">Select</option></select></span></td>
      <td width="220" valign="middle">&nbsp;
        <input type="submit" name="submit" id="submit" value="Search record"> <a href="displayworkers.php">Clear Search</a></td>
    </tr>
  </tbody>
</table>
</form>
                            
					  </section>
				  </div>		
				</div>
			</div>
		</div>
		<div id="featured">
			<div class="container">
<div class="row">

<?php
						
									$i = 0;
									$sql = "SELECT * FROM worker WHERE status='Active'";
									if(isset($_GET[country]))
									{
										$sql = $sql . " AND country_id='$_GET[country]'";
									}
									if(isset($_GET[state]))
									{
										$sql = $sql . " AND state_id='$_GET[state]'";
									}
									if(isset($_GET[city]))
									{
										$sql = $sql . "  AND city_id='$_GET[city]'";	
									}
									
									$qsql = mysqli_query($con,$sql);
								   if(mysqli_num_rows($qsql)  == 0)
							       {
								    echo "<center>Sorry, No Workers Found For The Searched Location!!</center>";
								   }
									else
									{
									
									while($rs = mysqli_fetch_array($qsql))
									{
									?>
									<?php
                                    if(	$i == 3)
                                    {
                                        //echo '<div class="row">';
                                    }
                                    ?>
                                        <div class="3u">
                                            <section>							
                                                <header>
                                                <h2><?php  echo $rs[name]; ?></h2>
                                                </header>
                                                <p><strong>Work Profile:</strong><?php echo $rs[work_profile]; ?></p>	
                                                <p><strong>Expected salary: <?php echo $rupeesymbol; ?></strong> <?php echo $rs[expected_salary]; ?></p>					
                                                <h4>
                                                <a href="workerdetailed.php?workerid=<?php echo $rs[worker_id]; ?>">View Worker Profile</a><br> &nbsp;<hr>
                                                </h4>	
                                            </section>
                                        </div>
                                                 <?php
                                                if(	$i == 3)
                                                {
                                                        // echo "</div>";
                                                       $i=0;
                                                }				
                                                ?>
                                                <?php
                                                    $i++;
                                                }
                                             ?>
                                             <?php 
									           }
									          ?>

			</div>	
			</div>
		</div>
<?php include("footer.php");?>
<script type="application/javascript">

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
        xmlhttp.open("GET","ajaxstate.php?id="+id,true);
        xmlhttp.send();
    }
}
function loadcity(id) 
{
    if (id == "") 
	{
        document.getElementById("loadcity").innerHTML = "";
        return;
    } else
	 { 
        if (window.XMLHttpRequest)
		 {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
		 {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
                document.getElementById("loadcity").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxcity.php?id="+id,true);
        xmlhttp.send();
    }
}

function validateworksearch()
{
	if(document.frmworkersearch.country.value == "")
	{
		alert("Kindly select the country to search..");
		document.frmworkersearch.country.focus();
		return false;
	}	
	else if(document.frmworkersearch.state.value == "")
	{
		alert("Kindly select the state to search..");
		document.frmworkersearch.state.focus();
		return false;
	}	
	else if(document.frmworkersearch.city.value == "")
	{
		alert("Kindly select the city to search..");
		document.frmworkersearch.city.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>