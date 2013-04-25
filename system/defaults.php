<?php
defined('CODESAUR')           || exit(1);

defined('DS')                 || define('DS', "/");
defined('EXT')                || define('EXT', ".php");

defined('DEF_APP')            || define('DEF_APP', "application");
defined('DEF_BASE')           || define('DEF_BASE', "base");
defined('DEF_BACKEND')        || define('DEF_BACKEND', "backend");
//defined('DEF_FRONTEND')       || define('DEF_FRONTEND', "frontend");
defined('DEF_COMMON')         || define('DEF_COMMON', "common");
defined('DIR_CONFIG')         || define('DIR_CONFIG', "config");
defined('DIR_CONTROLLER')     || define('DIR_CONTROLLER', "controllers");
defined('DIR_MODEL')          || define('DIR_MODEL', "models");
defined('DIR_VIEW')           || define('DIR_VIEW', "views");
defined('DEF_PUBLIC')         || define('DEF_PUBLIC', "public");
defined('DIR_THIRDPARTY')     || define('DIR_THIRDPARTY', "thirdparty");
defined('DEF_TEMP')           || define('DEF_TEMP', "tmp");
defined('DIR_CACHE')          || define('DIR_CACHE', "cache");
defined('DIR_SESSION')        || define('DIR_SESSION', "sessions");
defined('DIR_LOG')            || define('DIR_LOG', "logs");
defined('ERROR_LOG')          || define('ERROR_LOG', "code-err.log");

defined('ROUTE_BACKEND')      || define('ROUTE_BACKEND', DS . "admin" . DS);

defined('SUFFIX_CONTROLLER')  || define('SUFFIX_CONTROLLER', "Controller");
defined('SUFFIX_MODEL')       || define('SUFFIX_MODEL', "Model");
defined('SUFFIX_VIEW')        || define('SUFFIX_VIEW', "View");
defined('CONTROLLER_ACTION')  || define('CONTROLLER_ACTION', ":");
defined('DEFAULT_CONTROLLER') || define('DEFAULT_CONTROLLER', "Home");
defined('DEFAULT_ACTION')     || define('DEFAULT_ACTION', "index");
defined('STRICT_ACTION')      || define('STRICT_ACTION', defined('NON_STRICT_ACTION') ? FALSE : TRUE);

defined('RULES_CFG')          || define('RULES_CFG', "rules");

defined('SESS_AUTH')          || define('SESS_AUTH', "cdn_user_login");

defined('AUTHORTTL')          || define('AUTHORTTL', 'Кодезавр');
defined('AUTHORWEB')          || define('AUTHORWEB', 'http://www.coden.mn');
defined('AUTHORTXT')          || define('AUTHORTXT', AUTHORTTL . ' систем нь “Мөнхийн-Ололт” ХХК-ны бүтээл &copy ' . date('Y') . '.');
defined('AUTHORINF')          || define('AUTHORINF', 'coden aka NarankhuuN, naregmailbox@yahoo.com, +976 99105835');