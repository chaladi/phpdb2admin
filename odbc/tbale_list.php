<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../styles/style1.css">
<script language="javascript" src="../scripts/ajax.js"></script>
</head>

<body class="white" onload="getajax('table_dis_code.php?load=<?php echo $_GET['load'];?>','list_table')" >

 <div id="search"><input type="text" name="s" id="search-input" onkeyup="getajax('table_dis_code.php?str='+this.value+'&load1=<?php echo $_GET['load'];?>','list_table')" /> </div>
<div id="list_table"></div>

<div id="search_list">
<?php 
for($i=0;$i<count($arry_list);$i++)
{
echo $arry_list[$i]; echo "<br>";
}
?>
</div>

<div id="loding" >
<img  src="../images/ajax-loader.gif">
</div>

<!-- <div id="loding"><img src="../images/ajax-loader.gif" align="middle" /></div> -->
</body>
</html>

