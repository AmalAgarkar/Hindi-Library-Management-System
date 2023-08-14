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
	<title>पुस्तकें प्रबंधित करें</title>
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

	<!-- Search Field -->
	<div class="row d-flex justify-content-center my-4">
		<div class="col-md-6">
			<input type="text" name="search_field" id="search_field" class="form-control" onkeyup="Search(this.value)" placeholder="Search" value=""> 
		</div>
	</div>

	<!-- Manage books table -->
	<div class="text-center mt-5 mb-4"><h3>पुस्तकें प्रबंधित करें</h3></div>
	<div id="fetch_table">
		<div class="row d-flex justify-content-center mb-5">
			<div class="col-md-10">
				<table class="table table-hover">
					<thead class="sticky-top" style="background-color: #d9e2ff">
						<tr>
							<th style="width:12%">एक्सेशन संख्या</th>
							<th>पुस्तक का नाम</th>
							<th style="width:12.5%">लेखक</th>
							<th>प्रकाशक</th>
							<th style="width:11%">वर्ग</th>
							<th style="width:12%">खरीद वर्ष</th>
							<th style="width:10%">पुस्तक मूल्य</th>
							<th colspan="2" style="width:13%">कार्य</th>
						</tr>
					</thead>
					<?php
						// $connection = mysqli_connect("localhost","root","");
						// mysqli_query($connection,'SET NAMES UTF8');
						// $db = mysqli_select_db($connection,"lms");
						include "../asset/dbconnect.php";
						$query = "select * from books order by substr(ac_no from 1 for 2), cast(substr(ac_no from 1) AS UNSIGNED)";
						$query_run = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($query_run)){
							?>
							<tbody class="bg-light">
								<tr>
									<td><?php echo $row['ac_no'];?></td>
									<td><?php echo $row['book_name'];?></td>
									<td><?php echo $row['author'];?></td>
									<td><?php echo $row['publisher'];?></td>
									<td><?php echo $row['category'];?></td>
									<td><?php echo $row['purchase_year'];?></td>
									<td><?php echo $row['book_price'];?></td>
									<td><a href="edit_book.php?an=<?php echo $row['ac_no'];?>">Edit</a></td>
									<td><a href="delete_book.php?an=<?php echo $row['ac_no'];?>">Delete</a></td>
								</tr>
							</tbody>
							<?php
						}
					?>
				</table>
			</div>
		</div>
	</div>

	<script>
	// AJAX call for search field
    function Search(str) {
    var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("fetch_table").innerHTML = this.responseText;
		}
	};

	xmlhttp.open("GET", "manage_book_ajax.php?text=" + str, true);
	xmlhttp.send();
	}
    </script>


</body>
</html>