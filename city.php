<?php 
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE city SET  `country_id`='$_POST[country]', `state_id`='$_POST[state]', `city`='$_POST[city]', `description`='$_POST[description]', `status`='$_POST[status]' WHERE city_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('City record updated successfully...');</script>";
		}
	}
	else
	{
$sql="INSERT INTO `city`(`city_id`, `country_id`, `state_id`, `city`, `description`, `status`) VALUES ('','$_POST[country]','$_POST[state]','$_POST[city]','$_POST[description]','$_POST[status]')";	
if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query" . mysqli_error($con);
	}
	else
	{
		echo "<script>alert('City record inserted successfully...');</script>";
	}
}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM city WHERE city_id='$_GET[editid]'";
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
								<h2>Add A City</h2>
							</header>
                            <form method="post" action="" name="frmcity" onSubmit="return validatecity()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="308" height="164" border="2">
							  <tbody>
							    <tr>
							      <td width="76" align="right">Country  <font color="#FF0000">*</font> </td>
							      <td width="214"><select name="country" id="country" onChange="loadstate(this.value)" autofocus>
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
							      <td align="right">State  <font color="#FF0000">*</font></td>
							      <td><span id='loadstate'><select></select></span></td>
						        </tr>
							    <tr>
							      <td align="right">City <font color="#FF0000">*</font></td>
							      <td><input type="text" name="city" id="city" value="<?php echo $rsedit[city]; ?>" ></td>
						        </tr>
							    <tr>
							      <td align="right">Description</td>
							      <td><textarea name="description" id="description"><?php echo $rsedit[description]; ?></textarea></td>
						        </tr>
                                 <tr>
							      <td height="37" align="right">Status  </td>
							      <td><select name="status" id="status">
                                      <option value="">Select</option>
									  <?php
                                      $arr= array("Active","Inactive");
                                      foreach($arr as $val)
                                      {
                                          if($rsedit[status] == $val)
                                          {
                                          echo "<option value='$val' selected >$val<option>";
                                          }
                                          else
                                          {
                                          echo "<option value='$val'>$val<option>";
                                          }
                                      }
                                      ?>
						          </select></td>
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
	function validatecity()
	{
			
	var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		 if(document.frmcity.country.value == "")
	{
		alert("Kindly select the country..");
		document.frmcity.country.focus();
		return false;
	}	
	else if(document.frmcity.state.value == "")
	{
		alert("Kindly select the state..");
		document.frmcity.state.focus();
		return false;
	}	
	else if(document.frmcity.city.value == "")
	{
		alert("Enter city..");
		document.frmcity.city.focus();
		return false;
	}
	else if(!document.frmcity.value.match(alphaspaceExp))
	{
		alert("Please enter only letters for city name..");
		document.frmcity.city.focus();
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
        xmlhttp.open("GET","ajaxstate.php?id="+id,true);
        xmlhttp.send();
    }
}

	</script>