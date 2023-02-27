let form = document.getElementById('js-file');
form.addEventListener('change', evt => {
	evt.preventDefault();
	let formData = new FormData();
	let files = form.files;
	[...files].forEach(element => formData.append('file[]', element));
	fetch('/admin/upload-image/', {
		method: 'POST',
		body: formData,
	})
		.then((response) => response.json())
		.then((msg) => {
			msg.forEach(function(row) {
				if (row.error == '')
				{
					let imgList = document.getElementById('js-file-list');
					let range = document.createRange();
					range.selectNodeContents(imgList);
					let imgBlock = range.createContextualFragment(row.data);
					imgList.append(imgBlock);
				}
				else
				{
					let input = document.getElementById('js-file');
					let parent = input.parentNode;

					let need = document.createElement('div');
					need.className = 'error-img';
					need.innerHTML = '<div>'+row.error + '</div>' + '<div><a href="#" class="delete-icon-alert" onClick="remove_img(this); return false;"></a></div>';

					parent.insertBefore(need, input);
				}
			});
		});
});

function remove_img(target)
{
	let parent = target.parentElement;
	let grand = parent.parentNode;
	grand.remove();
}
