/****************左边附加导航切换*****************/
$("#leftsidebar_box dt").css({
	"background-color": " #0AA1ED"
});
$(function() {
	$("#leftsidebar_box .my_order dd").show();
	$("#leftsidebar_box dd").hide();

	$("#leftsidebar_box dt").click(function() {
		$("#leftsidebar_box dt").css({
			"background-color": "#0AA1ED"
		});
		$(this).css({
			"background-color": "#0AA1ED"
		});
		$(this).parent().find('dd').removeClass("menu_chioce");
		//$("#leftsidebar_box dt img").attr("src", "img/myOrder/myOrder2.png");
		//	$(this).parent().find('img').attr("src", "img/myOrder/myOrder1.png");
		$(".menu_chioce").slideUp();
		$(this).parent().find('dd').slideToggle();
		$(this).parent().find('dd').addClass("menu_chioce");
		$(this).parent().siblings().children('dd').slideUp();
		var test2 = document.getElementById('test2');
		if(test2.getAttribute("src", 2) == "img/myOrder/myOrder2.png") {
			test2.setAttribute("src", "img/myOrder/myOrder1.png");
		} else {
			test2.setAttribute("src", "img/myOrder/myOrder2.png");
		}
	});

})

function pageup() {
	//var bt=document.getElementsByClassName("buttonup");
	//bt.css({"color": "cornflowerblue"});
	var lists = document.getElementsByClassName("pagechange");
	for(i = 0; i < lists.length; i++) {
		lists[i].style.backgroundColor = "rgb(242,242,242)";
		lists[i].style.color = "rgb(191,191,191)";

	}
	lists[0].style.backgroundColor = "cornflowerblue";
	lists[0].style.color = "white";
	if(lists[0].value == 1) {
		$(up).css({
			"color": "rgb(191,191,191)"
		});
	}
	if(lists[0].value >= 1) {
		for(i = 0; i < lists.length; i++) {
			lists[i].value = parseInt(lists[i].value) - 1;
			if(lists[0].value == 1) {
				$(up).css({
					"color": "rgb(191,191,191)"
				});
			}
		}
	}
	if(lists[0].value > 1) {
		$(up).css({
			"color": "cornflowerblue"
		});
		$(down).css({
			"color": "cornflowerblue"
		});
	} else if(lists[0].value == 0) {
		alert("当前是第一页");
		for(i = 0; i < lists.length; i++) {
			lists[i].value = parseInt(lists[i].value) + 1;

		}
		$(up).onclick = function() {};
	}

}

function pagedown() {
	//var bt=document.getElementsByClassName("buttonup");
	//bt.css({"color": "cornflowerblue"});

	var lists = document.getElementsByClassName("pagechange");
	
	if(lists[0].value < 10) {
		$(down).css({
			"color": "cornflowerblue"
		});
		if(lists[0].value >= 1) {
		for(i = 0; i < lists.length; i++) {
			lists[i].value = parseInt(lists[i].value) + 1;
		}
		lists[0].style.backgroundColor = "cornflowerblue";
		lists[0].style.color = "white";
	}

	} else if(lists[0].value >= 10) {
		var num = 0;
		for(i = 0; i < lists.length; i++) {
//			lists[i].value = parseInt(lists[i].value) - 1;
				if(lists[i].style.backgroundColor == "cornflowerblue"){
					if(i != lists.length-1){
						lists[i].style.backgroundColor = "rgb(242,242,242)";
						lists[i].style.color = "rgb(191,191,191)";
						lists[i+1].style.backgroundColor = "cornflowerblue";
						lists[i+1].style.color = "white";
						break;
					}else{
						alert("当前是最后一页");
						$(down).css({
						"color": "rgb(191,191,191)"
						});
						break;
					}
					
				}
		}
		$(down).onclick = function() {};
	}
	
	if(lists[0].value == 1) {
		$(up).css({
			"color": "rgb(191,191,191)"
		});
	} else {
		$(up).css({
			"color": "cornflowerblue"
		});
	}

	

}

function page(obj) {
	var lists = document.getElementsByClassName("pagechange");
	for(i = 0; i < lists.length; i++) {
		if(lists[i].value == obj.value) {

			lists[i].style.backgroundColor = "cornflowerblue";
			lists[i].style.color = "white";
		} else {
			lists[i].style.backgroundColor = "rgb(242,242,242)";
			lists[i].style.color = "rgb(191,191,191)";
		}

	}

}

function page1(obj) {
	var lists = document.getElementsByClassName("pagechange");
	for(i = 0; i < lists.length; i++) {
		if(lists[i].value == obj.value) {

			lists[i].style.backgroundColor = "cornflowerblue";
			lists[i].style.color = "white";
		} else {
			lists[i].style.backgroundColor = "rgb(242,242,242)";
			lists[i].style.color = "rgb(191,191,191)";
		}

	}

}

function page2(obj) {
	var lists = document.getElementsByClassName("pagechange");
	for(i = 0; i < lists.length; i++) {
		if(lists[i].value == obj.value) {

			lists[i].style.backgroundColor = "cornflowerblue";
			lists[i].style.color = "white";
		} else {
			lists[i].style.backgroundColor = "rgb(242,242,242)";
			lists[i].style.color = "rgb(191,191,191)";
		}

	}

}

function page3(obj) {
	var lists = document.getElementsByClassName("pagechange");
	for(i = 0; i < lists.length; i++) {
		if(lists[i].value == obj.value) {

			lists[i].style.backgroundColor = "cornflowerblue";
			lists[i].style.color = "white";
		} else {
			lists[i].style.backgroundColor = "rgb(242,242,242)";
			lists[i].style.color = "rgb(191,191,191)";
		}

	}

}

function page4(obj,int4) {
	var num = (parseInt(obj.value)+4);
	console.log(num);
	if(num>=16){
		var lists = document.getElementsByClassName("pagechange");
		for(i = 0; i < lists.length; i++) {
		if(lists[i].value == obj.value) {

			lists[i].style.backgroundColor = "cornflowerblue";
			lists[i].style.color = "white";
		} else {
			lists[i].style.backgroundColor = "rgb(242,242,242)";
			lists[i].style.color = "rgb(191,191,191)";
		}

	}
		return;
	}
	var lists = document.getElementsByClassName("pagechange");

	lists[0].value = obj.value;
	lists[0].focus();
	lists[0].style.backgroundColor = "cornflowerblue";
	lists[0].style.color = "white";
	for(i = 1; i < lists.length; i++) {
		if(i == lists.length - 1) {
			lists[i].value = parseInt(lists[i - 1].value) + 2;
		} else {
			lists[i].value = parseInt(lists[i - 1].value) + 1;
		}

	}
	for(i = 0; i < lists.length; i++) {
		if(lists[i].value == lists[0].value) {

			lists[i].style.backgroundColor = "cornflowerblue";
			lists[i].style.color = "white";
		} else {
			lists[i].style.backgroundColor = "rgb(242,242,242)";
			lists[i].style.color = "rgb(191,191,191)";
		}

	}
	$(up).css({
			"color": "cornflowerblue"
		});
		$(down).css({
			"color": "cornflowerblue"
		});

}

function remove(obj) {
	var inputobj = obj.parentNode.parentNode.parentNode;
	inputobj.remove();
	alert("收货成功");
}