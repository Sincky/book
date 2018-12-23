function summitClick(){
		if (oldOnblur($("oldPwd"))&&pwdOnblur($("newPwd"))&&sureOnblur($("surePwd"))){
			return true;
		}
			return false;
		}
function $(id){//依据id获取element对象
		return document.getElementById(id);
}
function $F(id){//依据id获取element对象的value值
		return document.getElementById(id).value;
}

function oldOnblur(obj){
	obj.placeholder="请输入原密码";
	var pwd=obj.value;
	if(pwd==''){
		$("errOld").innerHTML="原密码输入不能为空";
		$("errOld").className="nospan";
		return false;
	}
	else{
		return true;
	}
}

function pwdOnblur(obj){
		obj.placeholder="请输入新密码";
		var pwd=/^[0-9]{6,12}$/;
		if(pwd.exec(obj.value)){
			$("errNew").innerHTML="符合要求";
			$("errNew").className="okspan";
			return true;
		}	
		else{
			$("errNew").innerHTML="由6-12个数字组成";
			$("errNew").className="nospan";
			return false;
		}	
}

function sureOnblur(obj){
		obj.placeholder="请确认密码";
		var a =$F('newPwd');
		if(obj.value!=a){
			$("errSure").innerHTML="两次密码输入不一致";
			$("errSure").className="nospan";
			return false;
		}
		else{
			$("errSure").innerHTML="两次密码输入一致";
			$("errSure").className="okspan";
			return true;
		}
}
