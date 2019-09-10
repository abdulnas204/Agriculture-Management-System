<?php 
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
	if(isset($_POST[submit]))
	{
		$imgname1 = rand() . $_FILES[imge][name];
		move_uploaded_file($_FILES[imge][tmp_name],"imgcategory/" . $imgname1);
		
		if(isset($_GET[editid]))
		{
			$sql ="UPDATE category SET  `category`='$_POST[category]', `category_type`='$_POST[categorytype]', `description`='$_POST[description]', `img`='$imgname1', `status`='$_POST[status]' where category_id='$_GET[editid]'";
			if(!mysqli_query($con,$sql))
			{
				echo "Error in mysqli query";
			}
			else
			{
				echo "<script>alert('Category record updated successfully...');</script>";
			}
		}
		else
		{
		$sql="INSERT INTO `category`(`category_id`, `category`, `category_type`, `description`, `img`, `status`) VALUES ('','$_POST[category]','$_POST[categorytype]','$_POST[description]','$imgname1','$_POST[status]')";
		if(!mysqli_query($con,$sql))
			{
				echo "Error in mysqli query";
			}
			else
			{
				echo "<script>alert(' Category record inserted successfully...');</script>";
			}	
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM category WHERE category_id='$_GET[editid]'";
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
                                 <?php
								 if($_GET[cattype]=="Produce")
								 {
									 
									echo " <h2>Add or Edit Produce Category</h2>";
								 }
								 else
								 {
                                    echo " <h2>Add or Edit Product Category</h2>";
								 }
								 ?>
								
                                <?php
								if(isset($_GET[cattype]))
								{
									$cattype =  $_GET[cattype];
								}
								else
								{
									$cattype =  $rsedit[category_type];
								}
								?>
							</header>
                            <form method="post" action="" enctype="multipart/form-data" name="frmcategory" onSubmit="return validatecategory()">
                            <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
                            <input type="hidden" name="categorytype" id="categorytype" value="<?php echo $cattype; ?>" autofocus>
							<table width="414" height="278" border="2">
							  <tbody>
							    <tr>
							      <th scope="row" align="right">Category  <font color="#FF0000">*</font></th>
							      <td><input type="text" name="category" id="category" value="<?php echo $rsedit[category]; ?>"></td>
						        </tr>

							    <tr>
							      <th scope="row" align="right">Description</th>
							      <td><textarea name="description" id="description"><?php echo $rsedit[description]; ?></textarea></td>
						        </tr>
							    <tr>
							      <th scope="row" align="right">Image  <font color="#FF0000">*</font></th>
							      <td><input type="file" name="imge" id="imge" value="<?php echo $rsedit[img]; ?>"></td>
						        </tr>
							    <tr>
							      <th scope="row" align="right">Status</th>
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
							      <th scope="row">&nbsp;</th>
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
	
    function validatecategory()
    {
		
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space


	if(document.frmcategory.category.value == "")
	{
		alert("Category should not be empty..");
		document.frmcategory.category.focus();
		return false;
	}
	else if(!document.frmcategory.category.value.match(alphaspaceExp))
	{
		alert("Please enter only letters for Category..");
		document.frmcategory.category.focus();
		return false;
	}
	else if(document.frmcategory.imge.value == "")
	{
		alert("Kindly select an image..");
		document.frmcategory.imge.focus();
		return false;
	}
	else
	{
		return true;
	}
	}
    </script>