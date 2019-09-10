<?php
session_start();
?>
<link rel="canonical" href="http://www.plus2net.com/php_tutorial/cal2.php"/>
<script langauge="javascript">
function post_value(mm,dt,yy){
opener.document.f1.p_name.value = mm + "/" + dt + "/" + yy;
/// cheange the above line for different date format
self.close();
}

function reload(form){
var month_val=document.getElementById('month').value; // collect month value
var year_val=document.getElementById('year').value;      // collect year value
self.location='<?php echo basename($_SERVER['PHP_SELF']); ?>?month=' + month_val + '&year=' + year_val + "&workschedule=set"; // reload the page
}
</script>
<style type="text/css">
table.main {
  width: 100%; 
border: 1px solid black;
	background-color: #9dffff;
}
table.main td {
font-family: verdana,arial, helvetica,  sans-serif;
font-size: 11px;
}
table.main a{TEXT-DECORATION: none;}
table,td{ border: 1px solid #ffffff }

.tftable1 {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable1 th {font-size:12px;background-color:#acc8cc;border-width: 5px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable1 tr {background-color:#d4e3e5;}
.tftable1 td {font-size:12px;border-width: 5px;padding: 8px;border-style: solid;border-color: #729ea5;}
.tftable1 td:hover {background-color:#ffffff;}
</style>