<?php
session_start();
include("connection.php");//$dbconn 
//echo $_GET['type'];
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

echo "<div class=\"c_pad\">";
//echo "TABLE NAME:".$_GET['table']."<br>";
//echo $_GET['count'];
$primary_count=0;
$uniquekey_count=0;
if(isset($_GET['sub']))
{ 

		/*echo $_GET['field']."<br>";
		echo $_GET['type']."<br>";     
		echo $_GET['length']."<br>";
		echo $_GET['attributes']."<br>";
		echo $_GET['null']."<br>";
		echo $_GET['deflt']."<br>";
		echo $_GET['extra']."<br>";
		echo $_GET['constrant']."<br>";
		
		echo $_GET['null']."<br>";*/
		$sql="create ".$_GET['type']."  ".$_GET['tname']." ( ";

		
		for($i=1;$i<=$_GET['count'];$i++)
		{			
					$field="field".$i;
					$type="type".$i;
				    $length="length".$i;
					$attributes="attributes".$i;
					$nn="nn".$i;
					$deflt="deflt".$i;
					$extra="extra".$i;
					$constrant="constrant".$i;
					$comments="comments".$i;
					if(isset($_GET[$field])) 
					{
						 $sql=$sql.$_GET[$field]." ";
					}
					if(isset($_GET[$type]))
					{
							if($_GET[$type]=="integer" ||$_GET[$type]=="smallint" || $_GET[$type]=="bigint" || $_GET[$type]=="LONG VARGRAPHIC" || $_GET[$type]=="date" || $_GET[$type]=="float" || $_GET[$type]=="date" || $_GET[$type]=="double" || $_GET[$type]=="real" || $_GET[$type]=="LONG VARCHAR" )
							{
										 $sql=$sql.$_GET[$type]." ";
							} 
							//CHAR VARCHAR  VARGRAPHIC  graphic vargraphic CLOB DBCLOB
							if($_GET[$type]=="CHAR" ||$_GET[$type]=="VARCHAR" ||$_GET[$type]=="VARGRAPHIC" || $_GET[$type]=="graphic" || $_GET[$type]=="vargraphic" || $_GET[$type]=="CLOB" || $_GET[$type]=="DBCLOB" )
							{
								$sql=$sql.$_GET[$type]."(".$_GET[$length].")" ;
							}
							if($_GET[$type]=="DECIMAL" || $_GET[$type]=="numeric")
							{
								$sql=$sql.$_GET[$type]."(".$_GET[$length].",2)" ;
							
							}
					}
					if(isset($_GET[$nn]))
					{
									$sql=$sql.$_GET[$nn]." ";
					}
					if($_GET[$deflt]!=null && $_GET[$nn]=="not null")
					{
						$sql=$sql." with  default '".$_GET[$deflt]."'";
					}else{
						if($_GET[$deflt]!=null)
						{
							 $sql=$sql." default" ;
						}
					}
					if($_GET[$extra]=="auto incriment" && isset($_GET[$nn])=="not null" && $_GET[$constrant]=="primary")
					{
						  $sql=$sql."GENERATED ALWAYS AS IDENTITY";
					}
				
					if($i!=$_GET['count'])
					{
					$sql=$sql.",";
					}
					if(isset($_GET[$constrant]))
					{
						if($_GET[$constrant]=="primary")
						{
							if($primary_count==0)
							{
							 $prime=$_GET[$field];
							 $primary_count++;
							 
							}else{
								$prime=$prime.",".$_GET[$field];
							
							}
						
						}
						if($_GET[$constrant]=="unique")
						{
							if($uniquekey_count==0)
							{
							 $unque=$_GET[$field];
							 $uniquekey_count++;
							 
							}else{
								echo "<br> this is else part";
								$unque=$unque.",".$_GET[$field];
							
							}
						
						}
					}
					
			}
			if($primary_count!=0)
			{
			$prime_q="primary key(".$prime.")";
			$sql=$sql.",".$prime_q;
			}
			if($uniquekey_count!=0)
			{
			$unique_q="unique(".$unque.")";
			$sql=$sql.",".$unique_q;
			}
			
$sql=$sql.")";

//echo "<br>".$unque;
///connecting to database


		odbc_exec($dbconn,$sql) or die();
		//echo "<h3>TABLE IS <span style=\"color:#0066FF;\">".$_GET['table']."</span> CREATED </h3>";
// ending..
echo "<div class=\"sql\">";
echo $sql."<br>";
echo "</div>";
echo "<h3> Table ".$_GET['tname']." is created</h3>";
?>
</div>
</body>
</html>
<?
}
else
{
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
//include("../includes/menu.php");
?>
<div class="c_pad">
<!-- <a href="table_name_input.php">NEW TABLE</a>&nbsp;&nbsp;<a href="brwose.php?table_name=<?=$_GET['tname']?>">BROWSE</a>&nbsp;&nbsp;<a href="insert.php?tname=<?=$_GET['tname']?>">INSERT</a>&nbsp;&nbsp;<a href="drop.php?tname=<?=$_GET['tname']?>">DROP</a>&nbsp;&nbsp;<a href="rename_table.php?tname=<?=$_GET['tname']?>">Rename Table</a> 
 -->
<form name="table_form" action="create_table_from.php" method="get">
<table border="0" cellspacing="0">

<tr>
<th>Field</th>
<th>Type</th>
<th>Length/Values</th>
<!-- <th>Collation</th>
<th>Attributes</th> -->
<th>Null</th>
<th>Default2</th>
<th>Extra</th>
<th>Primary</th>
<th>Index</th>
<th>Unique</th>
<th>---</th>
<!-- <th>Comments</th> -->
</tr>
<? for($i=1;$i<=$_GET['count'];$i++) {
$field="field".$i;
$type="type".$i;
$length="length".$i;
$attributes="attributes".$i;
$nn="nn".$i;
$deflt="deflt".$i;
$extra="extra".$i;
$constrant="constrant".$i;
$comments="comments".$i;
?>
<tr>
<td align="center"><input type="text" style="width:100px;" name="<?=$field?>"/></td>
<td align="center"><select  name="<?=$type?>">
<option value="integer">INTERGER</option>
<option value="smallint">SMALLINT</option>
<option value="bigint">BIGINT</option>
<option value="date">DATE</option>
<option value="DECIMAL">DECIMAL</option>
<option value="numeric">NUMERIC</option>
<option value="CHAR">CHAR</option>
<option value="float">FLOAT</option>
<option value="double">DOUBLE</option>
<option value="real">REAL</option>
<option value="VARCHAR">VARCHAR</option>
<option value="LONG VARCHAR ">	LONG VARCHAR </option>
<option value="CLOB">	CLOB</option>
<option value="DBCLOB">DBCLOB</option>
<option value="graphic">GRAPHIC</option>
<option value="vargraphic">VARGRAPHIC</option>
<option value="LONG VARGRAPHIC">LONG VARGRAPHIC</option>
<option value="LONG VARCHAR">LONG VARCHAR</option>
</select></td>
<td align="center"><input style="width:50px;" type="text"  name="<?=$length?>"/></td>
<!-- <td align="center"><select name=""></select></td>
<td align="center"><select name="<?=$attributes?>">
<option value=""></option>
<option value="unsigned">unsigned</option>
<option value="unsignedzerofill">unsignedzerofill</option>
<option value="on update current_timestamp">on update current_timestamp</option>
<option value=""></option>
</select></td> -->
<td align="center"><select name="<?=$nn?>">
<option value=""> </option>
<option value="null">NULL</option>
<option value="not null">NOT NULL</option>
</select></td>
<td align="center"><input type="text" style="width:100px;" value="" name="<?=$deflt?>" /></td>
<td align="center"><select name="<?=$extra?>">
<option value=""></option>
<option value="auto incriment">AUTO INCRIMENT</option>

</select> </td>

<td align="center"><input type="radio" value="primary" name="<?=$constrant?>" /></td>
<td align="center"><input type="radio" value="index" name="<?=$constrant?>" /></td>
<td align="center"><input type="radio" value="unique" name="<?=$constrant?>" /></td>
<td align="center"><input type="radio" name="<?=$constrant?>" /></td>
<!-- <td align="center"><input type="text" value="" name="<?=$comments?>"/></td> -->
</tr>
<?  }?>
<input type="text" style="display:none " name="count" value="<?=$_GET['count'] ?>">
<input type="text" style="display:none " name="tname" value="<?=$_GET['tname'] ?>">
<input type="text" style="display:none " name="type" value="<?=$_GET['type'] ?>">
<tr><td align="center"><input type="submit" name="sub" value="Create"></td></tr>
</table>

</form>
</div>
</body>
</html>
<? }?>