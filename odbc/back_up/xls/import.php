<?php
include("../../connection.php");//$dbconn 
//echo $_GET['tname'];

//echo $_GET['fname'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$r = odbc_columns($dbconn,'','',$_GET['tname']);
$c_flag=0;
$col_list="";
$val_list="";
while (odbc_fetch_row($r))
{
	if($c_flag==0)
	{
	  $col_list=odbc_result($r,"COLUMN_NAME");$c_flag++;
	}else{
		  $col_list=$col_list.",".odbc_result($r,"COLUMN_NAME");
	}
}
//echo $col_list;// variable which contain colum list with coma saparated
?>




<?
//include("Connections/cnn.php");
require_once 'excel/reader.php';

$reader = new Spreadsheet_Excel_Reader();
$reader->setOutputEncoding("UTF-8");
$reader->read($_GET['fname']);

for ($i =1; $i <= $reader->sheets[0]["numRows"]; $i++)
{
$c=1;
//INSERT INTO TESTING ( NAME,RNO,MARKS ) VALUES ('12','21','34'),('121','12','12'),('12','98','98'),('77','77','77'); 
if($i!=1)
{
$val_list=$val_list.",";
}
	for ($j =1; $j <= $reader->sheets[0]["numCols"]; $j++)
	{
		if($j==1)
		{
		$val_list=$val_list."('".addslashes($reader->sheets[0]["cells"][$i][$j])."'";
		}else{
		$val_list=$val_list.",'".addslashes($reader->sheets[0]["cells"][$i][$j])."'";			
		}
		
		$c++;
	}
	$val_list=$val_list.")";
}
//echo $val_list;
echo $sql="INSERT INTO  ".$_GET['tname']." ( ".$col_list ." )   VALUES ".$val_list.";";
odbc_exec($dbconn,$sql);
fclose($fp) or die("can't close file");
?>

</body>
</html>
