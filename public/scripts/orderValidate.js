const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
const PHONE_REGEXP = /^(\+7|8)\(?\d{3}\)?\d{3}-?\d{2}-?\d{2}$/;

function orderValidate()
{
    let order = document.forms["orderForm"];
    let name = order["userFullname"].value;
    let tel = order["userTel"].value;
    let email = order["userEmail"].value;
    let address = order["userAddress"].value;

    let returnFlag = true;

    if (name.trim() === '')
    {
        document.getElementById('name_error').textContent = 'Пожалуйста, введите Фамилию и Имя';
        returnFlag = false;
    }
    else 
    {
        document.getElementById('name_error').textContent = '';
    }

    if (tel.trim() === '')
    {
        document.getElementById('tel_error').textContent = 'Пожалуйста, введите номер телефона';
        returnFlag = false;
    }
    else 
    {
        if (!PHONE_REGEXP.test(tel))
        {
            document.getElementById('tel_error').textContent = 'Введен некорректный номер телефона';
            returnFlag = false;
        }
        else
        {
            document.getElementById('tel_error').textContent = '';
        }
    }

    if (email.trim() === '')
    {
        document.getElementById('email_error').textContent = 'Пожалуйста, введите Email';
        returnFlag = false;
    }
    else
    {
        if (!EMAIL_REGEXP.test(email))
        {
            document.getElementById('email_error').textContent = 'Введен некорректный email';
            returnFlag = false;
        }
        else
        {
            document.getElementById('email_error').textContent = '';
        }
    }

    if (address.trim() === '')
    {
        document.getElementById('address_error').textContent = 'Пожалуйста, введите адрес';
        returnFlag = false;
    }

    if (returnFlag) document.getElementById('tel').value = tel.replace(/\+|\(|\)|\-/g,'');
    return returnFlag;
}