<?php
	if(isset($_POST['login'])) {
	
	$un = $_POST['un'];
	$pwd = $_POST['pwd'];
	
	if($un=="") {
		$errMSG = "Please Enter Valid User Name";
	}
	else if($pwd=="") {
		$errMSG = "Please Enter Valid Password";
	}	
	else if($un=="" && $pwd=="") {
		$errMSG = "Please Enter Valid User Name & Password";
	}
	else if($un=="admin" && $pwd=="admin") {
		$errMSG = "please login for billing ";
	}
	else {
		 if($un=="billing" || $pwd=="billing") {
			header("Location: billing.php"); /* Redirect browser */
			exit();
		}
		else {
			$errMSG = "Invalid User Credentials";
		}
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: login.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Contact - Dolphin Template</title>
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
						<li>
							<a href="index.html">Home</a>
						</li>

						
						<li>
							<a href="loginadmin.php">Admin Login</a>
						</li>

						<li class="selected">
							<a href="loginbilling.php">Billing Login</a>
						</li>
						<li >
							<a href="loginmanager.php">manager</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="contents">		
					

						<div class="body">
							<h1 style="margin-left: 150px">Sign In For Billing</h1>
							<form method="post" style="float: left;	color: black;	height: 200px; width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;">
								
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
											
											<td>User Name:</td>
											<td><input type="text" value="" name="un" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">
											<td>Password:</td>
											<td><input type="password" value="" name="pwd" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">
											
											<td colspan=2>
											<input type="submit" name="login" value="Log in" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
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