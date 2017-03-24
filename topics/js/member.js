/*
** 会員情報管理画面用スクリプト
*/


/*////////////////////////////// IDとタブ1を指定して編集ページを表示 ///*/

//
// id 対象ID
// tab1 対象タブ1
//

function tab1Edit(id, tab1) {
	if(isNaN(id)) {
		//メッセージを表示
		alert("IDが不明です。");
		return false;
	} else {
		//ページを切り替える
		location.href = "./edit.html?t1="+tab1+"&id="+id;
		return;
	}
}


/*////////////////////////////// 職務経歴の編集ページを表示 ///*/

//
// id 対象ID
// career 対象職務経歴ID
//

function careerEdit(id, career) {
	if(isNaN(id)) {
		//メッセージを表示
		alert("会員IDが不明です。");
		return false;
	} else if(isNaN(career)) {
		//メッセージを表示
		alert("職務経歴IDが不明です。");
		return false;
	} else {
		//ページを切り替える
		location.href = "./edit.html?t1="+"career"+"&id="+id+"&career="+career;
		return;
	}
}


/*////////////////////////////// 職務経歴の削除ページを表示 ///*/

//
// id 対象ID
// career 対象職務経歴ID
//

function careerDelt(id, career) {
	if(isNaN(id)) {
		//メッセージを表示
		alert("会員IDが不明です。");
		return false;
	} else if(isNaN(career)) {
		//メッセージを表示
		alert("職務経歴IDが不明です。");
		return false;
	} else {
		//ページを切り替える
		location.href = "./career_delt.html?id="+id+"&career="+career;
		return;
	}
}


/*////////////////////////////// 郵便番号から住所を取得し、フォームに反映 ///*/

//
// offset ディレクトリオフセット
//

function loadAddress(offset) {
	var zipcode1 = $("zipcode[0]").value;
	var zipcode2 = $("zipcode[1]").value;
	
	if(isNaN(zipcode1) || isNaN(zipcode2)) {
		//メッセージを表示
		alert("郵便番号が正しく入力されていません。");
		return false;
	}
	
	if(!offset) offset = "";
	var url = offset+"getAddress.html";
	var params = "zipcode1="+encodeURIComponent(zipcode1)+"&zipcode2="+encodeURIComponent(zipcode2);
	
	//Ajaxリクエストオブジェクト
	var ajaxObj = new Ajax.Request("../register/"+url, { method: 'post', parameters: params, onSuccess: onSuccess, onFailure: onFailure });
		
	//受信成功時の処理
	function onSuccess(ajaxObj) {
		var res = new String();
		
		//データを評価
		res = decodeURIComponent(ajaxObj.responseText);
		if(res=='null'){alert("住所の取得に失敗しました。");return false;}
		var data = eval("("+res+")");
		
		//フォームに反映
		setSelectedOption($("prefecture"), data["prefecture"]);
		updateSelector($("prefecture"), "city", offset+"getCity.html", data["city"]);
		$("address3").value = data["town_name"];
	}
	
	//受信失敗時の処理
	function onFailure(ajaxObj) {
		alert("住所の取得に失敗しました。");
	}
	return;
}

function loadAddress2(offset) {
	var zipcode1 = $("zipcode[0]").value;
	var zipcode2 = $("zipcode[1]").value;
	
	if(isNaN(zipcode1) || isNaN(zipcode2)) {
		//メッセージを表示
		alert("郵便番号が正しく入力されていません。");
		return false;
	}
	
	var url = "getAddress.html";
	var params = "zipcode1="+encodeURIComponent(zipcode1)+"&zipcode2="+encodeURIComponent(zipcode2);
	
	//Ajaxリクエストオブジェクト
	var ajaxObj = new Ajax.Request("../../register/"+url, { method: 'post', parameters: params, onSuccess: onSuccess, onFailure: onFailure });
		
	//受信成功時の処理
	function onSuccess(ajaxObj) {
		var res = new String();
		
		//データを評価
		res = decodeURIComponent(ajaxObj.responseText);
		if(res=='null'){alert("住所の取得に失敗しました。");return false;}
		var data = eval("("+res+")");
		
		//フォームに反映
		setSelectedOption($("prefecture"), data["prefecture"]);
		updateSelector2($("prefecture"), "city", "getCity.html", data["city"]);
		$("address3").value = data["town_name"];
	}
	
	//受信失敗時の処理
	function onFailure(ajaxObj) {
		alert("住所の取得に失敗しました。");
	}
	return;
}


/*////////////////////////////// セレクタの選択されたオプションをセット ///*/

//
// selector セレクタオブジェクト
// value 選択状態にするオプションのvalue属性の値
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


/*////////////////////////////// 職務履歴の「在籍中」チェックボックス ///*/

function switchToSelector() {
	$("to[Year]").disabled = $("to_now").checked;
	$("to[Month]").disabled = $("to_now").checked;
	
	return;
}
