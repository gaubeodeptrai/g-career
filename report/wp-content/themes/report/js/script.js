
// mouseover script
// @param なし
// @return なし
jQuery(function imgOver($) {
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

jQuery(function SlideNav($) {
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

jQuery(function($){
		$(function(){
			$(".sp_footer .footin .tgl_bx .tgl_ttl").on("click", function() {
				$(this).next('.tgl_in').slideToggle(); 
				$(this).toggleClass("on"); 
			});
		});
});

