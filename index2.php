<?php
session_start();
if(isset($_POST['login']))
{

$_POST['conn']."<br>";
 $_POST['u_name']."<br>";
 $_POST['pass']."<br>";
 $_POST['db_name']."<br>"; 

$ini_array = parse_ini_file("params.ini", true);
	for($i=0;$i<count($ini_array[config]);$i++)
	{ 

		if($ini_array[config][$i][1]==$_POST['u_name'] && $ini_array[config][$i][2]==$_POST['pass'])
		{
				 $_SESSION['conn']=$_POST['conn'];
				 $_SESSION['u_name']=$_POST['u_name'];
				 $_SESSION['db_name']=$_POST['db_name']; 
				 $_SESSION['dsn_name']=$_POST['dsn_name']; 
				 $_SESSION['pass']=$_POST['pass']; 
			header("location:index.php?conn=".$_SESSION['conn']."");
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles/style1.css">
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

<body style=" background-image:url(images/rajcopy.jpg);background-repeat:repeat;">
<div class="install">
<?php
$ini_array = parse_ini_file("params.ini", true);

$arr_0=array();
$arr_1=array();
$arr_2=array();
$arr_3=array();

	
	for($i=0;$i<count($ini_array[config]);$i++)
		$arr_0[$i]=$ini_array[config][$i][0];
		$result0=array_unique($arr_0);
	for($i=0;$i<count($ini_array[config]);$i++)
		$arr_1[$i]=$ini_array[config][$i][1];
		$result1=array_unique($arr_1);
	for($i=0;$i<count($ini_array[config]);$i++)
		$arr_2[$i]=$ini_array[config][$i][2];
		$result2=array_unique($arr_2);
	for($i=0;$i<count($ini_array[config]);$i++)
		$arr_3[$i]=$ini_array[config][$i][3];
		$result3=array_unique($arr_3);
	for($i=0;$i<count($ini_array[config]);$i++){
		$arr_4[$i]=$ini_array[config][$i][4];}
		$result4=array_unique($arr_4);	

?>

<img src="images/logo.png" align="middle" />

<form   name="conn_type" action="index2.php"   method="post">
<fieldset>
<legend class="required">Connection Profile</legend>
	<label style="width:115px;">Connection Type :</label>
	<select name="conn" onchange="dis()" style="width:140px;" >
	<option value="pecl" selected="selected" >PECL</option>
	<option value="odbc" >ODBC</option>
	</select>
			

	<label   style="width:115px;" >User name :</label>
<select name="u_name"  style="width:140px;" >
<?php
for($i=0;$i<count($result1);$i++)
{
?>
<option value="<?=$result1[$i]?>" ><?=$result1[$i]?></option>
<?php
}
?>
</select>
	<!-- <input type="text"  name="u_name"> --> <br>
	<label  style="width:115px;" >Password :</label>
		<input type="password" name="pass" style="width:140px;"><br>
	<label style="width:115px;" >DataBase Name :</label>
<select name="db_name"  style="width:140px;" >
<?php
for($i=0;$i<count($result3);$i++)
{
?>
<option value="<?=$result3[$i]?>" ><?=$result3[$i]?></option>
<?php
}
?>
</select>

		<!-- <input type="text" name="db_name"  />  -->
		
		<br />
		<div id="dsn" style="display:none;">
		<label   style="width:115px;" >DSN Name :</label>
			<select name="dsn_name"  style="width:140px;" >
			<?php
			for($i=0;$i<count($result4);$i++)
			{
			?>
			<option value="<?=$result4[$i]?>" ><?=$result4[$i]?></option>
			<?php
			}
			?>
			</select>
	
		<!-- <input type="text" name="dsn_name" style="width:140px;"   /><a href="#"> <img title="HELP" style="margin-left:0px;" width="14" height="14" src="images/Help.png" /></a> -->
		
		<br /></div>
		<label for="email"  accesskey="e"></label>
		<input type="submit" name="login" value="Login"><!--<a style=" padding-left:10px;color:#990000;font-weight:bold; text-decoration:none;" href="install/index2.php">Register</a> --><br>
		
</fieldset>

</form>
</div>
</body>
</html>

