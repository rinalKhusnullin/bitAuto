function editValidate()
{
    wasNoError = true;
    form = document.forms['admin_edit'];
    for (let i = 0; i < form.length; i++)
    {
        if (form[i].nodeName === 'INPUT' || form[i].nodeName === 'TEXTAREA')
        {
            if (form[i].type === 'text')
            {
                if (form[i].value === '')
                {
                    elementName = form[i].name.toUpperCase();
                    form[i].parentElement.classList.add('empty');
                    form[i].classList.add('red-placeholder');
                    form[i].placeholder = 'Please, enter ' + elementName;
                    wasNoError = false;
                } 
                else
                {
                    form[i].parentElement.classList.remove('empty');
                    form[i].placeholder = '';
                }
            }
        }
    }
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

