<?php defined('TEMPLATEPATH') or die('Access denied!');

?><!doctype html>
<html lang="en-US">
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <style>
            .lkh-underConstruction{
                position: fixed;
                overflow: hidden;
                left: 0;
                top: 0;
                right:0;
                bottom:0;
                background-color: #fff;
                z-index: 88888;
            }
                .lkh-underConstructionLogo{
                    width: 210px;
                    height: 210px;
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    margin-left: -105px;
                    margin-top: -135px;
                    background: transparent url('<?=get_stylesheet_directory_uri()?>/img/logoPlumForWhiteBg.svg') 50% 50% no-repeat;
                    background-size: cover;
                    overflow: hidden;
                }
                    @keyframes lkh-underConstructionLogoAnimateFns {
                        0%{}
                        26%,100%{
                            left: 100%;
                        }
                    }
                    .lkh-underConstructionLogo:before{
                        content: '';
                        position: absolute;
                        left: -107px;
                        top: -35px;
                        bottom: -35px;
                        width: 107px;
                        transform: rotate(17deg);
                        background: transparent;
                        background: linear-gradient(90deg, rgba(255,255,255,0) 17%, rgba(255,255,255,0.53) 50%, rgba(255,255,255,0) 83%);
                    }
                    .lkh-underConstructionLogo:before{
                        animation: lkh-underConstructionLogoAnimateFns 3s 1 ease-out;
                        animation-fill-mode: forwards;
                        animation-iteration-count: infinite;
                        animation-delay: 1.7s;
                    }
                .lkh-underConstructionLogoText{
                    width: 300px;
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    margin-left: -143px;
                    margin-top: 62px;
                    font-size: 25px;
                    text-align: center;
                    color: #ba974c;
                    font-family: 'Poiret One', cursive;
                }
        </style>
    </head>
    <body>
        <!--noindex-->
            <noindex>
                <div id="lkh-underConstruction" class="lkh-underConstruction">
                    <div class="lkh-underConstructionLogo"></div>
                    <div class="lkh-underConstructionLogoText">Website under construction...</div>
                </div>
            </noindex>
        <!--/noindex-->    
    </body>
</html>