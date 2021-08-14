<?php
require_once 'dbconfig.php';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Product Analysis</title>
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
							<a href="billing.php">Bill </a>
						</li>
						<li class="selected">
							<a href="product_analysis.php">Analysis </a>
						</li>
						<li>
							<a href="index.html">Logout</a>
						</li>

					</ul>
				</div>
			</div>
			<div id="contents">
				<div class="box">
					<div>
						<div class="body">
							<h1>Sales Analysis</h1>
							<ul id="rooms">
							<?php
							
							$maximum_soldout_product_id 		= "";
							$maximum_soldout_product_name 		= "";
							$maximum_soldout_product_qty 		= 0;
							$maximum_soldout_product_customers 	= 0;
							$totally_sold_out					= 0;
							
							$stmt = $DB_con->prepare('SELECT * FROM billing');
							$stmt->execute();	
							if($stmt->rowCount() > 0) {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
								extract($row);
								if($row['sold_qty']>$maximum_soldout_product_qty) {
										$maximum_soldout_product_id 		= $row['pid'];										
										$maximum_soldout_product_qty 		= $row['sold_qty'];										
								}
								}
								
							}
							
							
							$stmt1 = $DB_con->prepare('SELECT * FROM products');
							$stmt1->execute();	
							if($stmt1->rowCount() > 0) {
								while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
								extract($row1);

									if($row1['pid']==$maximum_soldout_product_id) {
										$maximum_soldout_product_name = $row1['pname'];
									}
								}
							}
							
							$stmt = $DB_con->prepare('SELECT * FROM billing');
							$stmt->execute();	
							if($stmt->rowCount() > 0) {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
								extract($row);
								if($row['pid']==$maximum_soldout_product_id) {
										$totally_sold_out = $totally_sold_out+$row['sold_qty'];
										$maximum_soldout_product_customers++;								
								}
								}
								
							}
							
							?>
								<li>
									<img src="images/ni6.png" alt="Img" height="287" width="287">									
									
									<h3> Product ID:  <?php echo $maximum_soldout_product_id ; ?></h3>
									
									<h3> Name:  <?php echo $maximum_soldout_product_name; ?></h3>
									
									<h3> Total Customers Bought This Product: <?php echo $maximum_soldout_product_customers;?></h3>
									
									<h3> Total Sold Out: <?php echo $totally_sold_out;?></h3>
									
									<h3> Highest Number Of Pieces Bought By A Customer: <?php echo $maximum_soldout_product_qty;?></h3>
									
								</li>
							
							
							</ul>
						</div>
					</div>
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