<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars success payment item row
 *
 * Created by ShineTheme
 *
 */
$order_token_code=STInput::get('order_token_code');
$order_code = STInput::get('order_code');
if($order_token_code)
{
    $order_code=STOrder::get_order_id_by_token($order_token_code);

}
$object_id = $key;
$total = 0;
$check_in =get_post_meta($order_code,'check_in',true);
$check_in_timestamp=get_post_meta($order_code,'check_in_timestamp',true);
$check_out=get_post_meta($order_code,'check_out',true);
$check_out_timestamp=get_post_meta($order_code,'check_out_timestamp',true);
$price = get_post_meta($order_code,'item_price',true);
$price_total = get_post_meta($order_code,'total_price',true);
$item_id = get_post_meta($order_code,'item_id',true);
$selected_equipments = get_post_meta($order_code,'data_equipment',true);
$data_prices = get_post_meta($order_code, 'data_prices', true);
$format=TravelHelper::getDateFormat();


$currency = get_post_meta($order_code, 'currency', true);
$rate = floatval(get_post_meta($order_code,'currency_rate', true));
?>
<tr>
    <td><?php echo esc_html($i) ?></td>
    <td  width="35%">
        <a href="<?php echo esc_url(get_the_permalink($object_id))?>" target="_blank">
        <?php echo get_the_post_thumbnail($key,array(360,270,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto'))?>
        </a>
    </td>
    <td>
        <p><strong><?php st_the_language('booking_address') ?></strong> <?php echo get_post_meta($object_id,'cars_address',true)?> </p>
        <p><strong><?php st_the_language('booking_email') ?></strong> <?php echo get_post_meta($object_id,'cars_email',true)?> </p>
        <p><strong><?php st_the_language('booking_phone') ?></strong> <?php echo get_post_meta($object_id,'cars_phone',true)?> </p>
        <p><strong><?php st_the_language('booking_car') ?></strong> <?php  echo get_the_title($object_id)?></p>
        <p><strong><?php st_the_language('booking_price') ?></strong> <?php
            echo TravelHelper::format_money_from_db($price,$currency,$rate);
            ?> / <?php echo STCars::get_price_unit_by_unit_id($data_prices['unit']); ?></p>
        <?php if($pickup=get_post_meta($order_code,'pick_up',true)): ?>
        <p><strong><?php _e("Pick-up: ", ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($pickup) ?></p>
        <?php endif;?>
        <?php if($dropoff=get_post_meta($order_code,'drop_off',true)): ?>
        <p><strong><?php _e("Drop-off: ", ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($dropoff)?></p>
        <?php endif;?>

        <p><strong><?php _e("Pick-up Time: ", ST_TEXTDOMAIN) ?></strong> <?php echo @date_i18n($format.' '.get_option('time_format'),$check_in_timestamp) ?></p>
        <p><strong><?php _e("Drop-off Time: ", ST_TEXTDOMAIN) ?></strong> <?php echo @date_i18n($format.' '.get_option('time_format'),$check_out_timestamp) ?></p>
        <?php if($name = get_post_meta($order_code,'driver_name',true)): ?>
            <p><strong><?php _e("Driver’s Name: ", ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($name)?></p>
        <?php endif ?>
        <?php if($name = get_post_meta($order_code,'driver_age',true)): ?>
            <p><strong><?php _e("Driver’s Age: ", ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($name) ?></p>
        <?php endif ?>

        <?php if(!empty($selected_equipments)){
            ?>
            <p><strong><?php _e("Equipments: ", ST_TEXTDOMAIN) ?></strong>
                <ul>
                <?php foreach($selected_equipments as $equipment){
                    $price_unit='';
                    if(isset($equipment->price_unit) and $equipment->price_unit){
                        $price_unit=' ('.TravelHelper::format_money($equipment->price).'/'.st_car_price_unit_title($equipment->price_unit).')';
                    }
                   // echo "<li>".$equipment->title.$price_unit." ->xx ".TravelHelper::format_money(STCars::get_equipment_line_item($equipment->price,$equipment->price_unit,$check_in_timestamp,$check_out_timestamp))."</li>";
                    echo "<li>".$equipment->title.$price_unit."</li>";

            } ?>
                </ul>
            </p>

        <?php
        } ?>
    </td>
</tr>
