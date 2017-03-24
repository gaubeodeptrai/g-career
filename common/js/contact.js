$(function city() {
	var AJAX = false;
	var param, obj, re;
	var where;
	var pref = "";
	var city = "";
	var html = "";
    var host =  "http://"+location.hostname;
	//alert(host);

	if(window.XMLHttpRequest) {
	    // Firefox, Opera など
	    AJAX = new XMLHttpRequest();
	    //ajax.overrideMimeType('text/xml');
	} else if(window.ActiveXObject) {
	    // IE
	    try {
	        AJAX = new ActiveXObject('Msxml2.XMLHTTP');
	    } catch (e) {
	        AJAX = new ActiveXObject('Microsoft.XMLHTTP');
	    }
	}
	
	var Field = function(){
	    param = '?ajax=1';
	    if(pref!="") {
	        param += "&pref="+pref;
	        param += "&city="+city;
	        param += "&html="+3;
	    }
	    
	    AJAX.open('POST', '/callcenter/ajax/city.html'+ param);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#city").html(re);
	        }
	    }
	}

	$("select[name='prefecture']").change(function(){
	    var val = $(this).children("option:selected").text();
    	pref = val;
    	Field();
	});
	
});


$(function zip() {
	var AJAX = false;
	var param, obj, re;
	var where;
	var zip = "";
	var html = "";
    var host =  "http://"+location.hostname;
	//alert(host);

	if(window.XMLHttpRequest) {
	    // Firefox, Opera など
	    AJAX = new XMLHttpRequest();
	    //ajax.overrideMimeType('text/xml');
	} else if(window.ActiveXObject) {
	    // IE
	    try {
	        AJAX = new ActiveXObject('Msxml2.XMLHTTP');
	    } catch (e) {
	        AJAX = new ActiveXObject('Microsoft.XMLHTTP');
	    }
	}
	
	var Field = function(){
	    param = '?ajax=1';
	    if(zip!="") {
	        param += "&zip="+zip;
	        param += "&html="+1;
	    }
	    
	    AJAX.open('POST', '/callcenter/ajax/zip.html'+ param);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#prefectureCity").html(re);
	        }
	    }
	}

	$("a.zipBtn").click(function(){
	    var val1 = $("input[name='zip1']").val();
	    var val2 = $("input[name='zip2']").val();
    	zip = val1+val2;
    	Field();
    	return false;
	});
	
});
