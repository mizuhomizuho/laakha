<?php defined('TEMPLATEPATH') or die('Access denied!');

//------------------------------------------------------------------------------
//
//------------------------------------------------------------------------------

class lkh_cache{
    
    public static function init() {
        if(is_user_logged_in() && current_user_can('manage_options')){
            if('delcachepage'===filter_input(INPUT_GET,'action')){ // Очистка из внешней части
                self::deleteAllTransient();
            }
            else{
                add_action('wp_cache_cleared',function(){ // Очистка из админки
                    lkh_cache::deleteAllTransient();
                });
            }
        }
    }
    
    private static function deleteAllTransient() {
        $GLOBALS['wpdb']->query('DELETE FROM `'.$GLOBALS['wpdb']->prefix.'options` WHERE `option_name` LIKE (\'%\_transient\_%\')');
    }
    
    public static function get($key) {
        return get_transient($key);
    }
    
    public static function set($key,$val) {
        return set_transient($key,$val);
    }
}

lkh_cache::init();

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------

class lkh_mobileDetect{
    
    public static $cookieName='lkh_mobileDetectIsMobile';
    
    public static $result;

    public static function init($mobileDetectLib) {
        
        if(isset($_COOKIE[self::$cookieName])){
            $isMobile=(int)$_COOKIE[self::$cookieName];
        }
        else{
            include_once $mobileDetectLib;
            $detect = new Mobile_Detect;
            $isMobile=$detect->isMobile()?1:0;
            setcookie(self::$cookieName,$isMobile,time()+(3600*24*365*5),COOKIEPATH,COOKIE_DOMAIN);
        }
//        $isMobile=1;
        self::$result=$isMobile;
    }

    public static function get() {
        
        return self::$result;
    }
}

lkh_mobileDetect::init(get_stylesheet_directory().'/inc/Mobile_Detect.php');

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------

class lkh_themeSettings{
    
    public static $res=NULL;

    public static function get() {
        
        if(self::$res===NULL){
            
            $cacheKey='lkh_themeSettings';
            $res=lkh_cache::get($cacheKey);
            if(!$res){
                $res=get_fields(85);
                lkh_cache::set($cacheKey,$res);
            }

            self::$res=$res;
        }

        return self::$res;
    }
}

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------

class lkh_filter{

    public static function filterOnPage(){
        return is_product_category() || defined('LKH_IS_SEARCH') || is_shop();
    }
}

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------

class lkh_section{
    
    public static $getFieldsRes=NULL;

    public static function getFields($param){
        
        if(self::$getFieldsRes===NULL){
            
            self::$getFieldsRes=get_fields($param);
        }

        return self::$getFieldsRes;
    }
}

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------
class lkh_searchForm{

    public static function echoHtml() {
        echo self::getHtml();
    }

    public static function getHtml() {
        
        return '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'">
                <input type="search" placeholder="Search in store ..." value="'.get_search_query().'" name="s" />
                <button type="submit" value="'.esc_attr_x( 'Search', 'submit button', 'woocommerce' ).'"><i class="lkh-icomoon-search"></i></button>
                <input type="hidden" name="post_type" value="product" />
            </form>';
    }
}
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------


class lkh_modal{

    public static function getHtml($title='',$id='',$body='',$maxWidth=620) {
        return '<div id="'.$id.'" class="lkh-modal" style="max-width: '.$maxWidth.'px">'
                    .'<div data-fancybox-close class="lkh-modalCloseBtn"></div>'
                    .'<div class="lkh-modalTitle">'.$title.'</div>'
                    .'<div class="lkh-modalBody">'.$body.'</div>'
                .'</div>';
    }
}
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// 
//------------------------------------------------------------------------------


class lkh_catTree{

    public static function get() {

        $cacheKey='lkh_sectionsTreeArr';
        $res=lkh_cache::get($cacheKey);
        if(!$res){
            $res=[];
            self::generate($res);
//                    echo 'Create cache';
            lkh_cache::set($cacheKey,$res);
        }

        return $res;
    }

    public static function generateHtml($arrTree) {

        $html='<ul>';
        foreach($arrTree as $arrEl){
           $html.='<li>';
           $html.='<a href="'.esc_url($arrEl['url']).'">'.esc_html($arrEl['name']).' <span>('.$arrEl['count'].')</span></a>';
           if(isset($arrEl['children'])){
               $fns=__FUNCTION__;
               $html.=self::$fns($arrEl['children']);
           }
           $html.='</li>';
        }
        $html.='</ul>';

        return $html;
    }

    private static function generate(& $parentEl,& $catsArr=[],$parentId=0) {

        if(!$parentId){
            $catsArr=[];
            $params=[
                'orderby'    => 'meta_value_num',
                'order'      => 'asc',
                'hide_empty' => FALSE,
                'meta_query' => [[
                    'key' => 'order',
                    'type' => 'NUMERIC',
                ]],
            ];
            
            foreach(get_terms('product_cat',$params) as $catEl){
                $catsArr[$catEl->term_id]=(array)$catEl;
                $catsArr[$catEl->term_id]['url']=get_term_link($catEl);
                $thumbnailId=get_woocommerce_term_meta($catEl->term_id,'thumbnail_id',TRUE);
                if($thumbnailId){
                    $catsArr[$catEl->term_id]['imgUrl']=wp_get_attachment_url($thumbnailId);
                }
            }
//            var_dump($catsArr);
//            exit;
        }

        $thisFns=__FUNCTION__;

        foreach($catsArr as $catsArrK=>$catsArrV){
            if($catsArrV['parent']==$parentId){
                $parentEl['children'][$catsArrK]=$catsArrV;
                unset($catsArr[$catsArrK]);
                self::$thisFns($parentEl['children'][$catsArrK],$catsArr,$catsArrV['term_id']);
            }
        }

        if(!$parentId){
            if(isset($parentEl['children'])){
                $parentEl=$parentEl['children'];
            }
        }
    }
}

//------------------------------------------------------------------------------
