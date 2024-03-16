<?php defined('TEMPLATEPATH') or die('Access denied!');

/* Template Name: Laakha.com news */



add_action('wp_enqueue_scripts',function(){
    
    wp_enqueue_style('pageHomeCss',get_stylesheet_directory_uri().'/css/pageNews.css');
    
},800);


class lkh_newsList{
    
    public static $pg;
    public static $html;
    
    public static function init(){
        $itemsLimitOnPage=8;



        if(isset($GLOBALS['wp_query']->query_vars['pg'])){
            $pg=(int)$GLOBALS['wp_query']->query_vars['pg'];
            if($pg==1){
                wp_redirect(site_url('/'.$GLOBALS['wp_query']->query_vars['pagename']),301); 
                exit;
            }
        }
        else{
            $pg=1;
        }
        
        self::$pg=$pg;



        $cacheKey='lkh_newsListTotalFound';
        $totalFound=lkh_cache::get($cacheKey);
        if(!$totalFound){

            $totalFound=wp_count_posts('news_list');
            $totalFound=(int)$totalFound->publish;

            lkh_cache::set($cacheKey,$totalFound);
        }

        if($pg>ceil($totalFound/$itemsLimitOnPage)){
            status_header(404);
            $GLOBALS['wp_query']->set_404();
        }



        ob_start();

        $params=[
            'post_type'=>'news_list',
            'post_status'=>'publish',
            'posts_per_page'=>$itemsLimitOnPage,
            'orderby'=>'post_date',
            'order'=>'DESC',
        ];

        if($pg>1){
            $params['offset']=($pg-1)*$itemsLimitOnPage;
        }

        $query=new WP_Query($params);

        if($query->have_posts()){

            while($query->have_posts()){

                $query->the_post();
                
                $fields=get_fields();
                
//                var_dump($fields['image']['sizes']);
                
                $imgStyles='';
                if(isset($fields['image']['sizes']['1536x1536'])){
                    $imgStyles.='background-image: url(\''.$fields['image']['sizes']['1536x1536'].'\');';
                }

                $itemUrl=site_url(LKH_NEWS_PAGE_SLUG.'/'.get_post()->post_name.'/');
                ?>

                    <div>
                        <div class="lkh-newsListItem">
                            <div class="lkh-newsListItemImg">
                                <a href="<?=esc_url($itemUrl)?>" <?=$imgStyles!=''?' style="'.$imgStyles.'" ':''?>></a>
                            </div>
                            <div class="lkh-newsListItemName">
                                <a href="<?=esc_url($itemUrl)?>"><?=esc_html(get_the_title())?></a>
                            </div>
                            <div class="lkh-newsListItemDesc">
                                <?=esc_html($fields['short_desc'])?>
                            </div>
                            <div class="lkh-newsListItemDate">
                                <?=esc_html(get_the_date())?>
                            </div>
                            <div class="lkh-newsListItemMore">
                                <a href="<?=esc_url($itemUrl)?>" class="button lkh-btn">Read more</a>
                            </div>
                        </div>
                    </div>

                <?php
            }

            wp_reset_postdata();

            echo paginate_links([
                'base'=>site_url(LKH_NEWS_PAGE_SLUG.'/%_%/'),
                'format'=>'page-%#%',
                'current'=>$pg,
                'total'=>$query->max_num_pages,
            ]);

        }
        else{
            status_header(404);
            $GLOBALS['wp_query']->set_404();
        }

        self::$html=ob_get_clean();
    }
}



lkh_newsList::init();

    

if(lkh_newsList::$pg>1){
    add_filter('the_title',function($title){
        return $title.' - Page '.lkh_newsList::$pg;
    });
}



remove_action('wp_head','rel_canonical');
add_action('wp_head',function(){
    echo '<link rel="canonical" href="'.site_url(LKH_NEWS_PAGE_SLUG.'/'.(lkh_newsList::$pg>1?'page-'.lkh_newsList::$pg.'/':'')).'">'."\n"; 
});



add_filter('woocommerce_get_breadcrumb',function($thisCrumbs){

    $breadcrumb=[];
    $breadcrumb[]=$thisCrumbs[0];

    if(lkh_newsList::$pg>1){
        $breadcrumb[]=['News',site_url(LKH_NEWS_PAGE_SLUG)];
        $breadcrumb[]=['Page '.lkh_newsList::$pg,''];
    }
    else{
        $breadcrumb[]=['News',''];
    }

//    $breadcrumb[]=['',''];

    return $breadcrumb;
});

//add_filter('woocommerce_structured_data_breadcrumblist',function($markup){
//    unset($markup['itemListElement'][lkh_newsList::$pg>1?3:2]);
//    return $markup;
//});



add_filter('the_content',function($text){
    return $text.'<div class="lkh-newsList">'.lkh_newsList::$html.'</div>';
});




get_header();

if(is_404()){
    get_template_part('content','none');
}
else{
    ?>
        <div class="lkh-newsListBox">
            <?php
                echo '<h1>'.get_the_title().'</h1>';
                the_content();
            ?>
        </div>
    <?php
}

get_footer();