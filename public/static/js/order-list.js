function $(obj){
	return document.getElementById(obj);
}
function $C(obj){//返回的是一个类的数组
	return document.getElementsByClassName(obj);
}

function showdetail(obj){
	if(!document.getElementById("hide").style.display){
			document.getElementById("hide").style.display="none";	
	}
	if(document.getElementById("hide").style.display == "none"){
			document.getElementById("hide").style.display="block";					
	}else{
			document.getElementById("hide").style.display="none";
	}	
}

function saveStatus(){
	$("oneStatus").className = "btn btn-info";
	$("oneStatus").value = "处理中";
}
