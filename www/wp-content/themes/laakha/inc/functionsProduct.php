<?php defined('TEMPLATEPATH') or die('Access denied!');




//------------------------------------------------------------------------------
// Количество Related products в карточке товара
// Change number of related products output
// https://docs.woocommerce.com/document/change-number-of-related-products-output/
//------------------------------------------------------------------------------
add_filter( 'woocommerce_output_related_products_args',function( $args ) {
    $args['posts_per_page'] = 4;
    return $args;
}, 20 );
//------------------------------------------------------------------------------


//------------------------------------------------------------------------------
// Выбор варианта в карточке товара
//------------------------------------------------------------------------------
    
add_filter('woocommerce_attribute_label',function($label) {
    if(is_product()){
//        $label.=': <div class="lkh-singleProductVariantBoxTitleBtn"></div>';
        $label.=':';
    }
    return $label;
});

add_filter('woocommerce_dropdown_variation_attribute_options_html',function($html,$args){
    
    if(is_product()){
        
//        if($args['attribute']=='pa_size'){
//            $html='<div style="display: none">'.$html.'</div>';
//        }
//        elseif(preg_match_all('/<option\s+value="([^"]+)"\s*>([^<]+)<\/option>/',$html,$m)){
//            
//            $myHtml='';
//            
//            $createMySelectHtmlFns=function($valuesArr,$titlesArr,$forId,$priceArr=[],$sizeHtml=''){
//                $myHtml='';
//                foreach($valuesArr as $attrValK=>$attrValV){
//                    $myHtml.='<div class="lkh-singleProductVariantItem"'
//                                . ' data-lkh_attr_value="'.esc_attr($attrValV).'"'
//                                . ' data-lkh_attr_id="'.esc_attr($forId).'">'
//                                    .esc_html($titlesArr[$attrValK])
//                                    .(
//                                        $forId=='pa_sewing-type'
//                                        && isset($priceArr[$attrValV])
//                                            ?' <span>+£'.esc_html($priceArr[$attrValV]).'</span>'
//                                            :''
//                                    )
//                            .'</div>'
//                            .(
//                                $forId=='pa_sewing-type'
//                                && $attrValV=='ready-made'
//                                    ?$sizeHtml
//                                    :''
//                            );
//                }
//                
//                if($forId=='pa_size'){
//                    $className='lkh-singleProductVariantSize';
//                }
//                else{
//                    $className='lkh-singleProductVariantNormal';
//                }
//
//                return '<div id="lkh-singleProductVariant-'.$forId.'" class="'.$className.'">'.$myHtml.'</div>';
//
//            };
//
//            if($args['attribute']=='pa_sewing-type'){
//                
//                // Заполним $priceArr
//
//                $query="SELECT
//                        postmeta.post_id AS product_id,
//                        postmeta.meta_value AS attr_value
//                    FROM
//                        ".$GLOBALS['wpdb']->prefix."postmeta AS postmeta
//                    LEFT JOIN
//                        ".$GLOBALS['wpdb']->prefix."posts AS products
//                    ON
//                        ( products.ID = postmeta.post_id )
//                    WHERE
//                        postmeta.meta_key LIKE 'attribute_%'
//                        && postmeta.meta_value IN ('".implode("','",$m[1])."')
//                        && products.post_parent = ".$GLOBALS['product']->get_id();
//
//                $queryRes=$GLOBALS['wpdb']->get_results($query);
//
//                $priceArrRes=[];
//                foreach($queryRes as $queryResV){
////                    $html.='<pre>'. var_export($queryResV,1).'</pre>';
//                    $productVariation= new WC_Product_Variation($queryResV->product_id);
//                    $priceArrRes[$queryResV->attr_value]=$productVariation->get_price();
//                }
//
//                $minPrice=0;
//                foreach($priceArrRes as $priceArrResV){
//                    if(!$minPrice || $minPrice>$priceArrResV){
//                        $minPrice=$priceArrResV;
//                    }
//                }
//                
//                $priceArr=[];
//                foreach($priceArrRes as $priceArrResK=>$priceArrResV){
//                    $priceArr[$priceArrResK]=$priceArrResV-$minPrice;
//                }
////                $html.='<pre>'. var_export($args,1).'</pre>';
//                
//                
//                
//                // Заполним $sizeHtml
//                
//                $sizeTerms=wc_get_product_terms(
//                    $GLOBALS['product']->get_id(),
//                    'pa_size',
//                    array(
//                        'fields' => 'all',
//                    )
//                );
//                
//                $sizeTitlesArr=[];
//                $sizeValuesArr=[];
//                foreach($sizeTerms as $sizeTermsV){
//                    $sizeTitlesArr[]=$sizeTermsV->name;
//                    $sizeValuesArr[]=$sizeTermsV->slug;
//                }
//                
//                $sizeHtml=$createMySelectHtmlFns($sizeValuesArr,$sizeTitlesArr,'pa_size');
//                
//                
//                
//                $myHtml=$createMySelectHtmlFns($m[1],$m[2],$args['attribute'],$priceArr,$sizeHtml);
//                
//                $myHtml.='<div class="lkh-singleProductVariantFooterText">* The price for custom made can vary depending on the weight of the material and style of the outfit</div>';
//            }
//            else{
//                $myHtml=$createMySelectHtmlFns($m[1],$m[2],$args['attribute']);
//            }
//            
//            $html='<div style="display: none">'.$html.'</div>'.$myHtml;
//        }
        
        if(preg_match_all('/<option\s+value="([^"]+)"[^>]+>([^<]+)<\/option>/',$html,$m)){
            
            $myHtml='';
            
            if($args['attribute']=='pa_size'){
                
                $items=[
                    'size'=>[],
                    'normal'=>[],
                ];
                
                foreach($m[1] as $attrValK=>$attrValV){
                    $items[preg_match('/^\d+$/',$attrValV)?'size':'normal'][$attrValV]=$m[2][$attrValK];
                }
//                 $html.='<pre>'. var_export($m[1],1).'</pre>';
                
                
                $query="SELECT
                        postmeta.post_id AS product_id,
                        postmeta.meta_value AS attr_value
                    FROM
                        ".$GLOBALS['wpdb']->prefix."postmeta AS postmeta
                    LEFT JOIN
                        ".$GLOBALS['wpdb']->prefix."posts AS products
                    ON
                        ( products.ID = postmeta.post_id )
                    WHERE
                        postmeta.meta_key LIKE 'attribute_%'
                        && postmeta.meta_value IN ('".implode("','",$m[1])."')
                        && products.post_parent = ".$GLOBALS['product']->get_id();

                $queryRes=$GLOBALS['wpdb']->get_results($query);

                $priceArrRes=[];
                foreach($queryRes as $queryResV){
//                    $html.='<pre>'. var_export($queryResV,1).'</pre>';
                    $productVariation= new WC_Product_Variation($queryResV->product_id);
                    $priceArrRes[$queryResV->attr_value]=$productVariation->get_price();
                }

                $minPrice=0;
                foreach($priceArrRes as $priceArrResV){
                    if(!$minPrice || $minPrice>$priceArrResV){
                        $minPrice=$priceArrResV;
                    }
                }
                
                $priceArr=[];
                foreach($priceArrRes as $priceArrResK=>$priceArrResV){
                    $priceArr[$priceArrResK]=$priceArrResV-$minPrice;
                }
                

                
                $sizesPriceMin=0;
                $sizesPriceMax=0;
                foreach($items['size'] as $itemK=>$itemV){
                    if($priceArr[$itemK]){
                        if($sizesPriceMin==0 || $sizesPriceMin>$priceArr[$itemK]){
                            $sizesPriceMin=$priceArr[$itemK];
                        }
                        if($sizesPriceMax<$priceArr[$itemK]){
                            $sizesPriceMax=$priceArr[$itemK];
                        }
                    }
                }
                $priceReadyMade='';
                if($sizesPriceMin || $sizesPriceMax){
                    if($sizesPriceMin==$sizesPriceMax){
                        $priceReadyMade='£'.$sizesPriceMin;
                    }
                    else{
                        $priceReadyMade='£'.$sizesPriceMin.' - £'.$sizesPriceMax;
                    }
                }
                
                if(isset(lkh_themeSettings::get()['size_chart']['sizes']['2048x2048'])){
                    $sizeChartUrl=lkh_themeSettings::get()['size_chart']['sizes']['2048x2048'];
                }
                else{
                    $sizeChartUrl=FALSE;
                }
                
                $myHtml.='<div class="lkh-singleProductVariantReadyMade">'
                        . '<div class="lkh-singleProductVariantReadyMadeH">'
                            . 'Ready made:'
                            . ($sizeChartUrl?'<div id="lkh-singleProductVariantSizeChartBtn" data-size_chart_url="'.$sizeChartUrl.'" class="lkh-singleProductVariantSizeChartBtn">Size Chart</div>':'')
                            .(
                                $priceReadyMade!=''
                                    ?' <span class="lkh-singleProductVariantPrice">+'.esc_html($priceReadyMade).'</span>'
                                    :''
                            )
                        . '</div>'
                        . '<div class="lkh-singleProductVariantReadyMadeList">';
                
                foreach($items['size'] as $itemK=>$itemV){
                    $myHtml.='<div class="lkh-singleProductVariantSizeItem"'
                                . ' data-lkh_attr_value="'.esc_attr($itemK).'"'
                                . ' data-lkh_attr_id="'.esc_attr($args['attribute']).'">'
                                    .esc_html($itemV)
                            .'</div>';
                }
                $myHtml.='</div>'
                        . '</div>';
                
                
                
                foreach($items['normal'] as $itemK=>$itemV){
                    $myHtml.='<div class="lkh-singleProductVariantNormalItem"'
                                . ' data-lkh_attr_value="'.esc_attr($itemK).'"'
                                . ' data-lkh_attr_id="'.esc_attr($args['attribute']).'">'
                                    .esc_html($itemV)
                                    .(
                                        isset($priceArr[$itemK])
                                            ?' <span class="lkh-singleProductVariantPrice">+£'.esc_html($priceArr[$itemK]).'</span>'
                                            :''
                                    )
                            .'</div>';
                }
                
            
                
                
                $myHtml.='<div style="margin-top: 15px;">
                        <b>Colour:</b> The colour may vary due to screen resolution read more​
                    </div>
                    <div>
                        <b>Garment care:</b> Dry clean only​
                    </div>
                    <div>
                        <b>Delivery:</b> Dispatch 6 days after order, made to measure items may take longer.
                        <span
                            style="text-decoration: underline;cursor: pointer"
                            onclick="jQuery(\'#tab-title-delivery_and_return_policy>a\').click();jQuery(\'html, body\').animate({scrollTop:jQuery(\'#tab-title-delivery_and_return_policy\').offset().top-53},1007);"
                        >Click here</span>
                        for more info ​
                    </div>
                    <div>
                        <b>Returns:</b> You can buy with confidence, our products have a 14-day return, money back guarantee, all made to measure products are exempt from the returns & refund policy. *Terms & Conditions apply
                    </div>';
                
                
                if(preg_match('/^\/shop\/sarees\//',$_SERVER['REQUEST_URI'])){
                    $myHtml.='<div style="margin-top: 15px;">
                        Please be aware that the made to measure only applies to the saree blouse as the blouse comes un-stitched, the sari does not need any tailoring. You can either choose the standard size for the blouse or provide us with your own measurements.
                    </div>';
                }
            }
            else{
            
                foreach($m[1] as $attrValK=>$attrValV){
                    $myHtml.='<div class="lkh-singleProductVariantNormalItem"'
                                . ' data-lkh_attr_value="'.esc_attr($attrValV).'"'
                                . ' data-lkh_attr_id="'.esc_attr($args['attribute']).'">'
                                    .esc_html($m[2][$attrValK])
                            .'</div>';
                }
            }
            
            $html='<div style="display: none">'.$html.'</div>'
                . '<div id="lkh-singleProductVariant-'.$args['attribute'].'">'.$myHtml.'</div>';
            
//            $html='<div>'.$html.'</div>'
//                . '<div id="lkh-singleProductVariant-'.$args['attribute'].'">'.$myHtml.'</div>';
        }
        
        
    }
    
    return $html;
    
},10,2);

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Вывод артикула под заголовком в карточке товара
//------------------------------------------------------------------------------

