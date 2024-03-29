<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create activity
 *
 * Created by ShineTheme
 *
 */
$validator= STUser_f::$validator;
?>
<div class="st-create">
    <h2><?php _e("Add new Activity",ST_TEXTDOMAIN) ?></h2>
</div>
<div class="msg">
    <?php echo STTemplate::message() ?>
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data" id="st_form_add_partner" class="<?php echo STUser_f::get_status_msg(); ?>">
    <?php wp_nonce_field( 'user_setting' , 'st_insert_post_activity' ); ?>
    <div class="form-group form-group-icon-left">
        
        <label for="title" class="head_bol"><?php echo __('Name of Activity', ST_TEXTDOMAIN); ?>:</label>
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <input id="title" name="st_title" type="text"
               placeholder="<?php echo __('Name of Activity', ST_TEXTDOMAIN); ?>" class="form-control" value="<?php echo STInput::request('st_title') ?>">
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_title'),'danger') ?></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label for="st_msg" class="head_bol"><?php st_the_language( 'user_create_activity_content' ) ?>:</label>
        <?php wp_editor( stripslashes(STInput::request('st_content')) , 'st_content' ); ?>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_content'),'danger') ?></div>
    </div>
    <div class="form-group">
        <label for="desc" class="head_bol"><?php _e("Activity Description",ST_TEXTDOMAIN) ?>:</label>
        <textarea id="desc" name="st_desc" rows="6" class="form-control"><?php echo stripslashes(STInput::request( 'st_desc' )) ?></textarea>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_desc'),'danger') ?></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label class="head_bol"><?php _e("Featured Image",ST_TEXTDOMAIN) ?>:</label>
        <?php
        $id_img = STInput::request('id_featured_image');
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
        <i><?php _e("Image format : jpg, png, gif . We recommend size 800x600",ST_TEXTDOMAIN) ?></i>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('featured_image'),'danger') ?></div>
    </div>

    <div class="tabbable tabs_partner">
        <ul class="nav nav-tabs" id="">
            <li class="active"><a href="#tab-location-setting" data-toggle="tab"><?php _e("Location Settings",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-general" data-toggle="tab"><?php _e("General Settings",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-info" data-toggle="tab"><?php _e("Informations",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-price-setting" data-toggle="tab"><?php _e("Price Settings",ST_TEXTDOMAIN) ?></a></li>
			<li><a href="#tab-cancel-booking" data-toggle="tab"><?php _e('Cancel Booking',ST_TEXTDOMAIN) ?></a></li>
            <?php $st_is_woocommerce_checkout=apply_filters('st_is_woocommerce_checkout',false);
            if(!$st_is_woocommerce_checkout):?>
                <li><a href="#tab-payment" data-toggle="tab"><?php _e("Payment Settings",ST_TEXTDOMAIN) ?></a></li>
            <?php endif ?>
            <?php $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
            if(!empty( $custom_field ) and is_array( $custom_field )) { ?>
                <li><a href="#tab-custom-fields" data-toggle="tab"><?php _e("Custom Fields",ST_TEXTDOMAIN) ?></a></li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-location-setting">
                <div class="row">
                    <!-- <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="multi_location"><?php st_the_language( 'user_create_car_location' ) ?>:</label>
                            <div id="setting_multi_location" class="location-front">
                                <select placeholder="<?php echo __( 'Select location...' , ST_TEXTDOMAIN ); ?>" tabindex="-1"
                                        name="multi_location[]" id="multi_location"
                                        class="option-tree-ui-select list-item-post-type app" data-post-type="location">
                                        <option value=""><?php echo __('Select a location', ST_TEXTDOMAIN); ?></option> 
                                    <?php
                                    $locations = TravelHelper::getLocationBySession();
                                    $html_location = TravelHelper::treeLocationHtml($locations, 0);
                    
                                    if(is_array($html_location) && count($html_location)):
                                        foreach($html_location as $key => $value):
                                            $id = preg_replace("/(\_)/", "", $value['ID']);
                                    ?>      
                                        <option value="<?php echo $value['ID']; ?>"><?php echo $value['prefix'].get_the_title($id); ?></option>
                                    <?php
                                    endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('multi_location'),'danger') ?></div>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="address" ><?php _e("Address",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-home input-icon input-icon-hightlight"></i>
                            <input id="address" name="address" type="text"
                                   placeholder="<?php _e("Address",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo STInput::request('address') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('address'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-12 partner_map">
                                <?php
                                if(class_exists('BTCustomOT')){
                                    BTCustomOT::load_fields();
                                    ot_type_bt_gmap_html();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <div class='form-group form-group-icon-left'>
                            <label for="is_featured"><?php _e( "Enable Street Views" , ST_TEXTDOMAIN ) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $enable_street_views_google_map  = STInput::request('enable_street_views_google_map') ?>
                            <select class='form-control app' name='enable_street_views_google_map' id="enable_street_views_google_map">
                                <option value='on' <?php if($enable_street_views_google_map == 'on') echo 'selected'; ?> ><?php _e("On",ST_TEXTDOMAIN) ?></option>
                                <option value='off' <?php if($enable_street_views_google_map == 'off') echo 'selected'; ?> ><?php _e("Off",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-general">
                <div class="row">
                    <?php
                    $taxonomies = (get_object_taxonomies('st_activity'));
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
                                        <label for="taxonomy"> <?php echo esc_html($taxonomy_label); ?>:</label>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="checkbox-inline checkbox-stroke">
                                                    <label for="taxonomy">
                                                        <i class="fa fa-cogs"></i>
                                                        <input id="check_all" name="check_all" class="i-check check_all" type="checkbox"  /><?php _e("All",ST_TEXTDOMAIN) ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php foreach($category as $k=>$v):
                                                $icon = get_tax_meta($k,'st_icon');
                                                $icon = TravelHelper::handle_icon($icon);
                                                $check = '';
                                                if(STUser_f::st_check_post_term_partner( ''  ,$value , $k) == true ){
                                                    $check = 'checked';
                                                }
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="checkbox-inline checkbox-stroke">
                                                        <label>
                                                            <i class="<?php echo esc_html($icon) ?>"></i>
                                                            <input name="taxonomy[]" class="i-check item_tanoxomy" <?php echo esc_html($check) ?> type="checkbox" value="<?php echo esc_attr($k.','.$taxonomy_name) ?>" /><?php echo esc_html($v) ?>
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
                    <div class="col-md-12">
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('taxonomy[]'),'danger') ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class='form-group form-group-icon-left'>
                            <label for="st_custom_layout"><?php _e( "Detail Activity Layout" , ST_TEXTDOMAIN ) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $layout = st_get_layout('st_activity');
                            if(!empty($layout) and is_array($layout)):
                                ?>
                                <select id="st_custom_layout" class='form-control app' name='st_custom_layout'>
                                    <?php
                                    $st_custom_layout = STInput::request('st_custom_layout');
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
                        <div class='form-group form-group-icon-left'>
                            <?php if(st()->get_option( 'partner_set_feature' ) == "on") { ?>
                                
                                <label for="is_featured"><?php _e( "Set as Featured" , ST_TEXTDOMAIN ) ?>:</label>
                                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                                <?php $is_featured  = STInput::request('is_featured') ?>
                                <select class='form-control' name='is_featured' id="is_featured">
                                    <option value='off' <?php if($is_featured == 'off') echo 'selected'; ?> ><?php _e("No",ST_TEXTDOMAIN) ?></option>
                                    <option value='on' <?php if($is_featured == 'on') echo 'selected'; ?> ><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                                </select>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            <label for="show_agent_contact_info"><?php _e('Choose which contact info will be shown?',ST_TEXTDOMAIN) ?>:</label>
							<?php $select=array(
								'use_theme_option'=>__('Use Theme Options',ST_TEXTDOMAIN),
								'user_agent_info'=>__('Use Agent Contact Info',ST_TEXTDOMAIN),
								'user_item_info'=>__('Use Item Info',ST_TEXTDOMAIN),
							) ?>
                            <i class="fa  fa-envelope-o input-icon input-icon-hightlight"></i>
							<select name="show_agent_contact_info" id="show_agent_contact_info" class="form-control app">
							<?php
							if(!empty($select)){
								foreach($select as $s=>$v){
									printf('<option value="%s" %s >%s</option>',$s,selected(STInput::request('show_agent_contact_info'),$s,FALSE),$v);
								}
							}
							?>
							</select>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('show_agent_contact_info'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">

                            <label for="email"><?php st_the_language( 'user_create_activity_email' ) ?>:</label>
                            <i class="fa  fa-envelope-o input-icon input-icon-hightlight"></i>
                            <input id="email" name="email" type="text"
                                   placeholder="<?php st_the_language( 'user_create_activity_email' ) ?>" class="form-control" value="<?php echo STInput::request('email') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('email'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6 clear">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="phone"><?php st_the_language( 'user_create_activity_phone' ) ?>:</label>
                            <i class="fa  fa-phone input-icon input-icon-hightlight"></i>
                            <input id="phone" name="phone" type="phone"
                                   placeholder="<?php st_the_language( 'user_create_activity_phone' ) ?>" class="form-control" value="<?php echo STInput::request('phone') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('phone'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="website"><?php st_the_language( 'user_create_activity_website' ) ?>:</label>
                            <i class="fa  fa-link input-icon input-icon-hightlight"></i>
                            <input id="website" name="website" type="text"
                                   placeholder="<?php st_the_language( 'user_create_activity_website' ) ?>" class="form-control" value="<?php echo STInput::request('website') ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('website'),'danger') ?></div>
                    </div>
					<div class="col-md-6 clear">
                        <div class="form-group form-group-icon-left">

                            <label for="contact_fax"><?php _e('Fax',ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa  fa-link input-icon input-icon-hightlight"></i>
                            <input id="contact_fax" name="contact_fax" type="text"
                                   placeholder="<?php _e('Fax',ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo STInput::request('contact_fax') ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('contact_fax'),'danger') ?></div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="video"><?php st_the_language( 'user_create_activity_video' ) ?>:</label>
                            <i class="fa  fa-youtube-play input-icon input-icon-hightlight"></i>
                            <input id="video" name="video" type="text"
                                   placeholder="<?php _e("Enter Youtube or Vimeo video link (Eg: https://www.youtube.com/watch?v=JL-pGPVQ1a8)") ?>" class="form-control" value="<?php echo STInput::request('video') ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('video'),'danger') ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="id_gallery"><?php _e( "Gallery" , ST_TEXTDOMAIN ) ?>:</label>
                            <?php $id_img = STInput::request('id_gallery') ?>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file multiple">
                                        <?php _e( "Browse…" , ST_TEXTDOMAIN ) ?> <input name="gallery[]" id="gallery" multiple type="file">
                                    </span>
                                </span>
                                <input type="text" readonly="" value="<?php echo esc_html( $id_img ) ?>" class="form-control data_lable">
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
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('gallery'),'danger') ?></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="type_activity"><?php _e("Activity Type" , ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                            <?php $type_activity = STInput::request('type_activity'); ?>
                            <select class="form-control app" name="type_activity" id="type_activity">
                                <option  value="specific_date" <?php if($type_activity =='specific_date') echo "selected"; ?> ><?php _e('Specific Date',ST_TEXTDOMAIN) ?></option>
                                <option  value="daily_activity" <?php if($type_activity =='daily_activity') echo "selected"; ?>><?php _e('Daily Activity',ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 data_duration">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="duration"><?php st_the_language( 'user_create_activity_duration' ) ?>:</label>
                            <i class="fa fa-clock-o input-icon input-icon-hightlight"></i>
                            <input type="text" name="duration" class="form-control number" id="duration"
                                   placeholder="<?php st_the_language( 'user_create_activity_duration' ) ?>" value="<?php echo STInput::request('duration') ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('duration'),'danger') ?></div>
                    </div>
                </div>
                <div class="row data_activity_specific_date">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="check_in"><?php _e("Start Date",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                            <input type="text" data-date-format="yyyy-mm-dd" name="check_in" id="check_in"
                                   class="date-pick form-control" value="<?php echo STInput::request('check_in') ?>" placeholder="<?php _e("Start Date",ST_TEXTDOMAIN) ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('check_in'),'danger') ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="check_out"><?php _e("End Date",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                            <input type="text" data-date-format="yyyy-mm-dd" name="check_out" id="check_out"
                                   class="date-pick form-control"  value="<?php echo STInput::request('check_out') ?>" placeholder="<?php _e("End Date",ST_TEXTDOMAIN) ?>">

                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('check_out'),'danger') ?></div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="activity-time"><?php st_the_language( 'user_create_activity_activity_time' ) ?>:</label>
                            <i class="fa fa-clock-o input-icon input-icon-hightlight"></i>
                            <input name="activity-time" class="time-pick form-control" type="text" id="activity-time"
                                   placeholder="<?php st_the_language( 'user_create_activity_activity_time' ) ?>" value="<?php echo STInput::request('activity-time') ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('activity-time'),'danger') ?></div>
                    </div>
                    <div class='col-md-6'>
                        <div class="form-group">
                            <label for="activity_booking_period"><?php _e("Booking Period",ST_TEXTDOMAIN) ?>:</label>
                            <input id="activity_booking_period" name="activity_booking_period" type="text" min="0" placeholder="<?php _e("Booking Period (day)",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('activity_booking_period') ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('activity_booking_period'),'danger') ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="max_people"><?php _e("Max Number of People",ST_TEXTDOMAIN) ?>:</label>
                            <input id="max_people" name="max_people" type="text" min="1" placeholder="<?php _e("Max Number of People",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('max_people') ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('max_people'),'danger') ?></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="venue-facilities"><?php st_the_language( 'user_create_activity_venue_facilities' ) ?>:</label>
                            <textarea class="form-control" name="venue-facilities" id="venue-facilities"><?php echo stripslashes(STInput::request('venue-facilities')) ?></textarea>
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('venue-facilities'),'danger') ?></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-price-setting">
                <div class="row">
                    <!--<div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <i class="fa  fa-cogs input-icon input-icon-hightlight"></i>
                            <label><?php /*_e( "Type Price" , ST_TEXTDOMAIN ) */?>:</label>
                            <?php /*$type_price = STInput::request('type_price');*/?>
                            <select id="type_price" name="type_price" class="form-control">
                                <option <?php /*if($type_price =="activity_price") echo "selected"; */?> value="activity_price"><?php /*_e( "Price / Activity" , ST_TEXTDOMAIN ) */?></option>
                                <option <?php /*if($type_price =="people_price") echo "selected"; */?> value="people_price"><?php /*_e( "Price / Person" , ST_TEXTDOMAIN ) */?></option>
                            </select>
                        </div>
                    </div>-->
                    <!--<div class="activity_price">
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left">
                                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                                <label><?php /*st_the_language( 'user_create_activity_price' ) */?>:</label>
                                <input id="price" name="price" type="text" placeholder="<?php /*st_the_language( 'user_create_activity_price' ) */?>" class="form-control number" value="<?php /*echo STInput::request('price') */?>">
                            </div>
                            <div class="st_msg"><?php /*echo STUser_f::get_msg_html($validator->error('price'),'danger') */?></div>
                        </div>
                    </div>-->
                    <div class="people_price">
                        <div class="col-md-4">
                            <div class="form-group form-group-icon-left">
                                
                                <label for="adult_price"><?php _e( "Adult Price" , ST_TEXTDOMAIN ) ?>:</label>
                                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                                <input id="adult_price" name="adult_price" type="text"
                                       placeholder="<?php _e( "Adult Price" , ST_TEXTDOMAIN ) ?>" class="form-control number" value="<?php echo STInput::request('adult_price') ?>">
                            </div>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('adult_price'),'danger') ?></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-icon-left">
                                
                                <label for="child_price"><?php _e( "Child Price" , ST_TEXTDOMAIN ) ?>:</label>
                                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                                <input id="child_price" name="child_price" type="text"
                                       placeholder="<?php _e( "Child Price" , ST_TEXTDOMAIN ) ?>" class="form-control number" value="<?php echo STInput::request('child_price') ?>">
                            </div>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('child_price'),'danger') ?></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-icon-left">
                                
                                <label for="infant_price"><?php _e( "Infant Price" , ST_TEXTDOMAIN ) ?>:</label>
                                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                                <input id="infant_price" name="infant_price" type="text"
                                       placeholder="<?php _e( "Infant Price" , ST_TEXTDOMAIN ) ?>" class="form-control number" value="<?php echo STInput::request('infant_price') ?>">
                            </div>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('infant_price'),'danger') ?></div>
                        </div>
                    </div>
                    <!--Fields list discount by Child number booking-->
                    <div class="adult">
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left">
                                <label for="discount_by_adult_title" class="head_bol"><?php _e("Discount by No. Adults",ST_TEXTDOMAIN) ?>:</label>
                            </div>
                        </div>
                        <?php
                        $discount_by_adult_title = STInput::request('discount_by_adult_title');
                        $discount_by_adult_key = STInput::request('discount_by_adult_key');
                        $discount_by_adult_value = STInput::request('discount_by_adult_value');
                        ?>
                        <div class="" id="data_discount_by_adult">
                            <?php
                            if(!empty($discount_by_adult_title)){
                                foreach($discount_by_adult_title as $k=>$v){
                                    if(!empty($v) and !empty($discount_by_adult_key[ $k ]) and !empty($discount_by_adult_value[ $k ])){
                                        ?>
                                        <div class="item">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="discount_by_adult_title"><?php _e("Title",ST_TEXTDOMAIN) ?></label>
                                                    <input id="" name="discount_by_adult_title[]" type="text" class="form-control" value="<?php echo esc_attr($v) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="discount_by_adult_key"><?php _e("Key Number",ST_TEXTDOMAIN) ?></label>
                                                    <input id="" name="discount_by_adult_key[]" type="text" class="form-control" value="<?php echo esc_attr($discount_by_adult_key[$k]) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="discount_by_adult_value"><?php _e("Percentage of Discount",ST_TEXTDOMAIN) ?></label>
                                                    <input id="" name="discount_by_adult_value[]" type="text" class="form-control" value="<?php echo esc_attr($discount_by_adult_value[$k]) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group form-group-icon-left">
                                                    <div class="btn btn-danger btn_del_program" style="margin-top: 27px">
                                                        X
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="col-md-12 div_btn_add_custom">
                            <div class="form-group form-group-icon-left">
                                <button id="btn_discount_by_adult" type="button" class="btn btn-info btn-sm"><?php _e("Add New",ST_TEXTDOMAIN) ?></button><br>
                            </div>
                        </div>
                    </div>
                    <div class="child">
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left">
                                <label class="head_bol"><?php _e("Discount by No. Children",ST_TEXTDOMAIN) ?>:</label>
                            </div>
                        </div>
                        <?php
                        $discount_by_child_title = STInput::request('discount_by_child_title');
                        $discount_by_child_key = STInput::request('discount_by_child_key');
                        $discount_by_child_value = STInput::request('discount_by_adult_value');
                        ?>
                        <div class="" id="data_discount_by_child">
                            <?php
                            if(!empty($discount_by_child_title)){
                                foreach($discount_by_child_title as $k=>$v){
                                    if(!empty($v) and !empty($discount_by_child_key[ $k ]) and !empty($discount_by_child_value[$k])) {
                                        ?>
                                        <div class="item">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="discount_by_child_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
                                                    <input id="" name="discount_by_child_title[]" type="text"
                                                           class="form-control"
                                                           value="<?php echo esc_attr( $v ) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="discount_by_child_key"><?php _e( "Key Number" , ST_TEXTDOMAIN ) ?></label>
                                                    <input id="" name="discount_by_child_key[]" type="text"
                                                           class="form-control"
                                                           value="<?php echo esc_attr( $discount_by_child_key[$k] ) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="discount_by_child_title"><?php _e( "Percentage of Discount" , ST_TEXTDOMAIN ) ?></label>
                                                    <input id="" name="discount_by_child_value[]" type="text"
                                                           class="form-control"
                                                           value="<?php echo esc_attr( $discount_by_child_value[$k] ) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group form-group-icon-left">
                                                    <div class="btn btn-danger btn_del_program"
                                                         style="margin-top: 27px">
                                                        X
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="col-md-12 div_btn_add_custom">
                            <div class="form-group form-group-icon-left">
                                <button id="btn_discount_by_child" type="button" class="btn btn-info btn-sm"><?php _e("Add New",ST_TEXTDOMAIN) ?></button><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="discount"><?php _e("Discount Rate",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-star  input-icon input-icon-hightlight"></i>
                            <input id="discount" name="discount" type="text" min="0"
                                   placeholder="<?php _e("Discount Rate (%)",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('discount') ?>">

                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('discount'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="is_sale_schedule"><?php _e("Sale Schedule",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $is_sale_schedule = STInput::request('is_sale_schedule');?>
                            <select class="form-control is_sale_schedule app" name="is_sale_schedule">
                                <option value="on" <?php if($is_sale_schedule == 'on') echo 'selected'; ?>><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                                <option value="off" <?php if($is_sale_schedule == 'off') echo 'selected'; ?>><?php _e("No",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="data_is_sale_schedule">
                        <div class="col-md-6 clear input-daterange">
                            <div class="form-group form-group-icon-left" >
                                
                                <label for="sale_price_from"><?php _e("Sale Start Date",ST_TEXTDOMAIN) ?>:</label>
                                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                <input name="sale_price_from" class="date-pick form-control st_date_start" placeholder="<?php _e("Sale Start Date",ST_TEXTDOMAIN) ?>" data-date-format="yyyy-mm-dd" type="text" value="<?php echo STInput::request('sale_price_from') ?>"/>
                                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('sale_price_from'),'danger') ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-icon-left" >
                                
                                <label for="sale_price_to"><?php _e("Sale End Date",ST_TEXTDOMAIN) ?>:</label>
                                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                <input name="sale_price_to" class="date-pick form-control st_date_end" placeholder="<?php _e("Sale End Date",ST_TEXTDOMAIN) ?>" data-date-format="yyyy-mm-dd" type="text" value="<?php echo STInput::request('sale_price_to') ?>" />
                                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('sale_price_to'),'danger') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 clear">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_activity_external_booking"><?php _e("External Booking",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $st_activity_external_booking = STInput::request('st_activity_external_booking'); ?>
                            <select class="form-control st_activity_external_booking app" name="st_activity_external_booking">
                                <option <?php if($st_activity_external_booking == 'off') echo 'selected';?> value="off"><?php _e("No",ST_TEXTDOMAIN) ?></option>
                                <option <?php if($st_activity_external_booking == 'on') echo 'selected';?> value="on"><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-6 data_st_activity_external_booking'>
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_activity_external_booking_link"><?php _e("External Booking URL",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-link  input-icon input-icon-hightlight"></i>
                            <input id="st_activity_external_booking_link" name="st_activity_external_booking_link" type="text" placeholder="<?php _e("Eg: https://domain.com") ?>" class="form-control" value="<?php echo STInput::request('st_activity_external_booking_link') ?>">
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_activity_external_booking_link'),'danger') ?></div>
                    </div>
                    <div class="col-md-6 clear">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="deposit_payment_status"><?php _e("Deposit Payment Options",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $deposit_payment_status = STInput::request('deposit_payment_status') ?>
                            <select class="form-control deposit_payment_status" name="deposit_payment_status" id="deposit_payment_status">
                                <option value=""><?php _e("Disallow Deposit",ST_TEXTDOMAIN) ?></option>
                                <option value="percent" <?php if($deposit_payment_status == 'percent') echo 'selected' ?>><?php _e("Deposit By Percent",ST_TEXTDOMAIN) ?></option>
                                <option value="amount" <?php if($deposit_payment_status == 'amount') echo 'selected' ?>><?php _e("Deposit By Amount",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 data_deposit_payment_status">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="deposit_payment_amount"><?php _e("Deposit Amount",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs  input-icon input-icon-hightlight"></i>
                            <input id="deposit_payment_amount" name="deposit_payment_amount" type="text" placeholder="<?php _e("Deposit Amount",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('deposit_payment_amount') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('deposit_payment_amount'),'danger') ?></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="best-price-guarantee"><?php st_the_language( 'user_create_activity_best_price_guarantee' ) ?>:</label>
                            <i class="fa fa-cogs  input-icon input-icon-hightlight"></i>
                            <?php $best_price_guarantee = STInput::request('best-price-guarantee')?>
                            <select class="form-control best-price-guarantee app" name="best-price-guarantee" id="best-price-guarantee">
                                <option <?php if($best_price_guarantee == "off") echo "selected"; ?> value="off"><?php _e('Off',ST_TEXTDOMAIN) ?></option>
                                <option <?php if($best_price_guarantee == "on") echo "selected"; ?> value="on"><?php _e('On',ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 data_best-price-guarantee">
                        <div class="form-group">
                            <label for="best-price-guarantee-text"><?php st_the_language( 'user_create_activity_best_price_guarantee_text' ) ?>:</label>
                            <textarea class="form-control" id="best-price-guarantee-text" name="best-price-guarantee-text"><?php echo STInput::request('best-price-guarantee-tex') ?></textarea>
                        </div>
                        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('best-price-guarantee-text'),'danger') ?></div>
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
                                    <?php $is_pay = STInput::request("is_meta_payment_gateway_".$k) ?>
                                    <select class="form-control app" name="is_meta_payment_gateway_<?php echo esc_attr($k) ?>" id="is_meta_payment_gateway_<?php echo esc_attr($k) ?>">
                                        <option <?php if($is_pay == 'on') echo "selected"; ?> value="on"><?php _e( "Yes" , ST_TEXTDOMAIN ) ?></option>
                                        <option <?php if($is_pay == 'off') echo "selected"; ?> value="off"><?php _e( "No" , ST_TEXTDOMAIN ) ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
            <div class="tab-pane fade" id="tab-custom-fields">
                <?php
                $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
                if(!empty( $custom_field ) and is_array( $custom_field )) {
                    ?>
                    <div class="row">
                        <?php
                        foreach( $custom_field as $k => $v ) {
                            $key   = str_ireplace( '-' , '_' , 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                            $class = 'col-md-12';
                            if($v[ 'type_field' ] == "date-picker") {
                                $class = 'col-md-4';
                            }
                            ?>
                            <div class="<?php echo esc_attr( $class ) ?>">
                                <div class="form-group">
                                    <label for="<?php echo esc_html($v[ 'title' ]) ?>"><?php echo esc_html($v[ 'title' ]) ?>:</label>
                                    <?php if($v[ 'type_field' ] == "text") { ?>
                                        <input id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text"
                                               placeholder="<?php echo esc_html($v[ 'title' ]) ?>" class="form-control" value="<?php echo STInput::request($key) ?>">
                                    <?php } ?>
                                    <?php if($v[ 'type_field' ] == "date-picker") { ?>
                                        <input id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text"
                                               placeholder="<?php echo esc_html($v[ 'title' ]) ?>"
                                               class="date-pick form-control" value="<?php echo STInput::request($key) ?>">
                                    <?php } ?>
                                    <?php if($v[ 'type_field' ] == "textarea") { ?>
                                        <textarea id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" class="form-control" ><?php echo get_post_meta( $post_id , $key , true); ?></textarea>
                                    <?php } ?>

                                    <div class="st_msg console_msg_"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="text-center div_btn_submit">
        <input  type="hidden" id=""  class="" name="action_partner" value="add_partner">
        <input name="btn_insert_post_type_activity" id="btn_insert_post_type_activity" type="submit" disabled class="btn btn-primary btn-lg" value="<?php _e("SUBMIT ACTIVITY",ST_TEXTDOMAIN) ?>">
    </div>

</form>
<div id="html_discount_by_adult" style="display: none">
    <div class="item">
        <div class="col-md-4">
            <div class="form-group">
                <label for="discount_by_adult_title"><?php _e("Title",ST_TEXTDOMAIN) ?></label>
                <input id="" name="discount_by_adult_title[]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="discount_by_adult_key"><?php _e("Key Number",ST_TEXTDOMAIN) ?></label>
                <input id="" name="discount_by_adult_key[]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="discount_by_adult_value"><?php _e("Percentage of Discount",ST_TEXTDOMAIN) ?></label>
                <input id="" name="discount_by_adult_value[]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group form-group-icon-left">
                <div class="btn btn-danger btn_del_program" style="margin-top: 27px">
                    X
                </div>
            </div>
        </div>
    </div>
</div>
<div id="html_discount_by_child" style="display: none">
    <div class="item">
        <div class="col-md-4">
            <div class="form-group">
                <label for="discount_by_child_title"><?php _e("Title",ST_TEXTDOMAIN) ?></label>
                <input id="" name="discount_by_child_title[]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="discount_by_child_key"><?php _e("Key Number",ST_TEXTDOMAIN) ?></label>
                <input id="" name="discount_by_child_key[]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="discount_by_child_value"><?php _e("Percentage of Discount",ST_TEXTDOMAIN) ?></label>
                <input id="" name="discount_by_child_value[]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group form-group-icon-left">
                <div class="btn btn-danger btn_del_program" style="margin-top: 27px">
                    X
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(function ($) {
        var type_price = $('#type_price').val();
        if (type_price == 'activity_price') {
            $('.activity_price').show(500);
            $('.people_price').hide(500);

        } else {
            $('.activity_price').hide(500);
            $('.people_price').show(500);
        }
        $('#type_price').change(function () {
            var type_price = $(this).val();
            if (type_price == 'activity_price') {
                $('.activity_price').show(500);
                $('.people_price').hide(500);

            } else {
                $('.activity_price').hide(500);
                $('.people_price').show(500);
            }
        });
        var type_activity = $('#type_activity').val();
        if (type_activity == 'specific_date') {
            $('.data_activity_specific_date').show(500);
            $('.data_duration').hide(500);

        } else {
            $('.data_activity_specific_date').hide(500);
            $('.data_duration').show(500);
        }
        $('#type_activity').change(function () {
            var type_activity =$(this).val();
            if (type_activity == 'specific_date') {
                $('.data_activity_specific_date').show(500);
                $('.data_duration').hide(500);
            } else {
                $('.data_activity_specific_date').hide(500);
                $('.data_duration').show(500);
            }
        });
    });
</script>