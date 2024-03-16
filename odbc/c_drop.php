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
echo "<div class=\"sql\">";
 echo $sql="ALTER ".$_GET['type']." ".$_GET['tname']." DROP COLUMN ".$_GET['c_name'].""; 
echo "</div >";
odbc_exec($dbconn,$sql) or die();
echo "<h3>coloumn is droped</h3>";

?>
</div>