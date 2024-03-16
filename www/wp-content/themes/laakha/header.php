<?php

ob_start();
include get_template_directory().'/header.php';
$headerContent=ob_get_clean();

$headerContent=str_replace([
        '<link rel="profile" href="http://gmpg.org/xfn/11">',
        '<link rel="pingback" href="'.get_bloginfo( 'pingback_url' ).'">', 
    ],[
        '',
        '',
    ],$headerContent);

echo $headerContent;
