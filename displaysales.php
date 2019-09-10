<?php
include("header.php");
include("dbconnection.php");
?>

		<div id="featured">
			<div class="container">

						<section>
							<header>
								<h2>Search by Location</h2>
							</header>
				
<form method="get" action="" name="frmsalessearch" onSubmit="return validatesalessearch()">
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
      <td width="275">&nbsp;<span id='loadstate'><select name="state"  autofocus class="search_categories"><option value="">Select State</option></select></span></td>
      <td width="250">&nbsp;<span id='loadcity'><select name="city"  autofocus class="search_categories"><option value="">Select City</option></select></span></td>
      <td width="220" valign="middle">&nbsp;
        <input type="submit" name="submit" id="submit" value="Search">&nbsp;	 <a href="displaysales.php">Clear Search</a>
        </td>
    </tr>
  </tbody>
</table>
</form>
                  <hr />
                            
					  </section>       
				<div class="row">

<?php
if(isset($_GET[submit]))
{
	$sql = "SELECT * FROM product INNER JOIN seller ON product.seller_id = seller.seller_id  WHERE product.status='Active' and product.quantity>1 AND seller.state_id='$_GET[state]' and seller.country_id='$_GET[country]' and seller.city_id='$_GET[city]'";
	                                 if(mysqli_num_rows($qsql)  == 0)
									{
										echo "<br><center>No Items to display based on location given...</center></br>";
									}
}
else
{
	$sql = "SELECT * FROM product WHERE status='Active' and quantity>1";
}
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
?>
    <div class="3u" >
        <section>
            <a href="displaysalesdetailed.php?productid=<?php echo $rs[0]; ?>" class="image full"><img src='imgproduct/<?php echo $rs[img_1]; ?>'  height="243" width="282" alt=""></a>
            <header>
                <h2><?php echo $rs[title]; ?></h2>
                <p><strong>Quantity :</strong> <?php echo $rs[quantity]; ?> <?php echo $rs[quantity_type]; ?></p>	
                <p><a href="displaysalesdetailed.php?productid=<?php echo $rs[0]; ?>">View Product detail</a></p>	
            </header>
            
        </section>
    </div>
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
        document.getElementById("loadstate").innerHTML = "<select name='state'><option value=''>Select</option></select>";
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

function validatesalessearch()
{
	if(document.frmsalessearch.country.value == "")
	{
		alert("Kindly select the country to search..");
		document.frmsalessearch.country.focus();
		return false;
	}	
	else if(document.frmsalessearch.state.value == "")
	{
		alert("Kindly select the state to search..");
		document.frmsalessearch.state.focus();
		return false;
	}	
	else if(document.frmsalessearch.city.value == "")
	{
		alert("Kindly select the city to search..");
		document.frmsalessearch.city.focus();
		return false;
	}
	else
	{
		return true;
	}

}
</script>