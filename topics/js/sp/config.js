// jQueryMobile �ݒ�
$(document).bind("mobileinit", function(){
	//$.mobile.ajaxLinksEnabled = false; // Ajax ���g�p�����y�[�W�J�ڂ𖳌��ɂ���
	$.mobile.ajaxFormsEnabled = false; // Ajax ���g�p�����t�H�[���J�ڂ𖳌��ɂ���
	$.mobile.loadingMessage = "�ǂݍ��ݒ�"; // ���[�h���̕�������{��ɂ���
	$.mobile.page.prototype.options.addBackBtn = true;
	$.mobile.page.prototype.options.backBtnText = "�߂�"; // Back�{�^������{��ɂ���
	
});
// ���̑����ʏ���
$(function() {
	// �y�[�W�g�b�v��
	$('.pageTop a').live('click', function() {
		$(this).blur();
		$('html, body').animate({ scrollTop:0 }, 'normal', 'swing');
		return false;
	});
});