<?php include 'protect.php'?>

<!DOCTYPE html>
<html>

<head>
	<title>पुस्तक जारी करें</title>
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
	

	<!-- Issue book form -->
	<div class="row d-flex justify-content-center my-5">
		<div class="col-md-4" id="main_content">
			<div class="text-center"><h3>पुस्तक जारी करें</h3></div><br>
			<form action="" method="post" autocomplete="off">
				<div class="form-group">
					<label for="ac_no">एक्सेशन संख्या</label>
					<input type="text" name="ac_no" id="ac_no" class="form-control" onkeyup="CheckAcno(this.value)" value="" required><div class="text-danger" id="acno_warning"></div>
				</div>
				<div class="form-group">
					<label for="book_name">पुस्तक का नाम</label>
					<input type="text" name="book_name" id="book_name" class="form-control" style="caret-color: transparent !important;" value="" required onkeypress="return false;">
				</div>
				<div class="form-group">
					<label for="user_id">यूज़र आई डी</label>
					<input type="text" name="user_id" id="user_id" class="form-control" onkeyup="CheckUser(this.value)" required><div class="text-danger" id="user_warning"></div>
				</div>
				<div class="form-group">
					<label for="user_name">यूज़र का नाम</label>
					<input type="text" name="user_name" id="user_name" class="form-control" style="caret-color: transparent !important;" value="" required onkeypress="return false;">
				</div>
				<div class="form-group">
					<label for="issue_date">जारी करने की दिनांक&nbsp;(YY-MM-DD)</label>
					<input type="text" name="issue_date" id="issue_date" class="form-control" value="<?php echo date("y-m-d");?>" required>
				</div><br>
				<div class="text-center">
					<button id="myBtn" type="submit" name="issue_book" id="book_name" class="btn btn-primary">पुस्तक जारी करें</button>
				</div>
			</form>
		</div>
	</div>

	<script>
		// AJAX call for checking if book is available and if book is issued
        function CheckAcno(acno) {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
				myBook = this.responseText;

                if(myBook=="Book does not exist"){
					document.getElementById("acno_warning").innerHTML = "किताब उपलब्ध नहीं है!";
					document.getElementById('myBtn').disabled = true;
				}
				else if(myBook=="Book Already Issued!"){
					document.getElementById("acno_warning").innerHTML = "पुस्तक पहले से ही जारी है!";
					document.getElementById('myBtn').disabled = true;
				}
				else{
					document.getElementById("book_name").value = myBook;
					document.getElementById('myBtn').disabled = false;
					if(document.getElementById("book_name").value !== ""){
						document.getElementById("acno_warning").innerHTML = "";
					}
				}
            };

            xmlhttp.open("GET", "checkAcno_ajax.php?acno=" + acno, true);
            xmlhttp.send();
        }

		// AJAX call for checking if user is registered
        function CheckUser(user) {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
				myUser = this.responseText;

                if (this.readyState == 4 && this.status == 200) {
					if(myUser=="User does not exist"){
						document.getElementById("user_warning").innerHTML = "यूज़र पंजीकृत नहीं है!";
						document.getElementById('myBtn').disabled = true;
					}
					else{
						document.getElementById("user_name").value = myUser;
						document.getElementById('myBtn').disabled = false;
						document.getElementById("user_warning").innerHTML = "";
					}
                }
            };

            xmlhttp.open("GET", "checkUser_ajax.php?user=" + user, true);
            xmlhttp.send();
        }
    </script>

</body>
</html>

<?php
	if(isset($_POST['issue_book']))
	{
		// $connection = mysqli_connect("localhost","root","");
		// mysqli_query($connection,'SET NAMES UTF8');
		// $db = mysqli_select_db($connection,"lms");
		include "../asset/dbconnect.php";
		$query = "insert into issue_books(ac_no, book_name, user_id, issue_date) values('$_POST[ac_no]','$_POST[book_name]','$_POST[user_id]','$_POST[issue_date]')";
		$query2 = "update books set issue_status = 'Issued' where ac_no = '$_POST[ac_no]'";
		$query_run = mysqli_query($connection,$query);
		$query_run2 = mysqli_query($connection,$query2);
?>
		<script type="text/javascript">
			alert("पुस्तक सफलतापूर्वक जारी हो गई है...");
		</script>
<?php
	}
?>