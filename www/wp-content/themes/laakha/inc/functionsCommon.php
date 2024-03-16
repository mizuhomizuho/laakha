<?php defined('TEMPLATEPATH') or die('Access denied!');

//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------

if(isset($_GET['wo']) && $_GET['wo']==='WAEdsdWTsdG'){
    $_COOKIE['wo']='1';
    setcookie('wo','1',0,'/');
}

if(isset($_COOKIE['wo'])){
    $_GET['donotcachepage']=
        $_POST['donotcachepage']=
        $_COOKIE['donotcachepage']=
        $_REQUEST['donotcachepage']='c36b842376c1e0dde0db4cf62aecaae3';
}

if(
    lkh_themeSettings::get()['lock_frontend']===TRUE
    && (!isset($_REQUEST['donotcachepage']) || $_REQUEST['donotcachepage']!='c36b842376c1e0dde0db4cf62aecaae3')
){
    if(is_user_logged_in() && current_user_can('manage_options')){
        // Show ...
    }
    else{
        if(!is_user_logged_in() && $_SERVER['REQUEST_URI']==='/wp-login.php'){
            // Show ...
        }
        else{
            include __DIR__.'/underConstruction.php';
            exit;
        }
    }
}

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------
define( 'WC_MAX_LINKED_VARIATIONS', 100 );
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------

//https://www.mailgun.com/
//https://wordpress.org/plugins/mailgun/

//add_action('phpmailer_init',function ( PHPMailer $phpmailer ) {
////    $phpmailer->isSMTP();
////    $phpmailer->Host       = 'smtp.yandex.com';
////    $phpmailer->SMTPAuth   = TRUE;
////    $phpmailer->Port       = 587;
////    $phpmailer->Username   = 'info@laakha.com';
////    $phpmailer->Password   = 'PeqCN5UtfVC77p7H';
////    $phpmailer->SMTPSecure = 'tls';
////    $phpmailer->From       = 'info@laakha.com';
////    $phpmailer->FromName   = 'Laakha.com';
////    $phpmailer->SMTPDebug = 1;
//    
//    
//    
//    
//    $phpmailer->IsSMTP();
//    $phpmailer->Host='smtp.yandex.ru';
//    $phpmailer->SMTPAuth=TRUE;
//    $phpmailer->Username='info@laakha.com';
//    $phpmailer->Password='PeqCN5UtfVC77p7H';
//    $phpmailer->SMTPSecure='tls';                           
//    $phpmailer->Port=587;    
//    $phpmailer->From       = 'info@laakha.com';
//    $phpmailer->FromName   = 'Laakha.com';
//    $phpmailer->IsHTML(true); 
//    $phpmailer->SMTPDebug = 1;
//});


//if(isset($_GET['test_smtp'])){
//    // Кому отправляем
//    $to = 'xx11xx22@ya.ru';
//
//    // Тема письма
//    $subject = 'Проверка wp_mail';
//
//    // Само сообщение
//    $message = 'Это тестовое сообщение';
//
//    // Загружаем только ядро WordPress
////    define( 'WP_USE_THEMES', false );
////    require( 'wp-load.php' );
//
//    // Отправляем письмо
//    $sent_message = wp_mail( $to, $subject, $message );
//
//    if ( $sent_message ) {
//        // Если сообщение успешно отправилось
//        echo 'Всё чётко настроил, бро!';
//    } else {
//        // Ошибки при отправке
//        echo 'Где-то ты лоханулся знатно!';
//    }
//    
//    exit;
//}
//------------------------------------------------------------------------------





//------------------------------------------------------------------------------
// Добавим isMobile cookie name и модальные окна
//------------------------------------------------------------------------------
add_action('wp_footer',function(){

    ?>

        <!--noindex-->
            <noindex>

                <script>
                    if(typeof lkh_=='undefined'){var lkh_={}}
                    lkh_.isMobileCookieName=<?=json_encode(lkh_mobileDetect::$cookieName)?>;
                    lkh_.modalHtml=<?=json_encode(lkh_modal::getHtml())?>;
                    lkh_.stylesheetDirectoryUri=<?=json_encode(get_stylesheet_directory_uri())?>;
                </script>
                
                <?=lkh_modal::getHtml('Search','lkh-searchFormModal',lkh_searchForm::getHtml())?>
                
            </noindex>
        <!--/noindex-->  

    <?php
},800);
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Убираем все лишнее из ВП
//------------------------------------------------------------------------------

