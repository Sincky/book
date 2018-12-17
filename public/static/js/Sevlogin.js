function $(obj){
	return document.getElementById(obj);
}

function SevtoIndex(){
	if($("name").value =="admin" && $("passw").value == "admin"){
		window.document.location.href="Serindex.html";
		alert("登陆成功");
	}else{
		alert("登陆失败");
	}
	
}
