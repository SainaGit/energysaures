<?php
defined('CODESAUR') || exit(1);

$web = array_merge(require_config('head', _COMMON_), require_config('web'));
$und = codesaur::instance()->controller->config;
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
codesaur::instance()->controller->incStyleToHtml('und/style.css');
if (codesaur::instance()->controller->isEmailForm) return;
?>
</head>
<body>
<div class="container">	
    <div id="header">    
    	<div id="logo">
            <a href="<?php echo _WEB_; ?>"><img src="<?php if (isset($und['logo'])) echo $und['logo']; ?>" alt="logo"/></a>
        </div>            
        <div id="contact_details">
            <?php
                if (isset($und['contact']))
                    foreach($und['contact'] as $contact)
                        echo $contact;
            ?>
        </div>
    </div>
    <div style="clear:both"></div>
    <div id="main">
        <div id="content">
            <div class="text">
                <h2><?php if (isset($und['underconstructing'])) echo $und['underconstructing']; ?></h2>
            </div>
            <div class="counter">
                <h3><?php if (isset($und['tilltext'])) echo $und['tilltext']; ?></h3>
                <div id="defaultCountdown"></div>
            </div>
            <div class="details">
                <a class="prev" href="#"><img src="<?php echo _WEB_PUBLIC_?>und/prev.png" alt="" /></a>
                <div id="sliderwrap">
                    <div id="slidertext">
                        <ul>
                            <li>
                                <?php
                                if (isset($und['intro']))
                                    foreach($und['intro'] as $intro)
                                        echo $intro;
                                ?>
                            </li>
                            <li>
                                <h3><?php if (isset($und['contact_through'])) echo $und['contact_through']; ?></h3>
                                <div class="social">
                                    <?php
                                        if (isset($und['yahoo']))
                                            echo '<a href="ymsgr:sendIM?' . $und['yahoo'] . '" class="yahoo">Yahoo</a>';
                                        if (isset($und['facebook']))
                                            echo '<a href="' . $und['facebook'] . '" class="facebook">Facebook</a>';
                                        if (isset($und['google']))
                                            echo '<a href="' . $und['google'] . '" class="google">Google</a>';
                                        if (isset($und['twitter']))
                                            echo '<a href="' . $und['twitter'] . '" class="twitter">Twitter</a>';
                                        if (isset($und['youtube']))
                                            echo '<a href="' . $und['youtube'] . '" class="youtube">YouTube</a>';
                                        if (isset($und['skype']))
                                            echo '<a href="' . $und['skype'] . '" class="skype">Skype</a>';
                                        if (isset($und['stumbleupon']))
                                            echo '<a href="' . $und['stumbleupon'] . '" class="stumbleupon">StumbleUpon</a>';
                                    ?>
                                </div>
                            </li>
                            <li>
                            <h3><?php if (isset($und['feedback'])) echo $und['feedback']; ?></h3>
                            <form method="post" id="subscribeform" action="<?php echo codesaur::instance()->router->generate('feedback_underconstruction'); ?>">
                                <div id="email_input">
                                    <input name="email" type="text" size="30" value="<?php if (isset($und['your_email'])) echo $und['your_email']; ?>" onfocus="if(this.value=='<?php if (isset($und['your_email'])) echo $und['your_email']; ?>'){this.value=''};" 	onblur="if(this.value==''){this.value='<?php if (isset($und['your_email'])) echo $und['your_email']; ?>'};" id="email" />
                                    <input name="message" type="text" size="80" value="<?php if (isset($und['message'])) echo $und['message']; ?>" onfocus="if(this.value=='<?php if (isset($und['message'])) echo $und['message']; ?>'){this.value=''};" 	onblur="if(this.value==''){this.value='<?php if (isset($und['message'])) echo $und['message']; ?>'};" id="message" />
                                    <input type="submit" id="submit" value="<?php if (isset($und['send'])) echo $und['send']; ?>" size="60" />
                                </div>
                            </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <a class="next" href="#"><img src="<?php echo _WEB_PUBLIC_?>und/next.png" alt=""/></a>
            </div>
        </div>
        <p class="copyright"><?php if (isset($und['copyright'])) echo $und['copyright']; ?></p>
    </div>
<?php
codesaur::instance()->controller->incScriptToHtml('http://code.jquery.com/jquery-latest.pack.js', '');
codesaur::instance()->controller->incScriptsToHtml(array('thirdparty/countdown/jquery.countdown.js', 'thirdparty/countdown/jquery.countdown-mn.js', 'und/jcarousellite1.0.1_min.js'));
?>
<script type="text/javascript">
$(function () {
var austDay = new Date("<?php if (isset($und['till'])) echo $und['till']; else echo "April 25, 2013 18:00:00"; ?>");
    $('#defaultCountdown').countdown({until: austDay, layout: '{dn} {dl}, {hn} {hl}, {mn} {ml}, {sn} {sl}'});
    $('#year').text(austDay.getFullYear());
    });
$(function() {
    $("#slidertext").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev"
    });
});
</script>
</div>
</body>
</html>