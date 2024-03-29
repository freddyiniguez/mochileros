<?php
$tours = new STTour();

$info_price = STTour::get_info_price();
$price      = $info_price[ 'price' ];
$count_sale = $info_price[ 'discount' ];
if(!empty( $count_sale )) {
    $price      = $info_price[ 'price' ];
    $price_sale = $info_price[ 'price_old' ];
}
$link=st_get_link_with_search(get_permalink(),array('start','end','duration','people'),$_GET);
?>
<div class="">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <header class="thumb-header">
            <?php if(!empty( $count_sale )) { ?>
                <span class="box_sale btn-primary"> <?php echo esc_html( $count_sale ) ?>% </span>
            <?php } ?>
            <a href="<?php echo esc_url($link) ?>" class="hover-img">
                <?php
                $img = get_the_post_thumbnail( get_the_ID() , array( 800 , 600 , 'bfi_thumb' => true ) );
                if(!empty( $img )) {
                    echo balanceTags( $img );
                } else {
                    echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="' . bfi_thumb( get_template_directory_uri() . '/img/no-image.png' , array(
                            'width'  => 800 ,
                            'height' => 600
                        ) ) . '">';
                }
                ?>
                <h5 class="hover-title hover-hold">
                    <?php the_title(); ?>
                </h5>
            </a>
        </header>
        <div class="thumb-caption">
            <div class="row mt10">
                <div class="col-md-5 col-sm-5 col-xs-5">
                    <i class="fa fa-map-marker"> &nbsp;</i>
                    <?php $address = get_post_meta( get_the_ID() , 'address' , true ); ?>
                    <?php
                    if(!empty( $address )) {
                        echo esc_html( $address );
                    }
                    ?>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-7 text-right">
                    <div class="package-info">
                        <?php
                        $type_tour = get_post_meta( get_the_ID() , 'type_tour' , true );
                        if($type_tour == 'daily_tour') {
                            $day = STTour::get_duration_unit();
							echo '<i class="fa fa-calendar">&nbsp;</i> '. esc_html( $day );
                        } else {
                            $check_in  = get_post_meta( get_the_ID() , 'check_in' , true );
                            $check_out = get_post_meta( get_the_ID() , 'check_out' , true );
                            if(!empty( $check_in ) and !empty( $check_out )) {
                                $date = date_i18n( TravelHelper::getDateFormat() , strtotime($check_in) ) . ' <i class="fa fa-long-arrow-right"></i> ' . date_i18n( TravelHelper::getDateFormat() , strtotime($check_out ));
                                echo '<i class="fa fa-calendar">&nbsp;</i> '.balanceTags( $date );
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
            <div class="row mt10">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <p class="mb0 text-darken">
                        <i class="fa fa-money">&nbsp;</i>
                       <span> <?php echo STTour::get_price_html( false , false , ' <br> -',FALSE ); ?></span>
                    </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <ul class="icon-group  text-color pull-right">
                        <?php echo TravelHelper::rate_to_string( STReview::get_avg_rate() ); ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</div>

