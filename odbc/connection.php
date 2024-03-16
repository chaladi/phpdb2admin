<?php
session_start();
	$dbname = $_SESSION['db_name'];
	$username =$_SESSION['u_name'];
	$password = $_SESSION['pass'];
	$dsn_name=$_SESSION['dsn_name'];
	$dbconn = odbc_connect($dsn_name, $username, $password);
?>