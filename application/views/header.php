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
<meta name="robots" content="<?php echo $web['robots']; ?>" />
<meta name="keywords" content="<?php echo $web['keyboards']; ?>" />
<meta name="viewport" content="<?php echo $web['viewport']; ?>">
<title><?php echo $web['title']; ?></title>
<link rel="shortcut icon" href="<?php echo $web['favico']; ?>" type="image/x-icon" />
<link rel="icon" type="image/png" href="<?php echo $web['icopng']; ?>" /> 
<?php
codesaur::instance()->controller->incStylesToHtml(array('css/energymo.css', 'css/nav.css', 'css/listo.css'));
?>
<!--[if IE]>
<script>
  document.createElement('header');
  document.createElement('footer');
  document.createElement('section');
  document.createElement('nav');
</script>
<![endif]-->
</head>
<body>
<div id="container">
<header>
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
    <div class="sysmenu">
        <ul>
            <li><img src="#" alt="Сайтын бүтэц" /><a href="#">Сайтын бүтэц</a></li>
            <li><img src="#" alt="Санал хүсэлт" /><a href="#">Санал хүсэлт</a></li>
            <li><img src="#" alt="English" /><a href="/?lang=en">English</a></li>
        </ul>
    </div>
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
</header>
<section id="splash">
    <div class="slider">
      <ul class="items">
        <li><img src="<?php echo _WEB_PUBLIC_; ?>slider/slide1-splash.jpg" alt="" /><span class="banner">We meet a wide range of fabrication requirements</span></li>
        <li><img src="<?php echo _WEB_PUBLIC_; ?>slider/slide2-splash.jpg" alt="" /><span class="banner">Providing premium products of exceptional value</span></li>
        <li><img src="<?php echo _WEB_PUBLIC_; ?>slider/slide3-splash.jpg" alt="" /><span class="banner">A wide range of high quality structural steel projects </span></li>
        <li><img src="<?php echo _WEB_PUBLIC_; ?>slider/slide4-splash.jpg" alt="" /><span class="banner">Offering the best level of excellence in steel fabrication</span></li>
      </ul>
      <div class="banner-bg"> </div>
      <a href="#" class="prev">prev</a><a href="#" class="next">next</a>
    </div>
</section>
