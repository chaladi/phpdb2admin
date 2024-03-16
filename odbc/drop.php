<?php
session_start();
include("connection.php");//$dbconn 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>

<body>

<?php
include("../includes/menu.php");
?>
<div class="c_pad">
<?php
$sql="DROP ".$_GET['type']." ".$_GET['tname']."";
odbc_exec($dbconn,$sql) or die();
//header('Location:s.php');
echo "<h3> ".$_GET['tname']." is droped.</h3>"


?>
</div>
