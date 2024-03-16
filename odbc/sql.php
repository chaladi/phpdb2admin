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
if(isset($_POST['sub']))
{
odbc_exec($dbconn,$_POST['t_area']) or die();
}
?>
<div class="c_pad">
<form name="frm1" action="sql.php" method="post">
<label><strong>SQL</strong></label><br />
<textarea name="t_area" cols="60" rows="10"></textarea><br>
<input type="submit" name="sub">
</form></div>





