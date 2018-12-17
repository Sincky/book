function $(id){//依据id获取element对象
	return document.getElementById(id);
}
function choose(obj){
	if(obj.id==("changepwd")){
		$("AMChangePwd").src="AMChangePwd.html";
	}
	else{
		$("AMChangePwd").src="AMAddAddress.html";
	}
	
}
function onAMCPClick(){
	document.location.href="login.html";
}

   