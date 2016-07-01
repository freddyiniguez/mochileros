<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.1.5
 *
 * Hotel search Map
 *
 * Created by ShineTheme
 *
 */
if(!class_exists( 'STActivity' ))
    return false;
$class  = new STActivity();
$fields = $class->get_search_fields();
if (empty($st_direction) )$st_direction = 'horizontal';
if(!isset( $field_size ))
    $field_size = 'md';
?>

<form id="hotel_search_half_map" method="get" class="search filter_search_map" action="<?php echo home_url() ?>">
    <h2><?php echo esc_html( $title ) ?></h2>
    <input type="hidden" name="post_type" value="st_activity">
    <input type="hidden" name="action" value="st_search_list_half_map">
    <input type="hidden" name="zoom" value="<?php echo esc_html( $zoom ) ?>">
    <input type="hidden" name="style_map" value="<?php echo esc_html( $style_map ) ?>">
    <input type="hidden" name="number" value="<?php echo esc_html( $number ) ?>">
    <input type="hidden" name="is_search_map" value="true">
    <input type="hidden" name="st_google_location" value="tesoritos" >
    <input type="hidden" name="st_locality" value="">
    <input type="hidden" name="st_country" value="">
    <div class="row">
        <?php echo balanceTags($form_search) ?>
    </div>
    <!--Search Advande-->
    <div class="search_advance">
        <div class="expand_search_box form-group-<?php echo esc_attr($field_size);?>">
            <span class="expand_search_box-more"> <i class="btn btn-primary fa fa-plus mr10"></i><?php echo __("Advance Search",ST_TEXTDOMAIN) ; ?></span>
            <span class="expand_search_box-less"> <i class="btn btn-primary fa fa-minus mr10"></i><?php echo __("Advance Search",ST_TEXTDOMAIN) ; ?></span>
        </div>
        <div class="view_more_content_box">
            <div class="<?php  if(!empty($st_direction) and $st_direction=='horizontal') echo 'row';?>">
                <div class=" col-md-3 col-lg-3  ">
                    <div data-date-format="dd/mm/yyyy" class="form-group input-daterange  form-group-lg form-group-icon-left">      <label for="field-hotel-checkin">Check In</label><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                            <input id="field-hotel-checkin" placeholder="dd/mm/yyyy" class="form-control checkin_hotel off" value="" name="start" type="text">
                    </div>
                </div>
                <div class=" col-md-3 col-lg-3  ">
                    <div data-date-format="dd/mm/yyyy" class="form-group input-daterange form-group-lg form-group-icon-left">
                        <label for="field-hotel-checkout">Check Out</label>
                        <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                        <input id="field-hotel-checkout" placeholder="dd/mm/yyyy" class="form-control off checkout_hotel" value="" name="end" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End search Advance-->

    <button class="btn btn-primary btn_search btn-lg" data-title="<?php st_the_language( 'search_for_activity' ) ?>"
            type="submit"><?php st_the_language( 'search_for_activity' ) ?></button>
</form>
