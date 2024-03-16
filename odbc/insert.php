<?php  
session_start();
include("connection.php");//$dbconn 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../styles/style.css">
<style>
table tr td { text-align:center;}
</style>
</head>

<body>
<?php
include("../includes/menu.php");
?>
<?php
echo "<div class=\"c_pad\">";

//$_GET['tname'];
////insert query genaration
if(isset($_POST['insert']))
{
//echo $_GET['tname']."working";
$list_val="";
$list_field="";
$val_flag=0;

 $r = odbc_columns($dbconn,'','',$_GET['tname']);
                while ($row = odbc_fetch_array($r)) {
				             
						$name= $row['COLUMN_NAME']."var";
						if(isset($_POST[$name]))
						{
							if($val_flag==0)
							{
								 $list_field=$list_field."".$row['COLUMN_NAME']." ";$val_flag++; 						
								 $list_val=$list_val."'".$_POST[$name]."' ";$val_flag++;
							}else{
								  $list_field=$list_field." , ".$row['COLUMN_NAME']." ";
								$list_val=$list_val.", '".$_POST[$name]."'";
							}
							}
						
					 }
echo "<div class=\"sql\">";
					echo $sql="INSERT INTO ".$_GET['tname']." ( ". $list_field." )   VALUES  (".$list_val.")";
echo "</div>";					
					odbc_exec($dbconn,$sql) or die();
					//echo "<h3><span style=\"color:#0066FF;\">".$_GET['table']."</span> CREATED </h3>";
echo "<h3>one ROW is inserted </h3>";
}


////end of insert query genaration







        function get_cols(&$conn,$table) {
                $cols = array();
                $keys = array();
                $r = odbc_primarykeys($conn,'','',$table);
                while ($row = odbc_fetch_array($r)) {
                        $keys[] = $row['COLUMN_NAME']; 
				}
				 
				?>
				<table border="1"  class="table_style" cellspacing="0" width="600" >
				<form name="insert" action="insert.php?tname=<?=$_GET['tname']?>" method="post">
				<tr><th>Name</th><th>Type</th><th>Scal</th><th>Null</th><th>Default</th><th>Primary key</th><th>Value</th></tr>
				<?
				
                $r = odbc_columns($conn,'','',$table);
                while ($row = odbc_fetch_array($r)) {
				        $c = array();         
						$name= $row['COLUMN_NAME'];
						$c=$name;
                        $type= $row['TYPE_NAME'];
                        $special = '';
                        if (isset($row['COLUMN_SIZE'])){ $special = $row['COLUMN_SIZE'];}
                        if (isset($row['LENGTH']))  $special = $row['LENGTH']; 
						if(isset($row['DECIMAL_DIGITS'])){$scale=$row['DECIMAL_DIGITS']; }else{$scale="";}
                        if($row['NULLABLE']==0){$nul="NOT NULL";}else{$nul="NULL";};
                        $default = str_replace("'",'',$row['COLUMN_DEF']);
						
                       // echo "PK  ".$pk = in_array($row['COLUMN_NAME'],$keys);
                        $p_flag=0;
						for($i=0;$i<sizeof($keys);$i++)
						{
					
							if($row['COLUMN_NAME']==$keys[$i])
							{
								$p_flag=1;
							}
						}
						if($p_flag==1){$primarykey="PRIMAEY KEY";}else{$primarykey="";}
						$var_name=$row['COLUMN_NAME']."var";
						?>
					
						<tr><td><?= $row['COLUMN_NAME']?></td><td>&nbsp;<? echo $row['TYPE_NAME']."(".$special.")";?></td><td>&nbsp;<?=$scale?></td><td>&nbsp;<?=$nul?></td><td>&nbsp;<?=$row['COLUMN_DEF']?></td><td>&nbsp;<?=$primarykey?></td><td>&nbsp;<input type="text" name="<?=$var_name?>" /></td></tr>
						<?
						
                }
				?>
				<tr><Td><input type="submit" value="Insert" name="insert" /></Td></tr>
				</form>
				<?
				echo "</table>";
                //return $cols;
        }
?>
<!-- <a href="brwose.php?table_name=<?=$_GET['tname']?>">BROWSE</a>&nbsp;&nbsp;&nbsp;<a href="insert.php?tname=<?=$_GET['tname']?>">INSERT</a>
 --><?php
/* http://www.google.co.in/codesearch/p?hl=en#LX3Xeo88Rho/sql/sql-1.3.zip|Acepi5B9Vu0/import.php&q=odbc_primarykeys
        OpenLink ODBC/Virtuoso branch, import schema from existing database
*/
/* CHANGE THIS TO REFLECT YOUR ODBC SETTINGS: */


 $cols = get_cols($dbconn,$_GET['tname']);
           
?>
</div>
</body>
</html>

