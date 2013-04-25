function checkCommentForm()
{
    with (window.document.frmComment)
    {
        if(isEmpty(txtName, 'Нэр талбарыг оруулна уу.'))
        {
            return;
        }
        else
            if(isEmpty(txtShort, 'Сэтгэгдэл талбарыг оруулна уу.'))
            {
                return;
            }
            else
            {
                submit();
            }
    }    
}

function checkCommentFormModify()
{
    with (window.document.frmComment)
    {
        if(isEmpty(txtName, 'Нэр талбарыг оруулна уу.'))
        {
            return;
        }
        else
            if(isEmpty(txtShort, 'Сэтгэгдэл талбарыг оруулна уу.'))
            {
                return;
            }
            else
            {
                submit();
            }
    }    
}

function modComment(ID, RefID)
{
    window.location.href = 'index.php?view=modify&id=' + RefID + '&comment=' + ID + '#tabs-2';
}

function delComment(ID, RefID)
{
    if (confirm('Энэ бичлэгийг устгахдаа итгэлтэй байна уу?'))
    {
        window.location.href = 'execute.php?action=deleteComment&id=' + ID + '&refID=' + RefID;
    }
}