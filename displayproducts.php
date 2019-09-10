<?php
include("header.php");
include("dbconnection.php");
?>
		<div id="featured">
			<div class="container">
				<div class="row">

<?php
$sql = "SELECT * FROM selling_product WHERE status='Active'";
  $qsql = mysqli_query($con,$sql);
  while($rs = mysqli_fetch_array($qsql))
  {
?>
    <div class="3u" >
        <section>
            <a href="displayproductsdetailed.php?productid=<?php echo $rs[0]; ?>" class="image full"><img src='imgsellingproduct/<?php echo $rs[product_img1]; ?>'  height="243" width="282" alt=""></a>
            <header>
                <h2><?php echo $rs[product_name]; ?></h2>
                
                <p><strong>Cost :  <?php echo $rupeesymbol; ?>  <?php echo $rs[cost]; ?> per <?php echo $rs[quantity_type]; ?></strong></p>	
                <p><a href="displayproductsdetailed.php?productid=<?php echo $rs[0]; ?>">View Product detail</a></p>	
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