/*
** �Ǘ��җp��ʋ��ʃX�N���v�g
*/


/*////////////////////////////// ���[���I�[�o�[ ///*/

//
// image �C���[�W�I�u�W�F�N�g
//

function rollOver(image) {
	//
	// �摜�̃t�@�C�����̍Ō�́u0�v�܂��́u1�v�ɂ��Ă������ƁB
	//   �`0.***  �ʏ펞
	//   �`1.***  ���[���I�[�o�[��
	//
	var directory = image.src.substring(0, image.src.lastIndexOf("/")+1);
	var imgName = image.src.substring(image.src.lastIndexOf("/")+1, image.src.lastIndexOf(".")-1);
	var ext = image.src.substring(image.src.lastIndexOf("."));
	var flg = image.src.substring(image.src.lastIndexOf(".")-1, image.src.lastIndexOf("."));
	
	if(flg=="0") {
		image.src = directory+imgName+"1"+ext;
	} else if(flg=="1") {
		image.src = directory+imgName+"0"+ext;
	}
}


/*////////////////////////////// �����t�H�[���̕\���E��\���؂�ւ� ///*/

//
// button �{�^���I�u�W�F�N�g
// id �����t�H�[�����܂���v�f��ID����
//

function switchSearchForm(button, id) {
	var display = $(id).style.display;
	
	if(display == "none" || display == "") {
		button.value = "�|�����t�H�[�������";
		document.cookie = "hideForm=0;";
	} else {
		button.value = "�{�����t�H�[�����J��";
		document.cookie = "hideForm=1;";
	}
	
	switchBlock(id);
}


/*////////////////////////////// �u���b�N��\���E��\�� ///*/

//
// blockId �Ώۗv�f��ID
//

function switchBlock(blockId) {
	var blockNode = $(blockId);
	var display = blockNode.style.display;
	
	if(display == "none" || display == "") {
		blockNode.style.display = "block";
	} else {
		blockNode.style.display = "none";
	}
}


/*////////////////////////////// �t�F�[�Y���Z�b�g���đ��M ///*/

//
// phase �t�F�[�Y
//

function setPhase(phase) {
	$("phase").value = phase;
	$("phase").form.submit();
	return;
}


/*////////////////////////////// �`�F�b�N�{�b�N�X�̏�Ԃ𔽓] ///*/

//
// form �t�H�[���I�u�W�F�N�g
// name �Ώۃ`�F�b�N�{�b�N�X��name����(�J�n����)
//

function flipCheck(form, name) {
	var elements = form.elements;
	var elementsNum = elements.length;
	var checkboxes = new Array();
	var i = new Number();
	
	if(elementsNum>0) {
		for(i=0;i<elementsNum;i++) {
			if(elements[i].type == "checkbox" && elements[i].name.indexOf(name)==0) checkboxes[checkboxes.length] = elements[i];
		}
	}
	
	var checkboxesNum = checkboxes.length;
	
	if(checkboxesNum>0) {
		for(i=0;i<checkboxesNum;i++) {
			checkboxes[i].checked = !checkboxes[i].checked;
		}
	}
	return false;
}


/*////////////////////////////// �E�B���h�E�����Ă��邩�ǂ����m�F ///*/

//
// windowObject �E�B���h�E�I�u�W�F�N�g
//

function windowClosed(windowObject) {
	var ua = navigator.userAgent;
	
	if(!windowObject) {
		if(ua.indexOf('MSIE 4')!=-1 && ua.indexOf('Win')!=-1) {
			return windowObject.closed;
		} else {
			return typeof windowObject.document != 'object';
		}
	} else {
		return true;
	}
}


/*////////////////////////////// �Z���N�^���N���A ///*/

//
// selector �Z���N�^
//

function clearSelector(selector) {
	var length = selector.length;
	
	for(var i=length ; i>0 ; i--) {
		selector.options[i-1] = null;
	}
	return;
}


/*////////////////////////////// �ꗗ�y�[�W��\�� ///*/

function list() {
	if(true) {
		//�y�[�W��؂�ւ���
		location.href = "./list.html";
		return;
	}
}


/*////////////////////////////// �ڍ׃y�[�W��\�� ///*/

//
// id �Ώ�ID
//

function view(id) {
	if(isNaN(id)) {
		//���b�Z�[�W��\��
		alert("ID���s���ł��B");
		return false;
	} else {
		//�y�[�W��؂�ւ���
		location.href = "./view.html?id="+id;
		return;
	}
}


/*////////////////////////////// �ҏW�y�[�W��\�� ///*/

//
// id �Ώ�ID
//

function edit(id) {
	if(isNaN(id)) {
		//���b�Z�[�W��\��
		alert("ID���s���ł��B");
		return false;
	} else {
		//�y�[�W��؂�ւ���
		location.href = "./edit.html?id="+id;
		return;
	}
}


/*////////////////////////////// �o�^�y�[�W��\�� ///*/

//
// id ������ID
//

function rgst(id) {
	if(isNaN(id)) {
		//���b�Z�[�W��\��
		alert("ID���s���ł��B");
		return false;
	} else {
		//�y�[�W��؂�ւ���
		location.href = "./rgst.html?id="+id;
		return;
	}
}


/*////////////////////////////// �폜�y�[�W��\�� ///*/

//
// id �Ώ�ID
//

