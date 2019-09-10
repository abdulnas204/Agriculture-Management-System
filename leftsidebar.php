<?php
session_start();
?>
<link rel="stylesheet" href="cssmenu/css/style.css">
<?php
if(isset($_SESSION[adminid]))
{
?>


<div class="3u">
						<section>
							<header class="menu-item">
  								<h2>Admin Menu</h2>
                                <h3><a href="adminpanel.php">Dashboard</a></h3>
                                <h3><a href="viewcustomerReg.php">View Customers</a></h3>
                                <h3><a href="viewadminpurchasereport.php"> View Product Billing Report</a></h3>
                                <h3><a href="viewadminpurchaserequest.php">View Produce Purchase Request</a></h3>
               					<h3><a href="viewpurchasereport.php">View Produce Billing Report</a></h3>
                                <h3><a href="logout.php">Logout</a></h3>                     
							</header>
						</section>
                        
						<section>
							<header class="menu-item">
								<h2>Farmer Menu</h2>                                   
                                <h3><a href="category.php?cattype=Produce">Add Produce category</a></h3>
                                <h3><a href="viewcategory.php?cattype=Produce">View Produce category</a></h3>   
                                <h3><a href="Produce.php">Add Produce types</a></h3>
                                <h3><a href="viewProduce.php">View Produce types</a></h3>       
								<h3><a href="variety.php?varietytype=Produce">Add Produce Variety</a></h3>
                                <h3><a href="viewvariety.php?varietytype=Produce">View Produce Variety</a></h3>    
                                <h3><a href="sellingproduce.php"> Add Farm Produce</a></h3>
                                <h3><a href="viewSellingProduce.php">View Farm Produce</a></h3>      
								<h3><a href="viewseller.php"> View Farmers</a></h3>
							</header>
						</section>
                    
                       <section>
						  	<header class="menu-item">
								<h2>Worker Menu</h2>
                                   <h3><a href="viewworker.php">View Worker</a></h3>
                                   <h3><a href="viewworkerrequest.php">View Worker Request</a></h3>
                        	</header>
						</section>    
                        
                                                
						<section>
							<header class="menu-item">
								<h2>Farmer's Kit</h2>
                                <h3><a href="category.php?cattype=SellingProduct">Add Selling Product Category</a></h3>     
                                <h3><a href="viewcategory.php?cattype=SellingProduct">View Selling Product Category</a></h3>  
                                <h3><a href="sellingproduct.php">Add Selling Product Type</a></h3>
                                <h3><a href="viewsellingproduct.php">View Selling Product Type</a></h3>
							</header>
						</section>   
                        
						<section>
							<header class="menu-item">
								<h2>Articles Menu</h2>
                       			<h3><a href="article.php">Add Article</a></h3>         
                        		<h3><a href="viewarticle.php">View Article</a></h3> 
							</header>
						</section>	
                                                         
						<section>
							<header class="menu-item">
								<h2>Settings</h2>
                                <h3><a href="admin.php">Add Admin</a></h3>
                                <h3><a href="viewadmin.php">View Admin</a></h3>
                                <h3><a href="chngadminpassword.php">Change Admin Password</a></h3>
                                
                            <h3><a href="city.php">Add City</a></h3>
                            <h3><a href="viewcity.php">View City</a></h3>
                            
                          <h3><a href="state.php">Add State</a></h3>
                          <h3><a href="viewstate.php">View State</a></h3>   
                                                                
                            <h3><a href="country.php">Add Country</a></h3>
                            <h3><a href="viewcountry.php">View Country</a></h3> 
							</header>
						</section>
</div>
<?php
}
if(isset($_SESSION[sellerid]))
{
?>
<div class="3u">
            <section>
                <header class="menu-item">
             <h2>Account Settings</h2>     
            <h3><a href="sellerpanel.php">View Your Profile</a></h3>          
           	<h3><a href="sellerprofile.php">Edit Your Profile</a></h3>     
            <h3><a href="sellerpanelchart.php">Track your progress</a></h3>    
            <h3><a href="Sellerchngpassword.php">Change Your Password</a></h3>
            <h3><a href="logout.php">Logout</a></h3> 
            </header>
            </section>
            <section>
            <header class="menu-item">
            <h2>Farm Sales Details</h2>
          	<h3><a href="Product.php">Put Your Produce On Sale</a></h3>
          	<h3><a href="viewProduct.php">View Your Produce On Sale</a></h3>
          	<h3><a href="viewsellerpurchaserequest.php">View Purchase Request</a></h3>
         	<h3><a href="viewpurchaseorder.php">View Purchase Order</a></h3>
          	<h3><a href="viewpurchasereport.php">Purchase Billing Report</a></h3>
            </header>
            </section>
            <section>
            <header class="menu-item">
            <h2>Agro Products Purchase Details</h2>
            <h3><a href="viewcstpurchasereport.php">Product Purchase Report</a></h3>
            </header>
            </section>
            <section>
            <header class="menu-item">
            <h2>Hire Details</h2>
          	<h3><a href="viewworkerrequest.php">View Hired Worker</a></h3> 	                     
            </header>
            </section>
</div>
<?php
}
if(isset($_SESSION[customerid]))
{
?>
<div class="3u">
            <section>
                <header class="menu-item">
                    <h2>Account Settings</h2>
                   
                    <h3><a href="customerpanel.php">View Your Profile</a></h3>          
           <h3><a href="customerUpdate.php">Edit Your Profile</a></h3>         
            <h3><a href="Customerchngpassword.php">Change Your Password</a></h3> 
                <h3><a href="logout.php">Logout</a></h3>                     
                </header>
            </section>
            <section>
            <header class="menu-item">
            <h2>Agro Products Purchase Details</h2>
            <h3><a href="viewcstpurchasereport.php">Product Purchase Report</a></h3>
            </header>
            </section>
             <section>
                <header class="menu-item">
                    <h2>Farm Produce Purchase Details</h2>           
                <h3><a href="viewpurchaserequest.php">View Farm Produce Purchase request</a></h3>
                <h3><a href="viewcstpurchaseorder.php">View Farm Produce Purchase Order</a></h3>
                <h3><a href="viewpurchasereport.php">View Billing Report</a></h3>
                </header>
            </section>
</div> 
<?php
}
if(isset($_SESSION[workerid]))
{
?>
<div class="3u">
            <section>
                <header class="menu-item">
                    <h2>Account Settings</h2>
                   
         	<h3><a href="workerpanel.php">View Your Profile</a></h3>          
           	<h3><a href="workerprofile.php">Edit Your Profile</a></h3>         
            <h3><a href="Workerchngpassword.php">Change Your Password</a></h3> 
            <h3><a href="logout.php">Logout</a></h3>                     
                </header>
            </section>
            <section>
            <header class="menu-item">
            <h2>Check Job Requests</h2>
            <h3><a href="viewworkerrequest.php">View Your Jobs</a></h3>
            <h3><a href="workerpanel.php?workschedule=set">Work Schedule</a></h3>
            </header>
            </section>
</div> 
<?php
}
?>