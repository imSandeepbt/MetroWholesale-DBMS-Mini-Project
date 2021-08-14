<?php
require_once 'dbconfig.php';

$bill_no = 0;
$given_bno = $bill_no;
$total_products = 0;
$total_bill = 0;
$given_bno = "";
$given_cid = "";
$given_pid = "";
$given_qty = "";
$given_pcost = "";

$generated = "NO";
	
	if(!isset($_GET['continue']) || !isset($_GET['get_cost'])) {
		$stmt = $DB_con->prepare('SELECT * FROM billing');
		$stmt->execute();	
		if($stmt->rowCount() > 0) {
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
				if($row['billno']>$bill_no) {
					$bill_no = $row['billno'];
				}
			}
		}
		$bill_no++;
		$given_bno = $bill_no;
	}
	
	if(isset($_GET['continue'])) {
		$given_bno = $_GET['continue'];
		$given_cid = $_GET['customer']; 
		
			$main_total = 0;
			$stmt1 = $DB_con->prepare('SELECT * FROM billing');
			$stmt1->execute();	
			if($stmt1->rowCount() > 0) {
				while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
					if($row1['billno']==$given_bno) {
						$main_total = $row1['total'];						
						$total_products++;
						$total_bill = $main_total;
					}		
				}
			}
	}
	


	if(isset($_GET['get_cost'])) {
		//$errMSG = "get gc"; bno=1&customer=1&product=1&qty=12
		$given_bno = $_GET['bno'];
		$given_cid = $_GET['customer'];
		$given_pid = $_GET['product'];
		$given_qty = $_GET['qty'];	
		
		$cost_received = "yes";
		
		$stmt1 = $DB_con->prepare('SELECT * FROM products');
			$stmt1->execute();	
			if($stmt1->rowCount() > 0) {
				while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
					if($row1['pid']==$given_pid) {
					$given_pcost = $row1['pcost'];
					}
				}
			}
			
			$given_pcost = $given_pcost*$given_qty;		

					$main_total = 0;
			$stmt1 = $DB_con->prepare('SELECT * FROM billing');
			$stmt1->execute();	
			if($stmt1->rowCount() > 0) {
				while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
					if($row1['billno']==$given_bno) {
						$main_total = $row1['total'];						
						$total_products++;
						$total_bill = $main_total;
					}		
				}
			}
	}

	if(isset($_POST['add'])) {
		$bill_no 	= $_POST['bno'];
		$cid		= $_POST['cid'];	
		$pid 		= $_POST['pid'];		
		$pc 		= $_POST['pc'];
		$pq 		= $_POST['pq'];
		
		if($pid=="" || !is_numeric ($pid)) {
			$errMSG = "Please Enter Valid Product ID";
		}
		else if($bill_no =="" || !is_numeric ($pc)) {
			$errMSG = "Please Enter Valid Bill Number";
		}	
		else if($cid=="" || !is_numeric ($cid)) {
			$errMSG = "Please Enter Valid Customer ID";
		}	
		else if($pc=="" || !is_numeric ($pc)) {
			$errMSG = "Please Enter Valid Product Cost";
		}	
		else if($pq=="" || !is_numeric ($pq)) {
			$errMSG = "Please Enter Valid Quantity Value";
		}
		else {
			$main_total = $pc;
			$stmt1 = $DB_con->prepare('SELECT * FROM billing');
			$stmt1->execute();	
			if($stmt1->rowCount() > 0) {
				while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
					if($row1['billno']==$bill_no && $row1['cid']==$cid) {
						$main_total = $main_total+$row1['cost'];						
						$total_products++;
						$total_bill = $main_total;
					}		
				}
			}
			
			try {
				$sta = "pending";
				$stmt = $DB_con->prepare('INSERT INTO billing(cid,pid,sold_qty,cost,total,billno,status) VALUES(:a, :b, :c, :d, :e, :f, :g)');
				$stmt->bindParam(':a',$cid);
				$stmt->bindParam(':b',$pid);				
				$stmt->bindParam(':c',$pq);
				$stmt->bindParam(':d',$pc);
				$stmt->bindParam(':e',$main_total);		
				$stmt->bindParam(':f',$bill_no);
				$stmt->bindParam(':g',$sta);
				
				if($stmt->execute())
				{
					$errMSG = "Product Added Into Cart";
					header("Location: billing.php?continue=$bill_no&customer=$cid"); /* Redirect browser */
				}
				else
				{
					$errMSG = "Unable To Add Product To Cart";
				}
			}
			catch(Exception $e) {
				echo "err: ".$e."   ".$e->getMessage();
			}
		}
	}
	
	if(isset($_POST['generate'])) {
			$bill_no 	= $_POST['bno'];
			$cid		= $_POST['cid'];
			
			
			$main_total = 0;
			$stmt1 = $DB_con->prepare('SELECT * FROM billing');
			$stmt1->execute();	
			if($stmt1->rowCount() > 0) {
				while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
					if($row1['billno']==$given_bno) {
						$main_total = $row1['total'];						
						$total_products++;
						$total_bill = $main_total;
					}		
				}
			}
			
			
			$state = "closed";
			$stmt = $DB_con->prepare('UPDATE billing SET status=:sta WHERE billno=:bno');
			$stmt->bindParam(':sta',$state);
			$stmt->bindParam(':bno',$bill_no);
						
			if($stmt->execute()){
				$errMSG = "Thanks For Visiting Us. Your Bill Number: ".$bill_no." And Your Bill Amount: ".$total_bill." Rupees";
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
			
			$given_cid = "";
			
					$stmt = $DB_con->prepare('SELECT * FROM billing');
					$stmt->execute();	
					if($stmt->rowCount() > 0) {
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
							if($row['billno']>$bill_no) {
								$bill_no = $row['billno'];
							}
						}
					}
					$bill_no++;
					$given_bno = $bill_no;
			
			//header("Location: billing.php?closed=yes&bill_no=$bill_no"); /* Redirect browser */
		
	}

	
	if(isset($_POST['clear'])) {
		$given_pid = "";
		$given_qty = "";
		$given_pcost = "";
		header("Location: billing.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Billing Section</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">

	<script>
	
		function get_cost1() {
			var product = document.bill.pid.value;
			document.bill.pq.value = "";
			document.bill.pc.value = "";
			//alert('product:'+product);
		}
		function get_cost() {
			var bno     = document.bill.bno.value;
			var customer = document.bill.cid.value;
			var product = document.bill.pid.value;
			var qty		= document.bill.pq.value;
			
			if(customer=="" || product=="") {
				if(customer=="" && product!="") {
					alert("Enter Customer Id");
				}
				else if(customer!="" && product=="") {					
					alert("Enter Product Id");
				}
				else {
					alert("Enter Customer Id & Product Id");
				}
			}			
			else {
			//alert(bno+' '+customer+' '+product+' '+qty);
			var url = "billing.php?get_cost=individual_cost&bno="+bno+"&customer="+customer+"&product="+product+"&qty="+qty;
			window.location.replace(url);
			}
		}
	</script>	
	</head>
<body>
	<div id="background">
		<div id="page">
			<div id="header">
				<div id="logo">
					<a href="index.html"><img src="images/ni1.png" alt="LOGO" height="112" width="118"></a>
				</div>
				<div id="navigation">
					<ul>
						<li class="selected">
							<a href="billing.php">Bill </a>
						</li>						
						<li>
							<a href="index.html">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="contents">		
					

						<div class="body">
							<h1 style="margin-left: 150px">Add To Cart</h1>
							<form method="post" name="bill" style="float: left;	color: #5a4535;	height: auto; width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;">
								
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
											<td>Bill No:</td>
											<td><input type="text" value="<?php echo $given_bno;?>" name="bno" class="txtfield" readonly></td>
										</tr> 	

										<tr style="height: 50px;">											
											<td>Customer ID:</td>
											<td><input type="text" value="<?php if($given_cid!="") { echo $given_cid; }?>" name="cid" class="txtfield" <?php if($given_cid!="") {?> readonly <?php } ?>></td>
										</tr> 	
																		
										<tr style="height: 50px;">											
											<td>Product ID:</td>
											<td><input type="text" value="<?php if($given_pid!="") { echo $given_pid; }?>" name="pid" class="txtfield" onchange="get_cost1()"></td>
										</tr> 		

										<tr style="height: 50px;">											
											<td>Quantity:</td>
											<td><input type="text" value="<?php if($given_qty!="") { echo $given_qty; }?>" name="pq" class="txtfield" onchange="get_cost()"></td>
										</tr> 
										
										<tr style="height: 50px;">
											<td>Product Cost:</td>
											<td><input type="type" value="<?php if($given_pcost!="") { echo $given_pcost; }?>"  <?php if($given_pcost!="") { ?> autofocus <?php } ?> name="pc" class="txtfield" readonly></td>
										</tr> 
										

										
										<tr style="height: 50px;">
											
											<td colspan=2>
											<input type="submit" name="add" value="Add" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
											<input type="submit" name="clear" value="Close" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;">
											</td>
											
										</tr>
										
										<tr style="height: 50px;">
											<td><b>Total Products: <?php echo $total_products;?></b></td>
											<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Cost: <?php echo $total_bill;?></b></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td colspan=2>
											<input type="submit" name="generate" value="Generate Bill" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 240px;border: 0;padding: 0;margin: 0;color:white;">
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