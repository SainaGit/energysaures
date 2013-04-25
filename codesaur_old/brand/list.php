<?php
if(!defined('WEB_ROOT'))
    exit;

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
$successMessage = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '&nbsp;'; 

$rowsPerPage = 50;
$sql = "SELECT * FROM brand ORDER BY Rank, DateCreated DESC";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
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
            <th>Лого</th>
            <th>Нэр</th>
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
            
            $img = WEB_ROOT . NO_IMAGE; 
            if($Image1 && $Image1 != "&")
            {
                $images = explode("&", $Image1);
                $mainImg = $images[0];
                $thumbImg = $images[1];
                $img = WEB_ROOT . BRAND_IMAGES_DIR;
                $img = $img . $thumbImg;    
            }
            $i += 1;
    ?>
        <tr <?php if($i%2 == 0) { echo 'class="alt"'; }?> >
            <td><img width="<?php echo THUMBNAIL_WIDTH; ?>px" src="<?php echo $img; ?>"  /></td> 
            <td><?php echo showBrandPath(GetBrand($ID)); ?></td>
            <td><?php echo $DateModified; ?></td>
            <td><?php echo $Rank; ?></td>
            <td><?php echo isActive($IsActive); ?></td>
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
            <td colspan="6">Брэнд бүртгэгдээгүй байна.</td>
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
    <input type="button" class="button" onclick="add();" value="Брэнд нэмэх" />
</div>
