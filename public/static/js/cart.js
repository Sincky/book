function $(id){//依据id获取element对象
	return document.getElementById(id);
}
function $F(id){//依据id获取element对象中的value值
	return document.getElementById(id).value;
}
function oneClick(obj){//减法的处理
				var inputobj = obj.nextSibling;//查找下一个（兄弟）节点
				if(parseInt(inputobj.value)>1){
					inputobj.value= inputobj.value -1;
				}else{
					alert("该商品选中件数为1，不能继续减少了。");
					return;
				}
				 
				multiply(inputobj,obj);
				
				var itemSuper=obj.parentNode.parentNode;//itemDiv
				var itemChilds=itemSuper.childNodes;
				var price;
				for(i of itemChilds){
					if(i.className=="choseDiv"){
						if(i.childNodes[0].checked==true){
							checkOnclick(i);
						}
					}
				}
				
			}
			function addClick(obj){
				var inputobj=obj.previousSibling;//查找上一个（兄弟）节点
//				var inputobj=obj.previousElementSibling;
//				alert(inputobj.nodeName);
//				alert(inputobj.value);
				inputobj.value =parseInt(inputobj.value) +1;//做类型转换
//				/*-没有重载，+是可以连接字符串的*/
//				inputobj.value =inputobj.value -1+2;
				multiply(inputobj,obj);

				var itemSuper=obj.parentNode.parentNode;//itemDiv
				var itemChilds=itemSuper.childNodes;
				var price;
				for(i of itemChilds){
					if(i.className=="choseDiv"){
						if(i.childNodes[0].checked==true){
							checkOnclick(i);
						}
					}
				}
			}
			
			function multiply(inputobj,obj){
				//获取父节点
				var inputSuper=obj.parentNode;
				var arr=inputSuper.parentNode.childNodes;
				var pricediv;//取值
				var sumdiv;//取p标签的对象
				for(i of arr){
//					if()
					if(i.nodeName=="DIV"){
						if(i.className=="onePriceDiv"){
//							alert(arr[i].childNodes[3].className);//priceDiv
							pricediv=i.childNodes[3].childNodes[0].innerText;
//							alert(pricediv);
						}
						if(i.className=="sumDiv"){
							sumdiv=i.childNodes[0];
						}
					}
				}
				sumdiv.innerHTML=pricediv*inputobj.value;
			}
			
			function addElements(obj){
				var adde=document.getElementById("addItem");
				var superE=adde.parentNode;
//				var newE=adde.cloneNode(true);//传入一个bl值，当为真时，会拷贝全部，FALSE则只会拷贝首节点
				var newE=document.createElement("div");//要传入一个值 标签的名称
				var newD=document.createElement("div");//要传入一个值 标签的名称
				newE.className="itemDiv";
				newD.className="priceDiv";
				superE.appendChild(newD);//append();
				superE.appendChild(newE);//append();
//				alert(adde.parentNode.nodeName);
			}
function deleteItem(obj){
	var deteI=obj.parentNode;
	var itemChilds=deteI.childNodes;
	var num;
	var sum;
	for(i of itemChilds){
		if(i.className=="numberDiv"){
//			alert(i.childNodes[2].value);
			num=i.childNodes[2].value;
		}
		if(i.className=="sumDiv"){
//			alert(i.childNodes[0].innerHTML);
			sum=i.childNodes[0].innerHTML;
		}
	}
	
	for(j of itemChilds){
		if(j.className=="choseDiv"){
//		alert(i.childNodes[0].nodeName);
			if(j.childNodes[0].checked==true){
//				alert(num);
				document.getElementById("piece").value=document.getElementById("piece").value-parseInt(num);
				document.getElementById("piece2").value=document.getElementById("piece2").value-num;
				document.getElementById("amount").value=document.getElementById("amount").value-parseInt(sum);
				document.getElementById("amount2").value=document.getElementById("amount2").value-parseInt(sum);
			}
		}
	}
	deteI.remove();
}

function allClick(obj){
	var bl=obj.checked;

	var lists=document.getElementsByClassName("checkInput");
	var piece=0;
	var amount=0;
//	alert(piece);
	for(i of lists){
		i.checked=obj.checked;
//		console.log(i);
	}
	var lists1=document.getElementsByClassName("numberDiv");
//	alert(lists.length);
	for(i of lists1){
//		alert(i.childNodes[2].value);//INPUT
		piece=parseInt(i.childNodes[2].value)+parseInt(piece);
//		alert(piece);
	document.getElementById("piece").value=parseInt(piece);
	document.getElementById("piece2").value=parseInt(piece);
		
	}
	
	var lists2=document.getElementsByClassName("sumDiv");
	//alert(lists2.length);
	for(k of lists2){
//		alert("222");
//		alert(k.childNodes[0].innerHTML);
		amount=parseInt(k.childNodes[0].innerHTML)+parseInt(amount);
	document.getElementById("amount").value=parseInt(amount);
	document.getElementById("amount2").value=parseInt(amount);
	}

//	alert(bl);
$("goodsAll1").checked=obj.checked;
$("goodsAll2").checked=obj.checked;
	if(bl==false){
	document.getElementById("piece").value=parseInt("0");
	document.getElementById("piece2").value=parseInt("0");
	document.getElementById("amount").value=parseInt("0");
	document.getElementById("amount2").value=parseInt("0");
	return;
	}
}
function checkOnclick(obj){
	var piece=0;
   	var amount=0;
   	
   	//点击选择按钮改变piece和amount
   var lists=document.getElementsByClassName("checkInput");
   for (i of lists) {
   	if(i.checked==true){
   		var itemChilds=i.parentNode.parentNode.childNodes;//itemDiv所有子节点
   		for (j of itemChilds) {
// 			alert(j.className);
   			if(j.className=="numberDiv"){
// 					alert(j.childNodes[2].value)
					piece=parseInt(j.childNodes[2].value)+parseInt(piece);
   			}
   			if(j.className=="sumDiv"){
// 				alert(j.childNodes[0].innerHTML)
				amount=parseInt(j.childNodes[0].innerHTML)+parseInt(amount);
   			}
   		}
   	}
   }
    document.getElementById("piece").value=parseInt(piece);
	document.getElementById("piece2").value=parseInt(piece);
	document.getElementById("amount").value=parseInt(amount);
	document.getElementById("amount2").value=parseInt(amount);
   	
   	if(obj.checked == true){
//	alert(true);
	
	for(i=0;i<lists.length;i++){/*i in lists进行迭代，可能出问题*/
		if(lists[i].checked==false){
//			console.log(lists[i].checked);
			return;
		}
//		$("goodsAll").checked=obj.checked;
		}
	}
	$("goodsAll1").checked=obj.checked;
$("goodsAll2").checked=obj.checked;

}

function submitClick(obj){//这个函数返回TRUE就是提交
	if(nameOnblur($("name"))){
		return true;
	}
	return false;
	
}