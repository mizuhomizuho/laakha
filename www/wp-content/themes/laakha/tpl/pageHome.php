<?php defined('TEMPLATEPATH') or die('Access denied!');

/* Template Name: Laakha.com homepage */



// Убирает вывод h1
add_action( 'wp_head',function(){
    
    if(is_front_page()){
        remove_action( 'storefront_loop_post', 'storefront_post_header', 10);
    }
    
}, 10 );

add_action('wp_enqueue_scripts',function(){
    
    wp_enqueue_style('fontsGoogleRaleway','https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap');
    wp_enqueue_style('fontsGoogleMontserrat','https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
    
    wp_enqueue_style('swiperV5Css',get_stylesheet_directory_uri().'/libs/swiper-5.4.1/package/css/swiper.min.css');
    wp_enqueue_script('swiperV5Js',get_stylesheet_directory_uri().'/libs/swiper-5.4.1/package/js/swiper.min.js',array(),'',true);
    
    wp_enqueue_style('pageHomeCss',get_stylesheet_directory_uri().'/css/pageHome.css');
//    wp_enqueue_script('pageHomeJs',get_stylesheet_directory_uri().'/js/pageHome.js',array(),'',true);
    
},800);

get_header();

//var_dump(lkh_themeSettings::get());

echo '</div>';
?>









<div class="lkh-homeSlideLinks">
    <div class="col-full">
        <div class="lkh-homeSlideLinksListBox">
            <div class="lkh-homeSlideLinksList">

                <?php

                    $cacheKey='lkh_homepageMenuAfterTopBannerHtml';
                    $res=lkh_cache::get($cacheKey);
                    if(!$res){

                        $html='';

                        $menu=wp_get_nav_menu_items('Homepage menu after top banner');
                        if($menu){
                            foreach($menu as $menuItem){
                                $html.='<div><div class="lkh-homeSlideLinksListItem">
                                        <a href="'.esc_url($menuItem->url).'">'.esc_html($menuItem->title).'</a>
                                    </div></div>';
                            }
                        }

                        if($html!=''){
                            $res=['html'=>$html];
                        }

                        lkh_cache::set($cacheKey,$res);
                    }

                    if($res){
                        echo $res['html'];
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="lkh-homeSlideCats">
    <div id="lkh-homeSlideCatsContainer" class="col-full">
        <div class="lkh-homeSlideCatsH">
            <div class="lkh-slideH">
                <span><span>Categories</span></span>
            </div>
        </div>
        <div id="lkh-homeSlideCatsSwiper" data-swiper="swiper-container">
            <div class="lkh-homeSlideCatsList" data-swiper="swiper-wrapper">
                <?php foreach(lkh_catTree::get() as $catItem) { ?>
                    <div data-swiper="swiper-slide">
                        <div class="lkh-homeSlideCatsListItemBox">
                            <a href="<?=esc_url($catItem['url'])?>" class="lkh-homeSlideCatsListItem">
                                <span class="lkh-homeSlideCatsListItemImg" style="background-image: url('<?=esc_url($catItem['imgUrl'])?>')"></span>
                                <span class="lkh-homeSlideCatsListItemTitle"><?=esc_html($catItem['name'])?></span>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="lkh-homeSlideCatsPagination" class="lkh-homeSlideCatsPagination swiper-pagination"></div>
    </div>
</div>

<div class="lkh-homeSlideNewArrivals">
    <div class="lkh-homeSlideNewArrivalsH">
        <div class="lkh-slideH">
            <span><span>New Arrivals</span></span>
        </div>
    </div>
    <div class="site-main">
        <div id="lkh-homeSlideNewArrivalsContainer" class="col-full">
            <?=do_shortcode('[products limit = "4" columns = "4" orderby = "id" order = "DESC" visibility = "visible"]')?>
        </div>
    </div>
    <div id="lkh-homeSlideNewArrivalsPagination" class="lkh-homeSlideNewArrivalsPagination swiper-pagination"></div>
</div>


<div class="lkh-homeSlideAdvantages">
    <div id="lkh-homeSlideAdvantagesContainer" class="col-full">
        <div class="lkh-homeSlideAdvantagesH">
            <div class="lkh-slideH">
                <span><span>Why Laakha</span></span>
            </div>
        </div>
        <div class="lkh-homeSlideAdvantagesListBox">
            <div id="lkh-homeSlideAdvantagesSwiper" data-swiper="swiper-container">
                <div class="lkh-homeSlideAdvantagesList" data-swiper="swiper-wrapper">
                    <div class="lkh-homeSlideAdvantagesListItem" data-swiper="swiper-slide">
                        <div class="lkh-homeSlideAdvantagesListItemWrap lkh-homeSlideAdvantagesListItemSewing">
                            <i class="lkh-icomoon-sewing"></i>
                            Custom tailoring
                            <br> services
                        </div>
                    </div>
                    <div class="lkh-homeSlideAdvantagesListItem" data-swiper="swiper-slide">
                        <div class="lkh-homeSlideAdvantagesListItemWrap lkh-homeSlideAdvantagesListItemHeart">
                            <i class="lkh-icomoon-heart"></i>
                            Fast, reliable
                            <br> customer service
                        </div>
                    </div>
                    <div class="lkh-homeSlideAdvantagesListItem" data-swiper="swiper-slide">
                        <div class="lkh-homeSlideAdvantagesListItemWrap lkh-homeSlideAdvantagesListItemTransport">
                            <i class="lkh-icomoon-transport"></i>
                            We deliver
                            <br> worldwide
                        </div>
                    </div>
                    <div class="lkh-homeSlideAdvantagesListItem" data-swiper="swiper-slide">
                        <div class="lkh-homeSlideAdvantagesListItemWrap lkh-homeSlideAdvantagesListItemPassword">
                            <i class="lkh-icomoon-password"></i>
                            Safe & Secure
                            <br> checkout
                        </div>
                    </div>
                    <div class="lkh-homeSlideAdvantagesListItem" data-swiper="swiper-slide">
                        <div class="lkh-homeSlideAdvantagesListItemWrap lkh-homeSlideAdvantagesListItemDiamond">
                            <i class="lkh-icomoon-diamond"></i>
                            Premium quality
                            <br> garments
                        </div>
                    </div>
                </div>
            </div>
            <div id="cwm-homeSlideAdvantagesListPagination" class="cwm-homeSlideAdvantagesListPagination swiper-pagination"></div>
        </div>
    </div>
</div>

<div class="lkh-homeSlideSale">
    <div class="lkh-homeSlideSaleH">
        <div class="lkh-slideH">
            <span><span>Sale</span></span>
        </div>
    </div>
    <div class="site-main">
        <div id="lkh-homeSlideSaleContainer" class="col-full">
            <?=do_shortcode('[products limit="4" columns="4" orderby="popularity" class="quick-sale" on_sale="true"]')?>
        </div>
    </div>
    <div id="lkh-homeSlideSalePagination" class="lkh-homeSlideSalePagination swiper-pagination"></div>
    <div class="lkh-homeSlideSaleF">
        <a href="<?=site_url('/sale/')?>" class="button lkh-btn">
            Show more
        </a>
    </div>
</div>

<div class="lkh-homeSlideAboutUs">
    <div class="col-full">
        <div class="lkh-homeSlideAboutUsLeftCol">
            <div class="lkh-homeSlideAboutUsH">
                <div class="lkh-slideH">
                    <span><span>About Us</span></span>
                </div>
            </div>
            <div class="lkh-homeSlideAboutUsContent">
                <div id="lkh-homeSlideAboutUsContentWrap" class="lkh-homeSlideAboutUsContentWrap">
                    <div class="lkh-homeSlideAboutUsText">
                        
                        <p>
                            LAAKHA celebrates the woman of today, we bring designs
                            that are inspired by Indian and Pakistani heritage with
                            a modern twist of elegance to suit women of every fit,
                            style, and culture.
                        </p>
                        <p>
                            Our design styles range from simple elegance to glamourous
                            pieces of art, a woman of today can enjoy.
                        </p>
                        <p>
                            Teamed with skilled and experience designers, and manufacturing
                            facilities in India and tech-heads enable us to bring you the best
                            of ethnic fashion, online.
                        </p>
                        <p>
                            Choose from 1000’s of our elegant to heavy hand-crafted embroidery
                            and stonework styles, which no doubt will make you look like a
                            million (Laakha) dollars.
                        </p>
                    </div>
                    <ul class="lkh-homeSlideAboutUsSots">
                        <li><a href="<?=lkh_themeSettings::get()['twitter_url']?>"><i class="lkh-icomoon-twitter"></i></a></li>
                        <li><a href="<?=lkh_themeSettings::get()['instagram_url']?>"><i class="lkh-icomoon-instagram"></i></a></li>
                        <li><a href="<?=lkh_themeSettings::get()['facebook_url']?>"><i class="lkh-icomoon-facebook"></i></a></li>
                        <li><a href="<?=lkh_themeSettings::get()['linkedin_url']?>"><i class="lkh-icomoon-linkedin"></i></a></li>
                        <li><a href="<?=lkh_themeSettings::get()['youtube_url']?>"><i class="lkh-icomoon-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <div id="lkh-homeSlideAboutUsContentBtn" class="lkh-homeSlideAboutUsContentBtn button lkh-btn">Read more</div>
        </div>
    </div>
</div>

<div class="lkh-homeSlideRecommended">
    <div class="lkh-homeSlideRecommendedH">
        <div class="lkh-slideH">
            <span><span>Recommended <span class="lkh-homeSlideRecommendedHEnd">Products</span></span></span>
        </div>
    </div>
    <div class="site-main">
        <div id="lkh-homeSlideRecommendedContainer" class="col-full">
            <?=do_shortcode('[products limit="4" columns="4" orderby="rand"]')?>
        </div>
    </div>
    <div id="lkh-homeSlideRecommendedPagination" class="lkh-homeSlideRecommendedPagination swiper-pagination"></div>

</div>

<div class="lkh-homeSlideBlog">
    <div class="lkh-homeSlideBlogH">
        <div class="lkh-slideH">
            <span><span>News</span></span>
        </div>
    </div>
    <div id="lkh-homeSlideBlogContainer" class="col-full">
        <div id="lkh-homeSlideBlogSwiper" data-swiper="swiper-container">
            <div class="lkh-homeSlideBlogList" data-swiper="swiper-wrapper">
                <?php
                    $query=new WP_Query([
                        'post_type'=>'news_list',
                        'post_status'=>'publish',
                        'posts_per_page'=>4,
                        'orderby'=>'post_date',
                        'order'=>'DESC',
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
                                <div data-swiper="swiper-slide">
                                    <div class="lkh-homeSlideBlogListItem">
                                        <a href="<?=esc_url(get_the_permalink())?>">
                                            <span style="<?=$imgStyles?>"></span>
                                            <div><?=esc_html(get_the_title())?></div>
                                        </a>
                                    </div>
                                </div>
                            <?php
                        }
                        wp_reset_postdata();
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="lkh-homeSlideBlogPagination" class="lkh-homeSlideBlogPagination swiper-pagination"></div>
    <div class="lkh-homeSlideBlogF">
        <a href="<?=site_url('news')?>" class="button lkh-btn">
            Show more
        </a>
    </div>
</div>

  







<?php

echo '<div>';

get_footer();