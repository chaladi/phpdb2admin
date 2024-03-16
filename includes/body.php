

<div id="m_body">
		<table width="950" border="0" cellspacing="0" height="600">
		<tr>
			<td width="250">
					<div style="width:250px;height:55px; display:block; background-image:url(images/header_bg.png);background-repeat:repeat-x; "></div>

						<?
echo $_SESSION['conn'];
						if($_GET['conn']=="pecl")
						{
							  $path="pecl/tbale_list.php"; 
						}else{
							 $path="odbc/tbale_list.php";	
						}
						?>							


					 <div class="left_menu">

						<ul >
							<li style="border-bottom:none;"><a target="left_frame" href="<?php echo $path."?load=TABLE";?>" id="idd1"><span   id="id1" onclick="raj('id1')">TABLES</span></a>
							</li><li><a href="<? echo $path."?load=VIEW";?>" target="left_frame"id="idd2"><span id="id2" onclick="raj('id2')">VIEWS</span></a></li>
							<li><a href="<? echo $path."?load=INDEX";?>"id="idd3"><span id="id3" onclick="raj('id3')">INDEX</span></a></li>
						</ul>

					</div>
					<div id="left">
												<iframe src="<?php echo $path."?load=TABLE";?>" name="left_frame" scrolling="auto" width="250" frameborder="0" height="550"></iframe>	
					</div>
			</td>
			<td width="710">
				<div id="right">
<iframe width="100%" height="630" src="odbc/right_frm.php" name="rframe" frameborder="0" scrolling="auto"></iframe>
					
				</div>	
			</td>	
		</tr>
		</table>
	</div>
