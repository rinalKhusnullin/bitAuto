function editValidate()
{
    ignoreInputs = ['id', 'dateCreation', 'dateUpdate', 'file[]']; // file[] для images 
    wasNoError = true;
    input = document.querySelectorAll('input, textarea');
    input.forEach(element => {
        if (ignoreInputs.includes(element.name)) return;

        if (element.value === '')
        {
            elementName = element.name.toUpperCase();
            element.parentElement.classList.add('empty');
            element.classList.add('red-placeholder');
            element.placeholder = 'Please, enter ' + elementName;
            wasNoError = false;
        } 
        else
        {
            element.parentElement.classList.remove('empty');
            element.placeholder = '';
        }

    });

    return wasNoError;
}

input = document.querySelectorAll('input, textarea');

input.forEach(element => {
    element.addEventListener('input', function() {
        if (element.name === 'price')
        {
            element.value = element.value.replace(/[^\d]/g,'');
        }
        
        if (element.value === '')
        {
            elementName = element.name.toUpperCase();
            element.parentElement.classList.add('empty');
            element.classList.add('red-placeholder');
            element.placeholder = 'Please, enter ' + elementName;
        } 
        else
        {
            element.parentElement.classList.remove('empty');
            element.placeholder = '';
        }
    })
});

