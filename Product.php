<?php 
session_start();
include("header.php");
include("dbconnection.php");
if($_SESSION[randnumber]  == $_POST[randnumber])
{
if(isset($_POST[submit]))
{
	$dt = date("Y-m-d");
	$imgname1 = rand() . $_FILES[img1][name];
	move_uploaded_file($_FILES[img1][tmp_name],"imgproduct/" . $imgname1);
	$imgname2 = rand() . $_FILES[img2][name];
	move_uploaded_file($_FILES[img2][tmp_name],"imgproduct/" . $imgname2);
	$imgname3 = rand() . $_FILES[img3][name];
	move_uploaded_file($_FILES[img3][tmp_name],"imgproduct/" . $imgname3);
	$imgname4 = rand() . $_FILES[img4][name];
	move_uploaded_file($_FILES[img4][tmp_name],"imgproduct/" . $imgname4);
	$imgname5 = rand() . $_FILES[img5][name];
	move_uploaded_file($_FILES[img5][tmp_name],"imgproduct/" . $imgname5);
		if($_POST[quantity] == 0)
		{
			$status = "Inactive";			
		}
		else
		{
			$status = $_POST[status];
		}	
	if(isset($_GET[editid]))
	{

		$qty = $_POST[quantity];
		$sql ="UPDATE product SET  seller_id='$_SESSION[sellerid]', category_id='$_POST[category]', produce_id='$_POST[produce]', variety_id='$_POST[variety]', title='$_POST[title]', ";
		if($_FILES[img1][name] != "")
		{
		$sql = $sql . " img_1='$imgname1',  ";
		}
		if($_FILES[img2][name] != "")
		{
		$sql = $sql . " img_2='$imgname2',  ";
		}
		if($_FILES[img3][name] != "")
		{
		$sql = $sql . " img_3='$imgname3',  ";
		}
		if($_FILES[img4][name] != "")
		{
		$sql = $sql . " img_4='$imgname4',  ";
		}
		if($_FILES[img5][name] != "")
		{
		$sql = $sql . " img_5='$imgname5',  ";
		}
		$sql = $sql . " quantity='$_POST[quantity]', quantity_type='$_POST[quantitytype]', description='$_POST[description]', uploaded_date='$_POST[uploaddate]', status='' WHERE product_id='$_GET[editid]'";
		if(!mysqli_query($con,$sql))
		{
			echo "Error in mysqli query";
		}
		else
		{
			echo "<script>alert('Product record updated successfully...');</script>";
		}
	}
	else
	{
$sql="INSERT INTO product(product_id, seller_id, category_id, produce_id, variety_id, title, img_1";
if($_FILES[img2][name] != "")
{
$sql = $sql . " , img_2";
}
if($_FILES[img2][name] != "")
{
$sql = $sql . " , img_3";
}
if($_FILES[img2][name] != "")
{
$sql = $sql . " , img_4";
}
if($_FILES[img2][name] != "")
{
$sql = $sql . " , img_5";
}
$sql = $sql . " , quantity, quantity_type, description, uploaded_date, status) VALUES ('','$_SESSION[sellerid]','$_POST[category]','$_POST[produce]','$_POST[variety]','$_POST[title]','$imgname1'";
if($_FILES[img2][name] != "")
{
$sql = $sql . " ,'$imgname2'";
}
if($_FILES[img2][name] != "")
{
$sql = $sql . " ,'$imgname3'";
}
if($_FILES[img2][name] != "")
{
$sql = $sql . " ,'$imgname4'";
}
if($_FILES[img2][name] != "")
{
$sql = $sql . " ,'$imgname5'";
}
$sql = $sql . " ,'$_POST[quantity]','$_POST[quantitytype]','$_POST[description]','$dt','$status')";	

if(!mysqli_query($con,$sql))
	{
		echo "Error in mysqli query";
	}
	else
	{
		if($_POST[status] == "Active")
		{
		echo "<script>alert('Your Produce Has Been Put On Sale...');</script>";
		}
		else
		{
		echo "<script>alert('Your Produce has not been put on sale..');</script>";
		}
	}
}
}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if(isset($_GET[editid]))
{
	$sql = "SELECT * FROM product WHERE product_id='$_GET[editid]'";
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
								<h2>Product</h2>
							</header>
                            <form method="post" action="" enctype="multipart/form-data" name="frmproduct" onSubmit="return validateproduct()">
                             <input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>" >
						  <table width="414" height="471" border="2" class="tftable" >
						    <tbody>
						      <tr>
						        <td width="107" align="right">Category <font color="#FF0000">*</font></td>
						        <td width="289"><select name="category" id="category" onchange="showUser(this.value)" autofocus>
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
						        <td align="right">Produce <font color="#FF0000">*</font></td>
						        <td>
                                <div id="txtHint">
                                <select name="produce" id="produce" onchange="showUser1(this.value)">
                                 <option value="">Select</option>
                                  <?php
								  $sql3 = "SELECT * FROM produce where status='Active'";
									$qsql3=mysqli_query($con,$sql3);
								  while($rssql3 = mysqli_fetch_array($qsql3))
								  {
									  if($rssql3[produce_id] == $rsedit[produce_id] )
									  {
									  echo "<option value='$rssql3[produce_id]' selected>$rssql3[produce]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql3[produce_id]'>$rssql3[produce]</option>";
									  }
								  }
								  ?>
					            </select>
                                </div>
                                </td>
					          </tr>
						      <tr>
						        <td align="right">Variety <font color="#FF0000">*</font></td>
						        <td><div id="txtHint1"><select name="variety" id="variety" >
                                 <option value="">Select</option>
                                  <?php
								  $sql4 = "SELECT * FROM variety where status='Active'";
									$qsql4=mysqli_query($con,$sql4);
								  while($rssql4 = mysqli_fetch_array($qsql4))
								  {
									  if($rssql4[variety_id] == $rsedit[variety_id] )
									  {
									  echo "<option value='$rssql4[variety_id]' selected>$rssql4[variety]</option>";
									  }
									  else
									  {
									  echo "<option value='$rssql4[variety_id]'>$rssql4[variety]</option>";
									  }
								  }
								  ?>
					            </select></div></td>
					          </tr>
						      <tr>
						        <td align="right">Title  <font color="#FF0000">*</font> </td>
						        <td><input type="text" name="title" id="title" value="<?php echo $rsedit[title]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Image 1  <font color="#FF0000">*</font> </td>
						        <td><input type="file" name="img1" id="img1">
                                    <input type="hidden" name="img11" id="img11" value="<?php echo $rsedit[img_1]; ?>">
                                </td>
					          </tr>
						      <tr>
						        <td align="right">Image 2</td>
						        <td><input type="file" name="img2" id="img2"></td>
					          </tr>
						      <tr>
						        <td align="right">Image 3</td>
						        <td><input type="file" name="img3" id="img3"></td>
					          </tr>
						      <tr>
						        <td align="right">Image 4</td>
						        <td><input type="file" name="img4" id="img4"></td>
					          </tr>
						      <tr>
						        <td align="right">Image 5</td>
						        <td><input type="file" name="img5" id="img5"></td>
					          </tr>
						      <tr>
						        <td align="right">Quantity  <font color="#FF0000">*</font></td>
						        <td><input type="number" name="quantity" id="quantity" value="<?php echo $rsedit[quantity]; ?>"></td>
					          </tr>
						      <tr>
						        <td align="right">Quantity Type  <font color="#FF0000">*</font></td>
						        <td><select name="quantitytype" id="quantitytype">
                                 <option value="">Select</option>
                                  <?php
								  $arr= array("Kilogram","Gram","Quintal");
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
						        <td align="right">Description</td>
						        <td><textarea name="description" id="description"><?php echo $rsedit[description]; ?></textarea></td>
					          </tr>

						      <tr>
						        <td align="right">Status</td>
						        <td><select name="status" id="status" onChange="loadstatus(this.value)">
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
					            </select>
                                <span id="ajaxstatus">Your produce will be put on sale..</span>
                                </td>
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
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
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

function showUser1(str) {
    if (str == "") {
        document.getElementById("txtHint1").innerHTML = "";
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
                document.getElementById("txtHint1").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","ajaxvariety.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<script type="application/javascript">
function validateproduct()
{
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	 if(document.frmproduct.category.value == "")
	{
		alert("Kindly select the category..");
		document.frmproduct.category.focus();
		return false;
	}
	else if(document.frmproduct.produce.value == "")
	{
		alert("Kindly select the produce..");
		document.frmproduct.produce.focus();
		return false;
	}
	 else if(document.frmproduct.variety.value == "")
	{
		alert("Kindly select the variety..");
		document.frmproduct.variety.focus();
		return false;
	}
	else if(document.frmproduct.title.value == "")
	{
		alert("Title should not be empty..");
		document.frmproduct.title.focus();
		return false;
	}
	else if(document.frmproduct.img11.value == "")
	{
		if(document.frmproduct.img1.value == "")
		{
		alert("Select at least one image..");
		document.frmproduct.img1.focus();
		return false;
		}
	}
	else if(document.frmproduct.quantity.value == "")
	{
		alert("Quantity should not be empty..");
		document.frmproduct.quantity.focus();
		return false;
	}
	else if(document.frmproduct.quantity.value < 1)
	{
		alert("Quantity should not be less than 1..");
		document.frmproduct.quantity.focus();
		return false;
	}	
	else if(document.frmproduct.quantitytype.value == "")
	{
		alert("Select a quantity type..");
		document.frmproduct.quantitytype.focus();
		return false;
	}
	else
	{
		return true;
	}
	
}
function loadstatus(prodstatus)
{
	if(prodstatus == "Active") 
	{
	document.getElementById("ajaxstatus").innerHTML = "Your produce will be put on sale..";
	}
	else
	{
	document.getElementById("ajaxstatus").innerHTML = "Your produce will not be put on sale because the status is inactive. Put it on Active to display the products";
	}
}
</script>