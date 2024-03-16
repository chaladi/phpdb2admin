<?php
session_start();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//Dth XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dth/xhtml1-transitional.dth">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title><link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>

<body>
<?php
include("../includes/menu.php");
?>
<?php
session_start();
include("connection.php");//$dbconn 
//$_GET['table'];
//$_GET['count'];
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
		echo $_GET['null']."<br>";
		
		ALTER TABLE EMPLOYEE
     ADD COLUMN HEIGHT MEASURE   DEFAULT MEASURE(1)
     ADD COLUMN BIRTHDAY BIRTHDATE DEFAULT DATE('01-01-1850')

		*/
		$sql="ALTER ".$_GET['type']."  ".$_GET['table']." ";

		
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
					$sql=$sql."ADD COLUMN ";
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
									$sql=" ".$sql.$_GET[$nn]." ";
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
						  $sql=$sql." GENERATED ALWAYS AS IDENTITY";
					}
				
					if($i!=$_GET['count'])
					{
					$sql=$sql." ";
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
								
								$unque=$unque.",".$_GET[$field];
							
							}
						
						}
					}
					
			}
			if($primary_count!=0)
			{
			$prime_q=" ADD PRIMARY KEY(".$prime.")";
			$sql=$sql." ".$prime_q;
			}
			if($uniquekey_count!=0)
			{
			$unique_q="unique(".$unque.")";
			$sql=$sql." ".$unique_q;
			}
			

 $sql_print=$sql."<br>";//echo "<br>".$unque;
///connecting to database


	odbc_exec($dbconn,$sql) or die();

// ending..
}

?>
<div class="c_pad">
<div class="sql">
<?php echo $sql_print; ?>

</div>
<?php
if(isset($sql_print))
{
echo "One column is created";
}
?>
<form name="table_form" action="add_columns.php" method="get">
<table border="0" cellspacing="0">

<tr>
<th>Field</th>
<th>Type</th>
<th>Length/Values</th>
<!--<th>Collation</th>
<th>Attributes</th> -->
<th>Null</th>
<th>Default2</th>
<th>Extra</th>
<th>Primary</th>
<th>Index</th>
<th>Unique</th>
<th>---</th>
<!--<th>Comments</th> -->
</tr>
<?php for($i=1;$i<=$_GET['count'];$i++) {
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
<td><input type="text" style="width:100px;" name="<? echo $field;?>"/></td>
<td><select  name="<? echo $type;?>">
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
<td><input style="width:50px;" type="text"  name="<? echo $length ;?>"/></td>
<!--<td><select name=""></select></td>
<td><select name="<? echo $attributes;?>">
<option value=""></option>
<option value="unsigned">unsigned</option>
<option value="unsignedzerofill">unsignedzerofill</option>
<option value="on update current_timestamp">on update current_timestamp</option>
<option value=""></option>
</select></td> -->
<td><select name="<? echo $nn;?>">
<option value=""> </option>
<option value="null">NULL</option>
<option value="not null">NOT NULL</option>
</select></td>
<td><input type="text" style="width:100px;" value="" name="<? echo $deflt;?>" /></td>
<td><select name="<? echo $extra;?>">
<option value=""></option>
<option value="auto incriment">AUTO INCRIMENT</option>

</select> </td>

<td><input type="radio" value="primary" name="<? echo $constrant;?>" /></td>
<td><input type="radio" value="index" name="<? echo $constrant;?>" /></td>
<td><input type="radio" value="unique" name="<? echo $constrant;?>" /></td>
<td><input type="radio" name="<?=$constrant?>" /></td>
<!--<td><input type="text" value="" name="<?=$comments?>"/></td> -->
</tr>
<?php  }?>
<input type="text" style="display:none " name="count" value="<? echo $_GET['count']; ?>">
<input type="text" style="display:none " name="table" value="<? echo $_GET['table']; ?>">
<input type="text" style="display:none " name="type" value="<? echo $_GET['type']; ?>">
<tr><td><input type="submit" name="sub" ></td></tr>
</table>

</form>
