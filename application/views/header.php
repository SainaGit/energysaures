<?php
defined('CODESAUR') || exit(1);

$web = array_merge(require_config('head', _COMMON_), require_config('web'));
?>
<!doctype html>
<html lang="<?php echo $web['lang']; ?>" dir="<?php echo $web['dir']; ?>">
<head>
<meta charset="<?php echo $web['charset']; ?>">
<meta name="description" content="<?php echo $web['description']; ?>">
<meta name="author" content="<?php echo $web['author']; ?>">
<meta name="generator" content="<?php echo $web['generator']; ?>" />
<meta name="robots" content="<?php echo $web['robots']; ?>" />
<meta name="keywords" content="<?php echo $web['keyboards']; ?>" />
<meta name="viewport" content="<?php echo $web['viewport']; ?>">
<title><?php echo $web['title']; ?></title>
<link rel="shortcut icon" href="<?php echo $web['favico']; ?>" type="image/x-icon" />
<link rel="icon" type="image/png" href="<?php echo $web['icopng']; ?>" /> 
<?php
codesaur::instance()->controller->incStyleToHtml("thirdparty/flexSlider/flexslider.css");
codesaur::instance()->controller->incStylesToHtml(array('css/energymo.css', 'css/nav.css', 'css/listo.css', 'css/sysmenu.css', 'css/search.css'));
?>
<!--[if IE]>
<script>
    document.createElement('header');
    document.createElement('footer');
    document.createElement('section');
    document.createElement('nav');
    document.createElement('aside');
    document.createElement('article');
</script>
<![endif]-->
</head>
<body>
<div id="container">
<header>
    <div class="sysmenu">
        <ul>
            <?php /*<li><a href="#">Сайтын бүтэц<img src="<?php echo _WEB_PUBLIC_ . 'img/sitemap-btn.png'; ?>" alt="Сайтын бүтэц" /></a></li>*/ ?>
            <li><a href="#">English</a></li>
            <li class="sep">|</li>
            <li><a href="#">Сайтын бүтэц</a></li>
            <li class="sep">|</li>
            <li><a href="#">Санал хүсэлт</a></li>
        </ul>
    </div>
    <div class="listo">
        <ul>
            <li><a href="1"><span>Home</span></a></li>
            <li><a href="2"><span>About</span></a></li>
            <li><a href="3"><span>Portfolio</span></a></li>
            <li><a href="4"><span>Contact</span></a></li>
            <li><a href="5"><span>Test</span></a></li>
        </ul>
    </div>
    <h1><a href="<?php echo _WEB_; ?>"><img src="<?php echo _WEB_PUBLIC_; ?>img/weblogo.png" alt="Return to the homepage" /></a></h1>
    <div class="navmenu">
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li class="sep">|</li>
            <li><a href="#">TUTORIALS</a>
                <ul>
                    <li><a href="#">Tusdg</a></li>
                    <li><a href="#">TUTORIALS</a></li>
                </ul>
            </li>
            <li class="sep">|</li>
            <li class="current"><a href="#">ARTICLES</a>
                <ul>
                    <li><a href="#">ARTICLES</a></li>
                    <li class="current"><a href="#">ARTICLES</a></li>
                </ul>
            </li>
            <li class="sep">|</li>
            <li><a href="#">INSPIRATION</a></li>
        </ul>
    </nav>
    </div>
    <div class="lighter">
        <form id="searchform">
            <span><input type="text" class="search rounded" placeholder="Search..."></span>
        </form>
    </div>
</header>
<section id="slide">
    <div class="flexslider">
        <ul class="slides">
            <li><a href="<?php echo _WEB_PUBLIC_?>slider/01.jpg" rel="bookmark" ><img src="<?php echo _WEB_PUBLIC_?>slider/01.jpg" alt="" /></a></li>
            <li><a href="<?php echo _WEB_PUBLIC_?>slider/02.jpg" rel="bookmark" ><img src="<?php echo _WEB_PUBLIC_?>slider/02.jpg" alt="" /></a></li>
            <li><a href="<?php echo _WEB_PUBLIC_?>slider/03.jpg" rel="bookmark" ><img src="<?php echo _WEB_PUBLIC_?>slider/03.jpg" alt="" /></a></li>
            <li><a href="<?php echo _WEB_PUBLIC_?>slider/04.jpg" rel="bookmark" ><img src="<?php echo _WEB_PUBLIC_?>slider/04.jpg" alt="" /></a></li>
            <li><a href="<?php echo _WEB_PUBLIC_?>slider/05.jpg" rel="bookmark" ><img src="<?php echo _WEB_PUBLIC_?>slider/05.jpg" alt="" /></a></li>
        </ul>
    </div>
    <aside id="reghelper">
    </aside>
</section>