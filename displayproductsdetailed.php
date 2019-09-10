<?php
session_start();
include("header.php");
include("dbconnection.php");
?>
<div id="featured">
			<div class="container">
				<div class="row">
					<div class="9u">
                    
<?php
$sql = "SELECT * FROM selling_product WHERE selling_prod_id='$_GET[productid]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);
?>
						<section>
							<header>
								<h2><?php echo $rs[product_name]; ?></h2>
							</header>
                            
<?php
include("productslider.php");
?>
<section>
     <p><strong style="font-size:14px;">Cost :  <?php echo $rupeesymbol; ?><?php echo $rs[cost]; ?></strong> <strong></strong></p>
</section>
<section>
    <header>
    <?php
	if(isset($_SESSION[customerid]) || isset($_SESSION[sellerid]))
	{
	?>
        <h2><a href='displaycart.php?prodid=<?php echo $rs[0]; ?>&prodcost=<?php echo $rs[cost]; ?>'>Add to Cart</a></h2>
     <?php
	}
	else
	{
	?>
<h2><a href='customerloginpanel.php?pagename=<?php echo basename($_SERVER['PHP_SELF']); ?>&productid=<?php echo $_GET[productid]; ?>'>Login to Customer panel</a></h2>
        <hr>
<h2><a href='sellerloginpanel.php?pagename=<?php echo basename($_SERVER['PHP_SELF']); ?>&productid=<?php echo $_GET[productid]; ?>'>Login to Seller panel</a></h2><hr>
    <?php
	}
	?>
    </header>
</section>
                           
							<p><?php echo $rs[product_description]; ?></p>
							
						</section>
					</div>
				<div class="3u" >
   
						
						
					</div>		
				</div>
			</div>
		</div>

	
<?php include("footer.php");?>
		