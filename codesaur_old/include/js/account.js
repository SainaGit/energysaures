function checkAddForm()
{
    with (window.document.frmMain)
    {
        if (isEmpty(txtUserName, 'Нэвтрэх нэр талбарыг оруулна уу.'))
        {
            return;
        }
        else
            if (isEmpty(txtPassword, 'Нууц үг талбарыг оруулна уу.'))
            {
                return;
            }
            else 
                if (isEmpty(txtFirstName, 'Нэр талбарыг оруулна уу.'))
                {
                   return;
                }
                else 
                    if (isEmpty(txtEmail, 'Имайл талбарыг оруулна уу.'))
                    {
                        return;
                    }
                    else
                        if (validate_email(txtEmail, "Имайл талбарыг зөв оруулна уу.") == false)
                        {
                            txtEmail.focus();
                            return;
                        }
                        else
                        {
                            submit();
                        }
    }
}

function checkModifyForm()
{
    with (window.document.frmMain) 
    {
        if (isEmpty(txtUserName, 'Нэвтрэх нэр талбарыг оруулна уу.'))
        {
            return;
        }
        else
            if (isEmpty(txtFirstName, 'Нэр талбарыг оруулна уу.')) 
            {
                return;
            }
            else 
                if (isEmpty(txtEmail, 'Имайл талбарыг оруулна уу.')) 
                {
                    return;
                }
                else
                    if (validate_email(txtEmail,"Имайл талбарыг зөв оруулна уу.") == false) 
                    {
                        txtEmail.focus();
                        return;
                    }
                    else
                    {
                        submit();
                    }
    }
}

function add()
{
    window.location.href = 'index.php?view=add';
}

function mod(ID)
{
    window.location.href = 'index.php?view=modify&id=' + ID;
}

function del(ID)
{
    if (confirm('Энэ бичлэгийг устгахдаа итгэлтэй байна уу?'))
    {
        window.location.href = 'execute.php?action=delete&id=' + ID;
    }
}