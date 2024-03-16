<?php defined('TEMPLATEPATH') or die('Access denied!');

//------------------------------------------------------------------------------
// Filter and search
//------------------------------------------------------------------------------
    
if(isset($_GET['s'])){
    
    if(!preg_match('/^\/\?/',$_SERVER['REQUEST_URI'])){
        wp_redirect(site_url('/').'?'.explode('?',$_SERVER['REQUEST_URI'])[1]);
        exit;
    }
//    var_dump($_SERVER['REQUEST_URI'],preg_match('/^\/\?/',$_SERVER['REQUEST_URI']));
    
    $_GET['post_type']='product';
    define('LKH_IS_SEARCH',TRUE);
}





add_filter( 'storefront_sidebar_widget_tags',function( $widget_tags ) {
    
    $widget_tags['before_widget']='<div id="lkh-filterAttrBox-%1$s" class="js-lkh-filterAttrBox">'.$widget_tags['before_widget'];
    $widget_tags['after_widget']=$widget_tags['after_widget'].'</div>';


    $widget_tags['before_title']='<div class="js-lkh-filterAttrBoxTitle lkh-filterAttrBoxTitle">'.$widget_tags['before_title'];
    $widget_tags['after_title']=$widget_tags['after_title'].'<div class="lkh-filterAttrBoxTitleBtn"></div></div>';
    
    return $widget_tags;
});

//add_action('storefront_sidebar',function($index){
//    echo '<div class="js-lkh-sectionFilterBtn lkh-sectionFilterBtn">Filter <i class="lkh-icomoon-right"></i></div>';
//},-10);



add_action('wp_footer',function(){

    ?>
        <div class="lkh-sectionFilterFixedHeader">
            Filter
            <div id="lkh-sectionFilterCloseBtn" class="lkh-sectionFilterCloseBtn">
                <i class="lkh-icomoon-crooss"></i>
            </div>
        </div>
    <?php
});

add_action('dynamic_sidebar_after',function($index){
    
    if($index=='sidebar-1' && lkh_filter::filterOnPage()){
        
        $filterResetUrl=explode('?',(string)$_SERVER['REQUEST_URI'])[0];
        
        ?>
            <div class="lkh-catalogFilterFooter">

                <div class="lkh-filterResetBtn"><a href="<?=$filterResetUrl?>">Reset filter</a></div>
            
            </div>
        <?php
    }
});



add_filter('woocommerce_layered_nav_term_html',function( $term_html ) {
    
    if(defined('LKH_IS_SEARCH')){
        $term_html=preg_replace('/ href="[^\?]+/',' href="'.site_url('/'),$term_html);
    }
    
//    $arr=explode('<span class="count">',$term_html);
//    if(count($arr)==2){
//        $term_html='<div style="clear: both"></div><span class="count">'.$arr[1].' '.$arr[0].'<div style="clear: both"></div>';
//    }
    
    return $term_html;
});



add_filter('body_class',function($classes) {
    
    if(lkh_filter::filterOnPage()){
        $classes[] = 'lkh-filterOnPage';
    }
    
    return $classes;
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Sort
//------------------------------------------------------------------------------


add_action('woocommerce_archive_description',function(){
        //if(defined('LKH_IS_SEARCH')) {
        //    <li data-value="relevance">Relevance</li>
        //    <li data-value="popularity">Sort by popularity</li>
        //    <li data-value="date">Sort by latest</li>
        //    <li data-value="price">Sort by price &uarr;</li>
        //    <li data-value="price-desc">Sort by price &darr;</li>
        //} else {
        //    <li data-value="menu_order">Default sorting</li>
        //    <li data-value="popularity">Sort by popularity</li>
        //    <li data-value="rating">Sort by rating</li>
        //    <li data-value="date">Sort by latest</li>
        //    <li data-value="price">Sort by price &uarr;</li>
        //    <li data-value="price-desc">Sort by price &darr;</li>
        //}
    
        ?>
        
            <div class="js-lkh-catalogSort lkh-catalogSort">
                <div class="js-lkh-catalogSortVal lkh-catalogSortVal">&nbsp;</div>
                <div class="js-lkh-catalogSortSelectShadow lkh-catalogSortSelectShadow"></div>
                <ul class="js-lkh-catalogSortSelect"></ul>  
            </div>  
            
        <?php
});
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Количество товаров в каталоге
//------------------------------------------------------------------------------
add_filter( 'loop_shop_per_page', function ( $cols ) {
    
    if(is_product_category()){
        $cols=30;
    }
    
    return $cols;
}, 20 );
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Вывод картинки товара в каталоге
//------------------------------------------------------------------------------
add_filter( 'woocommerce_product_get_image', function ($imageHtml, $ProductObj) {
    
    $style='';
    
    if(
        preg_match('/ src="([^"]+)" /',$imageHtml,$mSrc)
        && preg_match('/ srcset="([^"]+)" /',$imageHtml,$mSrcSet)
    ){
        $mSrc=$mSrc[1];
        $mSrcSet=$mSrcSet[1];
        
        $style='background-image: url(\''.$mSrc.'\');';
        
        $srcsetStyle='';
        foreach(explode(',',$mSrcSet) as $mSrcSetV){
            $mSrcSetVValArr=explode(' ',$mSrcSetV);
            if(count($mSrcSetVValArr)==2){
                $srcsetStyle.=($srcsetStyle==''?'':', ').'url(\''.$mSrcSetVValArr[0].'\') '.$mSrcSetVValArr[1];
            }
        }
        
        if($srcsetStyle!=''){
            $style.='background-image: -webkit-image-set('.$srcsetStyle.');';
        }
    }
    
    return '<div class="js-lkh-sectionProductImage lkh-sectionProductImage" style="'.$style.'">'.$imageHtml.'</div>';
    
},10,2);
//------------------------------------------------------------------------------


    
//------------------------------------------------------------------------------
// Описание категории перед футером
//------------------------------------------------------------------------------

add_action('storefront_before_footer',function(){
    if(is_product_category()){
        
        $fields=lkh_section::getFields(get_queried_object());
        
        if($fields['footer_desc_title']!='' && $fields['footer_desc']!=''){
            ?>
                <div class="lkh-sectionFooterDesc">
                    <div class="col-full">
                        <div class="lkh-sectionFooterDescH">
                            <div class="lkh-slideH">
                                <span><span><?=$fields['footer_desc_title']?></span></span>
                            </div>
                        </div>
                        <div class="lkh-sectionFooterDescText">
                            <?=$fields['footer_desc']?>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
}, 20 );
    
//------------------------------------------------------------------------------





//------------------------------------------------------------------------------
//
//------------------------------------------------------------------------------

add_action('woocommerce_before_shop_loop_item',function(){
    ?>
        <div class="lkh-sectionProductItem">
    <?php
},-800);

add_action('woocommerce_after_shop_loop_item',function(){
    ?>
        </div><!--/lkh-sectionProductItem-->
    <?php
},800);

//------------------------------------------------------------------------------