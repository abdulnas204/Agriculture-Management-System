<?php
session_start();
include("header.php");
include("dbconnection.php");
?>
<div id="featured">
			<div class="container">
				<div class="row">
					<div class="9u">
						<section>
							<header>
								<h2>Payment Bill</h2>
							</header>
                              <?php
								$sql = "SELECT * FROM product_purchase_bill where product_purchase_bill_id='$_GET[billid]'";
							  	$qsql = mysqli_query($con,$sql);
							 	$rs = mysqli_fetch_array($qsql);
							 
								   	$sql1 = "SELECT * FROM country WHERE country_id='$rs[country_id]'";
								  	$qsql1 = mysqli_query($con,$sql1);
								  	$rs1 = mysqli_fetch_array($qsql1);
								
								  	$sql2 = "SELECT * FROM state WHERE state_id='$rs[state_id]'";
								  	$qsql2 = mysqli_query($con,$sql2);
								  	$rs2 = mysqli_fetch_array($qsql2);
								 
								  	$sql3 = "SELECT * FROM city WHERE city_id='$rs[city_id]'";
								  	$qsql3 = mysqli_query($con,$sql3);
								  	$rs3 = mysqli_fetch_array($qsql3);
								?>
							<table width="805" height="162" border="0">
							  <tbody>
						   		<tr>
							      <th width="154" scope="row" align="right"><strong>Customer Name:&nbsp;</strong></th>
							      <td width="409">&nbsp;<?php echo $rs[customer_name]; ?></td>
							      <th width="93" align="right"><center>
							        <strong>Bill Number:&nbsp;</strong>
							        </center></th>
							      <td width="131">&nbsp;<?php echo $rs[product_purchase_bill_id]; ?></td>
						        </tr>
							    <tr>
							      <th scope="row" align="right"><strong>Customer Address:&nbsp;</strong></th>
							      <td><?php echo $rs[customer_address]; ?> <br>
                                  <?php echo $rs3[city]; ?> <br>
                                  <?php echo $rs2[state]; ?> <br>
                                  <?php echo $rs1[country]; ?> <br>
                                  PIN <?php echo $rs[pincode]; ?></td>
							      <td align="right"><center>
							        <strong>Date of Bill:&nbsp;</strong>
							        </center></td>
							      <td>&nbsp;<?php echo $rs[purchase_date]; ?></td>
						        </tr>
							    <tr>
							      <th scope="row" align="right"><strong>Contact Number:&nbsp;</strong></th>
							      <td><?php echo $rs[customer_contact_number]; ?></td>
							      <td>&nbsp;</td>
							      <td>&nbsp;</td>
						        </tr>
						      </tbody>
						  </table>
							<p>&nbsp;</p>
                          
						<header>
						  <h2>Order Details</h2>
						  </header>
<table width="755" border="0" class="tftable">
  <tbody>
    <tr>
      <th><strong>&nbsp;Image</strong></th>
      <th><strong>&nbsp;Product detail</strong></th>
      <th><strong>&nbsp;Product Cost</strong></th>
      <th><strong>&nbsp;Quantity</strong></th>
      <th><strong>&nbsp;Total</strong></th>
    </tr>
      <?php
	  		$i=1;
			$tot=0;
			  $sql = "SELECT * FROM product_purchase_record where product_purchase_bill_id='$_GET[billid]'";
			  $qsql = mysqli_query($con,$sql);
			  while($rs = mysqli_fetch_array($qsql))
			  {
			   	$sql1 = "SELECT * FROM selling_product WHERE selling_prod_id='$rs[selling_prod_id]'";
				  $qsql1 = mysqli_query($con,$sql1);
				  $rs1 = mysqli_fetch_array($qsql1);
			  echo "
					<tr>
					<td>&nbsp;<img src='imgsellingproduct/$rs1[product_img1]' width='25' height='25'></td>
					  <td>&nbsp;$rs1[product_description]</td>
					  <td>&nbsp;$rupeesymbol $rs[cost]</td>
					  <td>&nbsp;$rs[quantity]&nbsp;$rs1[quantity_type]</td>
					  <td>&nbsp;<span id='calccost$i'> $rupeesymbol " . $rs[cost] * $rs[quantity] ."</span></td>					  
					</tr>";
					$i++;
					$tot = $tot + ( $rs[cost] * $rs[quantity] );
			 }
	  ?>
    <tr>
      <th height="33" scope="row">&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Grand total</strong></th>
      <th>&nbsp; <?php echo $rupeesymbol; ?> <?php echo $tot; ?></th>
    </tr>
  </tbody>
</table>

					     
				          <p>&nbsp;</p>
				          <form method="post" action="" name="frmcstdetail" onSubmit="return validatecstdetail()">

<table width="755" border="0">
  <tbody>
    <tr>
      <th scope="row"><div align="right"></div></th>
      <td width="153">
       <button onclick="myFunction()" autofocus>Print Bill</button>
   </td>
    </tr>
  </tbody>
</table>
</form>
</p>
						</section>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php");?>
<script>
function myFunction() {
    window.print();
}
</script>