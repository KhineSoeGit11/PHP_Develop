<?php 
	//change in admin_dashbord button form in action logout.php and method GET
	session_start();
	session_destroy();
	header('location:login.php');

?>