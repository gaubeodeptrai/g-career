$(function search(){

    $(".formSubmitBtn").click(function(){

        var url = '';
        var prm = '';

        //エリア
        var pref = "";
        var nm = 1;
        $(this).parents("form").find("input[name='pref[]']").each(function(){

              if(pref==""){
                   pref += "pref-";
              }
              if(nm!="1"){
                   pref += "-";
              }
              pref+= $(this).val();
              nm++;
        });
        
        if(pref!=""){
            url += "/"+pref;
        }


        //市区町村
        if($("#pop_city_all").is(":checked")){
        } else {
        
            var city = "";
            var nm = 1;
            $(this).parents("form").find("input[name='city[]']").each(function(){

                  if(city==""){
                       city += "city-";
                  }
                  if(nm!="1"){
                       city += "-";
                  }
                  city+= $(this).val();
                  nm++;
            });
        
            if(city!=""){
                url += "/"+city;
            }
        }
        
        //路線
        var line = "";
        var nm = 1;
        $(this).parents("form").find("input[name='line[]']").each(function(){

              if(line==""){
                   line += "line-";
              }
              if(nm!="1"){
                   line += "-";
              }
              line+= $(this).val();
              nm++;
        });
        
        if(line!=""){
            url += "/"+line;
        }
        
        //駅
        var sta = "";
        var nm = 1;
        $(this).parents("form").find("input[name='sta[]']").each(function(){

              if(sta==""){
                   sta += "sta-";
              }
              if(nm!="1"){
                   sta += "-";
              }
              sta+= $(this).val();
              nm++;
        });
        
        if(sta!=""){
            url += "/"+sta;
        }

        //業種
        var ind = "";
        var nm = 1;
        $(this).parents("form").find("input[name='ind[]']").each(function(){

              if(ind==""){
                   ind += "ind-";
              }
              if(nm!="1"){
                   ind += "-";
              }
              ind+= $(this).val();
              nm++;
        });
        
        if(ind!=""){
            url += "/"+ind;
        }
                
        //職種
        var cate = "";
        var nm = 1;
        $(this).parents("form").find("input[name='cate[]']").each(function(){

              if(cate==""){
                   cate += "cate-";
              }
              if(nm!="1"){
                   cate += "-";
              }
              cate+= $(this).val();
              nm++;
        });
        
        if(cate!=""){
            url += "/"+cate;
        }

        //雇用形態
        var type = "";
        var nm = 1;
        $(this).parents("form").find("input[name='type[]']").each(function(){

             if($(this).is(":checked")){
                  if(type==""){
                       type += "type-";
                  }
                  if(nm!="1"){
                       type += "-";
                  }
                  type += $(this).val();
                  nm++;
             }
        });
        
        if(type!=""){
            url += "/"+type;
        }

        //給与
        var salary = "";
        var nm = 1;
        $(this).parents("form").find("select[name='salary']").each(function(){

              if(salary==""){
                   salary += "salary-";
              }
              if(nm!="1"){
                   salary += "-";
              }
              salary+= $(this).val();
              nm++;
        });
        
        if(salary!="salary-"){
            url += "/"+salary;
        }
        
        //勤務日
        var day = "";
        var nm = 1;
        $(this).parents("form").find("input[name='day[]']").each(function(){

              if(day==""){
                   day += "day-";
              }
              if(nm!="1"){
                   day += "-";
              }
              day+= $(this).val();
              nm++;
        });

        if(day!=""){
            url += "/"+day;
        }
        

        //特長
        var fea = "";
        var nm = 1;
        $(this).parents("form").find("input[name='fea[]']").each(function(){

              if(fea==""){
                   fea += "fea-";
              }
              if(nm!="1"){
                   fea += "-";
              }
              fea+= $(this).val();
              nm++;
        });
                
        if(fea!=""){
            url += "/"+fea;
        }
        
        //フリーワード
        var word = "";
        $(this).parents("form").find("input[name='word']").each(function(){

            word = $(this).val();
            
            if(word!=""){
                word = "word-"+word;
                word = encodeURIComponent(word);
                word = word.replace(/%2F/g,"%252F");
                word = word.replace(/%2f/g,"%252f");
            }
        });

        if(word!=""){
            url += "/"+word;
        }
        
        
        var hrefurl = "/callcenter/search"+url+"/"+prm;
        location.href = hrefurl;
        
        return false;
    });
    
});

