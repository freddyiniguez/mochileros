<?php
$link = st_get_link_with_search(get_permalink(), array('start', 'end', 'room_num_search', 'adult_number'), $_GET);
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
?>
<div class="col-md-4">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <?php if($discount_text=get_post_meta(get_the_ID(),'discount_text',true)){ ?>
            <span class="box_sale btn-primary"> <?php echo balanceTags($discount_text)?> </span>
        <?php }?>
        <header class="thumb-header">
            <a class="hover-img" href="<?php echo esc_url($link)?>">

                <?php the_post_thumbnail(array(360, 270)) ?>
                <h5 class="hover-title-center"><?php st_the_language('book_now')?> </h5>
            </a>

        </header>
        <div class="thumb-caption">
            <?php
            $view_star_review = st()->get_option('view_star_review', 'review');
            if($view_star_review == 'review') :
                ?>
                <ul class="icon-group text-color">
                    <?php
                    $avg = STReview::get_avg_rate();
                    echo TravelHelper::rate_to_string($avg);
                    ?>
                </ul>
            <?php elseif($view_star_review == 'star'): ?>
                <ul class="icon-list icon-group booking-item-rating-stars">
                    <span class="pull-left mr10"><?php echo __('Hotel star', ST_TEXTDOMAIN); ?></span>
                    <?php
                    $star = STHotel::getStar();
                    echo  TravelHelper::rate_to_string($star);
                    ?>
                </ul>

            <?php endif; ?>
            <h5 class="thumb-title"><a class="text-darken"
                                       href="<?php echo esc_url($link)?>"><?php the_title()?></a></h5>
            <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                <p class="mb0">
                    <small><i class="fa fa-map-marker"></i> <?php echo esc_html($address) ?></small>
                </p>
            <?php endif;?>
            <div class="text-darken">
                <?php echo st()->load_template( 'hotel/elements/attribute' , 'list' ,array("taxonomy"=>$taxonomy));?>
            </div>
            <p class="mb0 text-darken"><span
                    <?php
                    $price = STHotel::get_price();
                    ?>
                    class="text-lg lh1em"><?php echo TravelHelper::format_money($price) ?></span>
                <small>
                    <?php if(STHotel::is_show_min_price()): ?>
                        <?php _e("Price from", ST_TEXTDOMAIN) ?>
                    <?php else:?>
                        <?php _e("Price Avg", ST_TEXTDOMAIN) ?>
                    <?php endif;?>

                    <?php //st_the_language('avg/night')?>
                </small>
            </p>
        </div>
    </div>
</div>