function update()
{
	var data = {};
	data['receID'] = $('#receID').val();
	data['receName'] = $('#receName').val();
	data['receAdd'] = $('#receAdd').val();
	data['recePhone'] = $('#recePhone').val();

	$.ajax({
		type:'POST',
		url:'addressUpdate',
		data: data,
		success:function (data) {
			var bool = data;
			if(bool){
				alert("更新收货地址成功！即将跳转到我的收货信息列表~");
				window.location.href = "../addressadd/myaddress";
			}else{
				alert("添加失败，请重试~");
			}
		},
		error:function (data) {
			console.log(data);
			alert("添加失败，请重试~");
		}
	});

}

function productdelete() {
	if(window.confirm('你确定要删除此商品吗？')){
		//确定
		var data = {};
		data['bookID'] = $('#bookNumber').val();

		$.ajax({
			type:'POST',
			url:'productdelete',
			data: data,
			success:function (data) {
				var bool = data;
				if(bool){
					alert("删除商品成功！即将跳转到商品列表~");
					window.location.href = "../productlist/productlist";
				}else{
					alert("删除失败，请重试~");
				}
			},
			error:function (data) {
				console.log(data);
				alert("删除失败，请重试~");
			}
		});
		return true;
	}else{
		//取消
		return false;
	}


}