<?php
/*
Plugin Name: Shop urls
Description: Normal urls for shop
Version: 0.1
*/

function wpd_product_category_base_same_shop_base( $flash = false ){
    $terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'post_type' => 'product',
        'hide_empty' => false,
    ));
    if ($terms && !is_wp_error($terms)) {
        $siteurl = esc_url(home_url('/'));
        foreach ($terms as $term) {
            $term_slug = $term->slug;
            $baseterm = str_replace($siteurl, '', get_term_link($term->term_id, 'product_cat'));
 
            add_rewrite_rule($baseterm . '?$','index.php?product_cat=' . $term_slug,'top');
            add_rewrite_rule($baseterm . 'page/([0-9]{1,})/?$', 'index.php?product_cat=' . $term_slug . '&paged=$matches[1]','top');
            add_rewrite_rule($baseterm . '(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?product_cat=' . $term_slug . '&feed=$matches[1]','top');
 
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_filter( 'init', 'wpd_product_category_base_same_shop_base');
 
add_action( 'create_term', 'wpd_product_cat_same_shop_edit_success', 10, 2 );
function wpd_product_cat_same_shop_edit_success( $term_id, $taxonomy ) {
    wpd_product_category_base_same_shop_base(true);
}
