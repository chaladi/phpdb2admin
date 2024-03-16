<?php
session_start();
include("connection.php");//$dbconn 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>

<body>
<?php
include("../includes/menu.php");
$sql="SELECT 	 * FROM 	SYSCAT.TABLES WHERE 	TABSCHEMA NOT LIKE 'SYS%' AND TYPE = 'T' for read only";
$result = odbc_exec($dbconn, $sql);
//odbc_result_all($result);
/*
//odbc_specialcolumns  (  resource $connection_id  ,  int $type  ,  string $qualifier  ,  string $owner  ,  string $table  ,  int $scope  ,  int $nullable  )
$result = odbc_statistics($dbconn,"db2admin","db2admin","EMPLOYEE",0,0);
odbc_result_all($result);
$result=odbc_gettypeinfo  ($dbconn);
odbc_result_all($result);

 // $result = odbc_tables($dbconn);
 //$result =odbc_tableprivileges  (  $dbconn,"db2admin","db2admin","EMPLOYEE"  );
$result =odbc_columnprivileges  ($dbconn,"db2admin","db2admin","EMPLOYEE","EMPNO"   );
  odbc_result_all($result);
/*
$result = odbc_exec($dbconn, $sql);
			$r=odbc_num_rows($result); 
			$colcont=odbc_num_fields($result);
	echo "<table class=\"table_style\" border=\"0\" cellspacing=\"0\"> ";
*/
?>
<table class="table_style" border="1" width="100%" cellspacing="0">
<tr><th>TABNAME	</th><th>TABSCHEMA</th><th>OWNER</th><th>COLCOUNT</th><th>CREATE_TIME</th><th>ALTER_TIME</th></tr>
<?php

while($rows = odbc_fetch_object($result)) 
		 {
		 ?>
	<tr><td  ><?=$rows->TABNAME?></td><td align="center"><?=$rows->TABSCHEMA?></td><td align="center"><?=$rows->OWNER?></td><td  align="center"><?=$rows->COLCOUNT?></td>
	<td align="center"><?=substr($rows->CREATE_TIME,0,16)?></td><td align="center"><?=substr($rows->ALTER_TIME,0,16)?></td></tr>	 
		 <?php	
		 
		 }
?>

</table>

</body>
</html>