$(function popup(){
	
	//SHOW
	$(".searchbox .src_tpbx .btn a").live("click",function(){
		
    	var pos = $("#Contents").offset().top;
    	pos2 = pos+100;
    	$("#OverLayer").css("top",pos2+"px");
		window.scroll(0,pos);

		var id = $(this).attr("href");
		$("#GlayLayer , #OverLayer, "+id).fadeIn();
		return false;
	});

	//HIDE
	$("#OverLayer .popbox .tpbx .close a").click(function(){
		$("#GlayLayer,#OverLayer,#OverLayer .popbox").fadeOut();
		var pos = $("#Contents").offset().top;
		window.scroll(0,pos);
		return false;
	});

    $("#OverLayer input[name='all']").live("click",function(){
        if($(this).is(":checked")){
            $(this).parents(".sltin").find("input").each(function(){
                $(this).parents(".sltin").find("input").prop("checked","checked");
            });
        } else {
            $(this).parents(".sltin").find("input").each(function(){
                $(this).parents(".sltin").find("input").prop("checked","");
            });
        }
    });
    $("#OverLayer .sltin ul li input").live("click",function(){
        if($(this).is(":checked")){
        } else {
            $(this).parents(".sltin").find(".all").find("input[name='all']").prop("checked","");
        }
    });
    
	$("#OverLayer .popbox .sltbox .btn a").live("click",function(){
		if($(this).is(".station")){
		    var error = 0;
		    $(this).parents(".sltbox").find(".sta").find("li").each(function(){
		        if($(this).find("input").is(":checked")){
		            error = 1;
		        }
		    });
		    if(error==0){
		        alert("駅にチェックを入れてください");
		        return false;
		    }
		}
		$("#GlayLayer,#OverLayer,#OverLayer .popbox").fadeOut();
		var pos = $("#Contents").offset().top;
		window.scroll(0,pos);

		var id = $(this).attr("href");
			
		var html = '';
		
		var pref = "";
		var sub = "";
        $(this).parents(".sltbox").find(".pref").find("select").each(function(){
		    if($(this).children("option").is(":selected")){
    		    var label = $(this).children("option:selected").text();
    		    var val = $(this).children("option:selected").prop("value");
    		    var name = $(this).prop("name");

       		    if(val!=""){
			        html += label+'<input type="hidden" value="'+val+'" name="pref[]">'
			        pref = 1;
		        }
		    }
		});
		
		
		var nm = 0;

        if(pref==1 && $("#pop_city_all").is(":checked")){
        } else {
            $(this).parents(".sltbox").find(".sltin").find("li").each(function(){
    		    if($(this).find("input").is(":checked")){

        		    var label = $(this).find("label").find("span").text();
        		    var val = $(this).find("input").val();
        		    var name = $(this).find("input").prop("name");
        		    
        		    if(name=="sta[]"){
        		        label += "駅";
        		    }
        		    if(name!="cmp[]" && name!="line[]"){
        		    
	             		if(nm==0 && pref==1){
	                	    html += "（";
	            		}
	            		
	        		    if(nm!=0){
	        		        html += "、";
	        		    }
	    		        html += label+'<input type="hidden" value="'+val+'" name="'+name+'">'
	    		        nm++;
	    		        
	    		        sub = 1;
    		        
    		        }
    		    }
    		});

    		if(pref==1 && sub==1){
        	    html += ")";
    		}
		
		}
        		
		
		$(id).html(html);
		
		return false;
	});
	
});

$(function ajaxPref() {
	var AJAX = false;
	var param, obj, re;
	var where;
	var pref = "";
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
	    }
	    param += "&ajax_type=1";
	    //alert(param);
	    
	    AJAX.open('POST', '/callcenter/search/index.html'+ param);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#popcity").html(re);
	        }
	    }
	}
	//Field();

	$("#OverLayer .popbox dl.pref select[name='pref[]']").live("change",function(){
	    var val = $(this).val();
    	pref = val;
    	
    	Field();
	});
});

$(function ajaxSta() {
	var AJAX = false;
	var param, obj, re;
	var where;
	var pref = "";
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
	    }
	    param += "&ajax_type=3";
	    //alert(param);
	    
	    AJAX.open('POST', '/callcenter/search/index.html'+ param);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#popline").html(re);
	        }
	    }
	}
	//Field();

	$("#OverLayer .popbox dl.pref select[name='pref_sta[]']").live("change",function(){
	    var val = $(this).val();
    	pref = val;
    	
    	Field();
	});
});

