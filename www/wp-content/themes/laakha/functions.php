<?php

//flush_rewrite_rules();

//exit;


//phpinfo();

// Скидки 
//https://qna.habr.com/q/606086
//https://ru.wordpress.org/plugins/search/Discounts+WooCommerce/
//https://qna.habr.com/q/496674

//if(isset($_GET['sfwgeg24'])){
//    nocache_headers();
//    wp_clear_auth_cookie();
//    wp_set_auth_cookie( 1 );
//    exit;
//}



include_once get_stylesheet_directory().'/inc/classes.php';
    
if(is_admin()){
    include_once get_stylesheet_directory().'/inc/functionsAdmin.php';
}
else{
    include_once get_stylesheet_directory().'/inc/functionsCommon.php';
    include_once get_stylesheet_directory().'/inc/functionsProduct.php';
    include_once get_stylesheet_directory().'/inc/functionsSection.php';
}
