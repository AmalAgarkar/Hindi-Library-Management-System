<?php
$connection = mysqli_connect("localhost","root","");
mysqli_query($connection,'SET NAMES UTF8');
$db = mysqli_select_db($connection,"lms");
?>