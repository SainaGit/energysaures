<?php
defined('CODESAUR') || exit(1);

use cdn\Controller;

class SiteController extends Controller
{
    function __construct() {
        
    }

    function index() {
        $this->loadView('header');
        $this->HtmlEndOfLine();
        $this->loadView('home');
        $this->HtmlEndOfLine();
        $this->loadView('footer');
    }
}