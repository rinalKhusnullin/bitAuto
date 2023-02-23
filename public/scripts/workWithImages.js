let form = document.getElementById('js-file');
form.addEventListener('change', evt => {
	evt.preventDefault();
	let formData = new FormData();
	let files = form.files;
	[...files].forEach(element => formData.append('file[]', element));
	fetch('/upload_image.php', {
		method: 'POST',
		body: formData,
	})
		.then((response) => response.json())
		.then((msg) =>{
		msg.forEach(function(row) {
			if (row.error == '')
			{
				let imgList = document.getElementById('js-file-list');
				console.log(row.data);
				let range = document.createRange();
				range.selectNodeContents(imgList);
				let imgBlock = range.createContextualFragment(row.data);
				imgList.appendChild(imgBlock);
			}
			else
			{
				alert(row.error);
			}
		});
		//form.val('');
	})
})
