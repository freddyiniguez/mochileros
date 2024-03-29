<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 14/07/2015
 * Time: 3:17 CH
 */
$item_data=isset($item['item_meta'])?$item['item_meta']:array();
$format=TravelHelper::getDateFormat();
$data_price = unserialize(st_wc_parse_order_item_meta($item_data['_st_data_price']));
?>
<ul class="wc-order-item-meta-list">
    <?php if(isset($item_data['_st_check_in'])): $data=st_wc_parse_order_item_meta($item_data['_st_check_in']); ?>
        <li>
            <span class="meta-label"><?php _e('Date:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php
                echo @date_i18n($format.' '.get_option('atetime_format'),strtotime($data));
                ?>
                <?php if(isset($item_data['_st_check_out'])){ $data=st_wc_parse_order_item_meta($item_data['_st_check_out']); ?>
                    <i class="fa fa-long-arrow-right"></i>
                    <?php echo @date_i18n($format.' '.get_option('atetime_format'),strtotime($data));?>
                <?php }?>
            </span>
        </li>
    <?php endif;?>
    <?php if(isset($item_data['_st_price_old'])):?>
        <li>
            <span class="meta-label"><?php _e('Price:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php echo TravelHelper::format_money(st_wc_parse_order_item_meta($item_data['_st_price_old'])) ?></span>
        </li>
    <?php endif;?>

    <?php if(isset($item_data['_st_adult_number']) and  $adult=st_wc_parse_order_item_meta($item_data[ '_st_adult_number' ]) and $adult){?>
        <li>
            <span class="meta-label"><?php echo __( 'Adult number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($adult);?>
                <?php if(!empty($adult)){?>
                    x
                    <?php echo TravelHelper::format_money($data_price['adult_price']/$adult) ; ?>
                    <i class="fa fa-long-arrow-right"></i>
                    <?php echo TravelHelper::format_money($data_price['adult_price']) ?>
                <?php  } ?>
            </span>
        </li>
    <?php }?>
    <?php if(isset($item_data['_st_child_number']) and $child=st_wc_parse_order_item_meta($item_data[ '_st_child_number' ]) and $child){?>
        <li>
            <span class="meta-label"><?php echo __( 'Children number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($child)?>
                <?php if(!empty($child)){?>
                    x
                    <?php echo TravelHelper::format_money($data_price['child_price']/$child) ; ?>
                    <i class="fa fa-long-arrow-right"></i>
                    <?php echo TravelHelper::format_money($data_price['child_price']) ?>
                <?php }?>
            </span>
        </li>
    <?php  }?>
    <?php if(isset($item_data['_st_infant_number']) and $infant=st_wc_parse_order_item_meta($item_data[ '_st_infant_number' ]) and $infant){?>
        <li>
            <span class="meta-label"><?php echo __( 'Infant number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($infant)?>
                <?php if(!empty($infant)){?>
                    x
                    <?php echo TravelHelper::format_money($data_price['infant']/$infant) ; ?>
                    <i class="fa fa-long-arrow-right"></i>
                    <?php echo TravelHelper::format_money($data_price['infant_price']) ?>
                <?php }?>
            </span>
        </li>
    <?php  }?>
    <?php  if(isset($item_data['_st_discount_rate'])): $data=st_wc_parse_order_item_meta($item_data['_st_discount_rate']);?>
        <?php  if (!empty($data)) {?><li><p>
            <?php echo __("Discount"  ,ST_TEXTDOMAIN) .": "; ?>
            <?php echo esc_attr($data) ."%";?>
        <?php } ;?></p></li>
    <?php endif; ?>
    <?php  if(isset($item_data['_line_tax'])): $data=st_wc_parse_order_item_meta($item_data['_line_tax']);?>
            <?php  if (!empty($data)) {?><li><p>
            <?php echo __("Tax"  ,ST_TEXTDOMAIN) .": "; ?>
            <?php echo TravelHelper::format_money($data) ;?>
        <?php } ;?></p></li>
    <?php endif; ?>
    
</ul>