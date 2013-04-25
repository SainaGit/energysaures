<?php
if(!defined('WEB_ROOT'))
    exit;

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
$successMessage = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '&nbsp;'; 

$rowsPerPage = 50;
$sql = "SELECT * FROM menu ORDER BY ParentID, Rank";
$result = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage);
?>
<h2><?php echo $contentTitle; ?></h2>
<?php if($errorMessage != '&nbsp;'){ ?>
<div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessage; ?></p></div>
<?php } ?>
<?php if($successMessage != '&nbsp;'){ ?>
<div class="success"><span><?php echo $msgSuccess; ?></span><p><?php echo $successMessage; ?></p></div>
<?php } ?>
<table cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th>Меню</th>
            <th>Төрөл</th>
            <th>Зассан</th>
            <th>Дараалал</th>
            <th>Статус</th>
            <th>Үйлдэл</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $count = dbNumRows($result); 
    if($count > 0)
    {
        $i = 0;
        while($row = dbFetchAssoc($result))
        {
            extract($row);
            $i += 1;
    ?>
        <tr <?php if($i%2==0) { echo 'class="alt"'; }?> >
            <td><?php echo showPath(GetMenu($ID)); ?></td>
            <td><?php echo $menuType[$Type]; ?></td>
            <td><?php echo $DateModified; ?></td>
            <td><?php echo $Rank; ?></td>
            <td><?php echo getLanguage($IsActive_mn, $IsActive_en); ?></td>
            <td>
                <a class="edit" href="javascript:mod(<?php echo $ID; ?>);"><?php echo $btnEditCaption; ?></a>
                <a class="delete" href="javascript:del(<?php echo $ID; ?>);"><?php echo $btnDeleteCaption; ?></a>
            </td>
        </tr>        
    <?php
        }
    }
    else
    {
    ?>
        <tr>
            <td colspan="6">Хуудас бүртгэгдээгүй байна.</td>
        </tr>
    <?php
    }
    ?>
    </tbody>    
</table>
<ul class="paginator">
    <?php echo $pagingLink; ?>
</ul>
<div style="text-align: right; padding-top: 10px;">
    <input type="button" class="button" onclick="add();" value="Хуудас нэмэх" />
</div>