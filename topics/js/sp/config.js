// jQueryMobile 設定
$(document).bind("mobileinit", function(){
	//$.mobile.ajaxLinksEnabled = false; // Ajax を使用したページ遷移を無効にする
	$.mobile.ajaxFormsEnabled = false; // Ajax を使用したフォーム遷移を無効にする
	$.mobile.loadingMessage = "読み込み中"; // ロード中の文字を日本語にする
	$.mobile.page.prototype.options.addBackBtn = true;
	$.mobile.page.prototype.options.backBtnText = "戻る"; // Backボタンを日本語にする
	
});
// その他共通処理
$(function() {
	// ページトップへ
	$('.pageTop a').live('click', function() {
		$(this).blur();
		$('html, body').animate({ scrollTop:0 }, 'normal', 'swing');
		return false;
	});
});