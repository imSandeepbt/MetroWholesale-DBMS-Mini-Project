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
				<br>
				<br>
				<br>
				<div id="navigation">

					<ul>
						<li  class="selected">
							<a href="product_add.php">Products</a>
						</li>
						<li>
							<a href="index.html">Logout</a>
						</li>
					
					</ul>
				</div>
				<br>
				<br>
				<br>
				<br>
				<br>

           


<div id="navigation">

					<ul>
						<li>
							<a href="groceries_add.php">groceries</a>
						</li>
						<li>
							<a href="menfashion_add.php">men fashion</a>
						</li>
						<li>
							<a href="womenfashion_add.php">women fashion</a>
						</li>
						<li>
							<a href="kidsfashion_add.php">kids fashion</a>
						</li>
						<li>
							<a href="household_add.php">household</a>
						</li>
						<li>
							<a href="foodworld_add.php">food world</a>
						</li>
						<li>
							<a href="kitchenneeds_add.php">kitchen needs</a>
						</li>
					
					</ul>
				</div>
				<br>
				<br>
				<br>
				<br>
				<br>


				<div id="navigation">

					<ul>
						<li>
							<a href="babycare_add.php">babycare</a>
						</li>
						<li>
							<a href="milk_add.php"> milk & dairy</a>
						</li>
						<li>
							<a href="education_add.php">education</a>
						</li>
						<li>
							<a href="entertainment_add.php">entertainment</a>
						</li>
						<li>
							<a href="sports_add.php">sports</a>
						</li>
						<li>
							<a href="furnishing_add.php">furnishing</a>
						</li>
						<li>
							<a href="healthcare_add.php">health care</a>
						</li>
					
					</ul>
				</div>

			</div>



			


         <br>
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