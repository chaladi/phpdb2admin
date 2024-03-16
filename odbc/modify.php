<?php
session_start();
include("connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>

<body>
<?php
include("../includes/menu.php");
?>
<div class="c_pad">
<?
$_GET['row_flag'];
//http://publib.boulder.ibm.com/infocenter/db2luw/v8/index.jsp?topic=/com.ibm.db2.udb.doc/admin/r0000888.htm
//echo $_GET['tname'];
/*echo $_GET['aa'];
echo $_GET['SNO']."<br>";//=1&
echo $_GET['ID']."<br>";//=07891f0040&
echo $_GET['NAME']."<br>";//=rajnder &
echo $_GET['FATHER']."<br>";//=mallesh 
echo $_GET['SNO1']."<br>";//=1&
echo $_GET['ID2']."<br>";//=07891f0040&
echo $_GET['NAME3']."<br>";//=rajnder &
echo $_GET['FATHER4']."<br>";//=mallesh 
echo "this is back up ".$_GET['backup']."<br>";
*/
//$dbconn 
if(isset($_GET['sub']))
{

			 $sql ="SELECT * FROM ".$_GET['tname']."";

			$result = odbc_exec($dbconn, $sql);
			///for primary key column name...
			echo "<br>";
				$r = odbc_primarykeys($dbconn ,'','',$_GET['tname']);
				$keys = array();
                while ($row = odbc_fetch_array($r)) {
                        $keys[] = $row['COLUMN_NAME']; 
				}
					echo "<br>"; 
					
					$r = odbc_columns($dbconn,'','',$_GET['tname']);
					$pk_field_no=NULL;
					$pname=NULL;
                while ($row = odbc_fetch_array($r)) 
				{
				$pk_field_no++;
				 $p_flag=0;
						for($i=0;$i<sizeof($keys);$i++)
						{
										
							if($row['COLUMN_NAME']==$keys[$i])
							{
								//$p_flag=1;
								echo $pname=$row['COLUMN_NAME'];
								echo $pkk=$row['COLUMN_NAME'].$pk_field_no;
							}
						}
						///if($p_flag==1){$primarykey="PRIMARY KEY";}else{$primarykey="";}
				}
				
			//end  for primary key column anme
			$r=odbc_num_rows($result);/// number if rows
			$colcont=odbc_num_fields($result);// number of fields
			for($i=1;$i<=$colcont;$i++)
			{
				
				 $_GET[odbc_field_name($result,$i)]."<br>";
				$dump_name=odbc_field_name($result,$i).$i;
				 $_GET[$dump_name]."<br>";
				if($_GET[odbc_field_name($result,$i)]!=$_GET[$dump_name])
				{
					if(isset($pname))
					{ 
						 $sql ="update ".$_GET['tname']." set ".odbc_field_name($result,$i)." = '".$_GET[odbc_field_name($result,$i)]."' where ".$pname." = '".$_GET[$pkk]."'";
						odbc_exec($dbconn, $sql);
					}else{	
						  $sql ="update ".$_GET['tname']." set ".odbc_field_name($result,$i)." = '".$_GET[odbc_field_name($result,$i)]."' where ".odbc_field_name($result,$i)." = '".$_GET[$dump_name]."'";
						 odbc_exec($dbconn, $sql) or die();
					 }
				}
				
			}
}






$cols = array();
?>
<div class="sql">
<?php
echo $sql;
$sql="SELECT * FROM ".$_GET['tname'];
?>
</div>
<?php
			$result = odbc_exec($dbconn, $sql);
			$r=odbc_num_rows($result);
 $colcont=odbc_num_fields($result);
?>
<form name="modify" action="modify.php" method="get">
<?
echo "<table class=\"table_style\" border=\"0\" cellspacing=\"0\"> ";
if($r!=0)
{
		for($i=1;$i<=$colcont;$i++)
		{

		echo "<tr><td>";
		echo odbc_field_name($result,$i);
		$dump_name=odbc_field_name($result,$i).$i;
		//$cols[]=odbc_field_name($result,$i);
		echo "</td>";
		?>
			<td><input type="text" name="<?=odbc_field_name($result,$i)?>" value="<?=$_GET[odbc_field_name($result,$i)]?>" >
				<input style="display:none;" type="text" name="<?=$dump_name?>" value="<?=$_GET[odbc_field_name($result,$i)]?>" >
			</td>
		<?
		echo "</tr>";
		}
		?>
		<input style="display:none; " type="text" name="tname" value="<?=$_GET['tname']?>"	>
		<input type="hidden" name="row_flag" value="<?=$_GET['row_flag']?>">
				<td><input type="submit" value="GO" name="sub"></td>
		<?
		$c=0;
		while($rows = odbc_fetch_object($result)) 
		 {	
		  echo "<tr>";
			
			?>

			<?
			 echo "</tr>";
		}
		$c=$colcont+1;
		echo "<h3>one row is updated</h3>";
		}else{
					//echo "<h3>No Rows selected</h3>";
		}

?>
</form>
</div>
</body>
</html>

