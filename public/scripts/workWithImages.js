let form = document.getElementById('js-file');
form.onchange = function() {
	if (window.FormData === undefined)
	{
		alert('В вашем браузере загрузка файлов не поддерживается');
	}
	else
	{
		let formData = new FormData();
		console.log(form[0].files);
		document.each(form[0].files, function(key, input) {
			formData.append('file[]', input);
		});

		document.ajax({
			type: 'POST',
			url: '/upload_image.php',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType: 'json',
			success: function(msg) {
				msg.forEach(function(row) {
					if (row.error == '')
					{
						let imgList = document.getElementById('js-file');
						imgList.append(row.data);
					}
					else
					{
						alert(row.error);
					}
				});
				form.val('');
			},
		});
	}
};

/* Удаление загруженной картинки */
function remove_img(target)
{
	$(target).parent().remove();
}