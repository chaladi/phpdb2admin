<?php
/*
echo $_POST['conn'];
echo $_POST['u_name'];
echo $_POST['pass'];
echo $_POST['db_name']; */
///wrinting connection details in .ini file
if(isset($_POST['sub']))
{
	$handle = @fopen("../params.ini", "r");
		if ($handle) {
			while (!feof($handle)) {
				$buffer = $buffer.fgets($handle, 4096);
			
			}
			
		}
//
		fclose("../params.ini");

		//echo "toltal=".strlen($buffer)."<br>";
		//echo $buffer."<BR>";
		//echo"[general] "."<br>".strlen("[general] ")."<br>";echo "<br>[config]".strlen("[config]")."<br>";echo "<br>[others]".strlen("[others]")."<br>";
		$findme   ='[config]';
		$findme1   ='[others]';
		 $pos = strpos($buffer, $findme)."<br>";
		$pos = strpos($buffer, $findme1)."<br>";
		
		///
		///string to be concatinate
		$ini_array = parse_ini_file("../params.ini", true);
		$size_arry=sizeof($ini_array['config']);
		$add=$size_arry."[]=\"".$_POST['conn']." \" \n
		".$size_arry."[]=\"".$_POST['u_name']."\"\n
		".$size_arry."[]=\"".$_POST['pass']."\"\n
		".$size_arry."[]=\"".$_POST['db_name']."\"\n	";
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
</head>

<body style=" background-image:url(../images/rajcopy.jpg);background-repeat:repeat;">
<div class="install">
<?
$ini_array = parse_ini_file("../params.ini", true);

?>
<img src="../images/logo.png" align="middle" />

<form   name="conn_type" action="conn_details.php"   method="post">
<fieldset>
<legend class="required">Connection Profile</legend>
	<label   style="width:110px;" >User name :</label>
	<select name="u_name">
	<?
	for($i=0;$i<sizeof($ini_array[config]);$i++)
	{
	?>
	<option value="<?=$ini_array[config][$i][2]?>"><?=$ini_array[config][$i][2]?></option>
	<?
	}
	?>
	</select> <a href="">Add new</a>
		<!--<input type="text"  name="u_name"> --><br>
	<label  style="width:110px;" >Password :</label>
		<input type="password" name="pass"><br>
	<label style="width:110px;" >DataBase Name :</label>
	<select name="db_name">
	<?
	for($i=0;$i<sizeof($ini_array[config]);$i++)
	{
	?>
	<option value="<?=$ini_array[config][$i][3]?>"><?=$ini_array[config][$i][3]?></option>
	<?
	}
	?>
	</select>
		<!--<input type="text" name="db_name"  /> -->
		
		<br />
		<label for="email"  accesskey="e"></label>
		<input type="submit" name="sub" value="Login"><br>
		<input type="text" value="<?=$_POST['conn']?>" name="conn" style="display:none;" />
</fieldset>

</form>
</div>
</body>
</html>

