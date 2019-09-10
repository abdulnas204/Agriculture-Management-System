<?php
include("dbconnection.php");

	$sql = "UPDATE product_purchase_record SET quantity='$_GET[totqty]' WHERE purchase_record_id='$_GET[purchaseid]'";
	$qsql = mysqli_query($con,$sql);

	$sql = "SELECT * FROM product_purchase_record WHERE purchase_record_id='$_GET[purchaseid]'";
	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
	echo $rs[cost] * $rs[quantity]
?>