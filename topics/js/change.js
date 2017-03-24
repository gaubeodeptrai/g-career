<!--
/*
gif1=new Image()
gif2=new Image()
gif1.src="icon1.png"
gif2.src="icon1.png"
NN6IN=0
function change(nobu){
if(!document.all&&!document.getElementById)
return
if (!document.all&&document.getElementById)
	NN6IN=1
	var List=document.getElementById&&!document.all? nobu.target:event.srcElement
	if (List.className=="kaisou"){
		var List2=document.getElementById&&!document.all? List.parentNode.childNodes:List.parentElement.all
		if (List2[2+NN6IN].style.display=="none"){
			List2[0].src="../common/images/jobset.jpg"
			List2[2+NN6IN].style.display=''}
		else{
			List2[0].src="../common/images/jobset.jpg"
			List2[2+NN6IN].style.display="none"
		}
	}
	
}
document.onclick=change
//document.getElementById('app_businessArea').style.display = 'none';
*/
function display(e,o,s){
	if(s){
		if(document.getElementById(e).style.display==''){
			document.getElementById(e).style.display='block';
		}else if(document.getElementById(e).style.display=='block'){
			document.getElementById(e).style.display='none';
		}else{
			document.getElementById(e).style.display='block';
		}
	}else{
		if(o.value==1){
			document.getElementById(e).style.display='block';
		}else{
			document.getElementById(e).style.display='none';	
		}
	}
}

function _EditMode(e){
	if(document.form1.scout_now=="f"){e=false;}
	document.form1.year.disabled=e;
	document.form1.month.disabled=e;
	document.form1.day.disabled=e;
	if(e==true){
		document.form1.year.value=null;
		document.form1.month.value=null;
		document.form1.day.value=null;
	}
}

function ElementCheck(e,o){
	var obj1 = document.getElementById(e);
	var obj  = obj1.getElementsByTagName('input');
	var max  = obj.length;
	var flg  = null;
	if(o.checked==true){flg=true;}
	else{flg=true;}
	for(var i = 0; i < max; i++){
		obj[i].checked=flg;
	}
}
function ElementSubCheck(e,e2,o){
	var obj1 = document.getElementById(e);
	var obj  = obj1.getElementsByTagName('input');
	var target1 = document.getElementById(e2);
	var max  = obj.length;
	var count = 0;
	for(var i = 0; i < max; i++){
		if(obj[i].checked==true){count++;}
	}
	if(count==max){target1.checked=true;}
	else{target1.checked=false;}
}

function CareerCheck(target1,target2,e){
	if(e.checked==true){
		target1.selectedIndex=0;
		target1.disabled=true;
		target2.selectedIndex=0;
		target2.disabled=true;
	}else{
		target1.disabled=false;
		target2.disabled=false;
	}
}

function CareerCheck2(form,target1,target2,e){
	if(e.checked==true){
		document.target1.form.selectedIndex=0;
		document.target1.form.disabled=true;
		document.target2.form.selectedIndex=0;
		document.target2.form.disabled=true;
	}else{
		document.target1.form.disabled=false;
		document.target2.form.disabled=false;
	}
}
//-->