// JavaScript Document

//prepare the request
var req=false;

function loadreq(){ document.getElementById('loding').style.display="block";
//document.getElementById('l_body').style.background="block";
document.getElementById('loding').bgcolor="#110033";
 
    if(window.XMLHttpRequest && !(window.ActiveXObject)) {
    	try {
			req = new XMLHttpRequest();
        } catch(e) {
			req = false;
        }
    // branch for IE/Windows ActiveX version
    } else if(window.ActiveXObject) {
       	try {
        	req = new ActiveXObject("Msxml2.XMLHTTP");
      	} catch(e) {
        	try {
          		req = new ActiveXObject("Microsoft.XMLHTTP");
        	} catch(e) {
          		req = false;
        	}
		}
    }
return req;
}


//send the request
function getajax(url,id){
loadreq();

req.open("GET",url,true);
req.send("")
//handle response
req.onreadystatechange=function(){
		if(req.readyState==3){
		document.getElementById('loding').style.display="block";
		}
		
		if(req.readyState==4){
			if(req.status==200)
				document.getElementById(id).innerHTML=req.responseText;
			else if(req.status==404)
				document.getElementById(id).innerHTML="File NOT FOUND";
document.getElementById('loding').style.display="none";
document.getElementById('frm2').style.display="none";
document.getElementById('loding').bgcolor="#110033";

		}
		
	}
	
}