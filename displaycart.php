<?php
session_start();
include("header.php");
include("dbconnection.php");
if($_GET[delid])
{
	$sql = "DELETE FROM product_purchase_record WHERE purchase_record_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con)  >= 1)
		{
	echo "<script>alert('Product deleted from cart');</script>";
		}
}
if(isset($_GET[prodid]))
{
	$sql = "INSERT INTO product_purchase_record(product_purchase_bill_id, selling_prod_id,customer_id, quantity, cost, status,seller_id) VALUES ('0','$_GET[prodid]','$_SESSION[customerid]','1','$_GET[prodcost]','Pending','$_SESSION[sellerid]')";
	$qsql = mysqli_query($con,$sql);
	echo "<script>alert('Product added to the cart');</script>";
}
?><div id="featured">
			<div class="container">
				<div class="row">
					<div class="9u">						
								<h2>Cart items</h2>
<form id="form1" name="form1" method="post" action="buyproduct.php">
    <table style="width:1250px;" border="0" class="tftable">
      <tbody>
        <tr>
          <th scope="row"><strong>&nbsp;Select</strong></th>
          <th scope="row"><strong>&nbsp;Image</strong></th>
          <th><strong>&nbsp;Product detail</strong></th>
          <th><strong>&nbsp;Product Cost</strong></th>
          <th><strong>&nbsp;Quantity</strong></th>
          <th><strong>&nbsp;Total</strong></th>
          <th><strong>&nbsp;Delete</strong></th>
        </tr>
          <?php
                $i=1;
                  $sql = "SELECT * FROM product_purchase_record where customer_id='$_SESSION[customerid]' AND status='Pending'";
                  $qsql = mysqli_query($con,$sql);
                  while($rs = mysqli_fetch_array($qsql))
                  {
                    $sql1 = "SELECT * FROM selling_product WHERE selling_prod_id='$rs[selling_prod_id]'";
                      $qsql1 = mysqli_query($con,$sql1);
                      $rs1 = mysqli_fetch_array($qsql1);
                  echo "
                        <tr>
                        <td>&nbsp;<input type='checkbox' name='buyingproduct[]' value='$rs[purchase_record_id]' checked></td>
                        <td>&nbsp;<img src='imgsellingproduct/$rs1[product_img1]' width='25' height='25'></td>
                          <td>&nbsp;$rs1[product_description]</td>
                          <td>&nbsp;$rupeesymbol $rs[cost]</td>
                          <td>&nbsp;<input type='text' name='productcart' value='$rs[quantity]' size='3' onkeyup='changecost(this.value,$rs[purchase_record_id],$i)' /> $rs1[quantity_type]</td>
                          <td>&nbsp;$rupeesymbol<span id='calccost$i'>" . $rs[cost] * $rs[quantity] ."</span></td>
                          <td>&nbsp; <a href='displaycart.php?delid=$rs[purchase_record_id]' onclick='return delconfirm()'>Delete</a></td>					  
                        </tr>";
                        $i++;
                 }
          ?>
        <tr>
          <th colspan="7" scope="row"><div align="right"></div>        
              <div align="center">
                <input type="submit" name="submit" id="submit" value="Confirm order" autofocus>
              </div>
          </th>
          </tr>
      </tbody>
    </table>
</form> 
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php");?>
<script type="application/javascript">
function changecost(totqty,purchaseid,divid)
{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
		else
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("calccost"+divid).innerHTML = xmlhttp.responseText;
            }
        };
		xmlhttp.open("GET","ajaxupdatecart.php?totqty="+totqty+"&purchaseid="+purchaseid+"&divid="+divid,true);
        xmlhttp.send();
}

function delconfirm()
{
if(confirm("Are you sure want to delete this cart item?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}	
}
</script>