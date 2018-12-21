function addProduct() {
	var bookID = $('#bookNumber').val();
	var bookName = $('#bookName').val();
	var bookAuthor = $('#bookAuthor').val();
	var bookPrice = $('#bookPrice').val();
	var bookPages = $('#bookPages').val();
	var bookWords = $('#bookWords').val();
	var publishCompany = $('#publishCompany').val();
	var publishEdition = $('#publishEdition').val();
	var publishDate = $('#publishDate').val();
	var stock = $('#stock').val();
	var booksize = $('#format option:selected').val();
	var packaging =  $('#packaging option:selected').val();
	var paper =  $('#paper option:selected').val();
	var book = {};

	book['bookID']= bookID;
	book['bookname']= bookName;
	book['author']= bookAuthor;
	book['price']= bookPrice;
	book['wordnum']= bookWords;
	book['pages']= bookPages;
	book['press']= publishCompany;
	book['edition']= publishEdition;
	book['pressdate']= publishDate;
	book['stock']= stock;
	book['booksize']= booksize;
	book['package']= packaging;
	book['paper']= paper;

	//文件
	var files= new FormData();
	files.append('files[]',$('#fileField')[0].files[0],'index');
	files.append('files[]',$('#fileField2')[0].files[0],'intro');
	files.append('files[]',$('#fileField3')[0].files[0],'collect');
	files.append('files[]',$('#fileField4')[0].files[0],'detail1');
	files.append('files[]',$('#fileField5')[0].files[0],'detail2');
	files.append('files[]',$('#fileField6')[0].files[0],'detail3');
	files.append('files[]',$('#fileField7')[0].files[0],'detail1big');
	files.append('files[]',$('#fileField8')[0].files[0],'detail2big');
	files.append('files[]',$('#fileField9')[0].files[0],'detail3big');
	files.append('book',JSON.stringify(book));
	$.ajax({
		type:'POST',
		url:'addproduct',
		processData: false,
		contentType: false,
		data:files,
		success:function (data) {
			var bool = data;
			console.log(bool);
			if(bool){
				alert("添加商品成功！即将跳转到商品列表~");
				window.location.href = "../productlist/productlist";
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

function update()
{
	var data = {};
	data['bookID'] = $('#bookNumber').val();
	data['price'] = $('#bookPrice').val();
	data['stock'] = $('#stock').val();

	$.ajax({
		type:'POST',
		url:'productUpdate',
		data: data,
		success:function (data) {
			var bool = data;
			if(bool){
				alert("更新商品信息成功！即将跳转到商品列表~");
				window.location.href = "../productlist/productlist";
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