
// mouseover script
// @param なし
// @return なし
$(function imgOver() {
    $('img, input:image').each(function() {
        var node = this;
        if(node.src.match("_off.")) {
            node.originalSrc = node.src;
            node.temporarySrc = node.originalSrc.replace(/_off/,'');
            node.rolloverSrc = node.temporarySrc.replace(/(\.gif|\.jpg|\.png)/,'_on'+"$1");
            node.activeSrc = node.temporarySrc.replace(/(\.gif|\.jpg|\.png)/,'_active'+"$1");
            //画像のプリロード処理開始
            preloadImage(node.rolloverSrc);
            //Mouseover
            node.onmouseover = function() {
                if(this.className!='active') {
                    this.src = this.rolloverSrc;
                }
            }
            //Mouseout
            node.onmouseout = function() {
                if(this.className!='active') {
                    this.src = this.originalSrc;
                }
            }
        }
    });
});


// 画像のプリロードを行う関数
// @param string 画像のパス
// @return なし
preloadImages = [];
preloadImage = function(path) {
    var pre = preloadImages;
    var len = pre.length;
    pre[len] = new Image();
    pre[len].src = path;
}

//submitNo
$(function submitNo() {
    $(document).on("keypress", "input:not(.allow_submit)", function(event) {
      return event.which !== 13;
    });
});

//slide
$(function SlideSrc() {
	$("#TOPBX .contentbox .srcbox .srcin.flt .btn a").live("click",function(){
		$(this).parents(".srcin").removeClass("flt");
		$(this).parent(".btn").hide();
		return false;
	});
});

$(function SlideNav() {
	$(".nav").hide();
	$('header .headin .menu a').click(function () {
	    if($(this).parents(".headin").next(".nav").is(":hidden")){
	    	$(this).parents(".headin").next(".nav").show();
	    	$(this).html('<img src="/callcenter/images/btn_header_menu_on.png" alt="menu" />');
	    	$("body").append('<div class="sp_menupopbg" style="background:#000;position:fixed;z-index:100;opacity:0.7;height:100%;width:100%;left:0;top:0;"></div>');
		}else{
	    	$(this).parents(".headin").next(".nav").hide();
	    	$(this).html('<img src="/callcenter/images/btn_header_menu_off.png" alt="menu" />');
	    	$(".sp_menupopbg").remove();
		}
		return false;
	});
});


$(function Gnavi() {
	$("nav ul .btnbx .list").hide();
	$('nav ul li').hover(function () {
	    if($(this).children("ul").is(":hidden")){
	    	$(this).children("ul").fadeIn();
	    	$(this).addClass("on");
		}
	},function(){
	    $(this).children("ul").fadeOut();
	    $(this).removeClass("on");
	});
});

$(function SlideSrcTop() {
	$("#TOPBX .contentbox .sp_selctbx .slct2 .listbx").hide();
	$('#TOPBX .contentbox .sp_selctbx .slct2 .tla a').live("click",function () {
	    if($(this).parents(".tla").next(".listbx").is(":hidden")){
	    	$(this).parents(".tla").next(".listbx").slideDown(100);
	    	$(this).addClass("on");
		}else{
	    	$(this).parents(".tla").next(".listbx").slideUp(100);
		    $(this).removeClass("on");
		}
		return false;
	});
	$("#SRCBX .searchbox .srclistbox .areabox .sp_selctbx .slct2 .listbx").hide();
	$('#SRCBX .searchbox .srclistbox .areabox .sp_selctbx .slct2 .tla a').live("click",function () {
	    if($(this).parents(".tla").next(".listbx").is(":hidden")){
	    	$(this).parents(".tla").next(".listbx").slideDown(100);
	    	$(this).addClass("on");
		}else{
	    	$(this).parents(".tla").next(".listbx").slideUp(100);
		    $(this).removeClass("on");
		}
		return false;
	});
});

$(function SlideDt() {
	$('#SRCBX .searchbox .relatebox .relatein .tbbx dl dt').live("click",function () {
	    if($(this).next("dd").is(":hidden")){
	    	$(this).next("dd").slideDown(100);
	    	$(this).addClass("on");
		}else{
	    	$(this).next("dd").slideUp(100);
		    $(this).removeClass("on");
		}
		return false;
	});
});

$(function SlideQa() {
	$("#FAQBX .qabox .qain .qact").hide();
	$('#FAQBX .qabox .qain .qa_q a').click(function () {
	    if($(this).parents(".qa_q").next(".qact").is(":hidden")){
	    	$(this).parents(".qa_q").next(".qact").slideDown(100);
		}else{
	    	$(this).parents(".qa_q").next(".qact").slideUp(100);
		}
		return false;
	});
});

