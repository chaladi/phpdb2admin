<?php
include("../../connection.php");//$dbconn 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
// logic for column list
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
$path="../../../works/".$_GET['fname'];
$fp = fopen($path,'r') or die("can't open file");

$while_flg=0;
while($csv_line = fgetcsv($fp,1024)) {
	 if($while_flg!=0)
	{
		$val_list=$val_list.",";
	}
	$while_flg=$while_flg+1;

    for ($i = 0, $j = count($csv_line); $i < $j; $i++) 
	{
		if($i==0)
		{
 				$val_list=$val_list."('".$csv_line[$i]."'";
		}
		else
		{
			$val_list=$val_list.",'".$csv_line[$i]."'";
		}
       
    }
	
	$val_list=$val_list.")";

}
//echo "<br>".$val_list;
echo $sql="INSERT INTO  ".$_GET['tname']." ( ".$col_list ." )   VALUES ".$val_list.";";
odbc_exec($dbconn,$sql);
fclose($fp) or die("can't close file");

?>
<body>

</body>
</html>
