<?php
session_start();
include("connection.php");//$dbconn 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>

<body>
<?php
include("../includes/menu.php");
?>
<?
if(isset($_POST['re_sub']))
{

echo $sql="RENAME TABLE ".$_GET['tname']." TO ".$_POST['n']."";
odbc_exec($dbconn,$sql);
//header('Location:s.php');
echo "The table name is Rename as ".$_GET['tname']."";
}
?>
<form name="rename" method="post" action="rename_table.php?tname=<?=$_GET['tname']?>">
<?
 echo "RENAME TABLE ".$_GET['tname']." TO";
?>
<input type="text" name="n"/>

<input type="submit" name="re_sub" />
</form>
</body>
</html>
