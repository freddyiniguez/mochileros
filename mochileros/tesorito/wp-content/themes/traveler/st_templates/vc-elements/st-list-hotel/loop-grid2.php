<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/29/14
 * Time: 4:03 PM
 */

echo '<div class="row row-wrap st-list-hotel">';
while($query->have_posts())
{
    $query->the_post();

    $col = 12 / $st_ht_of_row;
    $hotel=new STHotel(get_the_ID());
    ?>
    <div <?php post_class('col-md-'.esc_attr($col)." col-sm-6 style_box")?>>
        <?php echo STFeatured::get_featured(); ?>
        <div class="thumb">
            <?php if($discount_text=get_post_meta(get_the_ID(),'discount_text',true)){ ?>
                <span class="box_sale btn-primary"> <?php echo balanceTags($discount_text)?> </span>
            <?php }?>
            <header class="thumb-header">
                <a class="hover-img" href="<?php the_permalink()?>">
                    <?php the_post_thumbnail(array(400,300,'bfi_thumb'=>true));?>

                    <h5 class="hover-title-center"><?php _e('Book Now',ST_TEXTDOMAIN)?></h5>
                </a>
            </header>
            <div class="thumb-caption">
                <?php 
                    $view_star_review = st()->get_option('view_star_review', 'review');
                    if($view_star_review == 'review') :
                ?>
                <ul class="icon-group text-tiny text-color st-item-rating">
                    <?php
                    $avg = STReview::get_avg_rate();
                    echo TravelHelper::rate_to_string($avg);
                    ?>
                </ul>
            <?php elseif($view_star_review == 'star'): ?>
                <ul class="icon-group text-tiny text-color st-item-rating">
                  <?php
                    $star = STHotel::getStar();
                    echo  TravelHelper::rate_to_string($star);
                  ?>
              </ul>
            <?php endif;  ?>
                <h5 class="thumb-title"><a class="text-darken" href="<?php the_permalink()?>"><?php the_title()?></a></h5>
                <?php if($address=get_post_meta(get_the_ID(),'address',true)){ ?>
                <p class="mb0"><small><i class="fa fa-map-marker"></i> <?php echo balanceTags($address)?></small>
                </p>
                <?php }?>
                <p class="mb0 text-darken">
                    <span class="text-lg lh1em text-color"><?php
                        $min_price=STHotel::get_avg_price(get_the_ID());
                        $price = STHotel::get_price();
                        echo TravelHelper::format_money($price);

                        ?></span><small> <?php
                        if(STHotel::is_show_min_price()){
                           _e('min/night',ST_TEXTDOMAIN);
                        }else{
                            _e('avg/night',ST_TEXTDOMAIN);
                        }
                        ?></small>

            </div>
        </div>
    </div>
<?php
}
echo "</div>";
