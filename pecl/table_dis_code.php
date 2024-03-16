<?
session_start();
	include("connection.php");
if(isset($_GET['load']))
{

	$arry_list=array();
	if($_GET['load']=="TABLE")
	{
	echo "<ul style=\" list-style-image:url(../images/table.png); \">";
	}else{
	echo "<ul style=\"list-style-image:url(../images/view.png);\">";
	}
	echo "<ul>";
		$result = db2_tables($dbconn);
		$tables = array();
 while($tables =db2_fetch_assoc($result))
 {
				if($tables['TABLE_TYPE']==$_GET['load'])
				   {  $arry_list[]=$tables['TABLE_NAME'];?>
					<li><a href="structure.php?tname=<?= $tables['TABLE_NAME']?>&type=<?=$_GET['load']?>" target="rframe"   name="asdf"><?=$tables['TABLE_NAME']?></a></li> 
					<?php }
		}
		
	echo "</ul>";

}else{
	
	 
	echo "<ul>";
		$result = db2_tables($dbconn);
		 $len=strlen($_GET['str']);
		 while($tables =db2_fetch_assoc($result)){
				if($tables['TABLE_TYPE']==$_GET['load1'])
				   { 
				   //echo substr(odbc_result($result,"TABLE_NAME"),0,$len)."<br>";
				   		if(substr($tables['TABLE_TYPE'],0,$len)==strtoupper($_GET['str']))
						{
						   ?>
							<li><a href="structure.php?tname=<?= $tables['TABLE_TYPE']?>&type=<?=$_GET['load1']?>" target="rframe"   name="asdf"><?=$tables['TABLE_TYPE']?></a></li> 
							<?php
						}
				 }
		}
		
	echo "</ul>";

}
?>