$(function ajaxSta2() {
	var AJAX = false;
	var param, obj, re;
	var where;
	var pref = $("#OverLayer .popbox dl.pref select[name='pref_sta[]']").val();
	var cmp = "";
	var stcmp_all = "";
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
	    }
	    if(cmp!="") {
	        param += "&cmp="+cmp;
	    }
	    if(stcmp_all!="") {
	        param += "&stcmp_all="+stcmp_all;
	    }
	    param += "&ajax_type=3";
	    //alert(param);
	    
	    AJAX.open('POST', '/callcenter/search/index.html'+ param);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#popline").html(re);
	        }
	    }
	}
	//Field();

	$("#OverLayer .popbox input[name='cmp[]'], #OverLayer .popbox input#pop_stcmp_all").live("click",function(){
	    cmp = "";
	    stcmp_all = "";
	    pref = $("#OverLayer .popbox dl.pref select[name='pref_sta[]']").val();
	    $(this).parents(".sltin").find("input[name='cmp[]']").each(function(){
		    if($(this).is(":checked")){
	    	    var val = $(this).val();
	        	if(cmp!=""){
	        	    cmp += "-";
	        	}
	        	cmp += val;
	    	}
    	});
    	if($(this).is("#pop_stcmp_all")){
		    if($(this).is(":checked")){
    	        stcmp_all = 1;
    	    }
    	}
    	
    	Field();
	});
});


$(function ajaxSta3() {
	var AJAX = false;
	var param, obj, re;
	var where;
	var pref = $("#OverLayer .popbox dl.pref select[name='pref_sta[]']").val();
	var cmp = "";
	var line_all = "";
    $("#OverLayer .popbox input[name='cmp[]']").each(function(){
	    if($(this).is(":checked")){
    	    var val = $(this).val();
        	if(cmp!=""){
        	    cmp += "-";
        	}
        	cmp += val;
    	}
	});
	var line = "";
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
	    }
	    if(cmp!="") {
	        param += "&cmp="+cmp;
	    }
	    if(line!="") {
	        param += "&line="+line;
	    }
	    if(line_all!="") {
	        param += "&line_all="+line_all;
	    }
	    param += "&ajax_type=3";
	    //alert(param);
	    
	    AJAX.open('POST', '/callcenter/search/index.html'+ param);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#popline").html(re);
	        }
	    }
	}
	//Field();

	$("#OverLayer .popbox input[name='line[]'], #OverLayer .popbox input#pop_line_all").live("click",function(){
	    line = "";
	    line_all = "";
	    pref = $("#OverLayer .popbox dl.pref select[name='pref_sta[]']").val();
        $("#OverLayer .popbox input[name='cmp[]']").each(function(){
    	    if($(this).is(":checked")){
        	    var val = $(this).val();
            	if(cmp!=""){
            	    cmp += "-";
            	}
            	cmp += val;
        	}
    	});
	    $(this).parents(".sltin").find("input[name='line[]']").each(function(){
		    if($(this).is(":checked")){
	    	    var val = $(this).val();
	        	if(line!=""){
	        	    line += "-";
	        	}
	        	line += val;
	    	}
    	});
    	if($(this).is("#pop_line_all")){
		    if($(this).is(":checked")){
    	        line_all = 1;
    	    }
    	}
    	
    	Field();
	});
});


