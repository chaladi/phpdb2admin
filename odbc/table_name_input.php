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
<div class="c_pad">
<form name="tname" action="create_table_from.php"  method="get" >
Table Name <input type="text" name="tname"/> Number of fields<input type="text" name="count" /> 
<input type="hidden" name="type" value="<?=$_GET['type']?>" />
<input type="submit" name="sub_tname" value="Go" />
</form></div>
</body>
</html>
