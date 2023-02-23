let form = document.getElementById('js-file');
form.onchange = function() {
	if (window.FormData === undefined)
	{
		alert('В вашем браузере загрузка файлов не поддерживается');
	}
	else
	{
		let formData = new FormData();
		let files = form.files;
		[...files].forEach(elemnt => formData.append('file[]', input));

		fetch('/upload.php', {
			method: "POST",
			body: formData,
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
}
