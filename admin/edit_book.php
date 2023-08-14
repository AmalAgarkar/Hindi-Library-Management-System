<?php include 'protect.php'?>
<?php
	#fetch data from database
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
	include "../asset/dbconnect.php";
	$ac_no = "";
	$book_name = "";
	$author = "";
	$publisher = "";
	$category = "";
	$purchase_year = "";
	$book_price = "";
	$query = "select * from books where ac_no = '$_GET[an]'";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$ac_no = $row['ac_no'];
		$book_name = $row['book_name'];
		$author = $row['author'];
		$publisher = $row['publisher'];
		$category = $row['category'];
		$purchase_year = $row['purchase_year'];
		$book_price = $row['book_price'];
	}
?>


<!DOCTYPE html>
<html>

<head>
	<title>डैशबोर्ड</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.css">
  	<script type="text/javascript" src="../bootstrap4/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap4/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
	#main_content{
		padding: 50px;
		background-color: #d9e2ff;
		border-radius: 15px;
	}
</style>

<body>
	<!-- Navigation Bar 1 -->
	<nav class="navbar navbar-expand-lg navbar-dark font-weight-bold" style="background-color:#101a32">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php"><i class="fas fa-house"></i>&nbsp;&nbsp;हिंदी पुस्तकालय प्रबंधन प्रणाली</a>
			</div>
			<div class="text-white"><span>स्वागत है <?php echo $_SESSION['name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">मेरी प्रोफाइल </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="view_profile.php">प्रोफ़ाइल देखें</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="edit_profile.php">एडिट प्रोफ़ाइल</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">पासवर्ड बदलें</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">लॉग आउट</a>
		      </li>
		    </ul>
		</div>
	</nav>


	<!-- Edit book form -->
	<div class="row d-flex justify-content-center my-5">
		<div class="col-md-4" id="main_content">
			<div class="text-center"><h3>पुस्तक एडिट करें</h3><br></div>
			<form action="" method="post">
				<div class="form-group">
					<label for="ac_no">एक्सेशन संख्या</label>
					<input type="text" name="ac_no" id="ac_no" value="<?php echo $ac_no;?>" class="form-control" disabled required>
				</div>
				<div class="form-group">
					<label for="book_name">पुस्तक का नाम</label>
					<input type="text" name="book_name" id="book_name" value="<?php echo $book_name;?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="author">लेखक</label>
					<input type="text" name="author" id="author" value="<?php echo $author;?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="publisher">प्रकाशक</label>
					<input type="text" name="publisher" id="publisher" value="<?php echo $publisher;?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="category">वर्ग</label>
					<input type="text" name="category" id="category" value="<?php echo $category;?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="purchase_year">खरीद वर्ष</label>
					<input type="text" name="purchase_year" id="purchase_year" value="<?php echo $purchase_year;?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="book_price">पुस्तक मूल्य</label>
					<input type="text" name="book_price" id="book_price" value="<?php echo $book_price;?>" class="form-control">
				</div><br>
				<div class="text-center">
					<button type="submit" name="update_book" class="btn btn-primary">पुस्तक अपडेट करें</button>
				</div>
			</form>
		</div>
	</div>

</body>
</html>


<!-- Post updated details -->
<?php
	if(isset($_POST['update_book'])){
		// $connection = mysqli_connect("localhost","root","");
		// mysqli_query($connection,'SET NAMES UTF8');
		// $db = mysqli_select_db($connection,"lms");
		include "../asset/dbconnect.php";
		$intPurchaseYear = $_POST["purchase_year"];
		$intPurchaseYear = !empty($intPurchaseYear) ? "'$intPurchaseYear'" : "NULL";
		$intBookPrice = $_POST["book_price"];
		$intBookPrice = !empty($intBookPrice) ? "'$intBookPrice'" : "NULL";
		$query = "update books set book_name = '$_POST[book_name]',author = '$_POST[author]',publisher = '$_POST[publisher]',category = '$_POST[category]',purchase_year = $intPurchaseYear,book_price = $intBookPrice where ac_no = '$_GET[an]'";
		$query_run = mysqli_query($connection,$query);
		header("location:manage_book.php");
	}
?>