$(function SlideKaigo() {
	$("#KGOBX .kaigobox .det_txtbox .txtbox .txtin .txtct").hide();
	$("#KGOBX .kaigobox .det_txtbox .txtbox .txtin.ft .txtct").show();
	$("#KGOBX .kaigobox .det_txtbox .txtbox .txtin.ft h3 a").addClass("on");
	$('#KGOBX .kaigobox .det_txtbox .txtbox .txtin .com_pc a').click(function () {
	    if($(this).parents(".com_pc").next(".com_sp").next(".txtct").is(":hidden")){
	    	$(this).parents(".com_pc").next(".com_sp").next(".txtct").slideDown(100);
	    	$(this).addClass("on");
		}else{
	    	$(this).parents(".com_pc").next(".com_sp").next(".txtct").slideUp(100);
		    $(this).removeClass("on");
		}
		return false;
	});
	$('#KGOBX .kaigobox .det_txtbox .txtbox .txtin .com_sp a').click(function () {
	    if($(this).parents(".com_sp").next(".txtct").is(":hidden")){
	    	$(this).parents(".com_sp").next(".txtct").slideDown(100);
	    	$(this).addClass("on");
		}else{
	    	$(this).parents(".com_sp").next(".txtct").slideUp(100);
		    $(this).removeClass("on");
		}
		return false;
	});
});

$(function SlideQa2() {
	$('#FAQBX .qabox .toglbox ul .open a').click(function () {
	    if($("#FAQBX .qabox .qain .qact").is(":hidden")){
	    	$("#FAQBX .qabox .qain .qact").slideDown(100);
		}
		return false;
	});
	$('#FAQBX .qabox .toglbox ul .close a').click(function () {
	    $("#FAQBX .qabox .qain .qact").slideUp(100);
	});
});

$(function SlideFooter() {
	$('.sp_footer .footin .tgl_bx .tgl_ttl').click(function () {
	    if($(this).next(".tgl_in").is(":hidden")){
	    	$(this).next(".tgl_in").slideDown(100);
	    	$(this).addClass("on");
		}else{
	    	$(this).next(".tgl_in").slideUp(100);
		    $(this).removeClass("on");
		}
		return false;
	});
});


$(function TabFnc() {

	$('#TOPBX .contentbox .searchbox .tabbx ul li a').each(function() {
		$(this).live("click",function(){
			var tab = this.parentNode;
			var idName = tab.id;
			$("#TOPBX .contentbox .searchbox .areabox .areain").each(function() {
				$(this).hide();
			});
			$('#TOPBX .contentbox .searchbox .areabox .areain.'+idName).fadeIn();
			$('#TOPBX .contentbox .searchbox .tabbx ul li').each(function() {
				$(this).removeClass('on');
			});
			
			$('#TOPBX .contentbox .searchbox .tabbx ul li img').each(function() {
				var img = $(this).attr("src");
				img = img.replace(/_act/,'_off');
				$(this).attr("src",img);
			    $(this).removeClass("active");
			});
			
			$('#TOPBX .contentbox .searchbox .tabbx ul li#'+idName+'').each(function() {
				var img = $(this).find("img").attr("src");
				img = img.replace(/_on/,'_act');
				img = img.replace(/_off/,'_act');
				$(this).find("img").attr("src",img);
				$(this).find("img").addClass("active");
				$(this).addClass('on');
			});

			return false;
		});
		$('#TOPBX .contentbox .searchbox .tabbx ul li img').live("mouseover",function(){
			var img = $(this).attr("src");
			img = img.replace(/_off/,'_on');
			$(this).attr("src",img);
		});
		$('#TOPBX .contentbox .searchbox .tabbx ul li img').live("mouseout",function(){
			var img = $(this).attr("src");
			img = img.replace(/_on/,'_off');
			$(this).attr("src",img);
		});
	});
});

$(function pagetop() {
	$('.com_pagetop a').click(function () {
		$(this).blur();

		if (window.opera)
		{
			$('html').animate({ scrollTop: 0 }, 'fast');
		}else{
			$('html,body').animate({ scrollTop: 0 }, 'fast');
		}
		return false;
	});
});

$(function() {
	var topBtn = $('.com_pagetop');	
	topBtn.hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			topBtn.fadeIn();
		} else {
			topBtn.fadeOut();
		}
	});
});

$(function anker(){
	$(".anklnkjs a[href^=#]").click(function() {
		var myHref= $(this).attr("href");
		var myPos = $(myHref).offset().top;
		
		$("body,html").animate({scrollTop : myPos}, 800);
		return false;
	});
});

//フッターもっと見る
$(function footerSp(){
	$(".sp_footer .morebox .btn a").click(function() {
		if($(this).parents(".morebox").next(".linkbox").is(":hidden")){
    		$(this).parents(".morebox").next(".linkbox").slideDown();
    		$(this).parent(".btn").addClass("on");
    		$(this).children("span").text("閉じる");
		} else {
    		$(this).parents(".morebox").next(".linkbox").slideUp();
    		$(this).parent(".btn").removeClass("on");
    		$(this).children("span").text("もっと見る");
		}
		
		return false;
	});
});

//スマホヘッダー
$(function HeaderSp(){
    var top = 0;
    var sd = 0;

	var top = $(window).scrollTop();
		
	if(top > 0){
	   $(".headin").addClass("scl");
	} else {
	   $(".headin").removeClass("scl");
	}
			
    $(window).scroll(
    	function() {
    		top = $(window).scrollTop();
     		
			if(top > 0){
			   $(".headin").addClass("scl");
			} else {
			   $(".headin").removeClass("scl");
			}

    	}
   	);  
});


//ブックマーク
$(function BookMark(){
    var userAgent = window.navigator.userAgent.toLowerCase();
    if (userAgent.indexOf("msie") > -1) {
         $("#Sidebox .bookmark").show();
    }
    if (userAgent.indexOf("trident/7.0") > -1) {
         $("#Sidebox .bookmark").show();
    }
});