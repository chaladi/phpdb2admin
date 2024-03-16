<?php
include("../../connection.php");//$dbconn 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?php
echo $_GET['tname'];
$sql ="SELECT * FROM ".$_GET['tname'];

			$result = odbc_exec($dbconn, $sql);
			$r=odbc_num_rows($result);
			$colcont=odbc_num_fields($result);
			$path="../../../works/exports/".$_GET['tname'].".csv";
$fp = fopen ( $path, 'w' );

for($i=0;$i<$r;$i++)
{
fputcsv ( $fp, odbc_fetch_array($result) , ",", '"' );
}
?>
</body>
</html>
