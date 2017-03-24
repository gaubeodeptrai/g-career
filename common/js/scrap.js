
function scrap(favcheckid,node){
	if(favcheckid=='') {
		return false;
	}
	var btnimg =$(node);
	btnimg.replaceWith('<img src="/callcenter/images/btn_src_list_add.png" alt="検討中BOXへ追加済み" >');

	var myD = new Date();
	var myYear    = myD.getYear();
	var myYear4   = (myYear < 2000) ? myYear+1900 : myYear;
	var keep_date = myYear4 + "-" + (myD.getMonth() + 1) + "-" + myD.getDate();
	var fav = "";
	fav = $.cookie('favlist');
	
	if(fav==null) {
		fav = favcheckid+","+keep_date;
	} else {
		fav = favcheckid+","+keep_date+"|"+fav;
	}
	
	$.cookie('favlist', fav,{ path: '/callcenter/' ,expires: 30 });
}

function scrapDet(favcheckid,node){
	if(favcheckid=='') {
		return false;
	}
	var btnimg =$(node);
	btnimg.replaceWith('<img src="/callcenter/images/btn_src_review.png" alt="検討中BOXへ追加済み" >');

	var myD = new Date();
	var myYear    = myD.getYear();
	var myYear4   = (myYear < 2000) ? myYear+1900 : myYear;
	var keep_date = myYear4 + "-" + (myD.getMonth() + 1) + "-" + myD.getDate();
	var fav = "";
	fav = $.cookie('favlist');
	
	if(fav==null) {
		fav = favcheckid+","+keep_date;
	} else {
		fav = favcheckid+","+keep_date+"|"+fav;
	}
	
	$.cookie('favlist', fav,{ path: '/callcenter/' ,expires: 30 });
}
function scrapSp(favcheckid,node){
	if(favcheckid=='') {
		return false;
	}
	var btnimg =$(node);
	btnimg.replaceWith('<span class="no"><span>検討中BOXへ追加済み</span></span>');

	var myD = new Date();
	var myYear    = myD.getYear();
	var myYear4   = (myYear < 2000) ? myYear+1900 : myYear;
	var keep_date = myYear4 + "-" + (myD.getMonth() + 1) + "-" + myD.getDate();
	var fav = "";
	fav = $.cookie('favlist');
	console.log(myD);
	console.log(fav);
	if(fav == null) {
		fav = favcheckid + "," + keep_date;
	} else {
		fav = favcheckid+","+keep_date+"|"+fav;
	}
	
	$.cookie('favlist', fav,{ path: '/callcenter/' ,expires: 30 });

}

