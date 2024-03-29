<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create cars
 *
 * Created by ShineTheme
 *
 */
?>
<?php $validator= STUser_f::$validator; ?>
<div class="st-create">
    <h2><?php st_the_language( 'user_create_car' ) ?></h2>
</div>
<div class="msg">
    <?php echo STTemplate::message() ?>
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data" id="st_form_add_partner" class="<?php echo STUser_f::get_status_msg(); ?>">
    <?php wp_nonce_field( 'user_setting' , 'st_insert_post_cars' ); ?>
    <div class="form-group form-group-icon-left">
        
        <label for="title" class="head_bol"><?php _e("Name of Car",ST_TEXTDOMAIN) ?>:</label>
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <input id="st_title_car" name="st_title_car" type="text" placeholder="<?php _e("Name of car",ST_TEXTDOMAIN) ?>"
               class="form-control" value="<?php echo STInput::request('st_title_car') ?>">
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_title_car'),'danger') ?></div>
    </div>
    <div class="form-group form-group-icon-left hidden">
        <label for="st_content"><?php st_the_language( 'user_create_car_content' ) ?>:</label>
        <?php wp_editor(stripslashes(STInput::request('st_content')),'st_content'); ?>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_content'),'danger') ?></div>
    </div>
    <div class="form-group">
        <label class="desc"><?php _e("Car Description",ST_TEXTDOMAIN) ?>:</label>
        <textarea id="desc" name="st_desc" rows="6" class="form-control"><?php echo stripslashes(STInput::request( 'st_desc' )) ?></textarea>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_desc'),'danger') ?></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label class="head_bol" for="id_featured_image"><?php _e("Featured Image",ST_TEXTDOMAIN) ?>:</label>
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
            <li><a href="#tab-car-details" data-toggle="tab"><?php _e("Car Details",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-contact-details" data-toggle="tab"><?php _e("Contact Details",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-price-setting" data-toggle="tab"><?php _e("Price Settings",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-car-options" data-toggle="tab"><?php _e("Cars Options",ST_TEXTDOMAIN) ?></a></li>
			<li><a href="#tab-cancel-booking" data-toggle="tab"><?php _e('Cancel Booking',ST_TEXTDOMAIN) ?></a></li>
            <?php $st_is_woocommerce_checkout=apply_filters('st_is_woocommerce_checkout',false);
                 if(!$st_is_woocommerce_checkout):?>
            <li><a href="#tab-payment" data-toggle="tab"><?php _e("Payment Settings",ST_TEXTDOMAIN) ?></a></li>
            <?php endif ?>
            <?php $custom_field = st()->get_option( 'st_cars_unlimited_custom_field' );
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
                                        class="option-tree-ui-select list-item-post-type" data-post-type="location">
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
                            
                            <label for="address"><?php st_the_language( 'user_create_car_address' ) ?>:</label>
                            <i class="fa fa-home input-icon input-icon-hightlight"></i>
                            <input id="address" name="address" type="text"
                                   placeholder="<?php st_the_language( 'user_create_car_address' ) ?>" class="form-control" value="<?php echo STInput::request('address') ?>">

                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('address'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-12 partner_map">
                        <?php
                        if(class_exists('BTCustomOT')){
                            BTCustomOT::load_fields();
                            ot_type_bt_gmap_html();
                        }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <div class='form-group form-group-icon-left'>
                            <label for="is_featured"><?php _e( "Enable Street Views" , ST_TEXTDOMAIN ) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $enable_street_views_google_map  = STInput::request('enable_street_views_google_map') ?>
                            <select class='form-control' name='enable_street_views_google_map' id="enable_street_views_google_map">
                                <option value='on' <?php if($enable_street_views_google_map == 'on') echo 'selected'; ?> ><?php _e("On",ST_TEXTDOMAIN) ?></option>
                                <option value='off' <?php if($enable_street_views_google_map == 'off') echo 'selected'; ?> ><?php _e("Off",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade  " id="tab-car-details">
                <div class="row">
                    <?php
                    $taxonomies = ( get_object_taxonomies( 'st_cars' ) );
                    if(is_array( $taxonomies ) and !empty( $taxonomies )) {
                        foreach( $taxonomies as $key => $value ) {
                            ?>
                            <div class="col-md-12">
                                <?php
                                $category       = STUser_f::get_list_taxonomy( $value );
                                $taxonomy_tmp   = get_taxonomy( $value );
                                $taxonomy_label = ( $taxonomy_tmp->label );
                                $taxonomy_name  = ( $taxonomy_tmp->name );
                                if(!empty( $category )):
                                    ?>
                                    <div class="form-group form-group-icon-left">
                                        <label for="taxonomy"> <?php echo esc_html( $taxonomy_label ); ?>:</label>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="checkbox-inline checkbox-stroke">
                                                    <label for="taxonomy">
                                                        <i class="fa fa-cogs"></i>
                                                        <input name="check_all" class="i-check check_all" type="checkbox"  /><?php _e("All",ST_TEXTDOMAIN) ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php foreach( $category as $k => $v ):
                                                $icon = get_tax_meta( $k , 'st_icon' );
                                                $icon = TravelHelper::handle_icon( $icon );
                                                $check = '';
                                                if(STUser_f::st_check_post_term_partner( ''  ,$value , $k) == true ){
                                                    $check = 'checked';
                                                }
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="checkbox-inline checkbox-stroke">
                                                        <label for="taxonomy">
                                                            <i class="<?php echo esc_html( $icon ) ?>"></i>
                                                            <input name="taxonomy[]" <?php echo esc_html($check) ?> class="i-check item_tanoxomy" type="checkbox"
                                                                   value="<?php echo esc_attr( $k . ',' . $taxonomy_name ) ?>"/><?php echo esc_html( $v ) ?>
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
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="equipment_item_title"><?php st_the_language( 'user_create_car_equipment_price_list' ) ?>:</label>
                        </div>
                    </div>
                    <div class="" id="data_equipment_item">
                        <?php
                        $equipment_item_title = STInput::request('equipment_item_title');
                        $equipment_item_price = STInput::request('equipment_item_price');
                        $equipment_item_price_unit = STInput::request('equipment_item_price_unit');
                        $equipment_item_price_max = STInput::request('equipment_item_price_max');
                        ?>
                        <?php
                        if(!empty($equipment_item_title)){
                            foreach($equipment_item_title as $k=>$v){
                                if(!empty($v) and !empty($equipment_item_price[ $k ])) {
                                    ?>
                                    <div class="item">
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label for="equipment_item_title"><?php st_the_language( 'user_create_car_equipment_title' ) ?></label>
                                                <input id="title" name="equipment_item_title[]" type="text" class="form-control" value="<?php echo esc_html($v) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label for="equipment_item_price"><?php st_the_language( 'user_create_car_equipment_price' ) ?></label>
                                                <input id="price" name="equipment_item_price[]" type="text" class="form-control number" value="<?php echo esc_html($equipment_item_price[$k]) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label for="equipment_item_price_unit"><?php _e("Price Unit",ST_TEXTDOMAIN) ?></label>
                                                <select class="form-control" id="equipment_item_price_unit" name="equipment_item_price_unit[]">
                                                    <option value=""><?php _e("Fixed Price",ST_TEXTDOMAIN) ?></option>
                                                    <option value="per_hour" <?php if($equipment_item_price_unit[$k] == 'per_hour') echo "selected" ?> ><?php _e("Price per Hour",ST_TEXTDOMAIN) ?></option>
                                                    <option value="per_day" <?php if($equipment_item_price_unit[$k] == 'per_day') echo "selected" ?> ><?php _e("Price per Day",ST_TEXTDOMAIN) ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <label for="price_max"><?php _e("Price Max",ST_TEXTDOMAIN) ?></label>
                                                <input id="price_max" name="equipment_item_price_max[]" type="text" class="form-control number" value="<?php echo esc_html($equipment_item_price_max[$k]) ?>">
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
                    <div class="col-md-12 text-right">
                        <div class="form-group form-group-icon-left">
                            <button id="btn_add_equipment_item" type="button"
                                    class="btn btn-info btn-sm"><?php st_the_language( 'user_create_car_add_equipment' ) ?></button>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="features_taxonomy"><?php st_the_language( 'user_create_car_features' ) ?>:</label>
                        </div>
                    </div>
                    <div class="" id="data_features">
                        <?php
                        $features_taxonomy = STInput::request('features_taxonomy');
                        $taxonomy_info = STInput::request('taxonomy_info');
                        if(!empty($features_taxonomy)){
                            foreach($features_taxonomy as $key=>$value){
                                    ?>
                                    <?php $list = STUser_f::get_list_value_taxonomy( 'st_cars' ); ?>
                                    <div class="item">
                                        <div class="col-md-4">
                                            <div class="form-group form-group-icon-left">
                                                
                                                <label for="features_taxonomy"><?php st_the_language( 'user_create_car_features_attributes' ) ?></label>
                                                <i class="fa fa-arrow-down input-icon input-icon-hightlight"></i>
                                                <?php
                                                if(!empty( $list )) {
                                                    $id = explode( ',' , $value );
                                                    $id = $id[ 0 ];
                                                    ?>
                                                    <select name="features_taxonomy[]" id="features_taxonomy"
                                                            class="form-control taxonomy_car">
                                                        <?php foreach( $list as $k => $v ) { ?>
                                                            <option  <?php if($v[ 'value' ] == $id)
                                                                echo 'selected'; ?>
                                                                data-icon="<?php echo esc_attr( $v[ 'icon' ] ) ?>"
                                                                value="<?php echo esc_attr( $v[ 'value' ] . ',' . $v[ 'label' ] ) ?>"><?php echo esc_attr( $v[ 'label' ] ) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group ">
                                                <label for="taxonomy_info"><?php st_the_language( 'user_create_car_features_attributes_info' ) ?></label>
                                                <input id="title" name="taxonomy_info[]" type="text"
                                                       class="form-control"
                                                       value="<?php echo esc_html( $taxonomy_info[ $key ] ) ?>">
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
                        ?>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="form-group form-group-icon-left">
                            <button id="btn_add_features" type="button"
                                    class="btn btn-info btn-sm"><?php st_the_language( 'user_create_car_add_features' ) ?></button>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class='form-group form-group-icon-left'>
                            
                            <label for="st_custom_layout"><?php _e( "Detail Car Layout" , ST_TEXTDOMAIN ) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $layout = st_get_layout('st_cars');
                            if(!empty($layout) and is_array($layout)):
                            ?>
                            <select class='form-control' name='st_custom_layout' id="st_custom_layout">
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
                    <div class="col-md-6 clear">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="video"><?php st_the_language( 'user_create_car_video' ) ?>:</label>
                            <i class="fa  fa-youtube-play input-icon input-icon-hightlight"></i>
                            <input id="video" name="video" type="text"
                                   placeholder="<?php _e("Enter Youtube or Vimeo video link (Eg: https://www.youtube.com/watch?v=JL-pGPVQ1a8)") ?>" class="form-control" value="<?php echo STInput::request('video') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('video'),'danger') ?></div>
                        </div>
                    </div>
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
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('gallery'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade  " id="tab-contact-details">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            <label for="id_logo" class="head_bol"><?php _e("Logo",ST_TEXTDOMAIN) ?>:</label>
                            <?php
                            $id_img = STInput::request('id_logo');
                            $post_thumbnail_id = wp_get_attachment_image_src($id_img, 'full');
                            ?>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="logo"  type="file" >
                                    </span>
                                </span>
                                <input type="text" readonly="" value="<?php echo esc_url($post_thumbnail_id['0']); ?>" class="form-control data_lable">
                            </div>
                            <input id="id_logo" name="id_logo" type="hidden" value="<?php echo esc_attr($id_img) ?>">
                            <?php
                            if(!empty($post_thumbnail_id)){
                                echo '<div class="user-profile-avatar user_seting st_edit">
                                        <div><img width="300" height="300" class="avatar avatar-300 photo img-thumbnail" src="'.$post_thumbnail_id['0'].'" alt=""></div>
                                        <input name="" type="button"  class="btn btn-danger  btn_featured_image" value="'.st_get_language('user_delete').'">
                                      </div>';
                            }
                            ?>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('logo'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_name"><?php _e("Car Manufacturer Name",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa  fa-star input-icon input-icon-hightlight"></i>
                            <input id="st_name" name="st_name" type="text"
                                   placeholder="<?php _e("Car Manufacturer Name",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo STInput::request('st_name') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_name'),'danger') ?></div>
                        </div>
                    </div>
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
                            
                            <label for="email"><?php st_the_language( 'user_create_car_email' ) ?>:</label>
                            <i class="fa  fa-envelope-o input-icon input-icon-hightlight"></i>
                            <input id="email" name="email" type="text"
                                   placeholder="<?php st_the_language( 'user_create_car_email' ) ?>" class="form-control" value="<?php echo STInput::request('email') ?>">
                            <i class="placeholder"><?php _e("E-mail Car Agent, this address will received email when have new booking",ST_TEXTDOMAIN) ?></i>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('email'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6 clear">
                        <div class="form-group form-group-icon-left">

                            <label for="cars_website"><?php _e('Website',ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa  fa-envelope-o input-icon input-icon-hightlight"></i>
                            <input id="cars_website" name="cars_website" type="text"
                                   placeholder="<?php _e('Website',ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo STInput::request('cars_website') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('cars_website'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="phone"><?php st_the_language( 'user_create_car_phone' ) ?>:</label>
                            <i class="fa  fa-phone input-icon input-icon-hightlight"></i>
                            <input id="phone" name="phone" type="text" placeholder="<?php st_the_language( 'user_create_car_phone' ) ?>" class="form-control" value="<?php echo STInput::request('phone') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('phone'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">

                            <label for="cars_fax"><?php _e('Fax Number',ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa  fa-phone input-icon input-icon-hightlight"></i>
                            <input id="cars_fax" name="cars_fax" type="text" placeholder="<?php _e('Fax Number',ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo STInput::request('cars_fax') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('cars_fax'),'danger') ?></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="about"><?php st_the_language( 'user_create_car_about' ) ?>:</label>
                            <textarea name="about" rows="5" class="form-control"><?php echo stripslashes(STInput::request('about')) ?></textarea>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('about'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-price-setting">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="price"><?php st_the_language( 'user_create_car_price' ) ?>:</label>
                            <i class="fa fa-money input-icon input-icon-hightlight"></i>
                            <input id="price" name="price" type="text" placeholder="<?php st_the_language( 'user_create_car_price' ) ?>" class="form-control number" value="<?php echo STInput::request('price') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('price'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="is_custom_price"><?php _e("Custom Price",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $is_custom_price = STInput::request('is_custom_price');?>
                            <select class="form-control is_custom_price" name="is_custom_price" id="is_custom_price">
                                <option value="price_by_date" <?php if($is_custom_price == 'price_by_date') echo 'selected'; ?>><?php _e("Price by Date",ST_TEXTDOMAIN) ?></option>
                                <option value="price_by_number" <?php if($is_custom_price == 'price_by_number') echo 'selected'; ?>><?php _e("Price by number of day/hour",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="data_price_by_date">
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left">
                                <label for="st_price"><?php _e("Price by Date",ST_TEXTDOMAIN) ?>:</label>
                            </div>
                        </div>
                        <?php
                        $st_start_date = STInput::request('st_start_date');
                        $st_end_date = STInput::request('st_end_date');
                        $st_price = STInput::request('st_price');
                        ?>
                        <div class="content_data_price">
                            <?php if(!empty($st_start_date)){
                                foreach($st_start_date as $k=>$v){
                                    if(!empty($v) and !empty($st_end_date[ $k ]) and !empty($st_price[ $k ])) {
                                        ?>
                                        <div class="item">
                                            <div class="col-md-4">
                                                <div class="form-group form-group-icon-left">
                                                    
                                                    <label for="st_start_date"><?php _e( "Start Date" , ST_TEXTDOMAIN ) ?></label>
                                                    <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                    <input id="st_start_date" data-date-format="yyyy-mm-dd"
                                                           name="st_start_date[]" type="text"
                                                           placeholder="<?php _e( "Start Date" , ST_TEXTDOMAIN ) ?>"
                                                           class="form-control date-pick"
                                                           value="<?php echo esc_html( $v ) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-group-icon-left">
                                                    
                                                    <label for="st_end_date"><?php _e( "End Date" , ST_TEXTDOMAIN ) ?></label>
                                                    <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                    <input id="st_end_date" data-date-format="yyyy-mm-dd"
                                                           name="st_end_date[]" type="text"
                                                           placeholder="<?php _e( "End Date" , ST_TEXTDOMAIN ) ?>"
                                                           class="form-control date-pick"
                                                           value="<?php echo esc_html( $st_end_date[ $k ] ) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-group-icon-left">
                                                    
                                                    <label for="st_price"><?php _e( "Price" , ST_TEXTDOMAIN ) ?></label>
                                                    <i class="fa fa-money input-icon input-icon-hightlight"></i>
                                                    <input id="st_price" name="st_price[]" type="text"
                                                           placeholder="<?php _e( "Price" , ST_TEXTDOMAIN ) ?>"
                                                           class="form-control number" value="<?php echo esc_html( $st_price[ $k ] ) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <input name="st_priority[]" value="0" type="hidden" class="">
                                                <input name="st_price_type[]" value="default" type="hidden" class="">
                                                <input name="st_status[]" value="1" type="hidden" class="">

                                                <div class="btn btn-danger btn_del_price_custom" style="margin-top: 27px">
                                                    -
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            } ?>
                        </div>
                        <div class="col-md-12 div_btn_add_custom">
                            <div class="form-group form-group-icon-left">
                                <button id="btn_add_custom_price" class="btn btn-info" type="button"><?php _e("Add Price Custom",ST_TEXTDOMAIN) ?></button>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="data_price_by_number">
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left">
                                <label for="st_title"><?php _e("Price by Number",ST_TEXTDOMAIN) ?>:</label>
                            </div>
                        </div>
                        <?php
                        $st_number_start = STInput::request('st_number_start');
                        $st_number_end = STInput::request('st_number_end');
                        $st_price_by_number = STInput::request('st_price_by_number');
                        $st_title = STInput::request('st_title');
                        ?>
                        <div class="content_data_price_by_number">
                            <?php if(!empty($st_price_by_number)){
                                foreach($st_price_by_number as $k=>$v){
                                    if(!empty($v) and !empty($st_number_start[ $k ]) and !empty($st_number_end[ $k ])) {
                                        ?>
                                        <div class="item">
                                            <div class="col-md-3">
                                                <div class="form-group form-group-icon-left">
                                                    
                                                    <label for="st_title"><?php _e("Title",ST_TEXTDOMAIN) ?></label>
                                                    <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                    <input id="st_title"  name="st_title[]" type="text" placeholder="<?php _e("Title",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo esc_html($st_title[$k]) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-group-icon-left">
                                                    
                                                    <label for="st_start_date"><?php _e("Number Start",ST_TEXTDOMAIN) ?></label>
                                                    <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                    <input id="st_start_date"  name="st_number_start[]" type="text" placeholder="<?php _e("Number Start",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo esc_html($st_number_start[$k]) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-group-icon-left">
                                                    
                                                    <label for="st_end_date"><?php _e("Number End",ST_TEXTDOMAIN) ?></label>
                                                    <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                    <input id="st_end_date"  name="st_number_end[]" type="text" placeholder="<?php _e("Number End",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo esc_html($st_number_end[$k]) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group form-group-icon-left">
                                                    
                                                    <label for="st_price_by_number"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                                                    <i class="fa fa-money input-icon input-icon-hightlight"></i>
                                                    <input id="st_price_by_number" name="st_price_by_number[]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo esc_html($v) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="btn btn-danger btn_del_price_custom" style="margin-top: 27px"> - </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            } ?>
                        </div>
                        <div class="col-md-12 div_btn_add_custom">
                            <div class="form-group form-group-icon-left">
                                <button id="btn_add_custom_price_by_number" class="btn btn-info" type="button"><?php _e("Add Price Custom",ST_TEXTDOMAIN) ?></button>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="discount"><?php st_the_language( 'user_create_car_discount' ) ?>:</label>
                            <i class="fa fa-star  input-icon input-icon-hightlight"></i>
                            <input id="discount" name="discount" type="text"
                                   placeholder="<?php _e("Discount Rate (%)",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('discount') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('discount'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="is_sale_schedule"><?php _e("Sale Schedule",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $is_sale_schedule = STInput::request('is_sale_schedule');?>
                            <select class="form-control is_sale_schedule" name="is_sale_schedule">
                                <option value="off" <?php if($is_sale_schedule == 'off') echo 'selected'; ?>><?php _e("No",ST_TEXTDOMAIN) ?></option>
                                <option value="on" <?php if($is_sale_schedule == 'on') echo 'selected'; ?>><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="data_is_sale_schedule input-daterange">
                        <div class="col-md-6">
                            <div class="form-group form-group-icon-left" >
                                
                                <label for="sale_price_from"><?php _e("Sale Start Date",ST_TEXTDOMAIN) ?>:</label>
                                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                <input name="sale_price_from" class="date-pick form-control st_date_start" data-date-format="yyyy-mm-dd" type="text" value="<?php echo STInput::request('sale_price_from') ?>"/>
                                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('sale_price_from'),'danger') ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-icon-left" >
                                
                                <label for="sale_price_to"><?php _e("Sale End Date",ST_TEXTDOMAIN) ?>:</label>
                                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                <input name="sale_price_to" class="date-pick form-control st_date_end" data-date-format="yyyy-mm-dd" type="text" value="<?php echo STInput::request('sale_price_to') ?>"  />
                                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('sale_price_to'),'danger') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="number_car"><?php _e("Number of cars for Rent",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs  input-icon input-icon-hightlight"></i>
                            <input id="number_car" name="number_car" type="text" placeholder="<?php _e("Number of cars for Rent",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('number_car') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('number_car'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6 clear">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="deposit_payment_status"><?php _e("Deposit Payment Options",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $deposit_payment_status = STInput::request('deposit_payment_status') ?>
                            <select class="form-control deposit_payment_status" name="deposit_payment_status">
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
            </div>
            <div class="tab-pane fade" id="tab-car-options">
                <div class="row">
                    <div class='col-md-12'>
                        <div class="form-group">
                            <label for="cars_booking_period"><?php _e("Booking Period",ST_TEXTDOMAIN) ?>:</label>
                            <input id="cars_booking_period" name="cars_booking_period" type="text" min="0" placeholder="<?php _e("Booking Period (day)",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('cars_booking_period') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('cars_booking_period'),'danger') ?></div>
                        </div>
                    </div>
                    <?php $booking_unit = st()->get_option('cars_price_unit' ,'day') ; ?>
                    <?php if($booking_unit =='day') {?>
                    <div class='col-md-12'>
                        <div class="form-group">
                            <label for="cars_booking_min_day"><?php _e('Minimum days to book', ST_TEXTDOMAIN) ?>:</label>
                            <input id="cars_booking_min_day" name="cars_booking_min_day" type="text" min="0" placeholder="<?php _e('Minimum days to book', ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('cars_booking_min_day') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('cars_booking_min_day'),'danger') ?></div>
                        </div>
                    </div>
                    <?php }else{?>
                    <div class='col-md-12'>
                        <div class="form-group">
                            <label for="cars_booking_min_hour"><?php _e('Minimum hours to book', ST_TEXTDOMAIN) ?>:</label>
                            <input id="cars_booking_min_hour" name="cars_booking_min_hour" type="text" min="0" placeholder="<?php __('Minimum hours to book', ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('cars_booking_min_hour') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('cars_booking_min_hour'),'danger') ?></div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_car_external_booking"><?php _e("Car External Booking",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $st_car_external_booking = STInput::request('st_car_external_booking'); ?>
                            <select class="form-control st_car_external_booking" name="st_car_external_booking">
                                <option <?php if($st_car_external_booking == 'off') echo 'selected'; ?> value="off"><?php _e("No",ST_TEXTDOMAIN) ?></option>
                                <option <?php if($st_car_external_booking == 'on') echo 'selected'; ?> value="on"><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-6 data_st_car_external_booking'>
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_car_external_booking_link"><?php _e("Car External Booking URL",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-link  input-icon input-icon-hightlight"></i>
                            <input id="st_car_external_booking_link" name="st_car_external_booking_link" type="text" placeholder="<?php _e("Eg: https://domain.com") ?>" class="form-control" value="<?php echo STInput::request('st_car_external_booking_link') ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_car_external_booking_link'),'danger') ?></div>
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
                                    <select class="form-control" id="is_meta_payment_gateway_<?php echo esc_attr($k) ?>" name="is_meta_payment_gateway_<?php echo esc_attr($k) ?>">
                                        <option value="on"><?php _e( "Yes" , ST_TEXTDOMAIN ) ?></option>
                                        <option value="off"><?php _e( "No" , ST_TEXTDOMAIN ) ?></option>
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
                $custom_field = st()->get_option( 'st_cars_unlimited_custom_field' );
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
                                <div class="form-group form-group-icon-left">
                                    <label for="<?php echo esc_attr( $key ) ?>"><?php echo esc_html($v[ 'title' ]) ?>:</label>
                                    <?php if($v[ 'type_field' ] == "text") { ?>
                                        <input id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text"
                                               placeholder="<?php echo esc_html($v[ 'title' ]) ?>" class="form-control">
                                    <?php } ?>
                                    <?php if($v[ 'type_field' ] == "date-picker") { ?>
                                        <input for="<?php echo esc_attr( $key ) ?>" id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text"
                                               placeholder="<?php echo esc_html($v[ 'title' ]) ?>"
                                               class="date-pick form-control">
                                    <?php } ?>
                                    <?php if($v[ 'type_field' ] == "textarea") { ?>
                                        <textarea for="<?php echo esc_attr( $key ) ?>" id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" class="form-control" ><?php echo get_post_meta( $post_id , $key , true); ?></textarea>
                                    <?php } ?>

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
        <input name="btn_insert_post_type_cars" id="btn_insert_post_type_cars" type="submit" disabled class="btn btn-primary btn-lg" value="<?php _e("SUBMIT CAR",ST_TEXTDOMAIN) ?>">
    </div>
</form>
<div id="html_equipment_item" style="display: none">
    <div class="item">
        <div class="col-md-3">
            <div class="form-group ">
                <label for="equipment_item_title"><?php st_the_language( 'user_create_car_equipment_title' ) ?></label>
                <input id="title" name="equipment_item_title[]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group ">
                <label for="equipment_item_price"><?php st_the_language( 'user_create_car_equipment_price' ) ?></label>
                <input id="price" name="equipment_item_price[]" type="text" class="form-control number">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group ">
                <label for="equipment_item_price_unit"><?php _e("Price Unit",ST_TEXTDOMAIN) ?></label>
                <select class="form-control" id="equipment_item_price_unit" name="equipment_item_price_unit[]">
                    <option value=""><?php _e("Fixed Price",ST_TEXTDOMAIN) ?></option>
                    <option value="per_hour"><?php _e("Price per Hour",ST_TEXTDOMAIN) ?></option>
                    <option value="per_day"><?php _e("Price per Day",ST_TEXTDOMAIN) ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group ">
                <label for="price_max"><?php _e("Price Max",ST_TEXTDOMAIN) ?></label>
                <input id="price_max" name="equipment_item_price_max[]" type="text" class="form-control number">
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
<div id="html_features" style="display: none">
    <?php $list = STUser_f::get_list_value_taxonomy( 'st_cars' ); ?>
    <?php if(!empty( $list )) { ?>
        <div class="item">
            <div class="col-md-4">
                <div class="form-group form-group-icon-left">
                    
                    <label for="features_taxonomy"><?php st_the_language( 'user_create_car_features_attributes' ) ?></label>
                    <i class="fa fa-arrow-down input-icon input-icon-hightlight"></i>
                    <?php
                    if(!empty( $list )) {
                        ?>
                        <select name="features_taxonomy[]" class="form-control taxonomy_car">
                            <?php foreach( $list as $k => $v ) { ?>
                                <option data-icon="<?php //echo esc_attr( $v[ 'icon' ] ) ?>" value="<?php echo esc_attr( $v[ 'value' ] . ',' . $v[ 'label' ] ) ?>"><?php echo esc_attr( $v[ 'label' ] ) ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="title"><?php st_the_language( 'user_create_car_features_attributes_info' ) ?></label>
                    <input id="title" name="taxonomy_info[]" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group ">
                    <div class="btn btn-danger btn_del_program" style="margin-top: 27px">
                        X
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-md-12">
            <label for="<?php st_the_language( 'user_create_car_no_data' ) ?>"><?php st_the_language( 'user_create_car_no_data' ) ?></label>
        </div>
    <?php } ?>
</div>

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
                <input id="st_price" name="st_price[]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="number form-control number">
            </div>
        </div>
        <div class="col-md-1">
            <input name="st_priority[]" value="0" type="hidden" class="">
            <input name="st_price_type[]" value="default" type="hidden" class="">
            <input name="st_status[]" value="1" type="hidden" class="">
            <div class="btn btn-danger btn_del_price_custom" style="margin-top: 27px"> - </div>
        </div>
    </div>
</div>

<div class="data_price_by_number_html" style="display: none">
    <div class="item">
        <div class="col-md-3">
            <div class="form-group form-group-icon-left">
                
                <label for="st_title"><?php _e("Title",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <input id="st_title"  name="st_title[]" type="text" placeholder="<?php _e("Title",ST_TEXTDOMAIN) ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-group-icon-left">
                
                <label for="st_start_date"><?php _e("Number Start",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <input id="st_start_date"  name="st_number_start[]" type="text" placeholder="<?php _e("Number Start",ST_TEXTDOMAIN) ?>" class="form-control number">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-group-icon-left">
                
                <label for="st_end_date"><?php _e("Number End",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <input id="st_end_date"  name="st_number_end[]" type="text" placeholder="<?php _e("Number End",ST_TEXTDOMAIN) ?>" class="form-control number">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group form-group-icon-left">
                
                <label for="st_price_by_number"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                <input id="st_price_by_number" name="st_price_by_number[]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control number">
            </div>
        </div>
        <div class="col-md-1">
            <div class="btn btn-danger btn_del_price_custom" style="margin-top: 27px"> - </div>
        </div>
    </div>
</div>