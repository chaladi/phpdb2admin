<?php
session_start();
include("connection.php");//$dbconn 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>brwose</title><link rel="stylesheet" type="text/css" href="../styles/style.css">
<link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>

<body>
<?php
include("../includes/menu.php");
?>
<?php
//echo $_GET['tname'];



//$sql = "SELECT * FROM ". $_GET['tname'];
$cols = array();
echo "<div class=\"c_pad\">";
echo "<div class=\"sql\">";

echo $sql ="SELECT * FROM ".$_GET['tname']."";
echo " </div>";
			$result = odbc_exec($dbconn, $sql);
			$r=odbc_num_rows($result); 
			$colcont=odbc_num_fields($result);

echo "<table class=\"table_style\" border=\"0\" cellspacing=\"0\"> <tr>";
	if($r!=0)
	{
		for($i=1;$i<=$colcont;$i++)
		{
		echo "<th>";
		echo odbc_field_name($result,$i);
		$cols[]=odbc_field_name($result,$i);
		echo "</th>";
		}
		?>
			<th>EDIT</th>
		<?	
		echo "</tr>";
		$c=0;
		$row_flag=0;	
		 while($rows = odbc_fetch_object($result)) 
		 {	
		 	$row_flag=$row_flag+1;
		 	$p=NULL;
		  	echo "<tr>";
			for($i=0;$i<sizeof($cols);$i++)
			{
				 echo "<td>";
				 print $rows->$cols[$i];
				 echo "</td>";
				if(isset($rows->$cols[$i]))
				{
					if(!isset($p))
					{
						 $p=$cols[$i]."=".$rows->$cols[$i];	
					}
					else
					{
						  $p=$p."&".$cols[$i]."=".$rows->$cols[$i];
					}				
				}
			}
			//echo "<br>".$p."<br>";
			
				?>
					<td><a href="modify.php?tname=<?=$_GET['tname']?>&<? echo $p; ?>&backup=<?=$p?>&row_flag=<?=$row_flag?>">EDIT</a></td>
				<?
			echo "</tr>";
		}
		$c=$colcont+1;
		echo "<h3>".$r." rows are selected</h3>";
	}
	else
	{
					echo "<h3>No Rows selected</h3>";
	}
?>
</div>
</body>
</html>
