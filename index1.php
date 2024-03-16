<?php
session_start();
if(!isset($_SESSION['u_name']))
{
		if(file_exists("params.ini")){
		//if params.ini file exists...
			header("location:index2.php");
		}else{
			header("location:install/index2.php");
		}
}else{

				 $_SESSION['conn'];
				 $_SESSION['u_name'];
				 $_SESSION['db_name']; 
				 $_SESSION['dsn_name']; 

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PhpDB2Admin</title>
<link rel="stylesheet" type="text/css" href="styles/style1.css">

<script language="javascript" src="scripts/script.js" >

</script>
</head>

<body onload="raj('id1')"><a href="install/signout.php" style="position:absolute; margin-left:250px;">logout</a>
<div id="main">
	<div id="lpanel">
		<div class="logo"><img src="images/logo.png" width="217" /></div>
		<div class="icons" >
		<a href="#" title="HOME"><img src="images/home-24.png" onms /></a>
		<a href="#" title="ABOUT"><img src="images/about.png" height="24" /></a>
		<a href="#" title="HELP"><img src="images/help-icon.png" width="24" height="24" /></a>
		<a href="pecl_old/index.php" title="DB2" target="rframe"><img src="images/db2.jpg" name="" width="24" height="24" /></a>
		</div>
		<?
		if($_SESSION['conn']=="pecl")
		{
			echo $path="pecl/tbale_list.php";	
		}else{
			 echo $path="odbc/tbale_list.php";
		}
		?>	
		<div class="left_menu">
			<ul >
				<li style="border-bottom:none;"><a target="left_frame" href="<?php echo $path."?load=TABLE";?>" id="idd1"><span   id="id1" onclick="raj('id1')">TABLES</span></a>
				</li><li><a href="<? echo $path."?load=VIEW";?>" target="left_frame"id="idd2"><span id="id2" onclick="raj('id2')">VIEWS</span></a></li>
				<li><a href="<? echo $path."?load=INDEX";?>"id="idd3"><span id="id3" onclick="raj('id3')">INDEX</span></a></li>
			</ul>
		</div>
		
		<iframe width="100%" height="600" src="<?php echo $path."?load=TABLE";?>" name="left_frame"  frameborder="0" scrolling="auto"></iframe>
	</div>
	<div id="head">
	
	</div>
	<div id="menu">
		<ul>

			<li class="current"><a href="#" title="">Create table <span>To creating new table.</span></a></li>
			<li><a href="#" title="">Browse<span>We are a great team of people, with lots of fantastic things to offer.</span></a></li>
			<li><a href="#" title="">Insert<span>Our portfolio showcases all the work that we've done for the past few weeks.</span></a></li>
			<li><a href="#" title="">Drop<span>We also love to listen to some tunes while we work. Here we're sharing them with you all!</span></a></li>
			<li><a href="#" title="">Rename Table<span>If you would like to get in touch with us, you can do so here via email or telephone.</span></a></li>
		</ul>
	</div>
	<div id="rpanel">
		<iframe width="100%" height="600" src="" name="rframe" frameborder="0" scrolling="auto"></iframe>
	</div>
</div>

</body>
</html>
