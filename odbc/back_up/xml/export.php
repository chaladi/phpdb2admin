<?php
session_start();
include("../../connection.php");//$dbconn 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php


$cols = array();
echo $sql ="SELECT * FROM  TESTING";//.$_GET['tname']."";

			$result = odbc_exec($dbconn, $sql);
			$r=odbc_num_rows($result); 
			$colcont=odbc_num_fields($result);

		for($i=1;$i<=$colcont;$i++)
		{
		echo odbc_field_name($result,$i);
		$cols[]=odbc_field_name($result,$i);
		}
//include("Connections/cnn.php");
/*require_once 'excel/reader.php';

$reader = new Spreadsheet_Excel_Reader();
$reader->setOutputEncoding("UTF-8");
$reader->read("PHP2007.xls");
/*echo "<pre>";
print_r($reader->sheets[0]["cells"][1][2]);
echo "</pre>";*/

$x='<?xml version="1.0" encoding="utf-8"?>';
$x.='<root>';

 while($rows = odbc_fetch_object($result)) 
		 {	
		 	$row_flag=$row_flag+1;
		 	$p=NULL;
		  	$x.='<'.$_GET['tname'].'>';
			for($i=0;$i<sizeof($cols);$i++)
			{
				$x.='<'.$cols[$i].'>';
				$x.=$rows->$cols[$i];
				$x.='</'.$cols[$i].'>';			
			}
			$x.='</'.$_GET['tname'].'>';
		}
	$x.='</root>';	


echo $x;
echo $x;
$f=fopen("data1.xml","w+");
fwrite($f,$x);
fclose($f);
/*



for ($i = 2; $i <= ; $i++)
{
$c=1;
$x.='<student>';
for ($j =2; $j <= $reader->sheets[0]["numCols"]; $j++)
	{
		$x.='<'.str_replace(" ", "", $reader->sheets[0]["cells"][1][$c]).'>'.addslashes($reader->sheets[0]["cells"][$i][$j]).'</'.str_replace(" ", "", $reader->sheets[0]["cells"][1][$c]).'>';
		$c++;
	}
$x.='</student>';
//echo $sql."<br><br>$c";
}
$x.='</root>';
echo $x;
$f=fopen("data1.xml","w+");
fwrite($f,$x);
fclose($f);*/
?>
</body>
</html>
