function addNum() {
	var num = document.getElementById("number");
	if(num.value < 99) {
		num.value++;
	}
}

function subNum() {
	var num = document.getElementById("number");
	if(num.value > 1) {
		num.value--;
	}

}

function changeNum() {
	var num = document.getElementById("number");
	num.value = GetNum(num.value);
	if(num.value > 99) {
		num.value = 99;
	}
	if(num.value < 1) {
		num.value = 1;
	}
}

function GetNum(str) {
	var regEx = /[^\d]/g;
	return str.replace(regEx, '');
};

window.onload = function() {
	var oDiv = document.getElementById("rightMenu");
	var hDiv = document.getElementsByClassName("productContentDiv")[0];
	var H = 0;
	var H2 = hDiv.clientHeight;
	var Y = oDiv;
	while(Y) {
		H += Y.offsetTop;
		Y = Y.offsetParent;
	}
	H2 = H2 + H - oDiv.clientHeight;
	console.log(H);
	console.log(H2);
	window.onscroll = function() {
		var S = document.body.scrollTop || document.documentElement.scrollTop;
		console.log(S);
		if(S > H) {
			if( S < H2){
				oDiv.style = "margin-top:"+(S-H)+"px";
			}
		} else {
			oDiv.style = "margin-top:0px";
		}
	};
};
function detailBuy(){
	window.document.location.href="payment.html";
}

//加入购物车
function addCart(bookID) {
	var bookNum = $("#number").val();
	window.location.href = "addCart?bookID=" + bookID + "&bookNum=" + bookNum;
}

function showComment() {

	$(".productParameterDiv,.productIntroduceDiv,.productAfterSaleDiv").hide();
	$(".productCommentDiv").show();
	$(".productDetails").removeClass("select");
	$(".productComment").addClass("select");
	$(".menuDiv").hide();
}

function showDetail() {
	$(".productCommentDiv").hide();
	$(".productParameterDiv,.productIntroduceDiv,.productAfterSaleDiv").show();
	$(".productComment").removeClass("select");
	$(".productDetails").addClass("select");
	$(".menuDiv").show();
}