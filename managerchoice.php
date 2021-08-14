<?php
require_once 'dbconfig.php';

	if(isset($_POST['add'])) {
	$pid = $_POST['pid'];
	$pn = $_POST['pn'];
	$pc = $_POST['pc'];
	$pq = $_POST['pq'];
	
	if($pid=="" || !is_numeric ($pid)) {
		$errMSG = "Please Enter Valid Product ID";
	}
	else if($pn=="") {
		$errMSG = "Please Enter Valid Product Name";
	}
	else if($pc=="" || !is_numeric ($pc)) {
		$errMSG = "Please Enter Valid Product Cost";
	}	
	else if($pq=="" || !is_numeric ($pq)) {
		$errMSG = "Please Enter Valid Quantity Value";
	}
	else {
		$stmt = $DB_con->prepare('INSERT INTO products(pid,pname,pcost,pqty) VALUES(:a, :b, :c, :d)');
			$stmt->bindParam(':a',$pid);
			$stmt->bindParam(':b',$pn);
			$stmt->bindParam(':c',$pc);
			$stmt->bindParam(':d',$pq);		
			
			if($stmt->execute())
			{
				$errMSG = "Your Product Details Are Added To Stock";
				header("refresh:1;product_add.php"); 
			}
			else
			{
				$errMSG = "Unable To Add Product Details";
			}
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: product_add.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Products</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="background">
		<div id="page">
			<div id="header">
				<div id="logo">
					<a href="index.html"><img src="images/metrologo.png" alt="LOGO" height="112" width="250"></a>
				</div>
				<br>
				<div id="navigation">
					<ul>
						<li>
							<a href="producttable_view.php">Products</a>
						</li>

						<li >
							<a href="customerstable_view.php">Customers</a>
						</li>
						<li>
							<a href="employeestable_view.php">Employee</a>
						</li>
						<li>
							<a href="Billingtable_view.php">Billing</a>
						</li>
						<li>
							<a href="product_analysis.php">analysis</a>
						</li>

						
						<li>
							<a href="index.html">Logout</a>
						</li>
					
					</ul>
				</div>
			</div>
         <br>
         <br>
         <br>
         <br>

		</div>
		<div id="footer">
			
			<p>
				© 2020 by Product Sales Management System. All Rights Reserved
			</p>
		</div>
	</div>
</body>
</html>