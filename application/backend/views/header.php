<?php
defined('CODESAUR') || exit(1);

$web = require_config('head', _COMMON_);
?>
<!doctype html>
<html lang="<?php echo $web['lang']; ?>" dir="<?php echo $web['dir']; ?>">
<head>
<meta charset="<?php echo $web['charset']; ?>">
<title><?php echo $web['title']; ?></title>
<meta name="description" content="<?php echo $web['description']; ?>">
<meta name="author" content="<?php echo $web['author']; ?>">
<link rel="shortcut icon" href="<?php echo $web['favico']; ?>" type="image/x-icon" />
<link rel="icon" type="image/png" href="<?php echo $web['icopng']; ?>" /> 
<?php
codesaur::instance()->controller->incStylesToHtml(array('cdn/login.css'));
?>
</head>
<body>
