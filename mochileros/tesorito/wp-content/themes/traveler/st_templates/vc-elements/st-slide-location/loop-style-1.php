<?php
$thumbnail=get_post_thumbnail_id();
$img=wp_get_attachment_url($thumbnail);
if(empty($img)){
    $img = get_template_directory_uri().'/img/no-image.png';
}
$class_bg_img = Assets::build_css(" background: url(".$img.") ");

$c=TravelHelper::get_location_temp();

?>
<div class="bg-holder full text-center text-white style1">
    <div class="bg-mask"></div>
    <div class="bg-img <?php  echo esc_attr($class_bg_img)?>"></div>
    <div class="bg-front full-center">
        <div class="owl-cap">
            <?php if($st_weather == 'yes' and $c){ ?>
            <div class="owl-cap-weather"><span>
                    <?php echo esc_html($c['temp']) ?>
                </span>
                <?php echo balanceTags($c['icon']) ?>
            </div>
            <?php } ?>
            <h1 class="owl-cap-title fittext"><?php the_title() ?></h1>
            <div class="owl-cap-price <?php echo esc_html($st_type) ?>">
                <?php  $min_price = get_post_meta(get_the_ID() , 'min_price_'.$st_type , true );
                if(!empty($min_price)){
                    echo '<small>'.STLanguage::st_get_language('from').'</small><h5>'.TravelHelper::format_money($min_price).'</h5>';
                }
                ?>
            </div>
            <?php
            $page_search = st_get_page_search_result($st_type);
            $location_text = 'location_id'; 
            if ($st_type == 'st_cars'){
                $location_text = 'location_id_pick_up' ; 
            }
            if(!empty($page_search) and get_post_type($page_search)=='page'){

                //$link = add_query_arg(array('location_id'=>get_the_ID()),get_the_permalink($page_search));
                $link = add_query_arg(array($location_text=>get_the_ID(), 'location_name'=>get_the_title()),get_the_permalink($page_search));
            }else{
                //$link = home_url(esc_url('?s=&post_type='.$st_type.'&location_id='.get_the_ID()));
                //$link = home_url(esc_url('?s=&post_type='.$st_type.'&'.$location_text.'='.get_the_ID()."&pick-up=".get_the_title()));
                $link = add_query_arg(array(
                    's'=>'',
                    'post_type'=>$st_type,
                    $location_text=>get_the_ID(),
                    'pick-up'=>get_the_title()
                ),home_url('/'));

            }
            if($link_to == 'single'){
                $link = get_the_permalink();
            }
            ?>
            <a class="btn btn-white btn-ghost" href="<?php echo esc_url($link) ?>">
                <i class="fa fa-angle-right"></i>
                <?php STLanguage::st_the_language('explore') ?>
            </a>
        </div>
    </div>
</div>