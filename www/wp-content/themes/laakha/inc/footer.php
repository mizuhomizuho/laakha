<?php defined('TEMPLATEPATH') or die('Access denied!');
?>

<div class="lkh-footer">
    <div class="lkh-footerCols">
        <div>
            <div>
                <div>
                    <a href="<?=site_url('my-account')?>">My Account</a>
                </div>
                <br>
                <div>
                    <a href="<?=site_url('my-account')?>">Sign Up/Log In</a>
                </div>
                <div>
                    <a href="<?=site_url('wishlist')?>">My Wishlist</a>
                </div>
                <br>
                <div>
                    <a href="<?=site_url('news')?>">News</a>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div>
                    Customer Service
                </div>
                <br>
                
                <?php
                
                    $cacheKey='lkh_footerCustomerServiceMenuHtml';
                    $res=lkh_cache::get($cacheKey);
                    if(!$res){
                        
                        $html='';
                        
                        $menu=wp_get_nav_menu_items('Footer Customer Service');
                        if($menu){
                            foreach($menu as $menuItem){
                                $html.='<div>
                                        <a href="'.esc_url($menuItem->url).'">'.esc_html($menuItem->title).'</a>
                                    </div>';
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
        <div>
            <div>
                <div>
                    E-mail: <a href="<?=site_url('mailto:'.lkh_themeSettings::get()['email'])?>"><?=lkh_themeSettings::get()['email']?></a>
                </div>
                <br>
                <div>
                    Phone:
                    <span class="lkh-footerPhone">
                        <span><?=lkh_themeSettings::get()['phone']?></span>
                        <?php
                            $hrefPhone=preg_replace('/\D/','',lkh_themeSettings::get()['phone']);
                            $hrefPhone=mb_strlen($hrefPhone)>=10 ? '+'.$hrefPhone : $hrefPhone;
                        ?>
                        <a href="tel:<?=$hrefPhone?>"><?=lkh_themeSettings::get()['phone']?></a>
                    </span>
                </div>
            </div>
        </div>
        <div>
            <div class="lkh-footerColFollowUs">
                Follow us
                <ul class="lkh-footerSots">
                    <li><a href="<?=lkh_themeSettings::get()['twitter_url']?>"><i class="lkh-icomoon-twitter"></i></a></li>
                    <li><a href="<?=lkh_themeSettings::get()['instagram_url']?>"><i class="lkh-icomoon-instagram"></i></a></li>
                    <li><a href="<?=lkh_themeSettings::get()['facebook_url']?>"><i class="lkh-icomoon-facebook"></i></a></li>
                    <li><a href="<?=lkh_themeSettings::get()['linkedin_url']?>"><i class="lkh-icomoon-linkedin"></i></a></li>
                    <li><a href="<?=lkh_themeSettings::get()['youtube_url']?>"><i class="lkh-icomoon-youtube"></i></a></li>
                </ul>
                <?php /*<div class="lkh-footercCatwebmasterLink">
                    <a href="https://catwebmaster.com/" target="_blank"><span>This website done by</span> CatWebmaster.Com</a>
                </div>*/?>
            </div>
        </div>
    </div>
</div>






