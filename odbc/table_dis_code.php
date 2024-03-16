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
		$result = odbc_tables($dbconn);
		$tables = array();
		while (odbc_fetch_row($result)){
				if(odbc_result($result,"TABLE_TYPE")==$_GET['load'])
				   {  $arry_list[]=odbc_result($result,"TABLE_NAME");?>
					<li><a href="structure.php?tname=<?= odbc_result($result,"TABLE_NAME")?>&type=<?=$_GET['load']?>" target="rframe"   name="asdf"><?=odbc_result($result,"TABLE_NAME")?></a></li> 
					<?php }
		}
		
	echo "</ul>";

}else{
	
	 
	echo "<ul>";
		$result = odbc_tables($dbconn);
		 $len=strlen($_GET['str']);
		while (odbc_fetch_row($result)){
				if(odbc_result($result,"TABLE_TYPE")==$_GET['load1'])
				   { 
				   //echo substr(odbc_result($result,"TABLE_NAME"),0,$len)."<br>";
				   		if(substr(odbc_result($result,"TABLE_NAME"),0,$len)==strtoupper($_GET['str']))
						{
						   ?>
							<li><a href="structure.php?tname=<?= odbc_result($result,"TABLE_NAME")?>&type=<?=$_GET['load1']?>" target="rframe"   name="asdf"><?=odbc_result($result,"TABLE_NAME")?></a></li> 
							<?php
						}
				 }
		}
		
	echo "</ul>";

}
?>
