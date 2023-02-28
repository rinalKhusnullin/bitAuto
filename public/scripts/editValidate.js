const TAGSTOVALIDATE = ['INPUT', 'TEXTAREA'];
const TOVALIDATE = ['title', 'fullDesc', 'price', 'value', 'login', 
    'firstName', 'lastName', 'mail', 'fullName', 'phone', 'address', 'productId', 'productPrice'];

const TITLE_RESTRICK = 255 - 1;
const FULLDESC_RESTRICK = 2000 - 1;
const VALUE_RESTRICK = 50 - 1;
const FULLNAME_RESTRICK = 100 - 1;
const PHONE_RESTRICK = 15 - 1;
const MAIL_RESTRICK = 50 - 1;
const COMMENT_RESTRICK = 500 - 1;
const ADDRESS_RESTRICK = 80 - 1;

const INT_RESTRICK = 11 - 1;  

const NOTCHARS = ['price', 'productId', 'productPrice', 'phone']

function editValidate()
{
    wasNoError = true;
    form = document.forms['admin_edit'];
    for (let i = 0; i < form.length; i++)
    {
        if (TAGSTOVALIDATE.includes(form[i].nodeName))
        {
            if (TOVALIDATE.includes(form[i].name))
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

input = document.forms['admin_edit'];

[...input].forEach(element => {
    element.addEventListener('input', function() {
        if (TAGSTOVALIDATE.includes(element.nodeName) && TOVALIDATE.includes(element.name))
        {
            if (NOTCHARS.includes(element.name))
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

            if (element.name === 'price') element.value = element.value.substring(0, INT_RESTRICK);

            if (element.name === 'title') element.value = element.value.substring(0, TITLE_RESTRICK);

            if (element.name === 'fullName') element.value = element.value.substring(0, FULLNAME_RESTRICK);

            if (element.name === 'phone') element.value = element.value.substring(0, PHONE_RESTRICK);

            if (element.name === 'mail') element.value = element.value.substring(0, MAIL_RESTRICK);

            if (element.name === 'address') element.value = element.value.substring(0, ADDRESS_RESTRICK);

            if (element.name === 'comment') element.value = element.value.substring(0, COMMENT_RESTRICK);

            if (element.name === 'productId') element.value = element.value.substring(0, INT_RESTRICK);

            if (element.name === 'productPrice') element.value = element.value.substring(0, INT_RESTRICK);
        }
    })
});

