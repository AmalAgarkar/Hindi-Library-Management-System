<?php
	require("functions.php");
?>
<?php include 'protect.php'?>

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

<body>

	<!-- Navigation Bar 1 -->
	<nav class="navbar navbar-expand-lg navbar-dark font-weight-bold" style="background-color:#101a32">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php">हिंदी पुस्तकालय प्रबंधन प्रणाली</a>
			</div>
			<div class="text-white"><span>स्वागत है <?php echo $_SESSION['name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
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
	</nav><br><br><br><br><br>
	

	<!-- Cards -->
	<div class="row d-flex justify-content-center align-middle">
		<div class="col-md-2" style="margin: 0px">
			<div class="card bg-light text-center" style="border: 1px solid #6189f6">
				<div class="card-header" style="background-color: #d9e2ff">पंजीकृत यूज़र्स</div>
				<div class="card-body">
					<p class="card-text">कुल यूज़र्स: <?php echo get_user_count();?></p>
					<a class="btn btn-success" href="Regusers.php" target="_self">सभी यूज़र्स देखें</a>
				</div>
			</div>
		</div>
		<div class="col-md-2" style="margin: 0px">
			<div class="card bg-light text-center" style="border: 1px solid #6189f6">
				<div class="card-header" style="background-color: #d9e2ff">सभी पुस्तकें</div>
				<div class="card-body">
					<p class="card-text">कुल पुस्तकें: <?php echo get_book_count();?></p>
					<a class="btn btn-info" href="Regbooks.php" target="_self">सभी पुस्तकें देखें</a>
				</div>
			</div>
		</div>
		<div class="col-md-2" style="margin: 0px">
			<div class="card bg-light text-center" style="border: 1px solid #6189f6">
				<div class="card-header" style="background-color: #d9e2ff">जारी पुस्तकें</div>
				<div class="card-body">
					<p class="card-text">वर्तमान में जारी: <?php echo get_issue_book_count();?></p>
					<a class="btn btn-warning" style="color:white" href="view_issued_book.php" target="_self">जारी की गई पुस्तकें</a>
				</div>
			</div>
		</div>
		<div class="col-md-2" style="margin: 0px">
			<div class="card bg-light text-center" style="border: 1px solid #6189f6">
				<div class="card-header" style="background-color: #d9e2ff">ओवरड्यू पुस्तकें</div>
				<div class="card-body">
					<p class="card-text">ओवरड्यू पुस्तक संख्या: <?php echo get_overdue_book_count();?></p>
					<a class="btn btn-danger" href="view_overdue_book.php" target="_self">ओवरड्यू पुस्तकें</a>
				</div>
			</div>
		</div>
	</div><br><br>
</body>
</html>
