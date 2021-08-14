<?php
require_once 'dbconfig.php';

	if(isset($_POST['add'])) {
	$pid = $_POST['pid'];
	$pn = $_POST['pn'];
	$pc = $_POST['pc'];
	$pq = $_POST['pq'];
	$poff = $_POST['poff'];
	$pdpt = $_POST['pdpt'];
	
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
		$stmt = $DB_con->prepare('INSERT INTO products(pid,pname,pcost,pqty,poffer,pdept) VALUES(:a, :b, :c, :d, :e, :f)');
			$stmt->bindParam(':a',$pid);
			$stmt->bindParam(':b',$pn);
			$stmt->bindParam(':c',$pc);
			$stmt->bindParam(':d',$pq);	
			$stmt->bindParam(':e',$poff);
			$stmt->bindParam(':f',$pdpt);		
			
			if($stmt->execute())
			{
				$errMSG = "Your Product Details Are Added To Stock";
				header("refresh:1;education_add.php"); 
			}
			else
			{
				$errMSG = "Unable To Add Product Details";
			}
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: education_add.php"); /* Redirect browser */
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
				<div id="navigation">
					<ul>
						<li class="selected">
							<a href="education_add.php"> Add </a>
						</li>

						<li>
							<a href="education_view.php">View & delete</a>
						</li>

						<li>
							<a href="index.html"> Logout </a>
						</li>
					
					</ul>
				</div>
			</div>
			<div id="contents">		
					

						<div class="body">
							<h1 style="margin-left: 150px">Add Product Details</h1>
							<form method="post" style="float: left;	color: #5a4535;	height: 300px; width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;">
								
									<?php
									if(isset($errMSG)){
											?>
											<div class="alert alert-danger">
												<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
											</div>
											<?php
									}
									?> 
								
								<table style="border-collapse: collapse;margin-left:60px">
																		
										<tr style="height: 50px;">											
											<td>Product ID:</td>
											<td><input type="text" value="" name="pid" class="txtfield"></td>
										</tr> 
		
										
										<tr style="height: 50px;">											
											<td>Product Name:</td>
											<td><input type="text" value="" name="pn" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">
											<td>Product Cost:</td>
											<td><input type="type" value="" name="pc" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Quantity:</td>
											<td><input type="text" value="" name="pq" class="txtfield"></td>
										</tr> 

										<tr style="height: 50px;">											
											<td>Offer:</td>
											<td><input type="text" value="" name="poff" class="txtfield" ></td>
										</tr>

										<tr style="height: 50px;">											
											<td>Department:</td>
											<td><input type="text" value="education" name="pdpt" class="txtfield" ></td>
										</tr>

										<tr style="height: 50px;">
											
											<td colspan=2>
											<input type="submit" name="add" value="Add" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
											<input type="submit" name="clear" value="Clear" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;">
											</td>
											
										</tr>
									
								</table>
							</form>

						</div>
					
				
			</div>
		</div>
		<div id="footer">
			
			<p>
				© 2020 by Product Sales Management System. All Rights Reserved
			</p>
		</div>
	</div>
</body>
</html>