add_action('woocommerce_after_template_part',function($tpl){
    if(is_product()){
        if($tpl=='single-product/title.php'){
            if($GLOBALS['product']->get_sku()!=''){
                echo '<div class="lkh-singleProductScu">Product number is '. esc_html($GLOBALS['product']->get_sku()).'</div>';
            }
        }
    }
});

//------------------------------------------------------------------------------







//------------------------------------------------------------------------------
// Добавим кнопку Clear куда надо
//------------------------------------------------------------------------------

//add_action('woocommerce_after_template_part',function($tpl){
//    if(is_product()){
//        if($tpl=='single-product/price.php'){
//            echo '<span class="js-lkh-singleProductClearVariantsBtn lkh-singleProductClearVariantsBtn">Clear</span>';
//        }
//    }
//});

add_action('woocommerce_before_add_to_cart_button',function(){
    if(is_product()){
        echo '<div class="lkh-singleProductClearVariantsBtnBox">'
            . '<span class="js-lkh-singleProductClearVariantsBtn lkh-singleProductClearVariantsBtn">'
                . 'Clear'
            . '</span>'
        . '</div>';
    }
});

//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
// Настройка слайдера в карточке товара
//------------------------------------------------------------------------------

add_action('wp_enqueue_scripts',function(){
    if(is_product()){
        wp_enqueue_script('laakha-jqueryMouseWheel',get_stylesheet_directory_uri().'/libs/jquery.mousewheel.min.js',array(),'',true);
    }
},350);

add_filter('woocommerce_single_product_carousel_options',function($options) {
    if(is_product()){
        $options['animation'] = 'fade';
    }
    return $options;
});

// Основная картинка товара
add_filter( 'woocommerce_gallery_image_size', function( $size ) {
    if(is_product()){
        $size='large';
    }
    return $size;
});
//------------------------------------------------------------------------------




//------------------------------------------------------------------------------
// Еще одна вкладка
//------------------------------------------------------------------------------

add_filter( 'woocommerce_product_tabs',function($tabs){
    $tabs['delivery_and_return_policy']=[
        'title'=>'Delivery and Return Policy',
        'priority'=>'30',
        'callback'=>'lkh_delivery_and_return_policy_html',
    ];
    return $tabs;
});

function lkh_delivery_and_return_policy_html(){
    echo lkh_themeSettings::get()['delivery_and_return_policy'];
}

//------------------------------------------------------------------------------

