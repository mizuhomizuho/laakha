<?php
/*
Plugin Name: Shop image size
Description: Normal image size
Version: 0.1
*/

// Если миниатюра не создается а вместо нее показывается оригинально изображение:
// sudo apt install php-imagick
// sudo service apache2 restart

// Для изображения товара на странице каталога
add_filter('woocommerce_get_image_size_thumbnail',function(){
    return [
        'width'=>500,
        'height'=>500,
        'crop'=>0,
    ];
});

// Для большого изображения на странице товара
add_filter('big_image_size_threshold',function(){
    return 1920;
});

// Для миниатюр в галерее на странице товара
add_filter('woocommerce_get_image_size_gallery_thumbnail',function(){
    return [
        'width'=>200,
        'height'=>200,
        'crop'=>1,
    ];
});
