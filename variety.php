<?php
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
		
	$imgname1 = rand() . $_FILES[img][name];
	move_uploaded_file($_FILES[img][tmp_name],"imgvariety/" . $imgname1);
	
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE variety SET  `category_id`='$_POST[category]', `produce_id`='$_POST[produce]', `variety`='$_POST[variety]', `description`='$_POST[description]', `img`='$imgname1', `status`='Active'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Variety record updated successfully...');</script>";
		}
	}
	else
	{
$sql="INSERT INTO `variety`(`variety_id`, `category_id`, `produce_id`, `variety`, `description`, `img`, `status`) VALUES ('','$_POST[category]','$_POST[produce]','$_POST[variety]','$_POST[description]','$imgname1','Active')";
if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query";
	}
	else
	{
		echo "<script>alert('Variety record inserted successfully...');</script>";
	}
}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM variety WHERE variety_id='$_GET[editid]'";
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
								<h2>Add A Variety</h2>
							</header>
                            <form method="post" action="" enctype="multipart/form-data" name="frmvariety" onSubmit="return validatevariety()" >
                             <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
						  <table width="355" height="234" border="2">
						    <tbody>
						      <tr>
						        <td align="right">Category <font color="#FF0000">*</font></td>
						        <td><select name="category" id="category" onchange="showproduce(this.value)" autofocus>
                                   <option value="">Select</option>
                                  <?php
								  $sql1 = "SELECT * FROM category where status='Active'";
								  if(isset($_GET[varietytype]))
								  {
								  	$sql1 = $sql1 . " and category_type='$_GET[varietytype]'";
								  }
								  $qsql1 =mysqli_query($con,$sql1);
								  while($rssql1 = mysqli_fetch_array($qsql1))
								  {
									  if($rssql1[category_id] == $rsedit[category_id] )
									  {
									  echo "<option value='$rssql1[category_id]' selected>$rssql1[category]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql1[category_id]'>$rssql1[category]</option>";
									  }
								  }
								  ?>
					            </select></td>
					          </tr>
						      <tr>
						        <td align="right">Produce <font color="#FF0000">*</font></td>
						        <td>
                                <div id="txtHint">
                                <select name="produce" id="produce">
                                   <option value="">Select</option>
                                  <?php
								  $sql1 = "SELECT * FROM produce where status='Active'";
									$qsql1 =mysqli_query($con,$sql1);
								  while($rssql1 = mysqli_fetch_array($qsql1))
								  {
									  if($rssql1[produce_id] == $rsedit[produce_id] )
									  {
									  echo "<option value='$rssql1[produce_id]' selected>$rssql1[produce]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql1[produce_id]'>$rssql1[produce]</option>";
									  }
								  }
								  ?>
					            </select>
                                </div>
                                </td>
					          </tr>
						      <tr>
						        <td align="right">Variety </td>
						        <td><input type="text" name="variety" id="variety" value="<?php echo $rsedit[variety]; ?>"></td>
					          </tr>
						      <tr>
						        <td height="43" align="right">Description </td>
						        <td><textarea name="description" id="description"><?php echo $rsedit[description]; ?></textarea></td>
					          </tr>
						      <tr>
						        <td align="right">Image <font color="#FF0000">*</font></td>
						        <td><input type="file" name="img" id="img"></td>
					          </tr>
						      <tr>
						        <td align="right">Status</td>
						        <td><select name="status" id="status">
                                  <option value="">Select</option>
                                  <?php
								  $arr= array("Active","Inactive");
								  foreach($arr as $val)
								  {
									  if($rsedit[status] == $val)
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
						        <td>&nbsp;</td>
						        <td><input type="submit" name="submit" id="submit" value="Submit"></td>
					          </tr>
					        </tbody>
					      </table>
                          </form>
						  <p>&nbsp;</p>
						  <p>&nbsp;</p>
							
						</section>
					</div>
				</div>
			</div>
		</div>
	<?php include("footer.php");?>
<script type="application/javascript" >    
function showproduce(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "<select name='category' id='category'><option value=''>Select</option></select>";
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
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxproduce.php?q="+str,true);
        xmlhttp.send();
    }
}


function validatevariety()
{
	var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space

	 if(document.frmvariety.category.value == "")
	{
		alert("Kindly select the category..");
		document.frmvariety.category.focus();
		return false;
	}	
	else if(document.frmvariety.produce.value == "")
	{
		alert("Kindly select the produce..");
		document.frmvariety.produce.focus();
		return false;
	}
	else if(document.frmvariety.img.value == "")
	{
		alert("Kindly select an image..");
		document.frmvariety.img.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>