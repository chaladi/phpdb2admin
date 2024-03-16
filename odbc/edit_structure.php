<?
session_start();
include("connection.php");//$dbconn 
/*
echo $_GET['tname']."<br>";echo $_POST['tname']."<br>";
echo $_GET['cname']."<br>";
echo $_GET['typename']."<br>";
echo $_GET['scale']."<br>";
echo $_GET['nul']."<br>";
echo $_GET['deflt']."<br>";
echo "this is prime val ".$_GET['prime']."<br>";
echo $_GET['len']."<br>";*/

 for($i=1;$i<=1;$i++) {
$field="field".$i;
$type="type".$i;
$length="length".$i;
$scale="scale".$i;
$attributes="attributes".$i;
$nn="nn".$i;
$deflt="deflt".$i;
$extra="extra".$i;
$c_prime="constrant".$i;
$comments="comments".$i;
}
/*echo $_POST[$field]."<br>";
echo "type ".strtoupper($_POST[$type])."<br>";
echo $_POST[$length]."<br>";
echo $_POST[$attributes]."<br>";echo $_POST[$nn]."<br>";echo $_POST[$deflt]."<br>";
echo $_POST[$extra]."<br>";echo "this is prime val ".$_POST[$c_prime]."<br>";echo $_POST[$comments]."<br>";*/
//to rename field name..
	if(isset($_POST[$field]))
	{
		if($_GET['cname']!= strtoupper($_POST[$field]))
		{

		 $sql="ALTER ".$_GET['type']." ".$_POST['tname']."  RENAME COLUMN ".$_GET['cname']." TO ".$_POST[$field].";";

			odbc_exec($dbconn, $sql);
				$msg2="<h3>one column name is updated.</h3>";
		}
	}	
//end to rename field name..
//alter data type...
//ALTER TABLE UNIQQ alter column sal set data type INTEGER
if(isset($_POST[$type]))
	{
		
		if($_GET['typename']!=strtoupper($_POST[$type]))
		{
			if($_POST[$type]=="DECIMAL" || $_POST[$type]=="numeric")
			{
				
					  $sql="ALTER ".$_GET['type']." ".$_POST['tname']." ALTER column ".$_POST[$field]." set data type ".$_POST[$type]."(".$_POST[$length].",".$_POST[$scale].")";				
		
					odbc_exec($dbconn, $sql);
					$msg2="<h3>one column name is updated.</h3>";
			}
			else
			{
					if($_POST[$type]=="integer" ||$_POST[$type]=="smallint" || $_POST[$type]=="bigint" || $_POST[$type]=="LONG VARGRAPHIC" || $_POST[$type]=="date" || $_POST[$type]=="float" || $_POST[$type]=="date" || $_POST[$type]=="double" || $_POST[$type]=="real" || $_POST[$type]=="LONG VARCHAR" )
							{
								
								  $sql="ALTER ".$_GET['type']." ".$_POST['tname']." ALTER column ".$_POST[$field]." set data type  ".$_POST[$type]."";
								
								odbc_exec($dbconn, $sql);
								$msg2= "<h3>one column name is updated.</h3>";
							}else
							{
					
								 $sql="ALTER ".$_GET['type']." ".$_POST['tname']." ALTER column ".$_POST[$field]." set data type ".$_POST[$type]."(".$_POST[$length].")";
				
								odbc_exec($dbconn, $sql);
								$msg2= "<h3>one column name is updated.</h3>";
							}
			}
		}
	}	