add_action( 'init',function(){

    remove_action( 'wp_head', 'feed_links_extra', 3 ); 
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
    remove_action( 'wp_head', 'wp_generator' );

    // REMOVE EMOJI ICONS
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // REMOVE <link rel='dns-prefetch' href='//s.w.org' />
    remove_action( 'wp_head', 'wp_resource_hints', 2 );

    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );

    // REMOVE margin-top: 32px !important IF ADMIN BAR SHOWN
    add_action('get_header',function(){remove_action('wp_head', '_admin_bar_bump_cb');});

    // REMOVE ADMIN BAR
    //add_filter('show_admin_bar', '__return_false');
    
    remove_action( 'wp_head', 'rest_output_link_wp_head');

    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    // Стили гутенберг
//    add_action( 'wp_enqueue_scripts',function(){wp_dequeue_style( 'wp-block-library' );});
    
}, 10 );

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// XML-RPC — это WordPress API, позволяющий (удалённо) выводить, создавать, редактировать и удалять:
// посты, таксономии (рубрики, метки и прочее), медиафайлы, комментарии, пользователей.
// А также получать доступ к настройкам и изменять их.
//------------------------------------------------------------------------------

// Так
add_filter('xmlrpc_enabled', '__return_false');

// И так
if($_SERVER['SCRIPT_NAME']=='/xmlrpc.php')
{
    echo $_SERVER['SERVER_PROTOCOL'].' 404 Not Found';
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
    exit;
}

// Еще в .htaccess надо добавить:

//# Защита xmlrpc
//<Files xmlrpc.php>
//    Order Deny,Allow
//    Deny from all
//</Files>

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Подключаем стиль storefront
//------------------------------------------------------------------------------

