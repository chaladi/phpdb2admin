<?php
/*
echo $_POST['conn'];
echo $_POST['u_name'];
echo $_POST['pass'];
echo $_POST['db_name']; */
///wrinting connection details in .ini file
if(isset($_POST['sub']))
{
		
		$filename = "../params.ini";
		$handle = fopen($filename, "a+");
		 $buffer1 = fread($handle, filesize($filename));
		fclose($handle);

	if($buffer1==NULL)
	{
		
		$fh = fopen("../params.ini", 'w') or die("can't open file");
		$intial_string="[general][config][others]";
		fwrite($fh,$intial_string);
		fclose("../params.ini");
	}
	
	$filename = "../params.ini";
		$handle = fopen($filename, "r");
		echo $buffer = fread($handle, filesize($filename));
		fclose($handle);

		//echo "toltal=".strlen($buffer)."<br>";
		//echo $buffer."<BR>";
		//echo"[general] "."<br>".strlen("[general] ")."<br>";echo "<br>[config]".strlen("[config]")."<br>";echo "<br>[others]".strlen("[others]")."<br>";
		$findme   ='[config]';
		$findme1   ='[others]';
		echo "pos{config}"; echo $pos = strpos($buffer, $findme)."<br>";
		echo "pos{others}";echo $pos = strpos($buffer, $findme1)."<br>";
		
		///
		///string to be concatinate
		$ini_array = parse_ini_file("../params.ini", true);
		$size_arry=sizeof($ini_array['config']);
		$add=$size_arry."[]=\"".$_POST['conn']." \" \n
		".$size_arry."[]=\"".$_POST['u_name']."\"\n
		".$size_arry."[]=\"".$_POST['pass']."\"\n
		".$size_arry."[]=\"".$_POST['db_name']."\"\n	
		".$size_arry."[]=\"".$_POST['dsn_name']."\"\n	
		";
		//
		$frount=substr($buffer,0,$pos);
		$frount=$frount.$add;
		$len=strlen($frount);
		$frount=$frount.substr($buffer,($pos),strlen($buffer));
		
		//echo$frount;
		$fh = fopen("../params.ini", 'w') or die("can't open file");
		fwrite($fh,$frount);
		
		
	}	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../styles/style1.css">
<script language="javascript">
function dis(val)
{

if(document.conn_type.conn.value=="odbc")
{
document.getElementById('dsn').style.display = 'block';
}else{
document.getElementById('dsn').style.display = 'none';
}
}

</script>
</head>

<body style=" background-image:url(../images/rajcopy.jpg);background-repeat:repeat;">
<div class="install">
<?
$ini_array = parse_ini_file("../params.ini", true);

?>
<img src="../images/logo.png" align="middle" />

<form   name="conn_type" action="index2.php"   method="post">
<fieldset>

<legend class="required">Connection Profile</legend>
	<label style="width:115px;">Connection Type :</label>
	<select name="conn" onchange="dis()" style="width:140px;" >
	<option value="pecl" selected="selected"  >PECL</option>
	<option value="odbc" >ODBC</option>
	</select>

	<label   style="width:110px;" >User name :</label>

	<input type="text"  name="u_name"> <br>
	<label  style="width:110px;" >Password :</label>
		<input type="password" name="pass"><br>
	<label style="width:110px;" >DataBase Name :</label>
	
		<input type="text" name="db_name"  /> 
		
		<br />
		<div id="dsn" style="display:none;">
		<label style="width:110px;" >DSN Name :</label>
	
		<input type="text" name="dsn_name"   /><a href="#"> <img title="HELP" style="margin-left:0px;" width="14" height="14" src="../images/Help.png" /></a>
		
		<br /></div>
		<label for="email"  accesskey="e"></label>
		<input type="submit" name="sub" value="GO"><br>
		
</fieldset>

</form>
</div>
</body>
</html>

