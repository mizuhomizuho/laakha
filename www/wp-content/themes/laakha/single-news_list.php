<?php


add_action('wp_enqueue_scripts',function(){
    
    wp_enqueue_style('pageHomeCss',get_stylesheet_directory_uri().'/css/pageNews.css');
    
    wp_enqueue_script('addthisWidget','//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ed66f07de913fbd',array(),'',true);
    
},800);






$fields=get_fields();



remove_action('wp_head','rel_canonical');
add_action('wp_head',function(){

    echo '<link rel="canonical" href="'.site_url(LKH_NEWS_PAGE_SLUG.'/'.get_post()->post_name.'/').'">'."\n"; 
});


        
add_filter('woocommerce_get_breadcrumb',function($thisCrumbs){

    return [
        $thisCrumbs[0],
        ['News',site_url(LKH_NEWS_PAGE_SLUG)],
        
//        ['',''],
        [get_post()->post_title,site_url(LKH_NEWS_PAGE_SLUG.'/'.get_post()->post_name.'/')],
    ];
});

//add_filter('woocommerce_structured_data_breadcrumblist',function($markup){
//
//    $markup['itemListElement'][2]['item']['name']=get_post()->post_title;
//    $markup['itemListElement'][2]['item']['@id']=site_url(LKH_NEWS_PAGE_SLUG.'/'.get_post()->post_name.'/');
//
//    return $markup;
//});
        
        

get_header();

echo '</div>';

?>
        
    <div class="lkh-newsItem">

        <?php if(isset($fields['image']['sizes']['2048x2048'])) { ?>
            <div class="lkh-newsItemBanner" style="background-image: url('<?=$fields['image']['sizes']['2048x2048']?>')"></div>
        <?php } ?>
            
        <div class="col-full">
            
            <h1><?php the_title()?></h1>
            <?php the_content()?>
            
        </div>
            
    </div>

    <div class="lkh-newsSlideSots">
        <div class="col-full">
            <div class="lkh-newsSlideSotsH">
                <div class="lkh-slideH">
                    <span><span>Share in social networks</span></span>
                </div>
            </div>
            <div class="lkh-newsSlideSotsList">
                <div class="addthis_inline_share_toolbox"></div>
            </div>
        </div>
    </div>
    
    <div class="lkh-newsSlideBlog">
        <div class="lkh-newsSlideBlogH">
            <div class="lkh-slideH">
                <span><span>Other news</span></span>
            </div>
        </div>
        <div class="col-full">
            <ul class="lkh-newsSlideBlogList">
                <?php
                    $query=new WP_Query([
                        'post_type'=>'news_list',
                        'post_status'=>'publish',
                        'posts_per_page'=>4,
                        'orderby'=>'post_date',
                        'order'=>'DESC',
                        'post__not_in'=>[get_the_ID()],
                    ]);

                    if($query->have_posts()){
                        while($query->have_posts()){
                            $query->the_post();
                            $fields=get_fields();
                            $imgStyles='';
                            if(isset($fields['image']['sizes']['medium_large'])){
                                $imgStyles.='background-image: url(\''.$fields['image']['sizes']['medium_large'].'\');';
                            }
                            ?>
                                <li>
                                    <a href="<?=esc_url(get_the_permalink())?>">
                                        <span style="<?=$imgStyles?>"></span>
                                        <div><?=esc_html(get_the_title())?></div>
                                    </a>
                                </li>
                            <?php
                        }
                        wp_reset_postdata();
                    }
                ?>
            </ul>
        </div>
        <div class="lkh-newsSlideBlogF">
            <a href="<?=site_url('news')?>" class="button lkh-btn">
                Show more
            </a>
        </div>
    </div>
    
<?php

echo '<div>';

get_footer();

