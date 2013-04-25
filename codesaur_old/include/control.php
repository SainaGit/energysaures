<?php if(!defined('WEB_ROOT')) exit; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charsetIso; ?>" />
    <meta name="title" content="<?php echo $pageTitle; ?>" />
    <meta name="author" content="<?php echo AUTHORINF; ?>" />
    <meta name="language" content="<?php echo $languages[$deflangind]; ?>" />
    <title><?php echo $pageTitle; ?></title>
    <link rel="shortcut icon" href="<?php echo CMS_ROOT;?>include/images/favico.ico"/>
    <link rel="stylesheet" href="<?php echo CMS_ROOT;?>include/css/default.css"/>
    <link rel="stylesheet" href="<?php echo CMS_ROOT;?>include/css/jquery.ui.all.css"/>
    <script language="JavaScript" src="<?php echo CMS_ROOT;?>include/js/jquery/jquery-1.5.1.js" type="text/javascript"></script>
    <script language="JavaScript" src="<?php echo CMS_ROOT;?>include/js/jquery/jquery.ui.core.js" type="text/javascript"></script>
    <script language="JavaScript" src="<?php echo CMS_ROOT;?>include/js/jquery/jquery.ui.widget.js" type="text/javascript"></script>
    <script language="JavaScript" src="<?php echo CMS_ROOT;?>include/js/jquery/jquery.ui.tabs.js" type="text/javascript"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo CMS_ROOT;?>include/js/common.js"></script>
    <?php $n = count($script); for ($i = 0; $i < $n; $i++) if ($script[$i] != '') echo '<script language="JavaScript" type="text/javascript" src="' . CMS_ROOT. 'include/js/' . $script[$i]. '"></script>';?>
</head>
<body>
    <div id="header-wrapper" align="center">
        <div id="header">
            <div class="logo">
                <a href="<?php echo CMS_ROOT; ?>" title="Админ сайт"><img src="<?php echo CMS_ROOT;?>include/images/adminsite-logo.jpg" alt="Админ сайт" /></a>
            </div>
            <div class="defaultmenu">
                <ul>
                    <li><img src="<?php echo CMS_ROOT;?>include/images/btn-home.gif" alt="Үндсэн сайт" /><a href="<?php echo WEB_ROOT.'test/'; ?>" target="_blank">Үндсэн сайт</a></li>
                    <li><img src="<?php echo CMS_ROOT;?>include/images/btn-help.gif" alt="Тусламж" /><a href="#">Тусламж</a></li>
                    <li><img src="<?php echo CMS_ROOT;?>include/images/btn-samples.gif" alt="Загварууд" /><a href="#">Загварууд</a></li>
                    <li><img src="<?php echo CMS_ROOT;?>include/images/btn-feedback.gif" alt="Санал хүсэлт" /><a href="#" onclick="return Home.showFeedback();">Санал хүсэлт</a></li>
                    <li><img src="<?php echo CMS_ROOT;?>include/images/btn-logout.gif" alt="Гарах" /><a href="<?php echo CMS_ROOT . 'index.php?logout'; ?>"><?php echo $_SESSION['codesaur_last_name'] . '.' .$_SESSION['codesaur_first_name']; ?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div align="center">
        <div id="work">
            <div id="menunav">
                <div class="menunav_item" <?php if($currentMenu == 'Menu') echo 'id="selected_item"'; ?>><a href="<?php echo CMS_ROOT; ?>menu/">Хуудсууд</a></div>
                <div class="menunav_item" <?php if($currentMenu == 'Banner') echo 'id="selected_item"'; ?>><a href="<?php echo CMS_ROOT; ?>banner/">Баннер</a></div>
                <div class="menunav_item" <?php if($currentMenu == 'Admin') echo 'id="selected_item"'; ?>><a href="<?php echo CMS_ROOT; ?>account/">Админ</a></div>
                <div class="menunav_item" <?php if($currentMenu == 'Misc') echo 'id="selected_item"'; ?>><a href="<?php echo CMS_ROOT; ?>misc/">Бусад</a></div>
            </div>
            <div id="content">
                <div class="box"><?php require_once $content; ?>
                </div>                        
            </div>
        </div>
        <div id="footer">
            <a href="<?php echo AUTHORWEB; ?>" target="_blank"><?php echo AUTHORTXT; ?></a>
        </div>
    </div>
    <div class="clear"></div>
</body>
</html>