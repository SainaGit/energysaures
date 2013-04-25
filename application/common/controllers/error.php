<?php
defined('CODESAUR') || exit(1);

use cdn\Controller;

class ErrorController extends Controller
{
    function error404($error) {
        codesaur::end($error);
    }
}