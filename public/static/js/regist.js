
function summitClick(){
	if (nameOnblur($("name"))&&pwdOnblur($("pwd"))&&emailOnblur($("email"))&&telOnblur($("tel"))){
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
function nameOnblur(obj){

	obj.placeholder="请输入用户名称";
	var namevalue=obj.value.trim();

	var txt = new RegExp("[\u4e00-\u9fa5_a-zA-Z0-9_]{2,12}")
	
	if(txt.test(namevalue)){
		$("errName").innerHTML="符合要求";//js控制样式的切换 
		$("errName").className="okspan";
		return true;
	}
	else{
		$("errName").innerHTML="由2-10个汉字、字母、数字或_组成";
		$("errName").className="nospan";
		return false;
	}
}
function emailOnblur(obj){
	obj.placeholder="请输入邮箱"
	if(obj.value==''){
		$("errEmail").innerHTML="邮箱不能为空";
		$("errEmail").className="nospan"
		return false;
	}
	return true;
}
function pwdOnblur(obj){
	obj.placeholder="请输入密码";
	var pwd=/^[0-9]{6,12}$/;
	if(pwd.exec(obj.value)){
		$("errPwd").innerHTML="符合要求";
		$("errPwd").className="okspan"
			return true;
	}	
	else{
		$("errPwd").innerHTML="由6-12个数字组成";
		$("errPwd").className="nospan";
		return false;
	}	
}

function telOnblur(obj){
	obj.placeholder="请输入电话号码";
	var tel=/^[0-9]{6,12}$/;
	if(tel.exec(obj.value)){
		$("errTel").innerHTML="符合要求";//js控制样式的切换 
		$("errTel").className="okspan";
		return true;
	}
	else{
		$("errTel").innerHTML="由11位数字组成";
		$("errTel").className="nospan";
		return false;
	}
}