if(typeof lkh_=='undefined'){var lkh_={};}
(function($){var isMobile=Cookies.get(lkh_.isMobileCookieName);if(typeof isMobile=='undefined'){isMobile=0;}
if(parseInt(isMobile)==0){lkh_.isMobile=false;}
else{lkh_.isMobile=true;}
$('html').addClass('lkh-isMobile'+(lkh_.isMobile?'1':'0'));})(jQuery);(function($){(function(){lkh_.durationTest=localStorage.getItem('lkh-durationTest');if(lkh_.durationTest!==null){return;}
function factor(depth){var f=1;for(var i=1;i<depth;i++){f=f*i;}
return f;}
function load(amount,depth){var t0=performance.now();for(var n=1;n<amount;n++){var result=factor(depth);}
var t1=performance.now();var duration=(t1-t0).toFixed(0);return duration;}
if(load(10000,20000)<1000){lkh_.durationTest='fast';}
else{lkh_.durationTest='slow';}
localStorage.setItem('lkh-durationTest',lkh_.durationTest);})();if(lkh_.durationTest=='fast'){$('html').addClass('lkh-allowAnimate');}})(jQuery);lkh_.copyText=function(textareaId){var copyText=document.getElementById(textareaId);if(navigator.userAgent.match(/ipad|ipod|iphone/i)){var el=copyText;var editable=el.contentEditable;var readOnly=el.readOnly;el.contentEditable=true;el.readOnly=false;var range=document.createRange();range.selectNodeContents(el);var sel=window.getSelection();sel.removeAllRanges();sel.addRange(range);el.setSelectionRange(0,999999);el.contentEditable=editable;el.readOnly=readOnly;}else{copyText.select();}
document.execCommand("copy");};(function($){lkh_.pageLoadedFlag=false;$(window).on('load',function(){lkh_.pageLoadedFlag=true;});lkh_.afterLoadPage=[];function afterLoadPageRun(){$(lkh_.afterLoadPage).each(function(){this();});}
$(function(){var timeout_delay=1800;var interval_step=88;var preloaderEl=$('#lkh-mainPreloader');lkh_.afterLoadPage.push(function(){preloaderEl.addClass('lkh-mainPreloaderHide');});(function(){timeout_delay-=interval_step;if(!lkh_.pageLoadedFlag){setTimeout(arguments.callee,interval_step);return;}
if(timeout_delay<1){if($('html').hasClass('lkh-isMobile1')){preloaderEl.fadeOut('slow');afterLoadPageRun();}
else{preloaderEl.fadeOut('slow',afterLoadPageRun);}}
else{if($('html').hasClass('lkh-isMobile1')){preloaderEl.delay(timeout_delay).fadeOut('slow');afterLoadPageRun();}
else{preloaderEl.delay(timeout_delay).fadeOut('slow',afterLoadPageRun);}}})();});})(jQuery);(function($){var elBtn;var elDetail;var cl='lkh-headerCartOpen';lkh_.shortCartOpen=function(){if($(document.body).hasClass('woocommerce-checkout')||$(document.body).hasClass('woocommerce-cart')){return;}
elDetail.css({maxHeight:$(window).height()-(elBtn.position().top+elBtn.height())-71});elBtn.toggleClass(cl);return false;};$(function(){elBtn=$('#lkh-headerCart');elDetail=$('#lkh-headerCartDetail');$('#lkh-headerCartDetailShadow').click(function(){elBtn.removeClass(cl);});});})(jQuery);(function($){$(function(){if($('#wpadminbar').length){$('html').addClass('lkh-adminBarShowing');}});})(jQuery);(function($){$(function(){var mastheadEl=$('#masthead');mastheadEl.height(mastheadEl.height());var headerBoxEl=$('#lkh-headerBox');var headerBoxH=headerBoxEl.height();function scroll(){var st=$(window).scrollTop();if(headerBoxH<st){$('html').addClass('lkh-headerFixed').removeClass('lkh-headerNoFixed');}
else{$('html').removeClass('lkh-headerFixed').addClass('lkh-headerNoFixed');}}
$(window).scroll(scroll);scroll();});})(jQuery);(function($){$(function(){$('.js-lkh-sectionProductImage').each(function(){var attrName='data-srcset';var imgEl=$(this).children('img['+attrName+']');if(!imgEl.length){attrName='srcset';imgEl=$(this).children('img['+attrName+']');}
if(!imgEl.length){return;}
var setObj={};$.each(imgEl.attr(attrName).split(','),function(k,v){var setVal=v;setVal=setVal.replace(/^\s+/,'');setVal=setVal.replace(/\s+&/,'');var setValArr=setVal.split(' ');if(setValArr.length==2){var setValWidth=setValArr[1];setValWidth=setValWidth.replace(/^\s+/,'');setValWidth=setValWidth.replace(/\s+&/,'');var setValWidthExec=/^(\d+)w$/.exec(setValWidth);if(setValWidthExec!==null){var setValSrc=setValArr[0];setValSrc=setValSrc.replace(/^\s+/,'');setValSrc=setValSrc.replace(/\s+&/,'');setObj[setValWidthExec[1]]=setValSrc;}}});var maxW=false;$.each(setObj,function(k,v){if(maxW===false||maxW<k){maxW=k;}});if(maxW!==false){imgEl.css({maxWidth:maxW+'px'});}});});})(jQuery);(function($){$(function(){function resizeHeightForItemBlocks(){var windowW=$(window).width();$('ul.products').each(function(){var curBoxEl=$(this);var cols=/(\s|^)columns-(\d+)(\s|$)/.exec($(this).attr('class'));if(cols!==null){cols=cols[2];}
else{return;}
$.each(['li.product .woocommerce-loop-product__title'],function(k,v){var els=curBoxEl.find(v);$(els).css({minHeight:''});if($(window).width()<=767){return;}
var rowsEls=[];var maxH=0;els.each(function(i){rowsEls.push(this);var h=$(this).height();if(maxH<h){maxH=h;}
if(!((i+1)%cols)||els.length==i+1){$(rowsEls).css({minHeight:maxH});rowsEls=[];maxH=0;}});});});}
setTimeout(function(){resizeHeightForItemBlocks();},80);function resizeEnd(){if(new Date()-rtime<delta){setTimeout(resizeEnd,delta);}else{timeout=false;resizeHeightForItemBlocks();}}
var rtime;var timeout=false;var delta=200;$(window).resize(function(){rtime=new Date();if(timeout===false){timeout=true;setTimeout(resizeEnd,delta);}});});})(jQuery);(function($){$(function(){var closeAttrs=localStorage.getItem('lkh-filterAttrBoxClose');if(closeAttrs===null){closeAttrs={};}
else{closeAttrs=JSON.parse(closeAttrs);}
$.each(closeAttrs,function(k,v){$('#'+k).addClass('lkh-filterAttrBoxClose');});function saveStorage(){localStorage.setItem('lkh-filterAttrBoxClose',JSON.stringify(closeAttrs));}
$('.js-lkh-filterAttrBox').each(function(){var boxEl=$(this);boxEl.find('.js-lkh-filterAttrBoxTitle').click(function(){if(typeof closeAttrs[boxEl.attr('id')]=='undefined'){boxEl.addClass('lkh-filterAttrBoxClose');closeAttrs[boxEl.attr('id')]=1;saveStorage();}
else{boxEl.removeClass('lkh-filterAttrBoxClose');delete closeAttrs[boxEl.attr('id')];saveStorage();}});});});})(jQuery);(function($){$(function(){$('.js-lkh-sectionFilterBtn').click(function(){$('html').toggleClass('lkh-sectionFilterOpen');});$('#lkh-sectionFilterCloseBtn').click(function(){$('html').removeClass('lkh-sectionFilterOpen');});$(window).resize(function(){$('#lkh-sectionFilterCloseBtn').click();});});})(jQuery);(function($){$(function(){var selectEl=$('form.woocommerce-ordering select[name="orderby"]').eq(0);if(!selectEl.length){return;}
var mySelectTmpEl=$('<div>');var mySelectLabels={relevance:'Relevance',popularity:'Sort by popularity',date:'Sort by latest',price:'Low to high','price-desc':'High to low',menu_order:'Default sorting',rating:'Sort by rating'};selectEl.children('option').each(function(){var optVal=$(this).val();if(typeof mySelectLabels[optVal]!='undefined'){var optName=mySelectLabels[optVal];}
else{var optName=$(this).text();}
mySelectTmpEl.append($('<li>').attr('data-value',optVal).html(optName));});var mySelectTmpElHtml=mySelectTmpEl.html();if(mySelectTmpElHtml==''){return;}
else{$('.js-lkh-catalogSortSelect').html(mySelectTmpElHtml);$('html').addClass('lkh-catalogSortBuilded');}
function setVal(){var curVal=selectEl.val();$('.js-lkh-catalogSortVal').html($('.js-lkh-catalogSortSelect [data-value="'+curVal+'"]').html());$('.js-lkh-catalogSortSelect [data-value]').show();$('.js-lkh-catalogSortSelect [data-value="'+curVal+'"]').hide();}
setVal();$('.js-lkh-catalogSort').each(function(){var curEl=$(this);curEl.find('.js-lkh-catalogSortVal').click(function(){curEl.addClass('lkh-catalogSortOpen');});curEl.find('.js-lkh-catalogSortSelectShadow').click(function(){curEl.removeClass('lkh-catalogSortOpen');});curEl.find('li[data-value]').click(function(){selectEl.val($(this).attr('data-value'));setVal();curEl.removeClass('lkh-catalogSortOpen');selectEl.change();});});});})(jQuery);(function($){$(function(){var listEl=$('.single-product div.product .woocommerce-product-gallery .flex-control-thumbs');if(listEl.length!=1){return;}
(function(){var imgSrcAttrs={};listEl.find('li').each(function(){var imgSrc=$(this).find('img').attr('src');if(typeof imgSrcAttrs[imgSrc]=='undefined'){imgSrcAttrs[imgSrc]=1;}
else{$(this).hide();return false;}});})();listEl.wrap('<div id="lkh-singleProductGalleryThumbsBox" class="lkh-singleProductGalleryThumbsBox">'
+'<div class="lkh-singleProductGalleryThumbsWrap"></div>'
+'<div id="lkh-singleProductGalleryThumbsBtnTop" class="lkh-singleProductGalleryThumbsBtnTop"><i class="lkh-icomoon-up"></i></div>'
+'<div id="lkh-singleProductGalleryThumbsBtnBottom" class="lkh-singleProductGalleryThumbsBtnBottom"><i class="lkh-icomoon-down"></i></div>'
+'</div>');var wrapBoxEl=$('#lkh-singleProductGalleryThumbsBox');var btnTopEl=$('#lkh-singleProductGalleryThumbsBtnTop').hide();var btnBottomEl=$('#lkh-singleProductGalleryThumbsBtnBottom');var wrapBoxElH;var listElH;function setTopList(to){var listElTop=parseInt(listEl.css('top'));if(to=='up'){var newTop=listElTop+(wrapBoxElH-30);}
else{var newTop=listElTop-(wrapBoxElH-30);}
btnTopEl.show();btnBottomEl.show();if(newTop>0){newTop=0;btnTopEl.hide();}
else if(listElH+newTop<wrapBoxElH){newTop=(listElH-wrapBoxElH)*-1;btnBottomEl.hide();}
listEl.css({top:newTop});}
function mousewheel(event){if(event.deltaY==1){setTopList('up');}
else{setTopList('down');}
return false;}
function clickUp(){setTopList('up');}
function clickDown(){setTopList('down');}
var bindFlag=false;function resize(){wrapBoxElH=wrapBoxEl.height();listElH=listEl.height();if($(window).width()<=991||wrapBoxElH>listElH){if(bindFlag){bindFlag=false;wrapBoxEl.unbind('mousewheel',mousewheel);btnTopEl.unbind('click',clickUp);btnBottomEl.unbind('click',clickDown);}
btnTopEl.hide();btnBottomEl.hide();}
else{if(!bindFlag){bindFlag=true;wrapBoxEl.bind('mousewheel',mousewheel);btnTopEl.bind('click',clickUp);btnBottomEl.bind('click',clickDown);}
btnTopEl.show();btnBottomEl.show();}}
$(window).resize(resize);setTimeout(resize,8);});})(jQuery);(function($){$(function(){var btnEls=$('.js-lkh-mainTopBannerBtn');var animateClass='lkh-mainTopBannerBtnAnimate';if(!btnEls.length){return;}
function goAnimate(btnEl){btnEl.data('lkh-lockAnimFlag',true);btnEl.addClass(animateClass);setTimeout(function(){btnEl.removeClass(animateClass);btnEl.data('lkh-lockAnimFlag',false);},800);}
btnEls.hover(function(){var btnEl=$(this);btnEl.data('lkh-lockAutoRunFlag',true);if(btnEl.data('lkh-lockAnimFlag')){return;}
goAnimate(btnEl);},function(){});setTimeout(function(){btnEls.each(function(){var btnEl=$(this);if(btnEl.data('lkh-lockAutoRunFlag')){return;}
goAnimate(btnEl);});},1250);});})(jQuery);(function($){$(function(){var cartFormSelector='body.woocommerce-cart .woocommerce-cart-form';if(!$(cartFormSelector).length){return;}
$('div.woocommerce').on('change','.qty',function(){$(cartFormSelector).find('[name="update_cart"]').removeAttr('disabled').trigger('click');});});})(jQuery);(function($){$(function(){$('#lkh-headerMenuListBtn').click(function(){var modalElId='lkh-catalogMenuModal';var modalEl=$('#'+modalElId);if(!modalEl.length){modalEl=$('<div>').html(lkh_.modalHtml);modalEl.find('.lkh-modal').attr('id',modalElId);modalEl.find('.lkh-modalTitle').html('Catalog');modalEl.find('.lkh-modalBody').html($('<div class="lkh-catalogMenuModalList"></div>').html($('#lkh-headerMenuListWrap').html()));$(document.body).append(modalEl);}
$.fancybox.open({src:'#'+modalElId});return false;});});})(jQuery);(function($){$(function(){$('#lkh-singleProductVariantSizeChartBtn').click(function(){var modalElId='lkh-singleProductVariantSizeChartModal';var modalEl=$('#'+modalElId);if(!modalEl.length){modalEl=$('<div>').html(lkh_.modalHtml);modalEl.find('.lkh-modal').attr('id',modalElId);modalEl.find('.lkh-modalTitle').html('Size Chart');var imgEl=$('<img>').attr('src',$(this).attr('data-size_chart_url'));modalEl.find('.lkh-modalBody').html(imgEl);modalEl.find('.lkh-modal').css({maxWidth:'100%'});$(document.body).append(modalEl);}
$.fancybox.open({src:'#'+modalElId});return false;});});})(jQuery);(function($){$(function(){var productFormEl=$('form.variations_form.cart');if(!productFormEl.length){return;}
var btnEls=$('[data-lkh_attr_id][data-lkh_attr_value]');if(!btnEls.length){return;}
function clickOn(selectId,valueId){if(selectId=='pa_color'){$('table.variations select[data-attribute_name]').each(function(){if($(this).attr('id')=='pa_color'){return;}
if($(this).val()==''){clickOn($(this).attr('id'),$(this).find('option:eq(1)').attr('value'));}});}
$('#lkh-singleProductVariant-'+selectId+' [data-lkh_attr_id][data-lkh_attr_value]').removeClass('lkh-singleProductVariantItemActive');$('#lkh-singleProductVariant-'+selectId+' [data-lkh_attr_id][data-lkh_attr_value="'+valueId+'"]').addClass('lkh-singleProductVariantItemActive');$('table.variations select#'+selectId).val(valueId).change();}
function clickOff(selectId){$('#lkh-singleProductVariant-'+selectId+' [data-lkh_attr_id][data-lkh_attr_value]').removeClass('lkh-singleProductVariantItemActive');$('table.variations select#'+selectId).val('').change();}
$('table.variations .value select').each(function(){if($(this).val()!=''){clickOn($(this).attr('id'),$(this).val());}});$('.js-lkh-singleProductClearVariantsBtn').click(function(){$('table.variations .value select').each(function(){clickOff($(this).attr('id'));});setCurPrice();});var priceEl=$('.entry-summary p.price');var setCurPriceFirstPriceHtml=priceEl.html();if(productFormEl.data('product_variations')==false){var sendFlag=false;$(document).ajaxSend(function(event,jqXHR,ajaxOptions){if(ajaxOptions.url=='/?wc-ajax=get_variation'){sendFlag=true;}});function setCurPrice(){if(sendFlag){priceEl.html('&nbsp;');}
else{priceEl.html(setCurPriceFirstPriceHtml);}}
$(document).ajaxSuccess(function(event,jqXHR,ajaxOptions){if(ajaxOptions.url=='/?wc-ajax=get_variation'){sendFlag=false;if(jqXHR.responseJSON.price_html==''){priceEl.html(setCurPriceFirstPriceHtml);}
else{priceEl.html(jqXHR.responseJSON.price_html);}}});}
else{function setCurPrice(){setTimeout(function(){if($('.woocommerce-variation-add-to-cart').hasClass('woocommerce-variation-add-to-cart-enabled')){priceEl.html($('.woocommerce-variation.single_variation .woocommerce-variation-price').html());}
else{priceEl.html(setCurPriceFirstPriceHtml);}},88);}}
btnEls.click(function(){var selectId=$(this).attr('data-lkh_attr_id');var valueId=$(this).attr('data-lkh_attr_value');var clickMode=$(this).hasClass('lkh-singleProductVariantItemActive')?'off':'on';if(clickMode=='off'){clickOff(selectId);}
else{clickOn(selectId,valueId);}
setCurPrice();});});})(jQuery);(function($){lkh_.madeToMeasureStorageClass=function(){var _self=this;_self.key=null;_self.isLoaded=false;_self.load=function(){if(_self.isLoaded){return;}
_self.isLoaded=true;var data=localStorage.getItem('lkh-madeToMeasure');if(data===null){_self.storage={};}
else{_self.storage=JSON.parse(data);}}
_self.save=function(){localStorage.setItem('lkh-madeToMeasure',JSON.stringify(_self.storage));}};$(function(){var productFormEl=$('form.variations_form.cart');if(!productFormEl.length){return;}
var storageObj=new lkh_.madeToMeasureStorageClass();var clickMode='';var addToWishlistClickForceFlag=false;function addToWishlistClick(){if(addToWishlistClickForceFlag){addToWishlistClickForceFlag=false;return;}
clickMode='addToWishlistClick';if(productFormEl.find('table.variations select#pa_size').val()=='made-to-measure'&&!$(this).hasClass('wc-variation-selection-needed')){madeToMeasureModalOpen();return false;}}
var addToCartClickForceFlag=false;function addToCartClick(){if(addToCartClickForceFlag){addToCartClickForceFlag=false;return;}
clickMode='addToCartClick';if(productFormEl.find('table.variations select#pa_size').val()=='made-to-measure'&&!$(this).hasClass('wc-variation-selection-needed')){madeToMeasureModalOpen();return false;}}
productFormEl.find('button.single_add_to_cart_button').bind('click',addToCartClick);productFormEl.find('.tinvwl_add_to_wishlist_button').bind('click',addToWishlistClick);var madeToMeasureModalOpenFancybox;function madeToMeasureModalOpen(){var productId=productFormEl.find('input[name="product_id"]').val();var variationId=productFormEl.find('input[name="variation_id"]').val();storageObj.key='pId'+productId+'%vId'+variationId;$.each(productFormEl.serializeArray(),function(k,v){if(v.name.indexOf('attribute_')===0){storageObj.key+='%'+v.name.replace(/^attribute_/,'')+':'+v.value;}});storageObj.load();var modalElId='lkh-productMadeToMeasureModal';var modalEl=$('#'+modalElId);if(!modalEl.length){modalEl=$('<div>').html(lkh_.modalHtml);modalEl.find('.lkh-modal').attr('id',modalElId);modalEl.find('.lkh-modalTitle').html('Made to measure');var formEl=$('<form id="lkh-productMadeToMeasureForm" class="lkh-productMadeToMeasureForm">\n\
                        <div class="lkh-productMadeToMeasureFormTable">\n\
                            <div>\n\
                                <label>Height (ft and Inches)</label>\n\
                                <input type="text" name="height" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Sleeve length (Inches)</label>\n\
                                <input type="text" name="arm_length" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Bust (Inches)</label>\n\
                                <input type="text" name="bust" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Arm hole (Inches)</label>\n\
                                <input type="text" name="arm_hole" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Waist (Inches)</label>\n\
                                <input type="text" name="waist" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Top length (Inches)</label>\n\
                                <input type="text" name="top_length" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Hips (Inches)</label>\n\
                                <input type="text" name="hips" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Shoulders (Inches)</label>\n\
                                <input type="text" name="shoulders" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Right Leg (Inches)</label>\n\
                                <input type="text" name="right_leg" value="">\n\
                            </div>\n\
                            <div>\n\
                                <label>Left Leg (Inches)</label>\n\
                                <input type="text" name="left_leg" value="">\n\
                            </div>\n\
                        </div>\n\
                        <div>\n\
                            <label>Type your size requirement and other massage here...</label>\n\
                            <textarea name="massage"></textarea>\n\
                        </div>\n\
                        <div class="lkh-productMadeToMeasureFormFooter">\n\
                            <button type="reset" class="button lkh-btn">Reset</button>\n\
                            <button type="submit" class="button lkh-btn">Send</button>\n\
                        </div>\n\
                    </form>');formEl.submit(function(e){e.preventDefault();storageObj.storage.lastData=$(this).serializeArray();storageObj.storage[storageObj.key]=storageObj.storage.lastData;storageObj.save();if(clickMode=='addToCartClick'){addToCartClickForceFlag=true;productFormEl.find('button.single_add_to_cart_button').click();madeToMeasureModalOpenFancybox.close();}
else if(clickMode=='addToWishlistClick'){addToWishlistClickForceFlag=true;productFormEl.find('.tinvwl_add_to_wishlist_button').click();madeToMeasureModalOpenFancybox.close();}});modalEl.find('.lkh-modalBody').html(formEl);$(document.body).append(modalEl);}
if(typeof storageObj.storage.lastData!='undefined'){$.each(storageObj.storage.lastData,function(k,v){modalEl.find('#lkh-productMadeToMeasureForm').find('[name="'+v.name+'"]').val(v.value);});}
madeToMeasureModalOpenFancybox=$.fancybox.open({src:'#'+modalElId});}});})(jQuery);(function($){var swiperBuilder=function(selector,params){var mainObj=this;mainObj.swiperSelector=selector;mainObj.swiperParams=params;mainObj.swiperEl=$(mainObj.swiperSelector);var lastWindowWidth=$(window).width();function resize(){if(!mainObj.swiperEl.hasClass('swiper-container')){return;}
var windowW=$(window).width();if(lastWindowWidth!=windowW){mainObj.destroy().build();}
lastWindowWidth=windowW;}
mainObj.build=function(){if(mainObj.swiperEl.hasClass('swiper-container')){return mainObj;}
mainObj.swiperEl.data('swiper_class_old',mainObj.swiperEl.attr('class')||'');mainObj.swiperEl.attr('class','');mainObj.swiperEl.addClass(mainObj.swiperEl.data('swiper'));mainObj.swiperEl.css({maxWidth:$(window).width()});mainObj.swiperEl.find('[data-swiper]').each(function(){$(this).data('swiper_class_old',$(this).attr('class')||'');$(this).attr('class','');$(this).addClass($(this).data('swiper'));});setTimeout(function(){mainObj.swiper=new Swiper(mainObj.swiperEl,mainObj.swiperParams);},0);$(window).bind('resize',resize);return mainObj;};mainObj.destroy=function(){if(!mainObj.swiperEl.hasClass('swiper-container')){return mainObj;}
$(window).unbind('resize',resize);mainObj.swiperEl[0].swiper.destroy();mainObj.swiperEl.attr('class',mainObj.swiperEl.data('swiper_class_old'));mainObj.swiperEl.find('[data-swiper]').each(function(){$(this).attr('class',$(this).data('swiper_class_old'));});if(typeof mainObj.swiperParams.pagination!='undefined'){$(mainObj.swiperParams.pagination.el).html('');}
return mainObj;};return mainObj;};var swiperParams={};$(function(){$.each([{swiperElSelector:'#lkh-homeSlideCatsSwiper',swiperContainerSelector:'#lkh-homeSlideCatsContainer',swiperPaginationSelector:'#lkh-homeSlideCatsPagination',},{swiperElSelector:'#lkh-homeSlideAdvantagesSwiper',swiperContainerSelector:'#lkh-homeSlideAdvantagesContainer',swiperPaginationSelector:'#cwm-homeSlideAdvantagesListPagination',},{swiperElSelector:'#lkh-homeSlideBlogSwiper',swiperContainerSelector:'#lkh-homeSlideBlogContainer',swiperPaginationSelector:'#lkh-homeSlideBlogPagination',},],function(k,v){var swiperElSelector=v.swiperElSelector;var swiperContainerSelector=v.swiperContainerSelector;var swiperPaginationSelector=v.swiperPaginationSelector;if(!$(swiperElSelector).length){return;}
var swiper=null;function resize(){if($(window).width()<=767){if(swiper===null){var params={slidesPerView:1,spaceBetween:0,pagination:{el:swiperPaginationSelector,clickable:true,},};params=$.extend(params,swiperParams);swiper=new swiperBuilder(swiperElSelector,params);}
$(swiperContainerSelector).removeClass('col-full');swiper.build();}
else{$(swiperContainerSelector).addClass('col-full');if(swiper!==null){swiper.destroy();}}}
$(window).resize(resize);resize();});$.each([{swiperBoxId:'lkh-homeSlideNewArrivalsSwiper',swiperContainerSelector:'#lkh-homeSlideNewArrivalsContainer',swiperPaginationSelector:'#lkh-homeSlideNewArrivalsPagination',},{swiperBoxId:'lkh-homeSlideSaleSwiper',swiperContainerSelector:'#lkh-homeSlideSaleContainer',swiperPaginationSelector:'#lkh-homeSlideSalePagination',},{swiperBoxId:'lkh-homeSlideRecommendedSwiper',swiperContainerSelector:'#lkh-homeSlideRecommendedContainer',swiperPaginationSelector:'#lkh-homeSlideRecommendedPagination',},],function(k,v){var swiperBoxId=v.swiperBoxId;var swiperContainerSelector=v.swiperContainerSelector;var swiperPaginationSelector=v.swiperPaginationSelector;var swiperElSelector='#'+swiperBoxId;var swiperBoxEl=$(swiperContainerSelector).find('div.woocommerce>ul.products').parent();if(!swiperBoxEl.length){return;}
var swiper=null;function resize(){if($(window).width()<=767){if(swiper===null){swiperBoxEl.attr('id',swiperBoxId);swiperBoxEl.attr('data-swiper','swiper-container woocommerce');$(swiperContainerSelector).find('ul.products').attr('data-swiper','swiper-wrapper products');var productEls=$(swiperContainerSelector).find('ul.products>li.product');productEls.attr('data-swiper','swiper-slide '+productEls.attr('class'));var params={slidesPerView:1,spaceBetween:0,pagination:{el:swiperPaginationSelector,clickable:true,},};params=$.extend(params,swiperParams);swiper=new swiperBuilder(swiperElSelector,params);}
$(swiperContainerSelector).removeClass('col-full');swiper.build();}
else{$(swiperContainerSelector).addClass('col-full');if(swiper!==null){swiper.destroy();}}}
$(window).resize(resize);resize();});});})(jQuery);(function($){$(function(){$('#lkh-homeSlideAboutUsContentBtn').click(function(){var modalElId='lkh-homeSlideAboutUsContentModal';var modalEl=$('#'+modalElId);if(!modalEl.length){modalEl=$('<div>').html(lkh_.modalHtml);modalEl.find('.lkh-modal').attr('id',modalElId);modalEl.find('.lkh-modalTitle').html('About Us');modalEl.find('.lkh-modalBody').html($('#lkh-homeSlideAboutUsContentWrap').html());$(document.body).append(modalEl);}
$.fancybox.open({src:'#'+modalElId});});});})(jQuery);(function($){$(function(){function click(){var tabId=$(this).attr('href').replace(/^#/,'');var modalElId='lkh-productTabsModal-tabId-'+tabId;var modalEl=$('#'+modalElId);if(!modalEl.length){modalEl=$('<div>').html(lkh_.modalHtml);modalEl.find('.lkh-modal').attr('id',modalElId);modalEl.find('.lkh-modalTitle').html($(this).text());modalEl.find('.lkh-modalBody').html($('#'+tabId).html());if(tabId=='tab-additional_information'||tabId=='tab-description'){modalEl.find('.lkh-modalBody').children('h2').eq(0).hide();}
$(document.body).append(modalEl);}
$.fancybox.open({src:'#'+modalElId});}
function resize(){var tabsBoxEl=$('.woocommerce-tabs.wc-tabs-wrapper ul.tabs');var clickEls=tabsBoxEl.find('li[aria-controls] a');if($(window).width()<=767){if(tabsBoxEl.data('lkh-productTabsModalBindedFlag')!=='Y'){tabsBoxEl.data('lkh-productTabsModalBindedFlag','Y');clickEls.bind('click',click);}}
else{if(tabsBoxEl.data('lkh-productTabsModalBindedFlag')==='Y'){tabsBoxEl.data('lkh-productTabsModalBindedFlag','N');clickEls.unbind('click',click);}}}
$(window).resize(resize);resize();});})(jQuery);