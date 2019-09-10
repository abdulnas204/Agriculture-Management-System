<?php
session_start();
include("dbconnection.php");
$loopcount = 0;
							  $sql = "SELECT * FROM product";
							  if(isset($_SESSION[sellerid]))
							  {
								  $sql = $sql . " WHERE seller_id='$_SESSION[sellerid]'";
							  }
							  $qsql = mysqli_query($con,$sql);
							  while($rs = mysqli_fetch_array($qsql))
							  {
								   $sql1 = "SELECT * FROM category WHERE category_id='$rs[category_id]'";
								  $qsql1 = mysqli_query($con,$sql1);
								  $rs1 = mysqli_fetch_array($qsql1);
								  
								   $sql2 = "SELECT * FROM produce WHERE produce_id='$rs[produce_id]'";
								  $qsql2 = mysqli_query($con,$sql2);
								  $rs2= mysqli_fetch_array($qsql2);
								  
								   $sql3 = "SELECT * FROM variety WHERE variety_id='$rs[variety_id]'";
								  $qsql3 = mysqli_query($con,$sql3);
								  $rs3 = mysqli_fetch_array($qsql3);
								  
							 		$producetitle[$loopcount] =  $rs[title];								
//Oct
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '2015-10-01' AND '2015-10-31' AND purchase_order.product_id='$rs[product_id]' ";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $rspurchase_order_bill[0] . ",";

//Nov
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '2015-11-01' AND '2015-11-30' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Dec
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '2015-12-01' AND '2015-01-31' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Jan
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '2016-01-01' AND '2016-01-31' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Feb
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '2016-02-01' AND '2016-02-29' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Mar
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '2016-03-01' AND '2016-03-31' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] . ",";
//Apr
$sqlpurchase_order_bill = "SELECT IFNULL(sum(purchase_order.purchase_amt),0) FROM purchase_order_bill INNER JOIN purchase_order ON purchase_order_bill.purchase_order_id=purchase_order.purchase_order_id WHERE purchase_order_bill.paid_date BETWEEN '2016-04-01' AND '2016-04-30' AND purchase_order.product_id='$rs[product_id]'";
$qsqlpurchase_order_bill = mysqli_query($con,$sqlpurchase_order_bill);
$rspurchase_order_bill = mysqli_fetch_array($qsqlpurchase_order_bill);
$profit[$loopcount] = $profit[$loopcount] . $rspurchase_order_bill[0] ;
$loopcount = $loopcount +1;
							  }								  	  
$prolist = 0;							  
foreach($producetitle as $val)
{					
  
	$productwise =  $productwise .  "{
            name: '$val',
            data: [$profit[$prolist]]
      },
		";							
	$prolist = $prolist + 1;		  
}
//echo $productwise;
?>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Farm Produce Sales Representation'
        },
        subtitle: {
            text: 'Monthly sales chart'
        },
        xAxis: {
            categories: ['October 2015','November 2015','December 2015','January 2016', 'February 2016', 'March 2016', 'April 2016', 'May 2016', 'June 2016', 'July 2016'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Rupees'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' Rupees'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [
		<?php
		echo $productwise;
		?>
		]
    });
});
		</script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


