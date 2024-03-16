<?php
session_start();
include("connection.php");
if(isset($_POST['Submit']))
		{

		 $on=$_FILES['f']['name'];
		 $tn=$_FILES['f']['tmp_name'];
		$d="../works/".$on;
		move_uploaded_file($tn,$d);
		$link="Location:back_up/".$_POST['format']."/export.php?tname=".$_POST['tname']."&fname=".$on;
		header($link);
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
//echo $_GET['tname'];

?>
<div class="c_pad">
<form name="frm1" method="post"  enctype="multipart/form-data"  action="export.php">
		<table>
			<tr><td>File format</td><td><input type="radio" name="format" value="csv">.CSV&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="format" value="exl_csv">.EXl-CSV&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="format" value="xls">.XLS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="format" value="xml">.XML</td></tr>
		  <!--<tr><td>Upload File </td><td><input type="file" name="f" /></td></tr> -->
		  <input type="hidden" name="tname" value="<?=$_GET['tname']?>" >
		
		  <tr><td>&nbsp;</td><td colspan="2" ><input type="submit"  name="Submit"  value="Export"></td></tr>
		  
		  
		</table></form></div>
</body>
</html>