//end of alster data type
//ALTER TABLE bar ALTER COLUMN C1 SET NOT NULL
if(strtoupper($_POST[$nn])!=$_GET['nul'] && isset($_POST[$nn]))
{
		if(strtoupper($_POST[$nn])!="NULL")
		{
		 $sql="ALTER ".$_GET['type']." ".$_POST['tname']." ALTER COLUMN ".$_POST[$field]." SET  ".$_POST[$nn]."";
		}
		if(strtoupper($_POST[$nn])!="NOT NULL")
		{
		 $sql="ALTER ".$_GET['type']." ".$_POST['tname']." ALTER COLUMN ".$_POST[$field]."  DROP  NOT NULL";
		}
		odbc_exec($dbconn, $sql);
$msg2="<h3>one column name is updated.</h3>";
}
//end set null
//alter default value....
//ALTER TABLE UNIQQ alter column sal set default '2.0'
if(strtoupper($_POST[$deflt])!=$_GET['nul'] && isset($_POST[$deflt]))
{
	if($_GET['deflt']!=strtoupper($_POST[$deflt]))
	{
			 $sql="ALTER ".$_GET['type']." ".$_POST['tname']." alter column ".$_POST[$field]." set default '".$_POST[$deflt]."'";
			odbc_exec($dbconn, $sql);
$msg2= "<h3>one column name is updated.</h3>";
	}

}
//end of alter default value....
//ALTER TABLE UNNI1 add primary key(SDFSD)
//ALTER TABLE EMPLOYEE ADD PRIMARY KEY (EMP_NO, WORK_DEPT)

if(isset($_POST[$c_prime]))
{
	if($_GET['prime']!=strtoupper($_POST[$c_prime]))
	{
		if($_POST[$c_prime]=="primary")
		{
			 $sql="ALTER ".$_GET['type']." ".$_POST['tname']." ADD PRIMARY KEY(".$_POST[$field].")";
			
		}
		if($_POST[$c_prime]!="primary")
		{
			 $sql="ALTER ".$_GET['type']." ".$_POST['tname']." DROP PRIMARY KEY";
		}
		odbc_exec($dbconn, $sql);

$msg2= "<h3>one column name is updated.</h3>";
	}
}
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>

<body>
<?php
include("../includes/menu.php");
?>
<div class="c_pad">
<?php
echo "<div class=\"sql\">";
echo $sql;
 echo "</div>";
echo $msg2;
?>

<form name="table_form" action="edit_structure.php?cname=<?= $_GET['cname']?>&typename=<?=$_GET['typename']?>&len=<?=$_GET['len']?>&scale=<?=$_GET['scale']?>&nul=<?=$_GET['nul']?>&deflt=<?=$_GET['deflt']?>&prime=<?=$_GET['prime']?>&type=<?=$_GET['type']?>&tname=<?=$_GET['tname']?>" method="post">
<table border="0" cellspacing="0">

<tr>
<th>Field</th>
<th>Type</th>
<th>Length/Values</th>
<th>Scale</th>
<!-- <th>Collation</th>
<th>Attributes</th>
 --><th>Null</th>
