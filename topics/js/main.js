/*
** 管理者用画面共通スクリプト
*/


/*////////////////////////////// ロールオーバー ///*/

//
// image イメージオブジェクト
//

function rollOver(image) {
	//
	// 画像のファイル名の最後は「0」または「1」にしておくこと。
	//   ～0.***  通常時
	//   ～1.***  ロールオーバー時
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


/*////////////////////////////// 検索フォームの表示・非表示切り替え ///*/

//
// button ボタンオブジェクト
// id 検索フォームを包含する要素のID属性
//

function switchSearchForm(button, id) {
	var display = $(id).style.display;
	
	if(display == "none" || display == "") {
		button.value = "－検索フォームを閉じる";
		document.cookie = "hideForm=0;";
	} else {
		button.value = "＋検索フォームを開く";
		document.cookie = "hideForm=1;";
	}
	
	switchBlock(id);
}


/*////////////////////////////// ブロックを表示・非表示 ///*/

//
// blockId 対象要素のID
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


/*////////////////////////////// フェーズをセットして送信 ///*/

//
// phase フェーズ
//

function setPhase(phase) {
	$("phase").value = phase;
	$("phase").form.submit();
	return;
}


/*////////////////////////////// チェックボックスの状態を反転 ///*/

//
// form フォームオブジェクト
// name 対象チェックボックスのname属性(開始部分)
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


/*////////////////////////////// ウィンドウが閉じているかどうか確認 ///*/

//
// windowObject ウィンドウオブジェクト
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


/*////////////////////////////// セレクタをクリア ///*/

//
// selector セレクタ
//

function clearSelector(selector) {
	var length = selector.length;
	
	for(var i=length ; i>0 ; i--) {
		selector.options[i-1] = null;
	}
	return;
}


/*////////////////////////////// 一覧ページを表示 ///*/

function list() {
	if(true) {
		//ページを切り替える
		location.href = "./list.html";
		return;
	}
}


/*////////////////////////////// 詳細ページを表示 ///*/

//
// id 対象ID
//

function view(id) {
	if(isNaN(id)) {
		//メッセージを表示
		alert("IDが不明です。");
		return false;
	} else {
		//ページを切り替える
		location.href = "./view.html?id="+id;
		return;
	}
}


/*////////////////////////////// 編集ページを表示 ///*/

//
// id 対象ID
//

function edit(id) {
	if(isNaN(id)) {
		//メッセージを表示
		alert("IDが不明です。");
		return false;
	} else {
		//ページを切り替える
		location.href = "./edit.html?id="+id;
		return;
	}
}


/*////////////////////////////// 登録ページを表示 ///*/

//
// id 複製元ID
//

function rgst(id) {
	if(isNaN(id)) {
		//メッセージを表示
		alert("IDが不明です。");
		return false;
	} else {
		//ページを切り替える
		location.href = "./rgst.html?id="+id;
		return;
	}
}


/*////////////////////////////// 削除ページを表示 ///*/

//
// id 対象ID
//

function delt(id) {
	if(isNaN(id)) {
		//メッセージを表示
		alert("IDが不明です。");
		return false;
	} else {
		//ページを切り替える
		location.href = "./delt.html?id="+id;
		return;
	}
}


/*////////////////////////////// 親セレクタ選択で子セレクタを更新 ///*/

//
// parent 親セレクタオブジェクト
// childId 子セレクタのID属性
// url 取得URL
//

function updateSelector(parent, childId, url, childValue) {
	var parentId = parent.value;
	var params = "id="+encodeURIComponent(parentId);
	
	//Ajaxリクエストオブジェクト
	var ajaxObj = new Ajax.Request("../register/"+url, { method: 'post', parameters: params, onSuccess: onSuccess, onFailure: onFailure });
		
	//受信成功時の処理
	function onSuccess(ajaxObj) {
		var res = new String();
		
		//データを評価
		res = decodeURIComponent(ajaxObj.responseText);
		var data = eval("("+res+")");
		
		//子セレクタをクリア
		clearSelector($(childId));
		
		//子セレクタを更新
		$(childId).options[0] = new Option("選択して下さい", "");
		if(data!=null) {
			//子セレクタにオプションを追加
			for(var i=0 ; i<data.length ; i++) {
				$(childId).options[$(childId).length] = new Option(data[i]["name"], data[i]["id"]);
			}
		}
		
		//子セレクタの選択状態
		if(childValue!=undefined) setSelectedOption($(childId), childValue);
	}
	
	//受信失敗時の処理
	function onFailure(ajaxObj) {
		alert("リストの取得に失敗しました。");
	}
	return true;
}

function updateSelector2(parent, childId, url, childValue) {
	var parentId = parent.value;
	var params = "id="+encodeURIComponent(parentId);
	
	//Ajaxリクエストオブジェクト
	var ajaxObj = new Ajax.Request("../../register/"+url, { method: 'post', parameters: params, onSuccess: onSuccess, onFailure: onFailure });
		
	//受信成功時の処理
	function onSuccess(ajaxObj) {
		var res = new String();
		
		//データを評価
		res = decodeURIComponent(ajaxObj.responseText);
		var data = eval("("+res+")");
		
		//子セレクタをクリア
		clearSelector($(childId));
		
		//子セレクタを更新
		$(childId).options[0] = new Option("選択して下さい", "");
		if(data!=null) {
			//子セレクタにオプションを追加
			for(var i=0 ; i<data.length ; i++) {
				$(childId).options[$(childId).length] = new Option(data[i]["name"], data[i]["id"]);
			}
		}
		
		//子セレクタの選択状態
		if(childValue!=undefined) setSelectedOption($(childId), childValue);
	}
	
	//受信失敗時の処理
	function onFailure(ajaxObj) {
		alert("リストの取得に失敗しました。");
	}
	return true;
}

/*////////////////////////////// 駅選択画面ポップアップ ///*/

//
// offset ディレクトリオフセット
// stationNo 対象の駅ナンバー
//

function selectStation(offset, stationNo) {
	var selectStationWindow = new Object();
	var url = offset+"selectStation.html?stationNo="+encodeURIComponent(stationNo);
	
	//駅選択ウィンドウをポップアップ表示
	if(windowClosed(selectStationWindow)) {
		selectStationWindow = window.open(url, "selectStation","width=600,height=600,scrollbars=yes,lacation=no,menubar=no,resizable=yes,status=no,toolbar=no,directories=no");
	} else {
		selectStationWindow.location.href=url;
	}
	selectStationWindow.focus();
}


/*////////////////////////////// 駅をセット ///*/

//
// stationId 駅ID
// railroadName 沿線名
// stationName 駅名
// stationNo 対象の駅ナンバー
//   

function setStation(stationId, railroadName, stationName, stationNo) {
	
	//駅名の表示を更新
	opener.$("stationName["+stationNo+"]").innerHTML = railroadName+" "+stationName;
	
	//ボタンを更新
	opener.$("selectStationButton["+stationNo+"]").className = "button hide";
	opener.$("clearStationButton["+stationNo+"]").className = "button";
	
	//フォームの値を更新
	opener.$("station["+stationNo+"]").value = stationId;
	
	//ウィンドウを閉じる
	window.close();
	
}


/*////////////////////////////// 駅選択をクリア ///*/

//
// stationNo 対象の駅ナンバー
//

function clearStation(stationNo) {
	
	//駅名の表示を更新
	$("stationName["+stationNo+"]").innerHTML = "選択して下さい";
	
	//ボタンを更新
	$("selectStationButton["+stationNo+"]").className = "button";
	$("clearStationButton["+stationNo+"]").className = "button hide";
	
	//フォームの値を更新
	$("station["+stationNo+"]").value = "";
	
	return false;
}
