<h2><?php echo $contentTitle; ?></h2>
<?php

if (SHOW_COUNTER)
{
    js_redirect(CMS_ROOT . $defaultCMS, SHOW_COUNTER_DELAY);

    if(isset($_SESSION['codesaur_user_role']))
    {
        if($_SESSION['codesaur_user_role'] == "admin")
            require_once 'counter.php';
    }
}
else
    js_redirect(CMS_ROOT . $defaultCMS, 0);
?>