function delt(id) {
	if(isNaN(id)) {
		//���b�Z�[�W��\��
		alert("ID���s���ł��B");
		return false;
	} else {
		//�y�[�W��؂�ւ���
		location.href = "./delt.html?id="+id;
		return;
	}
}


/*////////////////////////////// �e�Z���N�^�I���Ŏq�Z���N�^���X�V ///*/

//
// parent �e�Z���N�^�I�u�W�F�N�g
// childId �q�Z���N�^��ID����
// url �擾URL
//

function updateSelector(parent, childId, url, childValue) {
	var parentId = parent.value;
	var params = "id="+encodeURIComponent(parentId);
	
	//Ajax���N�G�X�g�I�u�W�F�N�g
	var ajaxObj = new Ajax.Request("../register/"+url, { method: 'post', parameters: params, onSuccess: onSuccess, onFailure: onFailure });
		
	//��M�������̏���
	function onSuccess(ajaxObj) {
		var res = new String();
		
		//�f�[�^��]��
		res = decodeURIComponent(ajaxObj.responseText);
		var data = eval("("+res+")");
		
		//�q�Z���N�^���N���A
		clearSelector($(childId));
		
		//�q�Z���N�^���X�V
		$(childId).options[0] = new Option("�I�����ĉ�����", "");
		if(data!=null) {
			//�q�Z���N�^�ɃI�v�V������ǉ�
			for(var i=0 ; i<data.length ; i++) {
				$(childId).options[$(childId).length] = new Option(data[i]["name"], data[i]["id"]);
			}
		}
		
		//�q�Z���N�^�̑I�����
		if(childValue!=undefined) setSelectedOption($(childId), childValue);
	}
	
	//��M���s���̏���
	function onFailure(ajaxObj) {
		alert("���X�g�̎擾�Ɏ��s���܂����B");
	}
	return true;
}

function updateSelector2(parent, childId, url, childValue) {
	var parentId = parent.value;
	var params = "id="+encodeURIComponent(parentId);
	
	//Ajax���N�G�X�g�I�u�W�F�N�g
	var ajaxObj = new Ajax.Request("../../register/"+url, { method: 'post', parameters: params, onSuccess: onSuccess, onFailure: onFailure });
		
	//��M�������̏���
	function onSuccess(ajaxObj) {
		var res = new String();
		
		//�f�[�^��]��
		res = decodeURIComponent(ajaxObj.responseText);
		var data = eval("("+res+")");
		
		//�q�Z���N�^���N���A
		clearSelector($(childId));
		
		//�q�Z���N�^���X�V
		$(childId).options[0] = new Option("�I�����ĉ�����", "");
		if(data!=null) {
			//�q�Z���N�^�ɃI�v�V������ǉ�
			for(var i=0 ; i<data.length ; i++) {
				$(childId).options[$(childId).length] = new Option(data[i]["name"], data[i]["id"]);
			}
		}
		
		//�q�Z���N�^�̑I�����
		if(childValue!=undefined) setSelectedOption($(childId), childValue);
	}
	
	//��M���s���̏���
	function onFailure(ajaxObj) {
		alert("���X�g�̎擾�Ɏ��s���܂����B");
	}
	return true;
}

/*////////////////////////////// �w�I����ʃ|�b�v�A�b�v ///*/

//
// offset �f�B���N�g���I�t�Z�b�g
// stationNo �Ώۂ̉w�i���o�[
//

function selectStation(offset, stationNo) {
	var selectStationWindow = new Object();
	var url = offset+"selectStation.html?stationNo="+encodeURIComponent(stationNo);
	
	//�w�I���E�B���h�E���|�b�v�A�b�v�\��
	if(windowClosed(selectStationWindow)) {
		selectStationWindow = window.open(url, "selectStation","width=600,height=600,scrollbars=yes,lacation=no,menubar=no,resizable=yes,status=no,toolbar=no,directories=no");
	} else {
		selectStationWindow.location.href=url;
	}
	selectStationWindow.focus();
}


/*////////////////////////////// �w���Z�b�g ///*/

//
// stationId �wID
// railroadName ������
// stationName �w��
// stationNo �Ώۂ̉w�i���o�[
//   

function setStation(stationId, railroadName, stationName, stationNo) {
	
	//�w���̕\�����X�V
	opener.$("stationName["+stationNo+"]").innerHTML = railroadName+" "+stationName;
	
	//�{�^�����X�V
	opener.$("selectStationButton["+stationNo+"]").className = "button hide";
	opener.$("clearStationButton["+stationNo+"]").className = "button";
	
	//�t�H�[���̒l���X�V
	opener.$("station["+stationNo+"]").value = stationId;
	
	//�E�B���h�E�����
	window.close();
	
}


/*////////////////////////////// �w�I�����N���A ///*/

//
// stationNo �Ώۂ̉w�i���o�[
//

function clearStation(stationNo) {
	
	//�w���̕\�����X�V
	$("stationName["+stationNo+"]").innerHTML = "�I�����ĉ�����";
	
	//�{�^�����X�V
	$("selectStationButton["+stationNo+"]").className = "button";
	$("clearStationButton["+stationNo+"]").className = "button hide";
	
	//�t�H�[���̒l���X�V
	$("station["+stationNo+"]").value = "";
	
	return false;
}
