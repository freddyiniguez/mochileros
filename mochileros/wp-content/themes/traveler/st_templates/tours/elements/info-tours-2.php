<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours info
 *
 * Created by ShineTheme
 *
 */

//check is booking with modal
$st_is_booking_modal = apply_filters('st_is_booking_modal',false);

$type_tour = get_post_meta(get_the_ID(),'type_tour',true);
$default = array('font_size'=> "3" , 'title1'=> __("Tour Informations" , ST_TEXTDOMAIN ) , 'title2'=> __("Place Order" , ST_TEXTDOMAIN) )  ;
extract(wp_parse_args( $attr, $default ));
echo STTemplate::message();
?>
<?php 

    $tour_show_calendar = st()->get_option('tour_show_calendar', 'on');
    $tour_show_calendar_below = st()->get_option('tour_show_calendar_below', 'off');
    if($tour_show_calendar == 'on' && $tour_show_calendar_below == 'off'):
?>
<div class='tour_show_caledar_below_off'>
<?php echo st()->load_template('tours/elements/tour_calendar'); ?>
</div>
<?php endif; ?>
<div class="package-info-wrapper packge-info-wrapper-style2" style="width: 100%">
    <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
    <div class="row">

        <div class="col-md-6"> 
            <h<?php echo esc_attr($font_size );?>><?php echo esc_attr($title1) ;?></h<?php echo esc_attr($font_size );?>>
            <div class="package_info_2 item mt20">
                <div class="title"><i class="fa fa-info-circle"></i></div>
                <div class="head">
                    <?php _e('Tour type',ST_TEXTDOMAIN) ?>: 
                    <span class='text-color text-uppercase'>
                        <?php if($type_tour == 'daily_tour') echo __('Daily Tour', ST_TEXTDOMAIN); else echo __('Specific Date', ST_TEXTDOMAIN) ?>
                    </span>
                </div>
            </div>
            <div class="package_info_2 item mt20">
                <div class="title"><i class="fa fa-user-plus"></i></div>
                <div class="head">
                    <?php _e('Maximum People',ST_TEXTDOMAIN) ?>: 
                    <?php $max_people = get_post_meta(get_the_ID(),'max_people', true) ?>
                    <span class='text-color text-uppercase'>
                        <?php echo esc_html($max_people) ?>
                    </span>
                </div>
            </div>
            <div class="package_info_2 item mt20">
                <div class="title"><i class="fa fa-map-marker"></i></div>
                <div class="head">
                    <?php _e('Location',ST_TEXTDOMAIN) ?>: 
                    <span class='text-color text-uppercase'>
                        <?php echo TravelHelper::locationHtml(get_the_ID()); ?>
                    </span>
                </div>
            </div>
            <div class="package_info_2 item mt20">
                <div class="title"><i class="fa fa-star"></i></div>
                <div class="head">
                    <?php _e('Rate',ST_TEXTDOMAIN) ?>: 
                    <ul class='text-color'>
                        <?php 
                    $avg = STReview::get_avg_rate();
                    echo TravelHelper::rate_to_string($avg);
                    ?>
                    </ul>
                </div>
            </div> 
        </div>
        <div class="col-md-6">
            <h<?php echo esc_attr($font_size );?>><?php echo esc_attr($title2)?></h<?php echo esc_attr($font_size );?>>
            <form id="form-booking-inpage" method="post" action="" class="mt10">
                    <input type="hidden" name="action" value="tours_add_to_cart" >
                    <input type="hidden" name="item_id" value="<?php echo get_the_ID()?>">
                    <input type="hidden" name="type_tour" value="<?php echo esc_html($type_tour) ?>">
                    <div class="div_book">
                        <?php $check_in = STInput::request('check_in', ''); ?>
                        <?php $check_out = STInput::request('check_out', ''); ?>
                        <?php 
                            if($tour_show_calendar == 'on'):
                        ?>
                            <div class="row ">
                                <div class="col-xs-12 ">
                                    <strong><?php _e('Departure date',ST_TEXTDOMAIN)?>: </strong>
                                    
                                    <input placeholder ="<?php echo __("Select a tour in the calendar", ST_TEXTDOMAIN) ; ?>" id="check_in" type="text" name="check_in" value="<?php echo $check_in; ?>" readonly="readonly" class="form-control mt10">
                                </div>
                                <div class="col-xs-12 mt10">
                                    <strong><?php _e('Arrive date',ST_TEXTDOMAIN)?>: </strong>
                                    
                                    <input id="check_out" type="text" name="check_out" value="<?php echo $check_out; ?>" readonly="readonly" class="form-control mt10">
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row mt10">
                                <div class="col-xs-12 mb5">
                                    <a href="#list_tour_item" id="select-a-tour" class="btn btn-primary"><?php echo __('Select a tour', ST_TEXTDOMAIN); ?></a>
                                </div>
                                <div class="col-xs-12 mb5" style="display: none">
                                    <strong><?php _e('Departure date',ST_TEXTDOMAIN)?>: </strong>
                                    <input placeholder ="<?php echo __("Select a tour in the calendar", ST_TEXTDOMAIN) ; ?>" id="check_in_2" type="text" name="check_in" value="<?php echo $check_in; ?>" readonly="readonly" class="form-control">
                                </div>
                                <div class="col-xs-12 mb5" style="display: none">
                                    <strong><?php _e('Arrive date',ST_TEXTDOMAIN)?>: </strong>
                                    <input id="check_out_2" type="text" name="check_out" value="<?php echo $check_out; ?>" readonly="readonly" class="form-control">
                                </div>
                            </div>
                            <div id="list_tour_item" data-type-tour="<?php echo $type_tour; ?>" style="display: none; width: 500px; height: auto;">

                            <?php 
                                $start = date('Y-m-01', strtotime(date('Y-m-d')));
                                $start = strtotime($start);
                                $end = date('Y-m-t', $start);
                                $end = strtotime($end);
                                $lists = AvailabilityHelper::_get_list_availability_tour_frontend(get_the_ID(), $start, $end);
                                if(is_array($lists) && count($lists)){
                                    foreach($lists as $list){
                                        ?>
                                        <div class="item_tour" style="padding-left: 20px">
                                        <?php if($type_tour == 'daily_tour'): ?>
                                            <div class="mb10"><input type="radio" class="i-radio" name="select_tour" data-start="<?php echo $list['start']; ?>" data-end="<?php echo $list['end']; ?>"><strong><?php echo __('Departure date', ST_TEXTDOMAIN); ?>:</strong> <?php echo date(TravelHelper::getDateFormat(),strtotime($list['start'])); ?></div>
                                        <?php else: ?>
                                            <div class="mb10"><input type="radio" class="i-radio" name="select_tour" data-start="<?php echo $list['start']; ?>" data-end="<?php echo $list['end']; ?>"><strong><?php echo __('Departure date', ST_TEXTDOMAIN); ?>:</strong> <?php echo date(TravelHelper::getDateFormat(),strtotime($list['start'])); ?> - <strong><?php echo __('Arrive date', ST_TEXTDOMAIN); ?>:</strong> <?php echo date(TravelHelper::getDateFormat(),strtotime($list['end'])); ?></div>
                                        <?php endif; ?>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                            </div>
                        <?php endif; ?>
                            <div class="row mt10">
                                <div class="col-xs-12 col-sm-4 ">
                                    <strong><?php _e('Adults',ST_TEXTDOMAIN)?>: </strong>
                                    <select class="mt10 form-control st_tour_adult" name="adult_number" required>
                                        <?php for($i = 1; $i <= 20; $i++){
                                            $is_select = '';
                                            if(STInput::request('adult_number') == $i){
                                                $is_select = 'selected="selected"';
                                            }
                                            echo  "<option {$is_select} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-4 ">
                                    <strong><?php _e('Children',ST_TEXTDOMAIN)?>: </strong>
                                    <select class="mt10 form-control st_tour_children" name="child_number" required>
                                        <?php for($i = 0; $i <= 20; $i++){
                                            $is_select = '';
                                            if(STInput::request('child_number') == $i){
                                                $is_select = 'selected="selected"';
                                            }
                                            echo  "<option {$is_select} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-4 ">
                                    <strong><?php _e('Infant',ST_TEXTDOMAIN)?>: </strong>
                                <select class="mt10 form-control st_tour_infant" name="infant_number" required>
                                    <?php for($i = 0; $i <= 20; $i++){
                                        $is_select = '';
                                        if(STInput::request('infant_number') == $i){
                                            $is_select = 'selected="selected"';
                                        }
                                        echo  "<option {$is_select} value='{$i}'>{$i}</option>";
                                    } ?>
                                </select>
                                </div>
                            </div>
                            <input type="hidden" name="adult_price" id="adult_price">
                            <input type="hidden" name="child_price" id="child_price">
                            <input type="hidden" name="infant_price" id="infant_price">
						<div class="message_box mb10"></div>
                        <div class="div_btn_book_tour">
                            <?php if($st_is_booking_modal){ ?>

                                <a data-target="#tour_booking_<?php the_ID() ?>" onclick="return false" class="btn btn-primary btn-st-add-cart" data-effect="mfp-zoom-out" ><?php st_the_language('book_now') ?> <i class="fa fa-spinner fa-spin"></i></a>
                            <?php }else{ ?>
                            <?php echo STTour::tour_external_booking_submit();?>                                
                            <?php } ?>
                            <?php echo st()->load_template('user/html/html_add_wishlist',null,array("title"=>'','class'=>'')) ?>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
<?php 
    if($tour_show_calendar == 'on' && $tour_show_calendar_below == 'on'):
?>
<div class='tour_show_caledar_below_on'>
<?php echo st()->load_template('tours/elements/tour_calendar'); ?>
</div>
<?php endif; ?>
<?php
if($st_is_booking_modal){?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="tour_booking_<?php echo get_the_ID()?>">
        <?php echo st()->load_template('tours/modal_booking');?>
    </div>

<?php }?>