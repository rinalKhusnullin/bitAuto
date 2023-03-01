addListenerToImages();
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
					addListenerToImages();
				}
				else
				{
					let input = document.getElementById('js-file');
					let parent = input.parentNode;

					let need = document.createElement('div');
					need.className = 'error-img';
					need.innerHTML = '<div>'+ row.error + '</div>' + '<div><a href="#" class="delete-icon-alert" onClick="remove_img(this); return false;"></a></div>';

					parent.insertBefore(need, input);
				}
				updateListenerToImages();
			});
		});
});

function remove_img(target)
{
	let parent = target.parentElement;
	let grand = parent.parentNode;
	grand.remove();
	firstElemToChecked();
}

function getElemByColumn(column)
{
    let fields = document.querySelectorAll('.edit_table .tbody_edit .tr_edit');
    let result;
    fields.forEach(field => {
        if (column === field.querySelector('.th_edit').innerHTML) result = field.querySelector('.td_edit .td_value');
    });
    return result;
}


function addListenerToImages()
{
	images = document.forms[0]['main-image'] ?? [];

	if (images.constructor.name === 'RadioNodeList')
	{
		images.forEach(image => {
			image.addEventListener('change', function() {
				imageName = image.value;
				getElemByColumn('mainImage').innerHTML = imageName;
			})
		});
	}
	else if (images.constructor.name === 'HTMLInputElement')
	{
		image = images;
		imageName = image.value;
		getElemByColumn('mainImage').innerHTML = imageName;
	}
}

function updateListenerToImages()
{
	images = document.forms[0]['main-image'] ?? [];

	if (images.constructor.name === 'RadioNodeList')
	{
		images.forEach(image => {
			if (image.checked === true)
			{
				imageName = image.value;
				getElemByColumn('mainImage').innerHTML = imageName;
			}
		});
	}
	else if (images.constructor.name === 'HTMLInputElement')
	{
		image = images;
		imageName = image.value;
		getElemByColumn('mainImage').innerHTML = imageName;
	}
	if (images.length === 0)
	{	
		getElemByColumn('mainImage').innerHTML = '';
	}
}

function firstElemToChecked()
{
	images = document.forms[0]['main-image'] ?? [];

	if (images.constructor.name === 'RadioNodeList')
	{
		images[0].checked = true;
	}
	else if (images.constructor.name === 'HTMLInputElement')
	{
		images.checked = true;
	}
	updateListenerToImages();
}