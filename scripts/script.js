// JavaScript Document

function raj(iidd)
{

		for(i=1;i<=3;i++)
		{
		var iid="id"+i;
		var idd="idd"+i;
			if(iid==iidd)
			{			
				
			document.getElementById(iid).style.backgroundImage = "url(images/l_menu_onclick.gif)";
			document.getElementById(idd).style.backgroundImage = "url(images/l_menu_onclick.gif)";
			}else{
					document.getElementById(iid).style.backgroundImage = "url(images/r_def_img.gif)";
					document.getElementById(idd).style.backgroundImage="url(images/sel_glowtab-left.gif)";
				}
		}
}
