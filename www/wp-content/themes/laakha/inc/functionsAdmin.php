<?php defined('TEMPLATEPATH') or die('Access denied!');



//------------------------------------------------------------------------------
// Подключаем стили редактора
//------------------------------------------------------------------------------

add_action('admin_head',function(){
    wp_enqueue_style('fontsGooglePoiretOne','https://fonts.googleapis.com/css2?family=Poiret+One&display=swap');
});

add_action('after_setup_theme',function () {
    add_editor_style('css/editor.css');
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Страница настроек
//------------------------------------------------------------------------------

add_action('admin_head',function(){

//        return;

    ?>
        <style>
            #menu-posts-theme_settings .wp-submenu{
                display: none;
            }
        </style>
    <?php



    if(isset($_GET['post'],$_GET['action']) && $_GET['action']=='edit'){
        ?>
            <style>
                .post-type-theme_settings #titlewrap,  
                .post-type-theme_settings #wpbody-content .wrap .page-title-action,
                .post-type-theme_settings #delete-action,
                .post-type-theme_settings #misc-publishing-actions .edit-post-status,
                .post-type-theme_settings #misc-publishing-actions .edit-visibility,
                .post-type-theme_settings #misc-publishing-actions .misc-pub-curtime{
                    display: none;
                }
            </style>
        <?php
    }
    elseif(isset($_GET['post_type']) && $_GET['post_type']=='theme_settings'){
        ?>
            <style>
                .post-type-theme_settings #wpbody-content .wrap .page-title-action,
                .post-type-theme_settings #wpbody-content #posts-filter .search-box,
                .post-type-theme_settings #wpbody-content #posts-filter .tablenav,
                .post-type-theme_settings #wpbody-content #posts-filter .wp-list-table .check-column,
                .post-type-theme_settings #wpbody-content #posts-filter .wp-list-table .column-date,
                .post-type-theme_settings #wpbody-content .subsubsub,
                .post-type-theme_settings .row-actions .inline,
                .post-type-theme_settings .row-actions .trash{
                    display: none;
                }
            </style>
        <?php
    }
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Made to measure
//------------------------------------------------------------------------------
 
add_action( 'add_meta_boxes',function(){
    
    add_meta_box(
        'lkh_made_to_measure_meta_box',
        'Made to measure',
        function(){
        
            $json=get_post_meta(get_the_ID(),'lkh_made_to_measure_meta',TRUE);
            $arr=json_decode($json,TRUE);
            
            $str='';
            if($arr && is_array($arr)){
                foreach($arr as $arrK=>$arrV){
                    
                    if($arrK){
                        $str.='<hr>';
                    }
                    
                    $str.='<b>Product name:</b> '.wp_strip_all_tags($arrV['product']['name']);
                    $str.='<br><b>Product ID:</b> '.wp_strip_all_tags($arrV['product']['pId']);
                    $str.='<br><b>Variation ID:</b> '.wp_strip_all_tags($arrV['product']['vId']);
                    $str.='<br><b>Attributes:</b> '.wp_strip_all_tags(var_export($arrV['product']['selectedAttributes'],TRUE));
                    
                    foreach($arrV['madeToMeasure'] as $madeToMeasureV){
                        $str.='<br><b>'.wp_strip_all_tags($madeToMeasureV['name']).':</b> '.wp_strip_all_tags($madeToMeasureV['value']);
                    }
                }
            }
            
            echo $str;
        },
        'shop_order',
        'normal',
        'high'
    );
},80);

//------------------------------------------------------------------------------