$(function ajaxSearch() {
	var AJAX = false;
	var param, obj, re;
	var where;
	var pref = "";
	var city = "";
	var pmg_city = "";
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

	var Field2 = function(){

        var url = '';
        var prm = '';

	    prm = '?ajax=1';
	    prm += "&ajax_type=2";
	    
        //エリア
        var pref = "";
        var nm = 1;
        $(".searchbox .src_tpbx input[name='pref[]']").each(function(){

              prefpms = $(this).val();
              
              if(prefpms!=""){
                  if(pref==""){
                       pref += "pref-";
                  }
                  if(nm!="1"){
                       pref += "-";
                  }
                  pref+= prefpms;
                  nm++;
              }
        });
        
        if(pref!=""){
            url += "/"+pref;
        }

        
        if(pmg_city==""){

        var city = "";
        var nm = 1;
        $(".searchbox .src_tpbx input[name='city[]']").each(function(){

              citypms = $(this).val();
              
              if(citypms!=""){
                  if(city==""){
                       city += "city-";
                  }
                  if(nm!="1"){
                       city += "-";
                  }
                  city+= citypms;
                  nm++;
              }
        });
        
        if(city!=""){
            url += "/"+city;
        }

        }


        //駅
        var sta = "";
        var nm = 1;
        $(".searchbox .src_tpbx input[name='sta[]']").each(function(){

              stapms = $(this).val();
              
              if(stapms!=""){
                  if(sta==""){
                       sta += "sta-";
                  }
                  if(nm!="1"){
                       sta += "-";
                  }
                  sta+= stapms;
                  nm++;
              }
        });
        
        if(sta!=""){
            url += "/"+sta;
        }

        //業種
        var ind = "";
        var nm = 1;
        $(".searchbox .src_tpbx input[name='ind[]']").each(function(){

              indpms = $(this).val();
              
              if(indpms!=""){
                  if(ind==""){
                       ind += "ind-";
                  }
                  if(nm!="1"){
                       ind += "-";
                  }
                  ind+= indpms;
                  nm++;
              }
              
        });
        if(ind!=""){
            url += "/"+ind;
        }
        
        //職種
        var cate = "";
        var nm = 1;
        $(".searchbox .src_tpbx input[name='cate[]']").each(function(){

              catepms = $(this).val();
              
              if(catepms!=""){
                  if(cate==""){
                       cate += "cate-";
                  }
                  if(nm!="1"){
                       cate += "-";
                  }
                  cate+= catepms;
                  nm++;
              }
              
        });
        
        if(cate!=""){
            url += "/"+cate;
        }

        //雇用形態
        var type = "";
        var nm = 1;
        $(".searchbox .src_tpbx input[name='type[]']").each(function(){

             if($(this).is(":checked")){
                  if(type==""){
                       type += "type-";
                  }
                  if(nm!="1"){
                       type += "-";
                  }
                  type += $(this).val();
                  nm++;
             }
        });
        
        if(type!=""){
            url += "/"+type;
        }


        //給与
        var salary = "";
        var nm = 1;
        $(".searchbox .src_tpbx select[name='salary']").each(function(){

              if(salary==""){
                   salary += "salary-";
              }
              if(nm!="1"){
                   salary += "-";
              }
              salary+= $(this).val();
              nm++;
              
        });
        
        if(salary!="salary-"){
            url += "/"+salary;
        }
        
        
        //勤務日
        var day = "";
        var nm = 1;
        $(".searchbox .src_tpbx input[name='day[]']").each(function(){

              daypms = $(this).val();
              
              if(daypms!=""){
                  if(day==""){
                       day += "day-";
                  }
                  if(nm!="1"){
                       day += "-";
                  }
                  day+= daypms;
                  nm++;
              }
              
        });
        
        if(day!=""){
            url += "/"+day;
        }

        //特長
        var fea = "";
        var nm = 1;
        $(".searchbox .src_tpbx input[name='fea[]']").each(function(){

              feapms = $(this).val();
              
              if(feapms!=""){
                  if(fea==""){
                       fea += "fea-";
                  }
                  if(nm!="1"){
                       fea += "-";
                  }
                  fea+= feapms;
                  nm++;
              }
              
        });
        
        if(fea!=""){
            url += "/"+fea;
        }
        

        //フリーワード
        var word = "";
        $(".searchbox .src_tpbx input[name='word']").each(function(){

            word = $(this).val();
            
            if(word!=""){
                word = "word-"+word;
                word = encodeURIComponent(word);
                word = word.replace(/%2F/g,"%252F");
                word = word.replace(/%2f/g,"%252f");
            }
        });

        if(word!=""){
            url += "/"+word;
        }
        
        var hrefurl = "/callcenter/search"+url+"/"+prm;

	    //alert(param);
	    
	    AJAX.open('POST', hrefurl);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#count").html(re);
	        }
	    }
	}



	$(".searchbox .src_tpbx input[name='type[]']").live("click",function(){
    	Field2();
	});
	$(".searchbox .src_tpbx select[name='salary']").live("change",function(){
    	Field2();
	});
	$("#OverLayer .popbox .sltbox .btn a").live("click",function(){
    	Field2();
	});

	$(".searchbox .src_tpbx input[name='word']").live("blur",function(){
    	Field2();
	});

	//検索数hover
	$("#SRCBX .searchbox .srclistbox .src_tpbx .btnbox p .hd").hover(function(){
	    $(".formSubmitBtn img").attr("src","/callcenter/images/btn_top_serach_l2_on.png");
	},function(){
	    $(".formSubmitBtn img").attr("src","/callcenter/images/btn_top_serach_l2_off.png");
	});

	//sp_sort
	$("#SRCBX .searchbox  select[name='sort']").change(function(){
	    var val = $(this).find("option:selected").val();
	    location.href = val;
	});
	

});