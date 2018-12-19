function onnewLogin(){
	window.location.href="{:url('Login/login')}";
}
function summitClick(){
	if (  (nameOnblur($("name"))) &&(pwdOnblur($("pwd")))   ){
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
//	var name=$("name");
//	name.placeholder="请输入用户名称";
	obj.placeholder="请输入用户名称";
	var namevalue=obj.value.trim();
//	var txt=new RegExp(/^\w*$/);//使用正则表达式来进行字符串的匹配
	var txt=new RegExp(/^\w{6,12}$/);
//	alert(txt.test(namevalue));//通过test函数匹配namevalue
	//\w 0-9a-zA-Z-   ^以什么开头，$以什么结尾 \w{6,12} 6-12个字符
//	if(namevalue==""){
//		alert(111);
//	}
	if(txt.test(namevalue)){
		$("errName").innerHTML="符合要求";//js控制样式的切换 
		$("errName").className="okspan";
		return true;
	}
	else{
		$("errName").innerHTML="6-12个字符";
		$("errName").className="nospan";
		return false;
	}
}
function pwdOnblur(obj){
	obj.placeholder="请输入密码";
	var pwd=new RegExp(/\d{5,10}/);
	if(pwd.test(obj.value)){
		$("errPwd").innerHTML="符合要求";
		$("errPwd").className="okspan"
		return true;
	}
	else{
		$("errPwd").innerHTML="密码5-10位数字";
		$("errPwd").className="nospan";
		return false;
	}
}