<th>Default2</th>
<th>Extra</th>
<th>Primary</th>
<th>Index</th>
<th>Unique</th>
<th>---</th>
<!-- <th>Comments</th> -->
</th>
<? for($i=1;$i<=1;$i++) {
$field="field".$i;
$type="type".$i;
$length="length".$i;
$scale="scale".$i;
$attributes="attributes".$i;
$nn="nn".$i;
$deflt="deflt".$i;
$extra="extra".$i;
$c_prime="constrant".$i;
$comments="comments".$i;
$tname="tname".$i;
?>
<tr>
<td  ><input type="text" style="width:100px;" value="<?=$_GET['cname']?>" name="<?=$field?>"/></td>
<td><select  name="<?=$type?>">
<option value="integer" <?=$_GET['typename']=="INTEGER"?"selected=\"selected\"":'';?>>INTERGER</option>
<option value="smallint" <?=$_GET['typename']=="SMALLINT"?"selected=\"selected\"":'';?>>SMALLINT</option>
<option value="bigint" <?=$_GET['typename']=="BIGINT"?"selected=\"selected\"":'';?>>BIGINT</option>
<option value="date" <?=$_GET['typename']=="DATE"?"selected=\"selected\"":'';?>>DATE</option>
<option value="DECIMAL" <?=$_GET['typename']=="DECIMAL"?"selected=\"selected\"":'';?>>DECIMAL</option>
<option value="numeric" <?=$_GET['typename']=="NUMERIC"?"selected=\"selected\"":'';?>>NUMERIC</option>
<option value="CHAR" <?=$_GET['typename']=="CHAR"?"selected=\"selected\"":'';?>>CHAR</option>
<option value="float" <?=$_GET['typename']=="FLOAT"?"selected=\"selected\"":'';?>>FLOAT</option>
<option value="double" <?=$_GET['typename']=="DOUBLE"?"selected=\"selected\"":'';?>>DOUBLE</option>
<option value="real" <?=$_GET['typename']=="REAL"?"selected=\"selected\"":'';?>>REAL</option>
<option value="VARCHAR" <?=$_GET['typename']=="VARCHAR"?"selected=\"selected\"":'';?>>VARCHAR</option>
<option value="LONG VARCHAR " <?=$_GET['typename']=="LONG VARCHAR"?"selected=\"selected\"":'';?>>	LONG VARCHAR </option>
<option value="CLOB" <?=$_GET['typename']=="CLOB"?"selected=\"selected\"":'';?>>	CLOB</option>
<option value="DBCLOB" <?=$_GET['typename']=="DBCLOB"?"selected=\"selected\"":'';?>>DBCLOB</option>
<option value="graphic" <?=$_GET['typename']=="GRAPHIC"?"selected=\"selected\"":'';?>>GRAPHIC</option>
<option value="vargraphic" <?=$_GET['typename']=="VARGRAPHIC"?"selected=\"selected\"":'';?>>VARGRAPHIC</option>
<option value="LONG VARGRAPHIC" <?=$_GET['typename']=="LONG VARGRAPHIC"?"selected=\"selected\"":'';?>>LONG VARGRAPHIC</option>
<option value="LONG VARCHAR" <?=$_GET['typename']=="LONG VARCHAR"?"selected=\"selected\"":'';?>>LONG VARCHAR</option>
</select></td>
<td><input style="width:50px;" type="text" value="<?=$_GET['len']?>"  name="<?=$length?>"/></td>
<td><input type="text" name="<?=$scale?>" value="<?=$_GET['scale']?> "></td>
<!-- <td><select name=""></select></td>
<td><select name="<?=$attributes?>">
<option value=""></option>
<option value="unsigned">unsigned</option>
<option value="unsignedzerofill">unsignedzerofill</option>
<option value="on update current_timestamp">on update current_timestamp</option>
<option value=""></option>
</select></td>
 --><td><select name="<?=$nn?>">
<option value=""> </option>
<option value="null" <?=$_GET['nul']=="NULL"?"selected=\"selected\"":'';?>>NULL</option>
<option value="not null" <?=$_GET['nul']=="NOT NULL"?"selected=\"selected\"":'';?>>NOT NULL</option>
</select></td>
<td><input type="text" style="width:100px;" value="<?=$_GET['deflt']?>" name="<?=$deflt?>" /></td>
<td><select name="<?=$extra?>">
<option value=""></option>
<option value="auto incriment">AUTO INCRIMENT</option>

</select> </td>
<?
if($_GET['prime']!="PRIMARY KEY"){ $flg=0;}
?>
<td><input type="radio" <?= $_GET['prime']=="PRIMARY KEY"?"checked=\"checked\"":''; ?>value="primary" name="<?=$c_prime?>" /></td>
<td><input type="radio" value="index" name="<?=$c_prime?>" /></td>
<td><input type="radio" value="unique" name="<?=$c_prime?>" /></td>
<td><input type="radio" value=""  <?=$flg==0?"checked=\"checked\"":"";?> name="<?=$c_prime?>" /></td>

<!-- 
<td><input type="text" value=""  name="<?=$comments?>"/></td> -->
</tr>
<?  }?>
<input type="text" style="display:none " name="count" value="<?=$_GET['count'] ?>">
<input type="hidden"  name="tname" value="<?=$_GET['tname'] ?>">
<input type="text"  name="type" value="<?=$_GET['type'] ?>">
<tr><td><input type="submit" name="sub" value="Go" ></td></tr>
</table>

</form>
</div>
</body>
</html>
