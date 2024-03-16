<?php defined('TEMPLATEPATH') or die('Access denied!');

// <div id="devDiv"></div>
?>

<div class="lkh-headerWrap">
    <div class="col-full">
        <div id="lkh-headerBox">
            <div class="lkh-header">
                <div class="lkh-headerLeftBox">
                    <div class="lkh-headerLeft">
                        <div class="lkh-headerLogo">
                            <a href="<?=site_url()?>"></a>
                        </div>
                    </div>
                </div>
                <div class="lkh-headerRightBox">
                    <div class="lkh-headerRight">
                        <div class="lkh-headerSearch">
                            <div class="lkh-headerSearchModalBtn" data-fancybox data-src="#lkh-searchFormModal" data-modal="true"><i class="lkh-icomoon-search"></i></div>
                            <?php
                            
                                lkh_searchForm::echoHtml();
                            
                //                ob_start();
                //                the_widget( 'WC_Widget_Product_Search', 'title=' );
                //                echo str_replace(' placeholder="Search products',' placeholder="Search in store ',ob_get_clean());
                            ?>
                        </div>
                        
                        <div class="js-lkh-sectionFilterBtn lkh-headerFilter"><i class="lkh-icomoon-filter"></i></div>
                        
                        <div class="lkh-headerProfile">
                            <a href="<?=site_url('my-account')?>"><i class="lkh-icomoon-user"></i></a>
                        </div>
                        <div class="lkh-headerWishlist">
                            <a href="<?=site_url('wishlist')?>"><i class="lkh-icomoon-wishlist"></i></a>
                        </div>
                        <span id="lkh-headerCart">
                            <div class="lkh-headerCart">
                                <a class="lkh-headerCartLink" onclick="return lkh_.shortCartOpen()" href="<?=esc_url(wc_get_cart_url())?>"><i class="lkh-icomoon-bag"></i></a>
                                <div class="lkh-headerCartCount">
                                    <?php storefront_cart_link()?>
                                </div>
                                <div class="lkh-headerCartDetailBox">
                                    <div id="lkh-headerCartDetail" class="lkh-headerCartDetail">
                                        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                                    </div>
                                </div>
                                <div id="lkh-headerCartDetailShadow" class="lkh-headerCartDetailShadow"></div>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="lkh-headerMenu">
    <div class="col-full">
        <div class="lkh-headerMenuList">
            <a href="<?=site_url('/shop/')?>" id="lkh-headerMenuListBtn" class="lkh-headerMenuListBtn">Catalog <i class="lkh-icomoon-right"></i></a>
            <div id="lkh-headerMenuListWrap" class="lkh-headerMenuListWrap">
                <?php 

//                    echo do_shortcode('[product_categories parent="0"]');
                    echo lkh_catTree::generateHtml(lkh_catTree::get())?>
            </div>
        </div>
    </div>
</div>



