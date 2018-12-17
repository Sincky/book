function $(id){//依据id获取element对象
	return document.getElementById(id);
}
function $F(id){//依据id获取element对象中的value值
	return document.getElementById(id).value;
}
function nameOnblur(obj){//传入this对象
//	var name=$("name");//document.getElementById(id);
//	name.placeholder="请输入用户名";
//	$("name").placeholder="请输入用户名";
//	obj.placeholder="书名";
//	alert(obj.placeholder);
//	alert(obj.value)

	var namevalue=obj.value;
	var txt = new RegExp(/^\w{1,20}$/);//使用正则表达式来进行字符串的匹配
//	alert(txt.test(namevalue));//txt对象 通过test函数匹配namevalue
//  \w 0-9a-zA-Z ^以  为开头  $以 为结尾  \w{6,12}
	if(txt.test(namevalue)){
//		alert(11);
		$("errName").innerHTML="符合要求";//js控制样式的切换 html css js
		$("errName").className="okSpan";

	}else{
		$("errName").innerHTML="1-20个字符";
		$("errName").className="noSpan";
	}

}

function allClick(obj){
	var bl=obj.checked;
	var lists=document.getElementsByClassName("checkInput");
	for(i in lists){
		lists[i].checked=obj.cheecked;
	}
//	alert(bl);
}
