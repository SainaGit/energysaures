function trim(str)
{
    return str.replace(/^\s+|\s+$/g,'');
}

function checkNumber(textBox)
{
    while (textBox.value.length > 0 && isNaN(textBox.value))
    {
        textBox.value = textBox.value.substring(0, textBox.value.length - 1)
    }
    textBox.value = trim(textBox.value);
}

function chkOnlyCounter(field, maxlimit)
{   
    if (field.value.length > maxlimit)
    {     
        field.value = field.value.substring(0, maxlimit-2);     
        alert("Энэ талбарын урт нь " + maxlimit + " тэмдэгтээс ихгүй байна."); 
        return false;   
    }
}

function isEmpty(formElement, message)
{
    formElement.value = trim(formElement.value);
    
    _isEmpty = false;
    if (formElement.value == '')
    {
        _isEmpty = true;
        alert(message);
        formElement.focus();
    }
    
    return _isEmpty;
}               

function validate_email(field, alerttxt)
{
    with (field)                     
    {
        apos=value.indexOf("@");
        dotpos=value.lastIndexOf(".");
        if (apos<1||dotpos-apos<2)
        {
            alert(alerttxt);
            return false;
        }
        else 
        {
            return true;
        }
    }
}