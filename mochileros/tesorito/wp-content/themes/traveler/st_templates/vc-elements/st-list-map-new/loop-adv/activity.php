<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity element loop 2
 *
 * Created by ShineTheme
 *
 */

$col = 12 / 3;
$info_price = STActivity::get_info_price();
$price = $info_price['price'];
$count_sale = $info_price['discount'];
if(!empty($count_sale)){
    $price = $info_price['price'];
    $price_sale = $info_price['price_old'];
}
?>
<?php
$link=st_get_link_with_search(get_permalink(),array('start','end','duration','people'),$_GET);
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
?>
<div class="<?php echo 'div_map_item_'.get_the_ID() ?>" >
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <header class="thumb-header">
            <a href="<?php echo esc_url($link) ?>" class="hover-img">
                <?php
                $img = get_the_post_thumbnail( get_the_ID() , array(800,600,'bfi_thumb'=>false)) ;
                if(!empty($img)){
                    echo balanceTags($img);
                }else{
                    echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(get_template_directory_uri().'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                }
                ?>
                <h5 class="hover-title-center"><?php st_the_language('book_now')?></h5>
            </a>
        </header>
        <div class="thumb-caption">
            <ul class="icon-group text-tiny text-color">
                <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
            </ul>
            <h5 class="thumb-title">
                <a href="<?php the_permalink() ?>" class="text-darken">
                    <?php the_title(); ?>
                </a>
            </h5>
            <p class="mb0">
                <i class="fa fa-map-marker">&nbsp;</i>
                <small>
                    <?php $address = get_post_meta(get_the_ID(),'address',true); ?>
                    <?php
                    if(!empty($address)){
                        echo esc_html($address);
                    }
                    ?>
                </small>
            </p>
            <p class="mb0 text-darken item_price_map">
                <span class="text-lg lh1em text-color">
                      <?php echo STActivity::get_price_html(get_the_ID(),false,'<br>'); ?>
                   </span>
            </p>
        </div>
    </div>
    <div class="gap"></div>
</div>


