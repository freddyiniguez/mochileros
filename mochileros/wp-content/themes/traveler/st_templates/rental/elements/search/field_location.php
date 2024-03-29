<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field location
 *
 * Created by ShineTheme
 *
 */
$default=array(
    'title'=>'',
    'is_required'=>'on',
    'placeholder'=>''
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}
if($is_required == 'on'){
    $is_required = 'required';
}
if(!isset($field_size)) $field_size='lg';

$location_id=STInput::get('location_id', '');
$location_name = STInput::request('location_name', '');
if (!$location_id){
    $location_id = STInput::get('location_id_pick_up');
    $location_name = STInput::get('pick-up');
}
$locations = TravelHelper::getListFullNameLocation();

?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    
    <label for="field-rental-locationid"><?php echo esc_html( $title)?></label>
    <i class="fa fa-map-marker input-icon"></i>
    <div class="st-select-wrapper">
        <input autocomplete="off" type="text" name="location_name" value="<?php echo $location_name; ?>" class="form-control st-location-name <?php echo esc_attr($is_required); ?>" placeholder="<?php if($placeholder) echo $placeholder; ?>">
        <select id="field-rental-locationid" name="location_id" class="st-location-id st-hidden" placeholder="<?php if($placeholder) echo $placeholder; ?>" tabindex="-1">
            <option value=""></option>
            <?php 
                if(is_array($locations) && count($locations)):
                    foreach($locations as $key => $value):
            ?>
            <option <?php selected($value->ID, $location_id); ?> value="<?php echo $value->ID; ?>"><?php echo TravelHelper::showNameLocation($value->ID); ?></option>
            <?php endforeach; endif; ?>
        </select>
        <div class="option-wrapper"></div>
    </div>
</div>