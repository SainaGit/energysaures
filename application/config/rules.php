<?php
defined('CODESAUR') || exit(1);

return array(
    array('/', 'Site'),
    array('/under/', 'Under'),
    array('/under/feedback/', 'Under:emailForm', array('name' => 'feedback_underconstruction', 'methods' => 'POST')),
    array('/test/', 'Site')
);