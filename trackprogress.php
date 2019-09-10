<?php
session_start();
echo $_SESSION[sellerid];
include("dbconnection.php");
if(!isset($_SESSION[sellerid]))
{
	echo "<script>window.location='sellerloginpanel.php';</script>";
}
include("header.php");
if(isset($_SESSION[sellerid]))
{
	$sql = "SELECT * FROM seller WHERE seller_id='$_SESSION[sellerid]'";
	$qsql = mysqli_query($con,$sql);
	$rsdisp = mysqli_fetch_array($qsql);
}
?>

		

		<div id="featured">
			<div class="container">
				<div class="row">
				<?php include("leftsidebar.php");?>
			
					
					<div class="9u">
						<section>
								<header>
								<h2>Keep Track of Your Progress...</h2>
							</header>
<?php
include("areachart.php");
?>                            
                            	</section>
					</div>
				</div>
			</div>
		</div>
	<?php include("footer.php");?>