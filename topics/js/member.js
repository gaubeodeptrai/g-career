/*
** ������Ǘ���ʗp�X�N���v�g
*/


/*////////////////////////////// ID�ƃ^�u1���w�肵�ĕҏW�y�[�W��\�� ///*/

//
// id �Ώ�ID
// tab1 �Ώۃ^�u1
//

function tab1Edit(id, tab1) {
	if(isNaN(id)) {
		//���b�Z�[�W��\��
		alert("ID���s���ł��B");
		return false;
	} else {
		//�y�[�W��؂�ւ���
		location.href = "./edit.html?t1="+tab1+"&id="+id;
		return;
	}
}


/*////////////////////////////// �E���o���̕ҏW�y�[�W��\�� ///*/

//
// id �Ώ�ID
// career �ΏېE���o��ID
//

function careerEdit(id, career) {
	if(isNaN(id)) {
		//���b�Z�[�W��\��
		alert("���ID���s���ł��B");
		return false;
	} else if(isNaN(career)) {
		//���b�Z�[�W��\��
		alert("�E���o��ID���s���ł��B");
		return false;
	} else {
		//�y�[�W��؂�ւ���
		location.href = "./edit.html?t1="+"career"+"&id="+id+"&career="+career;
		return;
	}
}


/*////////////////////////////// �E���o���̍폜�y�[�W��\�� ///*/

//
// id �Ώ�ID
// career �ΏېE���o��ID
//

function careerDelt(id, career) {
	if(isNaN(id)) {
		//���b�Z�[�W��\��
		alert("���ID���s���ł��B");
		return false;
	} else if(isNaN(career)) {
		//���b�Z�[�W��\��
		alert("�E���o��ID���s���ł��B");
		return false;
	} else {
		//�y�[�W��؂�ւ���
		location.href = "./career_delt.html?id="+id+"&career="+career;
		return;
	}
}


/*////////////////////////////// �X�֔ԍ�����Z�����擾���A�t�H�[���ɔ��f ///*/

//
// offset �f�B���N�g���I�t�Z�b�g
//

function loadAddress(offset) {
	var zipcode1 = $("zipcode[0]").value;
	var zipcode2 = $("zipcode[1]").value;
	
	if(isNaN(zipcode1) || isNaN(zipcode2)) {
		//���b�Z�[�W��\��
		alert("�X�֔ԍ������������͂���Ă��܂���B");
		return false;
	}
	
	if(!offset) offset = "";
	var url = offset+"getAddress.html";
	var params = "zipcode1="+encodeURIComponent(zipcode1)+"&zipcode2="+encodeURIComponent(zipcode2);
	
	//Ajax���N�G�X�g�I�u�W�F�N�g
	var ajaxObj = new Ajax.Request("../register/"+url, { method: 'post', parameters: params, onSuccess: onSuccess, onFailure: onFailure });
		
	//��M�������̏���
	function onSuccess(ajaxObj) {
		var res = new String();
		
		//�f�[�^��]��
		res = decodeURIComponent(ajaxObj.responseText);
		if(res=='null'){alert("�Z���̎擾�Ɏ��s���܂����B");return false;}
		var data = eval("("+res+")");
		
		//�t�H�[���ɔ��f
		setSelectedOption($("prefecture"), data["prefecture"]);
		updateSelector($("prefecture"), "city", offset+"getCity.html", data["city"]);
		$("address3").value = data["town_name"];
	}
	
	//��M���s���̏���
	function onFailure(ajaxObj) {
		alert("�Z���̎擾�Ɏ��s���܂����B");
	}
	return;
}

function loadAddress2(offset) {
	var zipcode1 = $("zipcode[0]").value;
	var zipcode2 = $("zipcode[1]").value;
	
	if(isNaN(zipcode1) || isNaN(zipcode2)) {
		//���b�Z�[�W��\��
		alert("�X�֔ԍ������������͂���Ă��܂���B");
		return false;
	}
	
	var url = "getAddress.html";
	var params = "zipcode1="+encodeURIComponent(zipcode1)+"&zipcode2="+encodeURIComponent(zipcode2);
	
	//Ajax���N�G�X�g�I�u�W�F�N�g
	var ajaxObj = new Ajax.Request("../../register/"+url, { method: 'post', parameters: params, onSuccess: onSuccess, onFailure: onFailure });
		
	//��M�������̏���
	function onSuccess(ajaxObj) {
		var res = new String();
		
		//�f�[�^��]��
		res = decodeURIComponent(ajaxObj.responseText);
		if(res=='null'){alert("�Z���̎擾�Ɏ��s���܂����B");return false;}
		var data = eval("("+res+")");
		
		//�t�H�[���ɔ��f
		setSelectedOption($("prefecture"), data["prefecture"]);
		updateSelector2($("prefecture"), "city", "getCity.html", data["city"]);
		$("address3").value = data["town_name"];
	}
	
	//��M���s���̏���
	function onFailure(ajaxObj) {
		alert("�Z���̎擾�Ɏ��s���܂����B");
	}
	return;
}


/*////////////////////////////// �Z���N�^�̑I�����ꂽ�I�v�V�������Z�b�g ///*/

//
// selector �Z���N�^�I�u�W�F�N�g
// value �I����Ԃɂ���I�v�V������value�����̒l
//

function setSelectedOption(selector, value) {
	var len = selector.options.length;
	
	for(var i=0 ; i<len ; i++) {
		if(selector.options[i].value==value) {
			selector.selectedIndex = i;
			break;
		}
	}
	return;
}


/*////////////////////////////// �E�������́u�ݐВ��v�`�F�b�N�{�b�N�X ///*/

function switchToSelector() {
	$("to[Year]").disabled = $("to_now").checked;
	$("to[Month]").disabled = $("to_now").checked;
	
	return;
}
