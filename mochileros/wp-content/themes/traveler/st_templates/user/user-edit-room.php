<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create room
 *
 * Created by ShineTheme
 *
 */
if( STUser_f::st_check_edit_partner(STInput::request('id')) == false ){
    return false;
}
$post_id = STInput::request('id');
$post = get_post( $post_id );
?>
<?php $validator= STUser_f::$validator; ?>
<div class="st-create">
    <h2 class="pull-left"><?php echo __('Edit Hotel Room', ST_TEXTDOMAIN); ?></h2>
    <a target="_blank" href="<?php echo get_the_permalink($post_id) ?>" class="btn btn-default pull-right"><?php _e("Preview",ST_TEXTDOMAIN) ?></a>
</div>
<div class="msg">
    <?php echo STTemplate::message() ?>
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data" id="st_form_add_partner">
    <?php wp_nonce_field('user_setting','st_update_room'); ?>
    <div class="form-group form-group-icon-left">
        
        <label for="title" class="head_bol"><?php echo __('Room Name', ST_TEXTDOMAIN); ?>:</label>
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <input id="title" name="st_title" type="text" placeholder="<?php st_the_language('user_create_room_title') ?>" class="form-control" value="<?php echo esc_html($post->post_title) ?>">
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_title'),'danger') ?></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label for="st_content" class="head_bol"><?php  st_the_language('user_create_room_content') ?>:</label>
        <?php wp_editor( $post->post_content ,'st_content'); ?>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_content'),'danger') ?></div>
    </div>
    <div class="form-group">
        <label for="desc" class="head_bol"><?php _e("Room Description",ST_TEXTDOMAIN) ?>:</label>
        <textarea id="desc" rows="6" name="st_desc" class="form-control"><?php echo esc_html($post->post_excerpt) ?></textarea>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_desc'),'danger') ?></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label class="head_bol"><?php _e("Featured Image",ST_TEXTDOMAIN) ?>:</label>
        <?php $id_img = get_post_thumbnail_id($post_id);
        $post_thumbnail_id = wp_get_attachment_image_src($id_img, 'full');
        ?>
        <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="featured-image"  type="file" >
                        </span>
                    </span>
            <input type="text" readonly="" value="<?php echo esc_url($post_thumbnail_id['0']); ?>" class="form-control data_lable">
        </div>
        <input id="id_featured_image" name="id_featured_image" type="hidden" value="<?php echo esc_attr($id_img) ?>">
        <?php
        if(!empty($post_thumbnail_id)){
            echo '<div class="user-profile-avatar user_seting st_edit">
                            <div><img width="300" height="300" class="avatar avatar-300 photo img-thumbnail" src="'.$post_thumbnail_id['0'].'" alt=""></div>
                            <input name="" type="button"  class="btn btn-danger  btn_featured_image" value="'.st_get_language('user_delete').'">
                          </div>';
        }
        ?>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('featured_image'),'danger') ?></div>
    </div>
    <div class="tabbable tabs_partner">
        <ul class="nav nav-tabs" id="">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php _e("General",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-room-price" data-toggle="tab"><?php _e("Room Price",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-room-facility" data-toggle="tab"><?php _e("Room Facility",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-other-facility" data-toggle="tab"><?php _e("Other Facility",ST_TEXTDOMAIN) ?></a></li>
			<li><a href="#tab-cancel-booking" data-toggle="tab"><?php _e('Cancel Booking',ST_TEXTDOMAIN) ?></a></li>
            <?php $st_is_woocommerce_checkout=apply_filters('st_is_woocommerce_checkout',false);
            if(!$st_is_woocommerce_checkout):?>
                <li><a href="#tab-payment" data-toggle="tab"><?php _e("Payment Settings",ST_TEXTDOMAIN) ?></a></li>
            <?php endif ?>
            <li><a href="#availablility_tab" data-toggle="tab"><?php _e("Availability",ST_TEXTDOMAIN) ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-general">
                <div class="row">
                    <?php
                    $taxonomies = (get_object_taxonomies('hotel_room'));
                    if (is_array($taxonomies) and !empty($taxonomies)){
                        foreach ($taxonomies as $key => $value) {
                            ?>
                            <div class="col-md-12">
                                <?php
                                $category = STUser_f::get_list_taxonomy($value);
                                $taxonomy_tmp = get_taxonomy( $value );
                                $taxonomy_label =  ($taxonomy_tmp->label );
                                $taxonomy_name =  ($taxonomy_tmp->name );
                                if(!empty($category)):
                                    ?>
                                    <div class="form-group form-group-icon-left">
                                        <label for="check_all"> <?php echo esc_html($taxonomy_label); ?>:</label>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="checkbox-inline checkbox-stroke">
                                                    <label for="check_all">
                                                        <i class="fa fa-cogs"></i>
                                                        <input name="check_all" class="i-check check_all" type="checkbox"  /><?php _e("All",ST_TEXTDOMAIN) ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php foreach($category as $k=>$v):
                                                $icon = get_tax_meta($k,'st_icon');
                                                $icon = TravelHelper::handle_icon($icon);
                                                $check = '';
                                                if(STUser_f::st_check_post_term_partner( $post_id  ,$value , $k) == true ){
                                                    $check = 'checked';
                                                }
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="checkbox-inline checkbox-stroke">
                                                        <label for="taxonomy">
                                                            <i class="<?php echo esc_html($icon) ?>"></i>
                                                            <input name="taxonomy[]" class="i-check item_tanoxomy" type="checkbox" <?php echo esc_html($check) ?> value="<?php echo esc_attr($k.','.$taxonomy_name) ?>" /><?php echo esc_html($v) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        <?php
                        }
                    } else { ?>
                        <input name="no_taxonomy" type="hidden" value="no_taxonomy">
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            <label for="room_parent"><?php st_the_language('user_create_room_select_hotel') ?></label>
                            <?php $room_parent = get_post_meta($post_id , 'room_parent' ,true); ?>
                            <input type="text" name="room_parent" placeholder="<?php st_the_language('user_create_room_search') ?>" data-pl-name="<?php echo get_the_title($room_parent) ?>" data-pl-desc="" value="<?php echo esc_html($room_parent) ?>" id="room_parent" class="st_post_select" data-author="<?php echo esc_attr($data->ID)?>" data-post-type="st_hotel" style="width: 100%">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('room_parent'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="number_room"><?php st_the_language('user_create_room_number_room') ?></label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="number_room" name="number_room" placeholder="<?php st_the_language('user_create_room_number_room') ?>" type="text" min="1" value="<?php echo get_post_meta( $post_id , 'number_room' , true); ?>"  class="form-control number" >
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('number_room'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class='form-group form-group-icon-left'>
                            
                            <label for="st_custom_layout"><?php _e( "Detail Room Layout" , ST_TEXTDOMAIN ) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $layout = st_get_layout('hotel_room');
                            if(!empty($layout) and is_array($layout)):
                                ?>
                                <select class='form-control' name='st_custom_layout' id="st_custom_layout">
                                    <?php
                                    $st_custom_layout = get_post_meta($post_id , 'st_custom_layout' , true);
                                    foreach($layout as $k=>$v):
                                        if($st_custom_layout == $v['value']) $check = "selected"; else $check = '';
                                        echo '<option '.$check.' value='.$v['value'].'>'.$v['label'].'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            <label for="id_gallery"><?php _e( "Gallery" , ST_TEXTDOMAIN ) ?>:</label>
                            <?php $id_img = get_post_meta( $post_id , 'gallery' , true ); ?>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        <?php _e( "Browse…" , ST_TEXTDOMAIN ) ?> <input name="gallery[]" id="gallery" multiple type="file">
                                    </span>
                                </span>
                                <input type="text" readonly="" value="<?php echo esc_html( $id_img ) ?>"
                                       class="form-control data_lable">
                            </div>
                            <input id="id_gallery" name="id_gallery" type="hidden" value="<?php echo esc_attr( $id_img ) ?>">
                            <?php
                            if(!empty( $id_img )) {
                                echo '<div class="user-profile-avatar user_seting st_edit"><div>';
                                foreach( explode( ',' , $id_img ) as $k => $v ) {
                                    $post_thumbnail_id = wp_get_attachment_image_src( $v , 'full' );
                                    echo '<img width="300" height="300" class="avatar avatar-300 photo img-thumbnail" src="' . $post_thumbnail_id[ '0' ] . '" alt="">';
                                }
                                echo '</div><input name="" type="button"  class="btn btn-danger  btn_del_gallery" value="' . st_get_language( 'user_delete' ) . '"></div>';
                            }
                            ?>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('gallery'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-room-price">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="price"><?php _e("Price Per Night") ?>:</label>
                            <i class="fa fa-money input-icon input-icon-hightlight"></i>
                            <input id="price" name="price" type="text" placeholder="<?php st_the_language('user_create_room_price_per_night') ?>" class="form-control number" value="<?php echo get_post_meta($post_id , 'price' , true ) ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('price'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="discount_rate"><?php _e("Discount Rate",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="discount_rate" name="discount_rate" type="text" placeholder="<?php _e("Discount Rate (%)",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo get_post_meta($post_id , 'discount_rate' , true ) ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('discount_rate'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="is_sale_schedule"><?php _e("Sale Schedule",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $is_sale_schedule = get_post_meta($post_id,'is_sale_schedule',true) ?>
                            <select class="form-control is_sale_schedule" name="is_sale_schedule" id="is_sale_schedule">
                                <option value="on" <?php if($is_sale_schedule == 'on') echo 'selected'; ?>><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                                <option value="off" <?php if($is_sale_schedule == 'off') echo 'selected'; ?>><?php _e("No",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="data_is_sale_schedule">
                        <div class="col-md-6 input-daterange">
                            <div class="form-group form-group-icon-left" >
                                
                                <label for="sale_price_from"><?php _e("Sale Start Date",ST_TEXTDOMAIN) ?>:</label>
                                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                <input name="sale_price_from" id="sale_price_from" class="date-pick form-control st_date_start" data-date-format="yyyy-mm-dd" type="text" value="<?php echo get_post_meta($post_id , 'sale_price_from' , true ) ?>"/>
                                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('sale_price_from'),'danger') ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-icon-left" >
                                
                                <label for="sale_price_to"><?php _e("Sale End Date",ST_TEXTDOMAIN) ?>:</label>
                                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                <input name="sale_price_to" id="sale_price_to" class="date-pick form-control st_date_end" data-date-format="yyyy-mm-dd" type="text" value="<?php echo get_post_meta($post_id , 'sale_price_to' , true ) ?>" />
                                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('sale_price_to'),'danger') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="deposit_payment_status"><?php _e("Deposit Payment Options",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $deposit_payment_status = get_post_meta($post_id ,'deposit_payment_status',true) ?>
                            <select class="form-control deposit_payment_status" name="deposit_payment_status" id="deposit_payment_status">
                                <option value=""><?php _e("Disallow Deposit",ST_TEXTDOMAIN) ?></option>
                                <option value="percent" <?php if($deposit_payment_status == 'percent') echo 'selected' ?>><?php _e("Deposit By Percent",ST_TEXTDOMAIN) ?></option>
                                <option value="amount" <?php if($deposit_payment_status == 'amount') echo 'selected' ?>><?php _e("Deposit By Amount",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 data_deposit_payment_status">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="deposit_payment_amount"><?php _e("Deposit Payment Amount",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs  input-icon input-icon-hightlight"></i>
                            <input id="deposit_payment_amount" name="deposit_payment_amount" type="text" placeholder="<?php _e("Deposit Payment Amount",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo get_post_meta($post_id ,'deposit_payment_amount',true) ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('deposit_payment_amount'),'danger') ?></div>
                        </div>
                    </div>
                </div>
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="form-group form-group-icon-left">-->
<!--                            <label>--><?php //_e("Additional Payment Options",ST_TEXTDOMAIN) ?><!--:</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="content_data_paid_options">-->
<!--                        --><?php //$data_paid_options = get_post_meta($post_id,'paid_options',true);
//                        if(!empty($data_paid_options) and is_array($data_paid_options)):
//                            foreach($data_paid_options as $k=>$v){
//                        ?>
<!--                            <div class="paid_options_item" style="display: none;">-->
<!--                                <div class="col-md-5">-->
<!--                                    <label>--><?php //_e( "Title" , ST_TEXTDOMAIN ) ?><!--</label>-->
<!--                                    <input type="text" name="paid_options_title[]" class="form-control" value="--><?php //echo esc_html($v['title']) ?><!--">-->
<!--                                </div>-->
<!--                                <div class="col-md-6">-->
<!--                                    <label>--><?php //_e( "Value" , ST_TEXTDOMAIN ) ?><!--</label>-->
<!--                                    <input type="text" name="paid_options_value[]" class="form-control number" value="--><?php //echo esc_html($v['price']) ?><!--">-->
<!--                                </div>-->
<!--                                <div class="col-md-1">-->
<!--                                    <div class="form-group form-group-icon-left">-->
<!--                                        <div class="btn btn-danger btn_del_custom_partner" style="margin-top: 27px">-->
<!--                                            X-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        --><?php //}
//                        endif; ?>
<!--                    </div>-->
<!--                    <div class="col-md-12 div_btn_add_custom">-->
<!--                        <div class="form-group form-group-icon-left">-->
<!--                            <button id="btn_add_custom_paid_options" class="btn btn-info" type="button">--><?php //_e("Add New",ST_TEXTDOMAIN) ?><!--</button>-->
<!--                            <br>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="custom_price"><?php _e("Custom Price",ST_TEXTDOMAIN) ?></label>
                        </div>
                    </div>
                    <?php $data_price = STAdmin::st_get_all_price($post_id);?>
                    <div class="content_data_price">
                        <?php if(!empty($data_price)){
                            foreach($data_price as $k=>$v){
                                ?>
                                <div class="item">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-icon-left">
                                            
                                            <label for="st_start_date"><?php _e("Start Date",ST_TEXTDOMAIN) ?></label>
                                            <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                            <input id="st_start_date" data-date-format="yyyy-mm-dd" name="st_start_date[]" type="text" placeholder="<?php _e("Start Date",ST_TEXTDOMAIN) ?>" class="form-control date-pick" value="<?php echo esc_html($v->start_date) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-icon-left">
                                            
                                            <label for="st_end_date"><?php _e("End Date",ST_TEXTDOMAIN) ?></label>
                                            <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                            <input id="st_end_date" data-date-format="yyyy-mm-dd" name="st_end_date[]" type="text" placeholder="<?php _e("End Date",ST_TEXTDOMAIN) ?>" class="form-control date-pick" value="<?php echo esc_html($v->end_date) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-group-icon-left">
                                            
                                            <label for="st_price"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                                            <i class="fa fa-money input-icon input-icon-hightlight"></i>
                                            <input id="st_price" name="st_price[]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo esc_html($v->price) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <input name="st_priority[]" value="0" type="hidden" class="">
                                        <input name="st_price_type[]" value="default" type="hidden" class="">
                                        <input name="st_status[]" value="1" type="hidden" class="">
                                        <div class="btn btn-danger btn_del_price_custom" style="margin-top: 27px">-</div>
                                    </div>
                                </div>
                            <?php
                            }
                        } ?>
                
                    </div>
                    <div class="col-md-12 div_btn_add_custom">
                        <div class="form-group form-group-icon-left">
                            <button id="btn_add_custom_price" class="btn btn-info" type="button"><?php _e("Add Price Custom",ST_TEXTDOMAIN) ?></button>
                            <br>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="extra"><?php _e("Extra",ST_TEXTDOMAIN) ?>:</label>
                        </div>
                    </div>
                    <div class="content_extra_price">
                        <?php 
                            $extra = get_post_meta($post_id, 'extra_price', true);
                            if(is_array($extra) && count($extra)):
                                foreach($extra as $key => $val):
                        ?>
                        <div class="item">
                            <div class="col-xs-12 col-sm-3">
                                <div class="form-group form-group-icon-left">
                                    
                                    <label for="extra_title"><?php _e("Title",ST_TEXTDOMAIN) ?></label>
                                    <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                    <input value="<?php echo esc_html($val['title']); ?>" id="extra_title" data-date-format="yyyy-mm-dd" name="extra[title][]" type="text" placeholder="<?php _e("Title",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <div class="form-group form-group-icon-left">
                                    
                                    <label for="extra_name"><?php _e("Name",ST_TEXTDOMAIN) ?></label>
                                    <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                    <input value="<?php echo esc_html($val['extra_name']); ?>" id="extra_name" data-date-format="yyyy-mm-dd" name="extra[extra_name][]" type="text" placeholder="<?php _e("Name",ST_TEXTDOMAIN) ?>" class="form-control date-pick" value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <div class="form-group form-group-icon-left">
                                    
                                    <label for="extra_max_number"><?php _e("Max Of Number",ST_TEXTDOMAIN) ?></label>
                                    <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                    <input value="<?php echo esc_html($val['extra_max_number']); ?>" id="extra_max_number" data-date-format="yyyy-mm-dd" name="extra[extra_max_number][]" type="text" placeholder="<?php _e("Max of number",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <div class="form-group form-group-icon-left">
                                    
                                    <label for="extra_price"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                                    <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                    <input value="<?php echo esc_html($val['extra_price']); ?>" id="extra_price" data-date-format="yyyy-mm-dd" name="extra[extra_price][]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group form-group-icon-left">
                                    <div class="btn btn-danger btn_del_extra_price" style="margin-top: 27px">
                                        X
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; ?>
                    </div>
                    <div class="col-md-12 div_btn_add_custom">
                        <div class="form-group form-group-icon-left">
                            <button id="btn_add_extra_price" class="btn btn-info" type="button"><?php _e("Add Extra",ST_TEXTDOMAIN) ?></button>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-room-facility">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="adult_number"><?php st_the_language('user_create_room_adults_number') ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="adult_number" name="adult_number" type="text" min="1" value="<?php echo get_post_meta( $post_id , 'adult_number' , true); ?>"  class="form-control number">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('adult_number'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="children_number"><?php st_the_language('user_create_room_children_number') ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="children_number" name="children_number" type="text" min="1" value="<?php echo get_post_meta( $post_id , 'children_number' , true); ?>"  class="form-control number">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('children_number'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="bed_number"><?php st_the_language('user_create_room_beds_number') ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="bed_number" name="bed_number" type="text" min="1" class="form-control number" value="<?php echo get_post_meta( $post_id , 'bed_number' , true); ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('bed_number'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="room_footage"><?php _e("Room Footage (square feet)",ST_TEXTDOMAIN)?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="room_footage" name="room_footage" type="text"  placeholder="<?php st_the_language('user_create_room_room_footage')?>" class="form-control number" value="<?php echo get_post_meta( $post_id , 'room_footage' , true); ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('room_footage'),'danger') ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_room_external_booking"><?php _e("External Booking",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $st_room_external_booking = get_post_meta($post_id , 'st_room_external_booking' , true) ?>
                            <select class="form-control st_room_external_booking" name="st_room_external_booking" id="st_room_external_booking">
                                <option value="off" <?php if($st_room_external_booking == 'off') echo 'selected'; ?> ><?php _e("No",ST_TEXTDOMAIN) ?></option>
                                <option value="on" <?php if($st_room_external_booking == 'on') echo 'selected'; ?> ><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-6 data_st_room_external_booking'>
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_room_external_booking_link"><?php _e("External Booking URL",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-link  input-icon input-icon-hightlight"></i>
                            <input id="st_room_external_booking_link" name="st_room_external_booking_link" type="text" placeholder="<?php _e("Eg: https://domain.com") ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'st_room_external_booking_link' , true); ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_room_external_booking_link'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-other-facility">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="add_Ffacility"><?php _e("Add a Facility",ST_TEXTDOMAIN) ?>:</label>
                        </div>
                    </div>
                    <div class="content_data_add_new_facility">
                        <?php $add_new_facility = get_post_meta($post_id,'add_new_facility',true);
                        if(!empty($add_new_facility) and is_array($add_new_facility)):
                            foreach($add_new_facility as $k=>$v){

                                ?>
                                <div class="add_new_facility_item">
                                    <div class="col-md-3">
                                        <label for="add_new_facility_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
                                        <input type="text" name="add_new_facility_title[]" placeholder="<?php _e( "Title" , ST_TEXTDOMAIN ) ?>" class="form-control" value="<?php echo esc_html($v['title']) ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="add_new_facility_value"><?php _e( "Value" , ST_TEXTDOMAIN ) ?></label>
                                        <input type="text" name="add_new_facility_value[]" placeholder="<?php _e( "Value" , ST_TEXTDOMAIN ) ?>" class="form-control" value="<?php echo esc_html($v['facility_value']) ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="add_new_facility_icon"><?php _e( "Icon" , ST_TEXTDOMAIN ) ?></label>
                                        <input type="text" name="add_new_facility_icon[]" class="form-control" value="<?php if(!empty($v['facility_icon'])) echo esc_html($v['facility_icon']) ?>">
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group form-group-icon-left">
                                            <div class="btn btn-danger btn_del_facility btn_del_custom_partner" style="margin-top: 27px">
                                                X
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        endif; ?>
                    </div>
                    <div class="col-md-12 div_btn_add_custom">
                        <div class="form-group form-group-icon-left">
                            <button id="btn_add_custom_add_new_facility" class="btn btn-info" type="button"><?php _e("Add New",ST_TEXTDOMAIN) ?></button>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="room_description"><?php _e("Description",ST_TEXTDOMAIN) ?>:</label>
                            <textarea id="room_description" rows="6" name="room_description" class="form-control"><?php echo get_post_meta( $post_id , 'room_description' , true); ?></textarea>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('room_description'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
			<?php echo st()->load_template('user/tabs/cancel-booking',FALSE,array('validator'=>$validator)) ?>
            <div class="tab-pane fade" id="tab-payment">
                <?php
                $data_paypment = STPaymentGateways::get_payment_gateways();
                if (!empty($data_paypment) and is_array($data_paypment)) {
                    foreach( $data_paypment as $k => $v ) {?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-group-icon-left">
                                    
                                    <label for="is_meta_payment_gateway_<?php echo esc_attr($k) ?>"><?php echo esc_html($v->get_name()) ?>:</label>
                                    <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                                    <?php $is_pay = get_post_meta($post_id , 'is_meta_payment_gateway_'.$k , true) ?>
                                    <select class="form-control" name="is_meta_payment_gateway_<?php echo esc_attr($k) ?>" id="is_meta_payment_gateway_<?php echo esc_attr($k) ?>">
                                        <option value="on" <?php if($is_pay == 'on') echo 'selected' ?>><?php _e( "Yes" , ST_TEXTDOMAIN ) ?></option>
                                        <option value="off" <?php if($is_pay == 'off') echo 'selected' ?>><?php _e( "No" , ST_TEXTDOMAIN ) ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
            <div class="tab-pane fade" id="availablility_tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="default_state"><?php _e("Availability",ST_TEXTDOMAIN) ?>:</label>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-3">
                                <div class="form-group">
                                    <label for="default_state"><?php echo __('Default State') ?></label>
                                    <select name="default_state" id="default_state" class="form-control">
                                        <option value="available" selected="selected"><?php echo __('Available', ST_TEXTDOMAIN) ?></option>
                                        <option value="not_available"><?php echo __('Not Available', ST_TEXTDOMAIN) ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php echo st()->load_template('availability/form'); ?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="text-center div_btn_submit">
        <input name="btn_update_post_type_room" id="btn_insert_post_type_room" type="submit"  class="btn btn-primary btn-lg" value="<?php _e("UPDATE ROOM HOTEL",ST_TEXTDOMAIN) ?>">
    </div>
</form>

<div class="data_price_html" style="display: none">
    <div class="item">
        <div class="col-md-4">
            <div class="form-group form-group-icon-left">
                
                <label for="st_start_date"><?php _e("Start Date",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <input id="st_start_date" data-date-format="yyyy-mm-dd" name="st_start_date[]" type="text" placeholder="<?php _e("Start Date",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group form-group-icon-left">
                
                <label for="st_end_date"><?php _e("End Date",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <input id="st_end_date" data-date-format="yyyy-mm-dd" name="st_end_date[]" type="text" placeholder="<?php _e("End Date",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-group-icon-left">
                
                <label for="st_price"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                <input id="st_price" name="st_price[]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control number">
            </div>
        </div>
        <div class="col-md-1">
            <input name="st_priority[]" value="0" type="hidden" class="">
            <input name="st_price_type[]" value="default" type="hidden" class="">
            <input name="st_status[]" value="1" type="hidden" class="">
            <div class="btn btn-danger btn_del_price_custom" style="margin-top: 27px">X</div>
        </div>
    </div>
</div>
<!-- Template -->
<div class="paid_options_html">
    <div class="paid_options_item" style="display: none;">
        <div class="col-md-5">
            <label for="paid_options_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
            <input type="text" name="paid_options_title[]" placeholder="<?php _e( "Title" , ST_TEXTDOMAIN ) ?>" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="paid_options_value"><?php _e( "Value" , ST_TEXTDOMAIN ) ?></label>
            <input type="text" name="paid_options_value[]" placeholder="<?php _e( "Value" , ST_TEXTDOMAIN ) ?>" class="form-control">
        </div>
        <div class="col-md-1">
            <div class="form-group form-group-icon-left">
                <div class="btn btn-danger btn_del_custom_partner" style="margin-top: 27px">
                    X
                </div>
            </div>
        </div>
    </div>
</div>
<div class="data-extra-price-html" style="display: none">
    <div class="item">
        <div class="col-xs-12 col-sm-3">
            <div class="form-group form-group-icon-left">
                
                <label for="extra_title"><?php _e("Title",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                <input id="extra_title" data-date-format="yyyy-mm-dd" name="extra[title][]" type="text" placeholder="<?php _e("Title",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
            </div>
        </div>
        <div class="col-xs-12 col-sm-3">
            <div class="form-group form-group-icon-left">
                
                <label for="extra_name"><?php _e("Name",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                <input id="extra_name" data-date-format="yyyy-mm-dd" name="extra[extra_name][]" type="text" placeholder="<?php _e("Name",ST_TEXTDOMAIN) ?>" class="form-control date-pick" value="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-3">
            <div class="form-group form-group-icon-left">
                
                <label for="extra_max_number"><?php _e("Max Of Number",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                <input id="extra_max_number" data-date-format="yyyy-mm-dd" name="extra[extra_max_number][]" type="text" placeholder="<?php _e("Max of number",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
            </div>
        </div>
        <div class="col-xs-12 col-sm-2">
            <div class="form-group form-group-icon-left">
                
                <label for="extra_price"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                <input id="extra_price" data-date-format="yyyy-mm-dd" name="extra[extra_price][]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group form-group-icon-left">
                <div class="btn btn-danger btn_del_extra_price" style="margin-top: 27px">
                    X
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Template -->
<div class="add_new_facility_html">
    <div class="add_new_facility_item" style="display: none;">
        <div class="col-md-3">
            <label for="add_new_facility_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
            <input type="text" name="add_new_facility_title[]" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="add_new_facility_value"><?php _e( "Value" , ST_TEXTDOMAIN ) ?></label>
            <input type="text" name="add_new_facility_value[]" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="add_new_facility_icon"><?php _e( "Icon" , ST_TEXTDOMAIN ) ?></label>
            <input type="text" name="add_new_facility_icon[]" class="form-control" placeholder="<?php _e("(eg: fa-facebook)",ST_TEXTDOMAIN) ?>">
        </div>
        <div class="col-md-1">
            <div class="form-group form-group-icon-left">
                <div class="btn btn-danger btn_del_facility btn_del_custom_partner" style="margin-top: 27px">
                    X
                </div>
            </div>
        </div>
    </div>
</div>