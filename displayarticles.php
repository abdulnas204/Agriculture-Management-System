<?php 
include("header.php");
include("dbconnection.php");
?>


	

		<div id="featured">
			<div class="container">
				<div class="row">
				<?php include("leftsidebar.php");
?>
			
										
				  <div class='9u'>
                  <h2><?php echo $_GET[articletype]; ?></h2>
                              <?php
							  $sql = "SELECT * FROM article WHERE article_type='$_GET[articletype]' order by article_id desc  ";
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								echo "<section><header style='height:150px;'><a href='displayarticlesdetailed.php?articleid=$rs[article_id]'><img src='imgarticle/$rs[article_img1]' align='left' width='250' height='150' style='padding-right: 10px;'></a>
								<h2><a href='displayarticlesdetailed.php?articleid=$rs[article_id]'>$rs[title]</a></h2><strong>Published on $rs[publish_date]</strong><br>
								<p> ";
								echo substr($rs[article_description], 0, 270).".......";
								echo "</p></header></section><hr>";
							  }
							  ?>
								
						</div>
						
					
				</div>
			</div>
		</div>
	<?php include("footer.php");?>