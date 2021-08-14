<?php
require_once 'dbconfig.php';

	if(isset($_POST['add'])) {
	$eid = $_POST['eid'];
	$en = $_POST['en'];
	$emno = $_POST['emno'];
	$edpt = $_POST['edpt'];
	
	if($eid=="" || !is_numeric ($eid)) {
		$errMSG = "Please Enter Valid Employee ID";
	}
	else if($en=="") {
		$errMSG = "Please Enter Valid Employee Name";
	}
	
	else if($emno=="" || !is_numeric ($emno)) {
		$errMSG = "Please Enter Valid Mobile Number";
	}
	else if(strlen($emno)>10 || strlen($emno)<10) {
		$errMSG = "Mobile Number Should Be 10 Digits";
	}
	else if($edpt=="") {
		$errMSG = "Please Enter Valid Employee Department";
	}
	else {
		$stmt = $DB_con->prepare('INSERT INTO employees(eid,ename,emno,edept) VALUES(:a, :b, :c, :d)');
			$stmt->bindParam(':a',$eid);
			$stmt->bindParam(':b',$en);
			$stmt->bindParam(':c',$emno);
			$stmt->bindParam(':d',$edpt);
			
			
			if($stmt->execute())
			{
				$errMSG = "Employee Details Are Added";
				header("refresh:1;employees_add.php"); 
			}
			else
			{
				$errMSG = "Unable To Add Employee Details";
			}
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: employees_add.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add employee</title>
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
							<a href="employees_add.php"> Add </a>
						</li>

						<li>
							<a href="employees_view.php">View & delete</a>
						</li>

						<li>
							<a href="index.html">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="contents">		
					

						<div class="body">
							<h1 style="margin-left: 150px">Add Employee Details</h1>
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
											<td>Employee ID:</td>
											<td><input type="text" value="" name="eid" class="txtfield"></td>
										</tr> 		
										
										<tr style="height: 50px;">											
											<td>Employee Name:</td>
											<td><input type="text" value="" name="en" class="txtfield"></td>
										</tr> 
										
																				
										<tr style="height: 50px;">											
											<td>Mobile No:</td>
											<td><input type="text" value="" name="emno" class="txtfield"></td>
										</tr> 

										<tr style="height: 50px;">											
											<td>Employee Department:</td>
											<td><input type="text" value="" name="edpt" class="txtfield"></td>
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