function detailScrapSp(favcheckid,node){
	if(favcheckid=='') {
		return false;
	}
	//検討中BOX追加⇔済ボタン切替・検討中BOXへのリンク
	var $this = $(node);
	var $target= $('#detail a.save_btn');
	var currentParam = $this.attr('data-prm');
	var dataType = $this.attr('data-type');
	var dataStatus = $this.attr('data-status');
	var sameParam = '[data-prm="' + currentParam + '"]';
	var saveType = '[data-type="' + dataType + '"]';
	var $sameObj = $target.filter(saveType + sameParam);
	
	if ($sameObj.length){
		if (dataStatus === 'off') {
			$sameObj.parent('p').addClass('on');
			$sameObj.parent('p').removeClass('off');
			$sameObj.parent('p').after('<p class="scrap"><a href="/callcenter/scrap/"><span>検討中BOX</span></a></p>');
			$sameObj.html('<span>検討中BOXに追加済<span>クリックで削除</span></span>');
			$sameObj.attr('data-status', 'on');
			
			var myD = new Date();
			var myYear    = myD.getYear();
			var myYear4   = (myYear < 2000) ? myYear+1900 : myYear;
			var keep_date = myYear4 + "-" + (myD.getMonth() + 1) + "-" + myD.getDate();
			var fav = "";
			fav = $.cookie('favlist');
			if(fav == null) {
				fav = favcheckid + "," + keep_date;
			} else {
				fav = favcheckid+","+keep_date+"|"+fav;
			}
			$.cookie('favlist', fav,{ path: '/callcenter/' ,expires: 30 });
		}
		else if (dataStatus === 'on') {
			$sameObj.parent('p').addClass('off');
			$sameObj.parent('p').removeClass('on');
			$sameObj.parent('p').next('p.scrap').remove();
			$sameObj.html('<span>検討中BOXへ追加</span>');
			$sameObj.attr('data-status', 'off');
			
			var setIdData = Array();
			var setDateData = Array();
			var setData = '';
			var cookieData = $.cookie('favlist');
			if(cookieData!='') {
				//それぞれのCookieに分離
				var cookies = cookieData.split('|');
				//それぞれのCookie内で、求人ID、Cookie設定日に分離
				for(var i = 0, len = cookies.length; i < len; i++) {
					var data = cookies[i];
					var dataArray = data.split(',');
					//求人ID
					var workId = dataArray[0];
					var date = dataArray[1];
					if(workId != favcheckid) {
						setIdData.push(workId);
						setDateData.push(date);
					}
				}
				//再度Cookieを設定
				for(n = 0, len = setIdData.length; n < len; n++) {
					if(setIdData[n] != '' && setDateData[n] != '') {
						setData+=setIdData[n]+','+setDateData[n];
						if(n!=len-1) {
							setData+='|';
						}
					}
				}
				$.cookie('favlist', setData,{ expires: 30, path: '/callcenter/'});
			}
		}
	}
//ここまで
}


//複数選択された場合に検討中から削除
$(function deleteSelected(){
	$("#delAll").live("click",function(){
			$('#SRCBX .listbox .listin .ttlbx .tl input.pc').each(function() {
			if($(this).prop('checked')==1) {
				var targetId = $(this).val();
				deleteScrap(targetId);
			}
		});
		loaction.href="/scrap/";
		return false;
	});
});

//検討中から削除
$(function scrapDelBtn(){
	$("#SRCBX .listbox a.scrapDelBtn").live("click",function(){
	    var id = $(this).parents(".listin").prop("id");
	    id = id.replace(/work/,'');
		deleteScrap(id);
		loaction.href="/scrap/";
		return false;
	});
});


function deleteScrap(favcheckId,node) {
	var setIdData = Array();
	var setDateData = Array();
	var setData = '';
	
	var cookieData = $.cookie('favlist');
	if(cookieData!='') {
		//それぞれのCookieに分離
		var cookies = cookieData.split('|');
		//それぞれのCookie内で、求人ID、Cookie設定日に分離
		for(var i=0,len=cookies.length; i<len; i++) {
			var data = cookies[i];
			var dataArray = data.split(',');
			//求人ID
			var workId = dataArray[0];
			var date = dataArray[1];
			if(workId!=favcheckId) {
				setIdData.push(workId);
				setDateData.push(date);
			}
		}
		//再度Cookieを設定
		for(n=0,len=setIdData.length; n<len; n++) {
			if(setIdData[n]!='' && setDateData[n]!='') {
				setData+=setIdData[n]+','+setDateData[n];
				if(n!=len-1) {
					setData+='|';
				}
			}
		}
		$.cookie('favlist', setData,{ expires: 45, path: '/callcenter/'});
		
		//該当ブロックをフェードアウト
		$('#work'+favcheckId).fadeOut(500);
	}
}

//全てのチェックボックスにチェックを入れる
$(function checkAll(){
	$("#checkAll").live("click",function(){
		$('#SRCBX .listbox .listin .ttlbx .tl input').each(function() {
			$(this).prop('checked', 'checked');
		});
		$("#nocheckAll").prev("input").prop('checked', '');
	});
});

//全てのチェックボックスのチェックを外す
$(function nocheckAll(){
	$("#nocheckAll").live("click",function(){
		$('#SRCBX .listbox .listin .ttlbx .tl input').each(function() {
			$(this).prop('checked', '');
		});
		$("#checkAll").prev("input").prop('checked', '');
	});

});