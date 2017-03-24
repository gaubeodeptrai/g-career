

$(function search(){

    $(".formSubmitBtnPref").live("click",function(){

        var url = '';
        var prm = '';

        //エリア
        var area = "";
        var nm = 1;
        $(this).parents("form").find("select[name='area']").each(function(){

              area = $(this).val();
              
         });
        
        if(area!=""){
            url += "/area-"+area;
        }
        
        var hrefurl = "/callcenter/prefecture"+url+"/"+prm;
        location.href = hrefurl;
        
        return false;
    });

    $(".formSubmitBtnPref2").live("click",function(){

        var url = '';
        var prm = '';

        //エリア
        var area = "";
        var nm = 1;
        $(this).parents("form").find("select[name='area']").each(function(){

              area = $(this).val();
              
         });
        
        if(area!=""){
            url += "/line-"+area;
        }
        
        var hrefurl = "/callcenter/prefecture"+url+"/"+prm;
        location.href = hrefurl;
        
        return false;
    });
        
    $(".formSubmitBtnLine").live("click",function(){

        var url = '';
        var prm = '';

        var word = "";
        $(this).parents("form").find("input[name='lineword']").each(function(){

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
        
        if(word==""){
            alert("路線・駅名を入力してください");
            return false;
        }
        
        var hrefurl = "/callcenter/linesta"+url+"/"+prm;
        location.href = hrefurl;
        
        return false;
    });
    
    $(".formSubmitBtnWord").live("click",function(){

        var url = '';
        var prm = '';

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


    $(".formSubmitBtn").live("click",function(){

        var url = '';
        var prm = '';

        //エリア
        var pref = "";
        var nm = 1;
        $(this).parents("form").find("select[name='pref[]']").each(function(){

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

        var city = "";
        var nm = 1;
        $(this).parents("form").find("select[name='city[]']").each(function(){

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

             if($(this).is(":checked")){
                  if(ind==""){
                       ind += "ind-";
                  }
                  if(nm!="1"){
                       ind += "-";
                  }
                  ind += $(this).val();
                  nm++;
             }
        });
        
        if(ind!=""){
            url += "/"+ind;
        }
        
        //職種
        var cate = "";
        var nm = 1;
        $(this).parents("form").find("input[name='cate[]']").each(function(){

             if($(this).is(":checked")){
                  if(cate==""){
                       cate += "cate-";
                  }
                  if(nm!="1"){
                       cate += "-";
                  }
                  cate += $(this).val();
                  nm++;
             }
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

             if($(this).is(":checked")){
                  if(day==""){
                       day += "day-";
                  }
                  if(nm!="1"){
                       day += "-";
                  }
                  day += $(this).val();
                  nm++;
             }
        });
        
        if(day!=""){
            url += "/"+day;
        }

        //特長
        var fea = "";
        var nm = 1;
        $(this).parents("form").find("input[name='fea[]']").each(function(){

             if($(this).is(":checked")){
                  if(fea==""){
                       fea += "fea-";
                  }
                  if(nm!="1"){
                       fea += "-";
                  }
                  fea += $(this).val();
                  nm++;
             }
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


$(function ajaxSearch() {
	var AJAX = false;
	var param, obj, re;
	var where;
	var pref = "";
	var city = "";
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
	    if(city!="") {
	        param += "&city="+city;
	    }
	    param += "&ajax_type=1";
	    //alert(param);
	    
	    AJAX.open('POST', '/callcenter/index.html'+ param);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#searchbox").html(re);
	        }
	    }
	}
	//Field();

	$("#searchbox select[name='pref[]']").live("change",function(){
	    var val = $(this).val();
    	pref = val;

    	city = "";
    	
    	Field();
	});
	$("#searchbox select[name='city[]']").live("change",function(){
	    
	    var val = $("#searchbox select[name='pref[]']").val();
    	pref = val;
    	
	    var val = $(this).val();
    	city = val;
    	Field();
	});
});

$(function ajaxSearchSp() {
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
        $("#Searchbox_sp select[name='pref[]']").each(function(){

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
        $("#Searchbox_sp select[name='city[]']").each(function(){

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
        
        
        //路線
        var line = "";
        var nm = 1;
        $("#Searchbox_sp input[name='line[]']").each(function(){

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
        $("#Searchbox_sp input[name='sta[]']").each(function(){

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
        $("#Searchbox_sp input[name='ind[]']").each(function(){

             if($(this).is(":checked")){
                  if(ind==""){
                       ind += "ind-";
                  }
                  if(nm!="1"){
                       ind += "-";
                  }
                  ind += $(this).val();
                  nm++;
             }
             
        });
        if(ind!=""){
            url += "/"+ind;
        }
        
        
        //職種
        var cate = "";
        var nm = 1;
        $("#Searchbox_sp input[name='cate[]']").each(function(){

             if($(this).is(":checked")){
                  if(cate==""){
                       cate += "cate-";
                  }
                  if(nm!="1"){
                       cate += "-";
                  }
                  cate += $(this).val();
                  nm++;
             }
        });
        
        if(cate!=""){
            url += "/"+cate;
        }


        //雇用形態
        var type = "";
        var nm = 1;
        $("#Searchbox_sp input[name='type[]']").each(function(){

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
        $("#Searchbox_sp select[name='salary']").each(function(){
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
        $("#Searchbox_sp input[name='day[]']").each(function(){

             if($(this).is(":checked")){
                  if(day==""){
                       day += "day-";
                  }
                  if(nm!="1"){
                       day += "-";
                  }
                  day += $(this).val();
                  nm++;
             }
        });
        
        if(day!=""){
            url += "/"+day;
        }

        //特長
        var fea = "";
        var nm = 1;
        $("#Searchbox_sp input[name='fea[]']").each(function(){

             if($(this).is(":checked")){
                  if(fea==""){
                       fea += "fea-";
                  }
                  if(nm!="1"){
                       fea += "-";
                  }
                  fea += $(this).val();
                  nm++;
             }
        });
        
        if(fea!=""){
            url += "/"+fea;
        }
        

        //フリーワード
        var word = "";
        $("#Searchbox_sp input[name='word']").each(function(){

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
	            $("#sp_count").html(re);
	        }
	    }
	}

	var DetBtn = function(){

	    if($('.sp_selctbx .btnarea').size()) {
	    
        var top = $(window).scrollTop();
        var pos = $(".contentbox_select").offset().top;
        var btn = $(".sp_selctbx .btnarea").offset().top;
        var hgt = $(window).height();

        btnhgt = btn-hgt;
        if(top>=pos && top<btnhgt){
            $("#TOPBX .contentbox .sp_selctbx .btnbx").addClass("btnbxPos");
        } else {
            $("#TOPBX .contentbox .sp_selctbx .btnbx").removeClass("btnbxPos");
        }
        
        }
	}
	
	Field2();
	
	var Field = function(){
	    param = '?ajax=1';
	    if(pref!="") {
	        param += "&pref="+pref;
	    }
	    if(city!="") {
	        param += "&city="+city;
	    }
	    if(pmg_city!="") {
	        param += "&cityflg=1";
	    }
	    param += "&ajax_type=2";
	    //alert(param);
	    
	    AJAX.open('POST', '/callcenter/index.html'+ param);
	    AJAX.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    AJAX.send(param);
	    AJAX.onreadystatechange = function() {
	        if (AJAX.readyState == 4 && AJAX.status == 200) {
	            re = AJAX.responseText;
	            //$("#loding").hide();
	            re = AJAX.responseText;
	            $("#Searchbox_sp").html(re);
	            Field2();
	            DetBtn();
	        }
	    }
	}
	//Field();

	$("#Searchbox_sp select[name='pref[]']").live("change",function(){
	    var val = $(this).val();
    	pref = val;
    	pmg_city = 1;
    	city = "";
    	
    	Field();
	});
	$("#Searchbox_sp select[name='city[]']").live("change",function(){
	    
	    var val = $("#Searchbox_sp select[name='pref[]']").val();
    	pref = val;
    	pmg_city = "";
	    var val = $(this).val();
    	city = val;
    	Field();
	});


	$("#Searchbox_sp input[name='cate[]'],#Searchbox_sp input[name='ind[]'],#Searchbox_sp input[name='type[]']").live("click",function(){
    	Field2();
	});
	$("#Searchbox_sp input[name='day[]'],#Searchbox_sp input[name='fea[]']").live("click",function(){
    	Field2();
	});
	$("#Searchbox_sp select[name='salary']").live("change",function(){
    	Field2();
	});
	
	$("#Searchbox_sp input[name='word']").live("blur",function(){
    	Field2();
	});
	
    $(window).scroll(function(){
	    DetBtn();
    }); 
});


$(function SlideSrc() {
	$("#searchbox .srcin.flt .srct").each(function(){

		var hght = $(this).find("ul").css("height");
		hght = hght.replace(/px/g,'');
		if(parseInt(hght)<="70"){
			$(this).parents(".srcin").find(".btn").hide();
		} else {
			$(this).parents(".srcin").find(".btn").show();
		}
	});
});

$(function bxSlider2() {
	var w = $(window).width();
	var x = 700
	if (w <= x) {
  if($('#reco_slider').size()) {
  $('#reco_slider').bxSlider({
		controls: true,
		auto: true,
		pause: 8000,
		speed: 1000,
		pager: false,
		minSlides: 1,
		maxSlides: 1,
		moveSlides: 1
  });
  }
	} else {
  if($('#reco_slider').size()) {
  $('#reco_slider').bxSlider({
		controls: true,
		auto: true,
		slideWidth: 240,
		pause: 8000,
		speed: 1000,
		pager: true,
		slideMargin: 60,
		minSlides: 3,
		maxSlides: 3,
		moveSlides: 3
  });
  }
    }
});


$(function flatHeights(){
	var w = $(window).width();
	var x = 700
	if (w > x) {
    var sets = [], temp = [];
    $('#Slidebox .recobox .slidebox ul li .detbox .detin').each(function(i) {
        temp.push(this);
    });
    if (temp.length) sets.push(temp);

    $.each(sets, function() {
        $(this).flatHeights();
    });

	}
});


$(function spAreaSlide(){
    $(".sp_srcbox.area dl dt a").click(function(){
        if($(this).parents("dt").next("dd").is(":hidden")){
             $(this).parents("dt").next("dd").slideDown();
             $(this).addClass("on");
        } else {
             $(this).parents("dt").next("dd").hide();
             $(this).removeClass("on");
        }
        return false;
    });
});