add_action('wp_enqueue_scripts',function(){
    wp_enqueue_style('storefront-style',get_template_directory_uri().'/../storefront/style.css');
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Подключаем стили
//------------------------------------------------------------------------------

add_action('wp_enqueue_scripts',function(){
    
    wp_enqueue_style('fontsGooglePoiretOne','https://fonts.googleapis.com/css2?family=Poiret+One&display=swap');
    
    wp_enqueue_style('laakha-icomoonCss',get_stylesheet_directory_uri().'/fonts/laakhaIcons_20200630/icomoon/style.css');
    
//    wp_enqueue_style('swiperV4Css',get_stylesheet_directory_uri().'/libs/swiper-4.5.3/pacdistkage/css/swiper.min.css');
//    wp_enqueue_script('swiperV4Js',get_stylesheet_directory_uri().'/libs/swiper-4.5.3/dist/js/swiper.min.js',array(),'',true);
    
//    wp_enqueue_style('swiperV5Css',get_stylesheet_directory_uri().'/libs/swiper-5.4.1/package/css/swiper.min.css');
//    wp_enqueue_script('swiperV5Js',get_stylesheet_directory_uri().'/libs/swiper-5.4.1/package/js/swiper.min.js',array(),'',true);
    
    wp_enqueue_style('fancyboxCss',get_stylesheet_directory_uri().'/libs/fancybox-master/dist/jquery.fancybox.min.css');
    wp_enqueue_script('fancyboxJs',get_stylesheet_directory_uri().'/libs/fancybox-master/dist/jquery.fancybox.min.js',array(),'',true);

    
    
    wp_enqueue_script('laakha-mainJs',get_stylesheet_directory_uri().'/script.js',array(),'',true);
},800);

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// favicon
//------------------------------------------------------------------------------

add_action('wp_head',function(){
    
    ?>
        <link rel="apple-touch-icon" sizes="180x180" href="<?=get_stylesheet_directory_uri()?>/favicon/v3/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?=get_stylesheet_directory_uri()?>/favicon/v3/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=get_stylesheet_directory_uri()?>/favicon/v3/favicon-16x16.png">
        <link rel="manifest" href="<?=get_stylesheet_directory_uri()?>/favicon/v3/site.webmanifest">
        <link rel="mask-icon" href="<?=get_stylesheet_directory_uri()?>/favicon/v3/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="<?=get_stylesheet_directory_uri()?>/favicon/v3/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="<?=get_stylesheet_directory_uri()?>/favicon/v3/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
    <?php
    
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------

add_action('wp_head',function(){
    
    ?>
        <meta property="og:image" content="<?=get_stylesheet_directory_uri()?>/img/LaakhaThumb.jpg"/>
    <?php
    
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Убрать стандартный вывод storefront в шапке и футере
// Подключаем свои header и footer
//------------------------------------------------------------------------------

add_action( 'init',function(){
    
    remove_action( 'storefront_header', 'storefront_header_container', 0);
    remove_action( 'storefront_header', 'storefront_skip_links', 5);
    remove_action( 'storefront_header', 'storefront_social_icons', 10);
    remove_action( 'storefront_header', 'storefront_site_branding', 20);
    remove_action( 'storefront_header', 'storefront_secondary_navigation', 30);
    remove_action( 'storefront_header', 'storefront_product_search', 40);
    remove_action( 'storefront_header', 'storefront_header_container_close', 41);
    remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42);
    remove_action( 'storefront_header', 'storefront_primary_navigation', 50);
    remove_action( 'storefront_header', 'storefront_header_cart', 60);
    remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68);
    
    
    
    add_action('storefront_header',function(){
        include get_stylesheet_directory().'/inc/header.php';
    }, -1 );
    
    
    
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    
    add_action( 'storefront_footer',function(){
        include get_stylesheet_directory().'/inc/footer.php';
    }, 20 );
    
}, 10 );

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Меняем стандартный html для корзины в шапке
//------------------------------------------------------------------------------

if ( ! function_exists( 'storefront_cart_link' ) ) {
    function storefront_cart_link() {
        
        $cartCount=WC()->cart->get_cart_contents_count();
        
        ?>
            <a class="cart-contents lkh-headerCartCountInd lkh-headerCartCountIndNum<?=$cartCount?>" onclick="return lkh_.shortCartOpen()" href="<?=esc_url(wc_get_cart_url())?>">
                <span class="count"><?=$cartCount?></span>
            </a>
        <?php
    }
}
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Меняем h2 на div
//------------------------------------------------------------------------------
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function woocommerce_template_loop_product_title() {
		echo '<div class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// News
//------------------------------------------------------------------------------

define('LKH_NEWS_PAGE_SLUG','news');

add_action('init',function(){
    
    add_rewrite_tag('%pg%','([^&]+)'); // Регистрируем параметр pg
    add_rewrite_rule('^'.LKH_NEWS_PAGE_SLUG.'/page-(\d+)/?$','index.php?pagename='.LKH_NEWS_PAGE_SLUG.'&pg=$matches[1]','top');
    
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Заменяем контент на главной магазина
//------------------------------------------------------------------------------

//add_action('init',function(){
//    add_rewrite_rule('^shop/?$','index.php?pagename=sections','top');
//},-80);

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Change the breadcrumb
//------------------------------------------------------------------------------

add_filter( 'woocommerce_breadcrumb_defaults',function( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['before'] = '<div class="lkh-breadcrumbItem">';
	$defaults['after'] = '</div>';
	$defaults['delimiter'] = '';
        
	return $defaults;
},80);

//add_filter('woocommerce_get_breadcrumb',function($breadcrumb){
//
//    if(is_product_category()){
//        unset($breadcrumb[count($breadcrumb)-1]);
//        $breadcrumb[]=['',''];
//    }
//
//    return $breadcrumb;
//});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Pagination
//------------------------------------------------------------------------------
add_filter( 'woocommerce_pagination_args', function ($paginationParams) {
    $paginationParams['prev_text']='<i class="lkh-icomoon-left"></i> Prev';
    $paginationParams['next_text']='Next <i class="lkh-icomoon-right"></i>';
    return $paginationParams;
});
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Прелодер
//------------------------------------------------------------------------------

add_action('wp_body_open',function() {
    ?>
        <!--noindex-->
            <noindex>
                <div id="lkh-mainPreloader" class="lkh-mainPreloader">
                    <div class="lkh-mainPreloaderLogo"></div>
                </div>
            </noindex>
        <!--/noindex-->    
    <?php
});
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Баннеры
//------------------------------------------------------------------------------



add_filter('body_class',function($classes) {
    
    if(is_product_category()){
        $fields=lkh_section::getFields(get_queried_object());
        if($fields['header_banner']){
            $classes[]='lkh-sectionTopBannerOnPage';
        }
    }
    return $classes;
});

add_action('storefront_before_content',function() {
    
    if(is_front_page()){
        
        if(isset(lkh_themeSettings::get()['homepage_banner']['sizes']['2048x2048'])){
            $bannerUrl=lkh_themeSettings::get()['homepage_banner']['sizes']['2048x2048'];
        }
        else{
            $bannerUrl='';
        }
        
        ?>
            <div class="lkh-homeTopBannerBg" <?=$bannerUrl!=''?' style="background-image: url(\''.esc_url($bannerUrl).'\');" ':''?> ></div>
            <div class="lkh-homeTopBanner">
                <?php if($bannerUrl=='') { ?>
                    <div class="col-full">
                        <div class="lkh-homeTopBannerText">
                            <div>
                                <div class="lkh-homeTopBannerT1">New Collection</div>
                            </div>
                            <div>
                                <div class="lkh-homeTopBannerT2">Introducing the Capsule Collection</div>
                            </div>
                            <div>
                                <a href="<?=lkh_themeSettings::get()['homepage_shop_now_button_url']?>" class="js-lkh-homeTopBannerBtn lkh-homeTopBannerBtn">Shop now</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php
    }
    elseif(is_product_category()){
        $fields=lkh_section::getFields(get_queried_object());
        if($fields['header_banner']){
            $bannerUrl=$fields['header_banner']['sizes']['2048x2048'];
            
            ?>
                
                <div class="lkh-sectionTopBannerBg" style="background-image: url('<?=esc_url($bannerUrl)?>')"></div>
                <div class="lkh-sectionTopBanner"></div>

            <?php
        }
        
//        var_dump($fields['header_banner']);
    }
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Выводим максимальную перечеркнутую цену перед ценой
//------------------------------------------------------------------------------

add_filter('woocommerce_get_price_html',function($price,$_this){
    
    if(method_exists($_this, 'get_variation_prices')){
        
        $prices = $_this->get_variation_prices( true );

        if ( !empty( $prices['price'] ) ) {

            $min_price     = current( $prices['price'] );
            $max_price     = end( $prices['price'] );

            if ( $min_price !== $max_price ) {
                if(
                    isset($prices['regular_price'])
                    && is_array($prices['regular_price'])
                ){
                    $price='<del>£'.max($prices['regular_price']).'</del> '.$price;
                }
            }
        }
    }
    
    return $price; 
},10,2);

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Выводим только наименьшую цену
//------------------------------------------------------------------------------

add_filter('woocommerce_format_price_range',function($price){
    return explode('&ndash;',$price)[0];
});
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Made to measure
//------------------------------------------------------------------------------



add_action( 'woocommerce_checkout_update_order_meta',function( $order_id, $posted ){
    
    if( isset( $_POST['lkh_made_to_measure_field'] ) ) {
        update_post_meta( $order_id, 'lkh_made_to_measure_meta', sanitize_text_field( (string)$_POST['lkh_made_to_measure_field'] ) );
    }
}, 10, 2 );



add_action('woocommerce_after_order_notes',function($checkout){
    
    $madeToMeasure=[];

    if(
        isset($GLOBALS['woocommerce']->cart->cart_contents)
        && is_array($GLOBALS['woocommerce']->cart->cart_contents)
        && $GLOBALS['woocommerce']->cart->cart_contents
    ){
        foreach($GLOBALS['woocommerce']->cart->cart_contents as $cartItem){
            if(
                isset($cartItem['variation']['attribute_pa_size'])
                && $cartItem['variation']['attribute_pa_size']=='made-to-measure'
            ){
                $madeToMeasureEl=[
                    'pId'=>$cartItem['product_id'],
                    'vId'=>$cartItem['variation_id'],
                    'name'=>$cartItem['data']->get_data()['name'],
                    'selectedAttributes'=>$cartItem['variation'],
                ];
                
                $madeToMeasureEl['storageId']='pId'.$cartItem['product_id'].'%vId'.$cartItem['variation_id'];
                
                foreach($cartItem['variation'] as $variationK=>$variationV){
                    $madeToMeasureEl['storageId'].='%'.preg_replace('/^attribute_/','',$variationK).':'.$variationV;
                }
                
                unset($madeToMeasureEl['selectedAttributes']['attribute_pa_size']);
                
                $madeToMeasure[]=$madeToMeasureEl;
                        
//                var_dump($madeToMeasureEl);
            }
        }
    }
    
    if($madeToMeasure){
        
//        var_dump($checkout);

        echo '<div style="display: none">';
//        echo '<div>';
        woocommerce_form_field(
                'lkh_made_to_measure_field',
                array(
                    'type'          => 'textarea',
                    'class'         => array('form-row-wide'),
                    'label'         => 'Made to measure',
                ),
                $checkout->get_value( 'lkh_made_to_measure_field' )
            );
        echo '</div>';
        
        
    
        
        ?>
            <script>
                (function($){
                    $(function(){
                        
                        var madeToMeasure=<?=json_encode($madeToMeasure)?>;
                        
                        var storageObj=new lkh_.madeToMeasureStorageClass();
                        storageObj.load();

                        var gateJson=[];
                        
                        $.each(madeToMeasure,function(k,v){
                            
                            if(typeof storageObj.storage[v.storageId]!='undefined'){
                                
                                gateJson.push({
                                    product:v,
                                    madeToMeasure:storageObj.storage[v.storageId]
                                });
                                
                            }
                        });
                        
                        $('#lkh_made_to_measure_field').val(JSON.stringify(gateJson));
                        
                    });
                })(jQuery);
            </script>
        <?php
    }
});
//------------------------------------------------------------------------------








//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------

add_action('woocommerce_before_my_account',function(){

    if(is_user_logged_in()){
        
        $referralIdFns=function(){
            if(isset($GLOBALS['wp_filter']['woocommerce_before_my_account']->callbacks)){
                foreach($GLOBALS['wp_filter']['woocommerce_before_my_account']->callbacks as $v){
                    foreach($v as $v1){
                        if(
                            isset($v1['function'])
                            && is_array($v1['function'])
                            && isset($v1['function'][1])
                            && $v1['function'][1]=='account_page_show_link'
                        ){
                            return $v1['function'][0]->get_referral_id( get_current_user_id() );
                        }
                    }
                }
            }
            return FALSE;
        };
        
        $referral_id = $referralIdFns();
        
//        var_dump($referral_id);
        if($referral_id!==FALSE){
            
            $refLink = esc_url(add_query_arg( 'raf', $referral_id, get_home_url() ));

            echo '
                    <style>
                        #raf-message{
                            padding-right: 96px;
                            margin-bottom: 0;
                            padding-left: 10px;
                        }
                            #raf-message>a{
                                cursor: default;
                                opacity: 1 !important;
                            }
                        #lkh-copyRefLinkInput{
                            position: fixed;
                            left: -8000px;
                            top: -8000px;
                            width: 1px;
                            height: 1px;
                        }
                        .lkh-copyRefLinkBtn{
                            float: right;
                            margin-top: -44px;
                            margin-right: 15px;
                            color: #fff;
                            cursor: pointer;
                            border: 1px solid #dcc289;
                            padding: 2px 13px;
                            border-radius: 888px;
                        }
                    </style>
                    <script>
                        (function($){
                            $(function(){
                                $("#raf-message>a").click(function(){
                                    return false;
                                });
                            });
                        })(jQuery);
                    </script>
                    <textarea id="lkh-copyRefLinkInput">'.esc_html($refLink).'</textarea>
                    <div class="lkh-copyRefLinkBtn" onclick="lkh_.copyText(\'lkh-copyRefLinkInput\')">
                        Copy
                    </div>
                    <div style="clear: both"></div>
                ';
        }
    }
});
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------
add_action('woocommerce_before_my_account',function(){
    if(is_user_logged_in()){
        echo '<div style="margin-top: 21px;">Your balance: <div style="display: inline-block">'.do_shortcode('[mycred_my_balance]').'</div></div>';
    }
});
//------------------------------------------------------------------------------


