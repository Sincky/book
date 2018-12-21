/****** ** ** ** ** ** 左边附加导航切换 ** ** ** ** ** ** ** ** **/
function jump($url){
	setTimeout(function () {
		$("#frame").attr("src",$url);
	},350);
}

$(function() {
	$("#accordion").accordion({
		collapsible: true,
		active: false,
		activate: function( event, ui ) {
			if(ui.newHeader.length){
				if(ui.newHeader[0].id == "ui-id-1"){
					$("#imgLeft0").css("transform","rotate(-90deg)");
				}else{
					$("#imgLeft1").css("transform","rotate(-90deg)");
				}
			}
			if(ui.oldHeader.length){
				if(ui.oldHeader[0].id == "ui-id-1"){
					$("#imgLeft0").css("transform","rotate(0deg)");
				}else{
					$("#imgLeft1").css("transform","rotate(0deg)");
				}
			}
		},
	});

});
