<div class="row row-wrap">
    <?php
    $tours = new STTour();
    while(have_posts()):
        the_post();
        if(intval($st_tour_of_row) <= 0 ) $st_tour_of_row =4;
        $col = 12 / $st_tour_of_row;

        $info_price = STTour::get_info_price();
        $price = $info_price['price'];
        $count_sale = $info_price['discount'];
        if(!empty($count_sale)){
            $price = $info_price['price'];
            $price_sale = $info_price['price_old'];
        }
        ?>
        <div class="col-md-<?php echo esc_attr($col) ?> style_box col-sm-6 col-xs-12 st_fix_<?php echo esc_attr($st_tour_of_row); ?>_col">
            <?php echo STFeatured::get_featured(); ?>
            <div class="thumb">
                <header class="thumb-header">
                    <?php if(!empty($count_sale)){ ?>
                        <span class="box_sale btn-primary"> <?php echo esc_html($count_sale) ?>% </span>
                    <?php } ?>
                    <a href="<?php the_permalink() ?>" class="hover-img">
                        <?php
                        $img = get_the_post_thumbnail( get_the_ID() , array(800,600,'bfi_thumb'=>true)) ;
                        if(!empty($img)){
                            echo balanceTags($img);
                        }else{
                            echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(get_template_directory_uri().'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                        }
                        ?>
                        <h5 class="hover-title hover-hold">
                            <?php the_title(); ?>
                        </h5>
                    </a>
                </header>
                <div class="thumb-caption">
                    <div class="row">
                        <?php if($location=TravelHelper::locationHtml(get_the_ID())){ ?>
                        <div class="col-md-12">
                            <i class="fa fa-location-arrow"></i>
                            <?php
                              echo ($location);
                            ?>
                        </div>
                        <?php }?>
                        <?php if($price_html=STTour::get_price_html(false,false,' <br> -')){?>
                        <div class="col-md-12">
                            <p class="mb0 text-darken">
                                <i class="fa fa-money"></i>
                                <?php echo ($price_html); ?>
                            </p>
                        </div>
                        <?php }?>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="package-info">
                                <?php
                                $type_tour = get_post_meta(get_the_ID() , 'type_tour' ,true);
                                if($type_tour == 'daily_tour'){
                                    $day = STTour::get_duration_unit();
									echo ' <i class="fa fa-calendar"></i> '. esc_html($day);
                                }else{
                                    $check_in = get_post_meta(get_the_ID() , 'check_in' ,true);
                                    $check_out = get_post_meta(get_the_ID() , 'check_out' ,true);
                                    if(!empty($check_in) and !empty($check_out)){
                                        $format=TravelHelper::getDateFormat();
                                        $date = date_i18n($format,strtotime($check_in)).' <i class="fa fa-long-arrow-right"></i> '.date_i18n($format,strtotime($check_out));

										echo ' <i class="fa fa-calendar"></i> '. balanceTags($date);
                                    }
                                }

                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="icon-group text-color pull-left">
                                <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endwhile;
    ?>
</div>