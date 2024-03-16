<?php
include("../../connection.php");//$dbconn 
$filename=$_GET['tname'].".xls";
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"" . $filename . "\"" );
header ("Content-Description: PHP/INTERBASE Generated Data" );
//readfile($export_file);

?>
<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


?>

<?php
  $cols = array();
 $sql ="SELECT * FROM ".$_GET['tname'];

			$result = db2_exec($dbconn, $sql);
// to count the number of row in pecl
			$sql2=" select count(*) as num from ".$_GET['tname'];
			$result2 = db2_exec($dbconn, $sql2);
		   $r=db2_fetch_array($result2);
//////
			$colcont=db2_num_fields($result);
echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\"> <tr>";
	if($r!=0)
	{
		for($i=1;$i<=$colcont;$i++)
		{
		echo "<td>";
		 echo db2_field_name($result,$i);
		$cols[]=db2_field_name($result,$i);
		echo "</td>";
		}
		
		echo "</tr>";
		$c=0;
		$row_flag=0;	
		 while($rows = db2_fetch_array($result)) 
		 {	
		 	$row_flag=$row_flag+1;
		 	$p=NULL;
		  	echo "<tr>";
			for($i=0;$i<sizeof($cols);$i++)
			{
				 echo "<td>";
				 echo $rows[$cols[$i]];
				 echo "</td>";
				
			}
			//echo "<br>".$p."<br>";
			
				?>
					
				<?
			echo "</tr>";
		}
		$c=$colcont+1;
		//echo "<h3>".$r." rows are selected</h3>";
	}
	
?>
</table>

</body>
</html>