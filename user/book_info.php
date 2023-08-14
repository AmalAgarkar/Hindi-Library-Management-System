<?php
	session_start();
	#fetch data from database
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
	include "../asset/dbconnect.php";
	$book_name = "";
	$author = "";
	$category = "";
	$book_no = "";
	$price = "";
	$query = "select ac_no, book_name, author, publisher, issue_status from books order by substr(ac_no from 1 for 2), cast(substr(ac_no from 1) AS UNSIGNED)";

?>

<!DOCTYPE html>
<html>

<head>
	<title>पुस्तकालय</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.css">
  	<script type="text/javascript" src="../bootstrap4/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap4/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
	.Available {
		color: #009104;
	}
	.Issued {
		color: #ad0000;
	}
	.dropdown-menu {
		max-height: 40vh;
		overflow-y: scroll;
	}
	@supports ((position: -webkit-sticky) or (position: sticky)) {
		.sticky-top-2 {
			position: -webkit-sticky;
			position: sticky;
			top: 55px;
			z-index: 1019;
		}
	}
</style>

<body>

	<!-- Navigation Bar 1 -->
	<nav class="navbar navbar-expand-lg navbar-dark font-weight-bold" style="background-color:#101a32">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../index.php"><i class="fas fa-house"></i>&nbsp;&nbsp;हिंदी पुस्तकालय प्रबंधन प्रणाली</a>
			</div>
		</div>
	</nav>

	<!-- Navigation Bar 2 -->
    <nav class="navbar navbar-expand-lg navbar-light font-weight-bold sticky-top" style="background-color: #6189f6">
		<div class="container-fluid">
			<ul class="nav navbar-nav navbar-center">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">लेखक</a>
	        	<div class="dropdown-menu">

					<!-- Fetching distinct authors -->
					<?php 
					$query2 = "select distinct author from books where author is not null or author!=''";
					$query_run = mysqli_query($connection,$query2);
					while ($row = mysqli_fetch_assoc($query_run)){
						$author_distinct = $row['author'];
					?>

	        		<div class="dropdown-item" onclick='SearchFromAuthor("<?php echo $author_distinct;?>")'><?php echo $author_distinct;?></div>
	        		<div class="dropdown-divider"></div>

					<?php
					}
					?>
	        	</div>
		      </li>

		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">प्रकाशक</a>
	        	<div class="dropdown-menu">

					<!-- Fetching distinct publishers -->
					<?php 
					$query2 = "select distinct publisher from books where publisher is not null or publisher!=''";
					$query_run = mysqli_query($connection,$query2);
					while ($row = mysqli_fetch_assoc($query_run)){
						$publisher_distinct = $row['publisher'];
					?>

	        		<div class="dropdown-item" onclick='SearchFromPublisher("<?php echo $publisher_distinct;?>")'><?php echo $publisher_distinct;?></div>
	        		<div class="dropdown-divider"></div>

					<?php
					}
					?>
	        	</div>
		      </li>
		    </ul>
	
			<!-- Search Field -->
		    <div class="nav navbar-nav navbar-right">
				<input type="text" name="search_field" id="search_field" class="form-control" onkeyup="Search(this.value)" placeholder="Search" value=""> 
            </div>
		</div>
	</nav>
	
	<!-- Table -->
	<div class="text-center mt-5 mb-4"><h3>सभी पुस्तकें</h3></div>
	<div id="fetch_table">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10">
				<table class="table table-hover">
					<thead class="sticky-top-2" style="background-color: #d9e2ff; z-index: 0;">
						<tr>
							<th style="width:12%">एक्सेशन संख्या</th>
							<th style="width:19%">पुस्तक का नाम</th>
							<th style="width:19%">लेखक</th>
							<th style="width:19%">प्रकाशक</th>
							<th style="width:11%">जारी की स्थिति</th>
						</tr>
					</thead>
			
				<?php
					$query_run = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($query_run)){
						$ac_no = $row['ac_no'];
						$book_name = $row['book_name'];
						$author = $row['author'];
						$publisher = $row['publisher'];
						$issue_status = $row['issue_status'];
				?>
					<tbody class="bg-light">
						<tr>
							<td><?php echo $ac_no;?></td>
							<td><?php echo $book_name;?></td>
							<td><?php echo $author;?></td>
							<td><?php echo $publisher;?></td>
							<td class="<?php echo $issue_status?>"><?php echo $issue_status;?></td>
						</tr>
					</tbody>	
				<?php
					}
				?>	
				</table>
			</div>
		</div>
	</div>


	<!-- Asynchronous call by Search Field using AJAX -->
	<script>
    function Search(str) {

    var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("fetch_table").innerHTML = this.responseText;
		}
	};

	xmlhttp.open("GET", "book_info_ajax.php?text=" + str, true);
	xmlhttp.send();
	}
    </script>


	<!-- Asynchronous call by Author dropdown using AJAX -->
	<script>
    function SearchFromAuthor(str) {
    var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("fetch_table").innerHTML = this.responseText;
		}
	};

	xmlhttp.open("GET", "SearchAuthor_ajax.php?text=" + str, true);
	xmlhttp.send();
	}
    </script>
	

	<!-- Asynchronous call by Publisher dropdown using AJAX -->
	<script>
    function SearchFromPublisher(str) {
    var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("fetch_table").innerHTML = this.responseText;
		}
	};

	xmlhttp.open("GET", "SearchPublisher_ajax.php?text=" + str, true);
	xmlhttp.send();
	}
    </script>

</body>
</html>
