function checkAddForm()
{
    with (window.document.frmMain)
    {
        if (isEmpty(txtName, 'Гарчиг талбарыг оруулна уу.'))
        {
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
        if (isEmpty(txtName, 'Гарчиг талбарыг оруулна уу.'))
        {
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