<?php include 'protect.php'?>
<?php
	#fetch data from database
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
	include "../asset/dbconnect.php";
	$ac_no = "";
	$book_name = "";
	$user_id = "";
	$user_name = "";
	$issue_date = "";
	$return_date = "";
	$query = "select issue_books.ac_no, issue_books.book_name, issue_books.user_id, users.user_name, issue_books.issue_date, issue_books.return_date from issue_books left join users on issue_books.user_id = users.user_id order by return_date";
?>


<!DOCTYPE html>
<html>

<head>
	<title>जारी की गई पुस्तकें</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.css">
  	<script type="text/javascript" src="../bootstrap4/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap4/js/bootstrap.min.js"></script>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark font-weight-bold" style="background-color:#101a32">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php"><i class="fas fa-house"></i>&nbsp;&nbsp;हिंदी पुस्तकालय प्रबंधन प्रणाली</a>
			</div>
			<div class="text-white"><span>स्वागत है <?php echo $_SESSION['name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
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

	<div class="row d-flex justify-content-center my-4">
		<div class="col-md-6" id="main_content">
			<input type="text" name="search_field" id="search_field" class="form-control" onkeyup="Search(this.value)" placeholder="Search" value=""> 
		</div>
	</div>

	<!-- Issued books table -->
	<div class="text-center mt-5 mb-4"><h3>जारी की गई पुस्तकें</h3></div>
	<div id="fetch_table">
		<div class="row d-flex justify-content-center mb-5">
			<div class="col-md-10">
				<table class="table table-hover" style="margin:auto;">
					<thead class="sticky-top" style="background-color: #d9e2ff;">
						<tr>
							<th style="width:15%">एक्सेशन संख्या</th>
							<th>पुस्तक का नाम</th>
							<th>यूज़र आई डी</th>
							<th style="width:15%">Name</th>
							<th style="width:18%">जारी करने की दिनांक</th>
							<th style="width:13%">लौटाने की दिनांक</th>
						</tr>
					</thead>
			
				<?php
					$query_run = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($query_run)){
				?>
					<tbody class="bg-light">
						<tr>
							<td><?php echo $row['ac_no'];?></td>
							<td><?php echo $row['book_name'];?></td>
							<td><?php echo $row['user_id'];?></td>
							<td><?php echo $row['user_name'];?></td>
							<td><?php echo $row['issue_date'];?></td>
							<td><?php echo $row['return_date'];?></td>
						</tr>
					</tbody>
				<?php
					}
				?>	
				</table>
			</div>
		</div>
	</div>


	<!-- Asynchronous call by search field -->
	<script>
    function Search(str) {
    var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("fetch_table").innerHTML = this.responseText;
		}
	};

	xmlhttp.open("GET", "view_issued_ajax.php?text=" + str, true);
	xmlhttp.send();
	}
    </script>

</body>
</html>
