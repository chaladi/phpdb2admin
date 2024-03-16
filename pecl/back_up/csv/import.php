<?php
session_start();
include("../../connection.php");//$dbconn 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../../../styles/style.css">
</head>

<body>
<?php
include("../../../includes/menu.php");
?>
<?php
// logic for column list
 $r = db2_columns($dbconn,'','',$_GET['tname']);
$c_flag=0;
$col_list="";
$val_list="";
while (db2_fetch_row($r))
{
	if($c_flag==0)
	{
	  $col_list=db2_result($r,"COLUMN_NAME");$c_flag++;
	}else{
		  $col_list=$col_list.",".odbc_result($r,"COLUMN_NAME");
	}
}
//echo $col_list;// variable which contain    column     list with coma saparated
$path="../../../works/".$_GET['fname'];
$fp = fopen($path,'r') or die("can't open file");

$while_flg=0;
while($csv_line = fgetcsv($fp,1024)) 
{
//	echo 	 ;
 if($while_flg!=0)
	{
		$val_list=$val_list.",";
	}
$while_flg=$while_flg+1;
$str=$csv_line[0]; 
 $str2=str_replace(";", ",", $str);
 $str3=str_replace('"', "'", $str2);
if(stripos($str3, "," ) === false)
{
$val_list=$val_list."('".$str3."')";
}
else{
$val_list=$val_list."('".substr($str3,0,stripos($str3, "," ))."'".substr($str3,stripos($str3, "," )).")";
}
}
//echo "<br>".$val_list;
?>
<div class="sql">
<?php
echo $sql="INSERT INTO  ".$_GET['tname']." ( ".$col_list ." )   VALUES ".$val_list.";";
echo "</div>";
db2_exec($dbconn,$sql);
fclose($fp) or die("can't close file");
echo $while_flg."  row are Inserted";
?>

</body>
</html>
