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
<div class="c_pad">
<?php
//echo $_GET['tname'];
$sql ="SELECT * FROM ".$_GET['tname'];

			$result = db2_exec($dbconn, $sql);
// to count the number of row in pecl
			$sql2=" select count(*) as num from ".$_GET['tname'];
			$result2 = db2_exec($dbconn, $sql2);
		   $row_count=db2_fetch_array($result2);
//////
			// $r=db2_num_rows($result); echo "<br>";
			 $colcont=db2_num_fields($result);
			$path="../../../works/exports/".$_GET['tname'].".csv";
$fp = fopen ( $path, 'w' );

for($i=0;$i<$row_count[0];$i++)
{
fputcsv ( $fp, db2_fetch_array($result) , ",", '"' );
}

?>
<a href="<?=$path?>">CLICK</a> here to downlod the CSV file.
</div>
</body>
</html>
