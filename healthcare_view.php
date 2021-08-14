<?php
require_once 'dbconfig.php';
if(isset($_GET['delete_id']))
	{
		
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM products WHERE pid =:pid');
		$stmt_delete->bindParam(':pid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location:healthcare_view.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Product List</title>
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
							<a href="healthcare_add.php"> Add </a>
						</li>

						<li class="selected">
							<a href="healthcare_view.php">View & delete</a>
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
							<h1>Products</h1>
							<ul id="rooms">
							<?php
							$stmt = $DB_con->prepare('SELECT * FROM products where pdept="healthcare" ORDER BY pid DESC');
							$stmt->execute();	
							if($stmt->rowCount() > 0) {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
								extract($row);
							?>
								<li>
									<img src="images/originalproducts.png" alt="Img" height="287" width="287">									
									<h2><a href="#"> ID:  <?php echo $row['pid']; ?></a></h2>
									<h2><a href="#"> Name:  <?php echo $row['pname']; ?></a></h2>
									<h2><a href="#">Quantity: <?php echo $row['pqty'];?></a></h2>
									<h2><a href="#">Offer: <?php echo $row['poffer'];?></a></h2>

									<span class="rate" style="width:auto;"> &nbsp;Rate: <?php echo $row['pcost']; ?> Rs / Piece &nbsp;</span>
									<a href="?delete_id=<?php echo $row['pid']; ?>" title="click for deleting this product" onclick="return confirm('sure to delete ?')"> Delete</a>
								</li>
							<?php } } ?>
							
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