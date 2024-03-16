<?php defined('TEMPLATEPATH') or die('Access denied!');

/* Template Name: Laakha.com sections */

if(preg_match('/^\/sections\//',$_SERVER['REQUEST_URI'])){
    wp_redirect(site_url('shop'),301);
}

add_action('wp_enqueue_scripts',function(){
    
    wp_enqueue_style('pageSectionsCss',get_stylesheet_directory_uri().'/css/pageSections.css');
    
},80);

get_header();

?>

<div class="lkh-sectionsCatsList">
    <?php foreach(lkh_catTree::get() as $catItem) { ?>
        <div>
            <div class="lkh-sectionsCatsListItemBox">
                <a href="<?=esc_url($catItem['url'])?>" class="lkh-sectionsCatsListItem">
                    <span class="lkh-sectionsCatsListItemImg" style="background-image: url('<?=esc_url($catItem['imgUrl'])?>')"></span>
                    <span class="lkh-sectionsCatsListItemTitle"><?=esc_html($catItem['name'])?></span>
                </a>
            </div>
        </div>
    <?php } ?>
</div>

<?php

get_footer();