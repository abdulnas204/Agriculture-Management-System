<?php 
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	$imgname1 = rand() . $_FILES[img][name];
	move_uploaded_file($_FILES[img][tmp_name],"imgproduce/" . $imgname1);
	
    if(isset($_GET[editid]))
	{
		$sql ="UPDATE produce SET  `category_id`='$_POST[category]', `produce`='$_POST[produce]', `description`='$_POST[description]', `img`='$imgname1', `status`='$_POST[status]'  WHERE produce_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query".mysqli_error($con);
		}
		else
		{
			echo "<script>alert('Produce record updated successfully...');</script>";
		}
	}
	else
	{
	$sql="INSERT INTO `produce`(`produce_id`, `category_id`, `produce`, `description`, `img`, `status`) VALUES ('','$_POST[category]','$_POST[produce]','$_POST[description]','$imgname1','$_POST[status]')";	
	
	if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query".mysqli_error($con);
		}
		else
		{
			echo "<script>alert('Produce record inserted successfully...');</script>";
		}
	}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM produce WHERE produce_id='$_GET[editid]'";
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
								<h2>Add A Produce</h2>
							</header>
                            <form method="post" action="" enctype="multipart/form-data" name="frmproduce" onSubmit="return validateproduce()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
							<table width="253" height="450" border="2">
							  <tbody>
							    <tr>
							      <td height="36" align="right">Category  <font color="#FF0000">*</font></td>
							      <td><select name="category" id="category" autofocus>
                                   <option value="">Select</option>
                                  <?php
								  $sql2 = "SELECT * FROM category where status='Active' AND category_type='Produce'";
									$qsql2 =mysqli_query($con,$sql2);
								  while($rssql2 = mysqli_fetch_array($qsql2))
								  {
									  if($rssql2[category_id] == $rsedit[category_id] )
									  {
									  echo "<option value='$rssql2[category_id]' selected>$rssql2[category]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql2[category_id]'>$rssql2[category]</option>";
									  }
								  }
								  ?>
                                  </select></td>
						        </tr>
							    <tr>
							      <td height="45" align="right">Produce  <font color="#FF0000">*</font></td>
							      <td><input type="text" name="produce" id="produce" value="<?php echo $rsedit[produce]; ?>"></td>
						        </tr>
							    <tr>
							      <td valign="top" align="right">Description</td>
							      <td><textarea name="description" cols="75" rows="15" id="description"><?php echo $rsedit[description]; ?></textarea></td>
						        </tr>
							    <tr>
							      <td height="39" align="right">Image  <font color="#FF0000">*</font></td>
							      <td><input type="file" name="img" id="img"></td>
						        </tr>
							    <tr>
							      <td height="37" align="right">Status</td>
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
							
						</section>
					</div>
				</div>
			</div>
		</div>
	<?php include("footer.php");?>
	<script type="application/javascript">
	function validateproduce()
	{
		 if(document.frmproduce.category.value == "")
			{
				alert("Kindly select the category..");
				document.frmproduce.category.focus();
				return false;
			}
			else if(document.frmproduce.produce.value == "")
			{
				alert("Produce should not be blank..");
				document.frmproduce.produce.focus();
				return false;
			}
			else if(!document.frmproduce.produce.value.match(alphaspaceExp))
			{
				alert("Please enter only letters for produce..");
				document.frmproduce.produce.focus();
				return false;
			}
			else if(document.frmproduce.img.value == "")
			{
				alert("Select an image..");
				document.frmproduce.img.focus();
				return false;
			}
			else
			{
				return true;
			}
	}
	
	</script>