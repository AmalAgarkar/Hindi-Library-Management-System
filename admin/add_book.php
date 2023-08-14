<?php include 'protect.php'?>
<?php
	require("functions.php");
	#fetch data from database
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
	include "../asset/dbconnect.php";
	$name = "";
	$admin_id = "";
	$designation = "";
	$query = "select * from admins where admin_id = '$_SESSION[admin_id]'";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$name = $row['name'];
		$admin_id = $row['admin_id'];
		$designation = $row['designation'];
	}
?>

<!DOCTYPE html>
<html>

<head>
	<title>नई पुस्तक जोड़ें</title>
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

	<!-- Navigation Bar 2 -->
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6189f6">
		<div class="container-fluid">
			
		    <ul class="nav navbar-nav navbar-center font-weight-bold">
		      <li class="nav-item mr-2">
		        <a class="nav-link" href="admin_dashboard.php">डैशबोर्ड</a>
		      </li>
		      <li class="nav-item dropdown mr-1">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">पुस्तकें </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_book.php">नई पुस्तक जोड़ें</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_book.php">पुस्तकें प्रबंधित करें</a>
	        	</div>
		      </li>

		      <li class="nav-item dropdown mr-1">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">यूज़र्स</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_user.php">नया यूज़र जोड़ें</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_user.php">यूज़र्स प्रबंधित करें</a>
	        	</div>
		      </li>
	          <li class="nav-item mr-2">
		        <a class="nav-link" href="issue_book.php">पुस्तक जारी करें</a>
		      </li>
			  <li class="nav-item">
		        <a class="nav-link" href="return_book.php">पुस्तक लौटाऐं</a>
		      </li>
		    </ul>
		</div>
	</nav>
	

	<!-- Add book form -->
	<div class="row d-flex justify-content-center my-5">
		<div class="col-md-4" id="main_content">
			<div class="text-center"><h3>नई पुस्तक जोड़ें</h3><br></div>
			<form action="" method="post" autocomplete="off">
				<div class="form-group">
					<label for="ac_no">एक्सेशन संख्या</label>
					<input type="text" name="ac_no" id= "ac_no" class="form-control" onkeyup="CheckAcno(this.value)" value="" required><div class="text-danger" id="acno_warning"></div>
				</div>
				<div class="form-group">
					<label for="book_name">पुस्तक का नाम</label>
					<input type="text" name="book_name" id= "book_name" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="author">लेखक</label>
					<input type="text" name="author" id= "author" class="form-control">
				</div>
				<div class="form-group">
					<label for="publisher">प्रकाशक</label>
					<input type="text" name="publisher" id= "publisher" class="form-control">
				</div>
				<div class="form-group">
					<label for="category">वर्ग</label>
					<input type="text" name="category" id= "category" class="form-control">
				</div>
				<div class="form-group">
					<label for="purchase_year">खरीद वर्ष</label>
					<input type="text" name="purchase_year" id= "purchase_year" class="form-control">
				</div>
				<div class="form-group">
					<label for="book_price">पुस्तक मूल्य</label>
					<input type="text" name="book_price" id= "book_price" class="form-control">
				</div><br>
				<div class="text-center">
					<button id="myBtn" type="submit" name="add_book" class="btn btn-primary">पुस्तक जोड़ें</button>
				</div>
			</form>
		</div>
	</div>


	<!-- Asynchronous call to check with accession number that book already exist or not -->
	<script>
        function CheckAcno(acno) {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
				myBook = this.responseText;

                if(myBook=="Book already exist"){
					document.getElementById("acno_warning").innerHTML = "किताब पहले से उपलब्ध है!";
					document.getElementById('myBtn').disabled = true;
				}
				else{
					document.getElementById('myBtn').disabled = false;
					document.getElementById("acno_warning").innerHTML = "";
				}
            };

            xmlhttp.open("GET", "add_book_ajax.php?acno=" + acno, true);
            xmlhttp.send();
        }
	</script>

</body>
</html>

<!-- Posting added new book information into database -->
<?php
	if(isset($_POST['add_book']))
	{
		// $connection = mysqli_connect("localhost","root","");
		// mysqli_query($connection,'SET NAMES UTF8');
		// $db = mysqli_select_db($connection,"lms");
		include "../asset/dbconnect.php";
		$intPurchaseYear = $_POST["purchase_year"];
		$intPurchaseYear = !empty($intPurchaseYear) ? "'$intPurchaseYear'" : "NULL";
		$intBookPrice = $_POST["book_price"];
		$intBookPrice = !empty($intBookPrice) ? "'$intBookPrice'" : "NULL";
		$query = "insert into books(`ac_no`, `book_name`, `author`, `publisher`, `category`, `purchase_year`, `book_price`) values('$_POST[ac_no]','$_POST[book_name]','$_POST[author]','$_POST[publisher]','$_POST[category]',$intPurchaseYear,$intBookPrice)";
		$query_run = mysqli_query($connection,$query);
?>
		<script type="text/javascript"> 
		window.location.replace("admin_dashboard.php"); 
		</script> 
<?php
	}
?>