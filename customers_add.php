<?php
require_once 'dbconfig.php';

	if(isset($_POST['add'])) {
	$cid = $_POST['cid'];
	$cn = $_POST['cn'];
	$mno = $_POST['mno'];
	
	
	if($cid=="" || !is_numeric ($cid)) {
		$errMSG = "Please Enter Valid Customer ID";
	}
	else if($cn=="") {
		$errMSG = "Please Enter Valid Customer Name";
	}
	
	else if($mno=="" || !is_numeric ($mno)) {
		$errMSG = "Please Enter Valid Mobile Number";
	}
	else if(strlen($mno)>10 || strlen($mno)<10) {
		$errMSG = "Mobile Number Should Be 10 Digits";
	}
	else {
		$stmt = $DB_con->prepare('INSERT INTO customers(cid,cname,mno) VALUES(:a, :b, :c)');
			$stmt->bindParam(':a',$cid);
			$stmt->bindParam(':b',$cn);
			$stmt->bindParam(':c',$mno);
			
			
			if($stmt->execute())
			{
				$errMSG = "Customer Details Are Added";
				header("refresh:1;customers_add.php"); 
			}
			else
			{
				$errMSG = "Unable To Add Customer Details";
			}
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: customers_add.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add customers</title>
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
						
						<li  class="selected">
							<a href="customers_add.php"> Add </a>
						</li>

						<li>
							<a href="customers_view.php">View & delete</a>
						</li>

						<li>
							<a href="index.html">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="contents">		
					

						<div class="body">
							<h1 style="margin-left: 150px">Add Customer Details</h1>
							<form method="post" style="float: left;	color: #5a4535;	height: auto; width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;">
								
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
											<td>Customer ID:</td>
											<td><input type="text" value="" name="cid" class="txtfield"></td>
										</tr> 		
										
										<tr style="height: 50px;">											
											<td>Customer Name:</td>
											<td><input type="text" value="" name="cn" class="txtfield"></td>
										</tr> 
										
																				
										<tr style="height: 50px;">											
											<td>Mobile No:</td>
											<td><input type="text" value="" name="mno" class="txtfield"></td>
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