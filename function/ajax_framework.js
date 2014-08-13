
/* -------------------------- */
/*   XMLHTTPRequest Enable    */
/* -------------------------- */
function createObject() {
var request_type;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");
} else {
request_type = new XMLHttpRequest();
}
return request_type;
}

var http = createObject();

/* -------------------------- */
/*        OpenPage              */
/* -------------------------- */
function OpenPage(page) {
	
// Set te random number to add to URL request
	
nocache = Math.random();
//http.open('get', 'scan.php?nocache = '+nocache);
window.location.href ='#close';
http.open('get', page+'?cache='+nocache);
http.onreadystatechange =  searchNameqReply;
http.send(null);
}
function searchNameqReply() {
if(http.readyState == 4){
var response = http.responseText;
document.getElementById('center').innerHTML = response;
}
}
//######################Временно
function OpenPage2(page) {
	
	// Set te random number to add to URL request
		
	nocache = Math.random();
	//http.open('get', 'scan.php?nocache = '+nocache);
	window.location.href ='#close';
	http.open('get', page+'?cache='+nocache);
	http.onreadystatechange =  searchNameqReply2;
	http.send(null);
	}
	function searchNameqReply2() {
	if(http.readyState == 4){
	var response = http.responseText;
	document.getElementById('menu').innerHTML = response;
	}
	}
//#####################
	function OpenPage3(page) {
		
		// Set te random number to add to URL request
			
		nocache = Math.random();
		//http.open('get', 'scan.php?nocache = '+nocache);
		window.location.href ='#close';
		http.open('get', page+'?cache='+nocache);
		http.onreadystatechange =  searchNameqReply3;
		http.send(null);
		}
		function searchNameqReply3() {
		if(http.readyState == 4){
		var response = http.responseText;
		document.getElementById('sub-menu').innerHTML = response;
		}
		}	
//######################Временно



function insert_from_form (f_id){	
	//var name = $('#name').val();
	//var name = $('#age').val();
	//var f_id = 'test';
	//$.post("/printer/function/insert.php",{_table:"hw_device",manuf:"test"});
	$.post( "/printer/function/insert.php", $(f_id).serialize() );
	//$.post( "/printer/function/insert.php", $(f_id).serialize(), 
	//		function(data){
	//		$('#center').html(data);
	//		} );
	//alert(f_id);
}

//function post_open_test (f_user,out_id) {
//	var f_url='/printer/user-log.php';
//	$.post( f_url, {_user:f_user}, 
//			function(data){
//			$('#'+out_id).html(data);
//			} );
//
//		}



function post_open (in_id,out_id,f_url) {
	//var f_url='/printer/devices.php';
	//var out_id='center';
	//var in_id='#scan_1';
	//var _post="test";
	//alert($('#'+in_id).serialize());
	$.post( f_url, $('#'+in_id).serialize(), 
			function(data){
			$('#'+out_id).html(data);
			} );

		}


function delete_from(f_id){	
	
	$.post( "/printer/function/delete.php", $(f_id).serialize(), 
	function(data){
	alert ($(f_id).serialize());
	$('#center').html(data);
	} );

}

function ch_check(chk_id,inp_id,off_val){
	//alert(inp_id);
	//var chk_id = 'chkbox';
	if (document.getElementById(chk_id).checked) 
	{document.getElementById(inp_id).value='9999-00-00 00:00:00'}
	
	
	else
	{document.getElementById(inp_id).value=off_val}
	
}

function sh_hide(sh_el,h_el){
	
	//$(\"div.str-sub\").hide();$(\"#str-sub_$row[id]\").show()
	$(h_el).hide();
	$(sh_el).show();
	


	
	
	
}


function f_test (f_id) {
	
	alert('YAY');
	
	
}