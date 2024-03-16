<?php
session_start();
include("connection.php");//$dbconn 

 //echo  "<p>TABLE NAME :<span style=\"color:#FF0000 \"> ".$_GET['tname']."<span></p><br>";
        function get_cols(&$conn,$table) {
                $cols = array();
                $keys = array();
                $r = odbc_primarykeys($conn,'','',$table);
                while ($row = odbc_fetch_array($r)) {
                        $keys[] = $row['COLUMN_NAME'];
				}
				 
				?>
				<table class="table_style" border="0"  cellspacing="0" cellpadding="0" width="600" >
				<tr>
					<th>name</th>
					<th>type</th>
					<th>SCALE</th>
					<th>null</th>
					<th>default</th>
					<th>primary key</th>
					<?php if($_GET['type']!="VIEW") {?>
					
					<th>EDIT</th>
					<th>DROP</th>
					<?php }?>
				</tr>
				<?
				
                $r = odbc_columns($conn,'','',$table);
                while ($row = odbc_fetch_array($r)) {
				        $c = array();         

						$name= $row['COLUMN_NAME'];
                        $type= $row['TYPE_NAME'];
                        $special = '';
                        if (isset($row['COLUMN_SIZE'])){ $special = $row['COLUMN_SIZE'];}
                        if (isset($row['LENGTH']))  $special = $row['LENGTH']; 
						if(isset($row['DECIMAL_DIGITS'])){$scale=$row['DECIMAL_DIGITS']; }else{$scale="";}
                        if($row['NULLABLE']==0){$nul="NOT NULL";}else{$nul="NULL";};
                        $default = str_replace("'",'',$row['COLUMN_DEF']);
						$row['COLUMN_DEF']= str_replace("'",'',$row['COLUMN_DEF']);
                       // echo "PK  ".$pk = in_array($row['COLUMN_NAME'],$keys);
                        $p_flag=0;
						for($i=0;$i<sizeof($keys);$i++)
						{
					
							if($row['COLUMN_NAME']==$keys[$i])
							{
								$p_flag=1;
							}
						}
						if($p_flag==1){$primarykey="PRIMARY KEY";}else{$primarykey="";}
						?>
					
						<tr>
						<td><?= $row['COLUMN_NAME']?></td>
						<td><? echo $row['TYPE_NAME']."(".$special.")";?></td>
						<td><?=$scale?></td><td><?=$nul?></td>
						<td> &nbsp;<?=$row['COLUMN_DEF']?></td>
						<td>&nbsp; <?=$primarykey?></td>
						
						<?php if($_GET['type']!="VIEW") {?>
						
						<td><a href="edit_structure.php?cname=<?= $row['COLUMN_NAME']?>&typename=<?=$row['TYPE_NAME']?>&len=<?=$special?>&scale=<?=$scale?>&nul=<?=$nul?>&deflt=<?=$row['COLUMN_DEF']?>&prime=<?=$primarykey?>&tname=<?=$_GET['tname']?>&type=<?=$_GET['type']?>">edit</a></td>
						<td><a href="c_drop.php?tname=<?=$_GET['tname']?>&c_name=<?=$row['COLUMN_NAME']?>&type=<?=$_GET['type']?>">drop</a></td>
						
						<?php }?>
						</tr>
						<?
						
                }
				echo "</table>";
                //return $cols;
        }
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
<!-- <a  href="table_name_input.php">NEW TABLE</a>&nbsp;&nbsp;<a href="brwose.php?table_name=<?=$_GET['tname']?>">BROWSE</a>&nbsp;&nbsp;<a href="insert.php?tname=<?=$_GET['tname']?>">INSERT</a>&nbsp;&nbsp;<a href="drop.php?tname=<?=$_GET['tname']?>">DROP</a>&nbsp;&nbsp;<a href="rename_table.php?tname=<?=$_GET['tname']?>">Rename Table</a> 
 --><?php
/* http://www.google.co.in/codesearch/p?hl=en#LX3Xeo88Rho/sql/sql-1.3.zip|Acepi5B9Vu0/import.php&q=odbc_primarykeys
        OpenLink ODBC/Virtuoso branch, import schema from existing database
*/
/* CHANGE THIS TO REFLECT YOUR ODBC SETTINGS: */
?>
<div class="c_pad">
<?php

 $cols = get_cols($dbconn,$_GET['tname']);
           
?>
</div>
<?php if($_GET['type']!="VIEW") { ?>
<form name="add_clm" method="get" action="add_columns.php">
Add number of columns <input type="text" name="count">
<input type="hidden" name="table"  value="<?=$_GET['tname']?>">
<input type="hidden" name="type"  value="<?=$_GET['type']?>">
<input type="submit" value="Go" name="new_clm">
</form>
<?php }?>
</body>
</html>
