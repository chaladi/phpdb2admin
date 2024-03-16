<?php
session_start();
include("connection.php");//$dbconn 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../../../styles/style.css">
</head>

<body>
<?php
include("../../../includes/menu.php");
?>
<?
//echo $_GET['tname'];



//$sql = "SELECT * FROM ". $_GET['tname'];
$cols = array();
echo $sql ="SELECT * FROM ".$_GET['tname']."";

			$result = odbc_exec($dbconn, $sql);
			$r=odbc_num_rows($result); 
			$colcont=odbc_num_fields($result);

	
		for($i=1;$i<=$colcont;$i++)
		{
		$cols[]=odbc_field_name($result,$i);
		}
		
		
		$c=0;
		$row_flag=0;	
		 while($rows = odbc_fetch_object($result)) 
		 {	
		 	$row_flag=$row_flag+1;
		 	$p=NULL;
		
			for($i=0;$i<sizeof($cols);$i++)
			{
			
				 print $rows->$cols[$i];
			
				
				
			
		}
	

?>
</body>
</html>

