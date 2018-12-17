/****** ** ** ** ** ** 左边附加导航切换 ** ** ** ** ** ** ** ** **/

$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var link1 = this.el.find('.link1');
		var link2 = this.el.find('.link2');

		// Evento
		link1.on('click', {el: this.el,multiple: this.multiple,imgI:"imgLeft0"}, this.dropdown);
		link2.on('click', {el: this.el,multiple: this.multiple,imgI:"imgLeft1"}, this.dropdown);
		//links.on('click', {el: this.el,multiple: this.multiple,imgI:"imgLeft1"}, this.dropdown);
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
		$this = $(this),
			$next = $this.next();
		$next.slideToggle();
		$this.parent().toggleClass('open');
		
		var imgId = e.data.imgI;
		if($("#"+imgId).attr("title") != "1"){
			$("#"+imgId).css("transform","rotate(-90deg)");
			$("#"+imgId).attr("title","1");
		}else{
			$("#"+imgId).css("transform","rotate(0deg)");
			$("#"+imgId).attr("title","0");
		}
		if(!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
			$el.find('.submenu').not($next).slideUp().parent().find('img').css("transform","rotate(0deg)");
			$el.find('.submenu').not($next).slideUp().parent().find('img').attr("title",0);
		};
		
	}

	var accordion = new Accordion($('#accordion'), false);
});