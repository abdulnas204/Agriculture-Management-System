<?php 
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	$imgname1 = rand() . $_FILES[img1][name];
	move_uploaded_file($_FILES[img1][tmp_name],"imgsellingproduct/" . $imgname1);
	$imgname2 = rand() . $_FILES[img2][name];
	move_uploaded_file($_FILES[img2][tmp_name],"imgsellingproduct/" . $imgname2);
	$imgname3 = rand() . $_FILES[img3][name];
	move_uploaded_file($_FILES[img3][tmp_name],"imgsellingproduct/" . $imgname3);
	$imgname4 = rand() . $_FILES[img4][name];
	move_uploaded_file($_FILES[img4][tmp_name],"imgsellingproduct/" . $imgname4);
	$imgname5 = rand() . $_FILES[img5][name];
	move_uploaded_file($_FILES[img5][tmp_name],"imgsellingproduct/" . $imgname5);
	
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE selling_product SET  `category_id`='$_POST[category]', `product_name`='$_POST[productname]', `product_description`='$_POST[productdescription]', `product_img1`='$imgname1', `product_img2`='$imgname2', `product_img3`='$imgname3', `product_img4`='$imgname4', `product_img5`='$imgname5', `cost`='$_POST[cost]',`quantity_type`='$_POST[quantitytype]', `status`='Active' WHERE selling_prod_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Selling Product record updated successfully...');</script>";
		}
	}
	else
	{
	$sql="INSERT INTO `selling_product`(`category_id`, `product_name`, `product_description`,  `product_img1`,";
	if($_FILES[img2][name] != "")
	{
	$sql = $sql . "  `product_img2`, ";
	}
	if($_FILES[img3][name] != "")
	{
	$sql = $sql . " `product_img3`, ";
	}
	if($_FILES[img4][name] != "")
	{
	$sql = $sql . " `product_img4`, ";
	}
	if($_FILES[img5][name] != "")
	{
	$sql = $sql . " `product_img5`,";
	}
	$sql = $sql . "  `cost`,`quantity_type`, `status`) VALUES ('$_POST[category]','$_POST[productname]','$_POST[productdescription]','$imgname1',";
	if($_FILES[img2][name] != "")
	{
	$sql = $sql . " '$imgname2',";
	}
	if($_FILES[img3][name] != "")
	{
	$sql = $sql . " '$imgname3',";
	}
	if($_FILES[img4][name] != "")
	{
	$sql = $sql . " '$imgname4',";
	}
	if($_FILES[img5][name] != "")
	{
	$sql = $sql . " '$imgname5',";
	}	
	$sql = $sql . "'$_POST[cost]','$_POST[quantitytype]','Active')";
	
	if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query".mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Selling Product record inserted successfully...');</script>";
	}
}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM selling_product WHERE selling_prod_id='$_GET[editid]'";
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
								<h2>Add A Agro Product</h2>
							</header>
                            <form method="post" action="" enctype="multipart/form-data" name="frmsellingproduct" onSubmit="return validatesellingproduct()">
					     <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
                          <table width="381" height="368" border="2">
						    <tbody>
						      <tr>
						        <td width="122" align="right">Category <font color="#FF0000"> *</font></td>
						        <td width="241"><select name="category" id="category" autofocus>
                                <option value="">Select</option>
                                  <?php
								  $sql1 = "SELECT * FROM category where status='Active' AND category_type='SellingProduct'";
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
						        <td align="right">Product Name <font color="#FF0000"> *</font></td>
						        <td><input type="text" name="productname" id="productname" value="<?php echo $rsedit[product_name]; ?>" ></td>
					          </tr>
						      <tr>
						        <td align="right">Product Description</td>
						        <td><textarea name="productdescription" id="productdescription"><?php echo $rsedit[product_description]; ?></textarea></td>
					          </tr>
						      <tr>
						        <td align="right">Image1 <font color="#FF0000"> *</font></td>
						        <td><input type="file" name="img1" id="img1"></td>
					          </tr>
						      <tr>
						        <td align="right">Image2</td>
						        <td><input type="file" name="img2" id="img2"></td>
					          </tr>
						      <tr>
						        <td align="right">Image3</td>
						        <td><input type="file" name="img3" id="img3"></td>
					          </tr>
						      <tr>
						        <td align="right">Image4</td>
						        <td><input type="file" name="img4" id="img4"></td>
					          </tr>
						      <tr>
						        <td align="right">Image5</td>
						        <td><input type="file" name="img5" id="img5"></td>
					          </tr>
						      <tr>
						        <td align="right">Quantity Type</td>
						        <td><select name="quantitytype" id="quantitytype">
                                 <option value="">Select</option>
                                  <?php
								  $arr= array("Kilogram","Gram","Piece");
								  foreach($arr as $val)
								  {
									  if($rsedit[quantity_type] == $val)
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
						        <td align="right">Cost <font color="#FF0000"> *</font></td>
						        <td><input type="number" name="cost" id="cost" value="<?php echo $rsedit[cost]; ?>" ></td>
					          </tr>
						      <tr>
						        <td align="right">Status</td>
						        <td><select name="status" id="status">
                                <option value="">Select</option>
                                 <?php
								  $arr= array("Active","Inactive");
								  $i=1;
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
	function validatesellingproduct()
	{
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		 if(document.frmsellingproduct.category.value == "")
			{
				alert("Kindly select the category..");
				document.frmsellingproduct.category.focus();
				return false;
			}
		else if(document.frmsellingproduct.productname.value == "")
			{
				alert("Product name should not be blank..");
				document.frmsellingproduct.productname.focus();
				return false;
			}	
			else if(!document.frmsellingproduct.productname.value.match(alphaspaceExp))
			{
				alert("Please enter only letters for product name..");
				document.frmsellingproduct.productname.focus();
				return false;
			}
			else if(document.frmsellingproduct.img1.value == "")
			{
				alert("Select at least one image..");
				document.frmsellingproduct.img1.focus();
				return false;
			}
			else if(document.frmsellingproduct.cost.value == "")
			{
				alert("Cost should not be blank..");
				document.frmsellingproduct.cost.focus();
				return false;
			}
			else
			{
				return true;
			}
	}
</script>