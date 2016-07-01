<script>
    jQuery(function ($) {
        var map_full_height =  parseInt($(window).height() ) ;
        if ($("#st_header_wrap").length){
            map_full_height -= $("#st_header_wrap").outerHeight(true);
        } 
        if ($("body>.global-wrap.container").length){
            map_full_height -= parseInt($("body>.global-wrap.container").css("margin-bottom").replace('px', ''));
        }
        if ($("#main-footer").length){
            map_full_height -= $("#main-footer").outerHeight();    
            $("#main-footer").addClass('mt0');        
        }
        if ($("#wpadminbar").length){
            map_full_height -= $("#wpadminbar").outerHeight(true);
        }

        <?php if (!empty($auto_height) and $auto_height =='fixed') {?>
            var map_height = <?php echo esc_html($height); ?>;
        <?php }else {?>
            var map_height = map_full_height;
        <?php } ?>          
        $(".div_half_map, .half_map_container .st_gmap , .st_list_half_map , .content_map ,#list_half_map").height(map_height);
    });
</script> 
<div class='row half_map_container'>
    <?php if($map_position == 'left'): ?>
        <div class="col-md-6 st_gmap">
            <div id="gmap_wrapper" class="st_list_half_map row" >
                <div class="content_map"  >
                    <div id="list_half_map" class="gmap3" data-fitbounds="<?php echo esc_html($fit_bounds)?>" style=" width: 100%"></div>
                </div>
                <div class="st-gmap-loading-bg"></div>
                <div id="st-gmap-loading"><?php _e( 'Loading Maps' , ST_TEXTDOMAIN ); ?>
                    <div class="spinner spinner_map ">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
                <div class="gmap-controls">
                    <div id="gmap-control">
                        <span class="map-view"><i class="fa fa-picture-o"></i><?php _e( "View" , ST_TEXTDOMAIN ) ?></span>
                        <div class="map_type">
                            <span class="map-type-1 st-map-type" data-name="style_normal"><?php _e("Normal",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-2 st-map-type" data-name="style_midnight"><?php _e("Midnight",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-3 st-map-type" data-name="style_family_fest"><?php _e("Family Fest",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-4 st-map-type" data-name="style_open_dark"><?php _e("Open dark",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-5 st-map-type" data-name="style_riverside"><?php _e("Riverside",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-6 st-map-type" data-name="style_ozan"><?php _e("Ozan",ST_TEXTDOMAIN) ?></span>
                        </div>
                        <span class="st_my_location_list_half_map" style="display: block;"><i class="fa fa-map-marker"></i><?php _e( "My Location" , ST_TEXTDOMAIN ) ?></span>
                        <span class="st-gmap-full-half" data-full='<i class="fa fa-arrows-alt"></i><?php _e( "Fullscreen" , ST_TEXTDOMAIN ) ?>' data-no-full='<i class="fa fa-square-o"></i><?php _e( "Default" , ST_TEXTDOMAIN ) ?>'>
                            <i class="fa fa-arrows-alt"></i><?php _e( "Fullscreen" , ST_TEXTDOMAIN ) ?>
                        </span>
                    </div>
                    <input type="text" id="google-default-search" name="google-default-search" placeholder="<?php _e( 'Google Maps Search' , 'wpestate' );?>" value="" class="advanced_select  form-control">
                    <div id="st_gmapzoomplus" class="gmapzoomplus"><i class="fa fa-plus"></i></div>
                    <div id="st_gmapzoomminus" class="gmapzoomminus"><i class="fa fa-minus"></i></div>
                </div>

            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-6 div_half_map">
        <?php if($show_search_box == 'yes'): ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo st()->load_template( 'vc-elements/st-list-half-map/filter/' . $st_type , '' , $data_tmp ); ?>
            </div>
        </div>
        <?php endif ?>
        <div class="row data_list_hafl_map">
            <div class='col-md-12'><h3 class='mb30 mt30'><?php printf(__("Advanced Search  <span class='count_advan_saerch'>(%s)</span>",ST_TEXTDOMAIN),count($data_map)) ?></h3></div>
            <div class="content col-md-12">
                <?php if(!empty( $data_map ) and is_array( $data_map )):
                    foreach( $data_map as $k => $v ) {
                        ?>
                        <div class="col-md-6 col-sm-6">
                            <?php echo balanceTags( str_ireplace('item_price_map','',$v[ 'content_adv_html' ]) ) ?>
                        </div>
                    <?php
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if($map_position == 'right'): ?>
        <div class="col-md-6 st_gmap" >
            <div id="gmap_wrapper" class="st_list_half_map row">
                <div class="content_map">
                    <div id="list_half_map" class="gmap3" data-fitbounds="<?php echo esc_html($fit_bounds)?>" style="  width: 100%"></div>
                </div>
                <div class="st-gmap-loading-bg"></div>
                <div id="st-gmap-loading"><?php _e( 'Loading Maps' , ST_TEXTDOMAIN ); ?>
                    <div class="spinner spinner_map ">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
                <div class="gmap-controls">
                    <div id="gmap-control">
                        <span class="map-view"><i class="fa fa-picture-o"></i><?php _e( "View" , ST_TEXTDOMAIN ) ?></span>
                        <div class="map_type">
                            <span class="map-type-1 st-map-type" data-name="style_normal"><?php _e("Normal",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-2 st-map-type" data-name="style_midnight"><?php _e("Midnight",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-3 st-map-type" data-name="style_family_fest"><?php _e("Family Fest",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-4 st-map-type" data-name="style_open_dark"><?php _e("Open dark",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-5 st-map-type" data-name="style_riverside"><?php _e("Riverside",ST_TEXTDOMAIN) ?></span>
                            <span class="map-type-6 st-map-type" data-name="style_ozan"><?php _e("Ozan",ST_TEXTDOMAIN) ?></span>
                        </div>
                        <span class="st_my_location_list_half_map" style="display: block;"><i class="fa fa-map-marker"></i><?php _e( "My Location" , ST_TEXTDOMAIN ) ?></span>
                        <span class="st-gmap-full-half" data-full='<i class="fa fa-arrows-alt"></i><?php _e( "Fullscreen" , ST_TEXTDOMAIN ) ?>' data-no-full='<i class="fa fa-square-o"></i><?php _e( "Default" , ST_TEXTDOMAIN ) ?>'>
                            <i class="fa fa-arrows-alt"></i><?php _e( "Fullscreen" , ST_TEXTDOMAIN ) ?>
                        </span>
                    </div>
                    <input type="text" id="google-default-search" name="google-default-search" placeholder="<?php _e( 'Google Maps Search' , ST_TEXTDOMAIN );?>" value="" class="advanced_select  form-control">
                    <div id="st_gmapzoomplus" class="gmapzoomplus"><i class="fa fa-plus"></i></div>
                    <div id="st_gmapzoomminus" class="gmapzoomminus"><i class="fa fa-minus"></i></div>
                </div>

            </div>
        </div>
    <?php endif; ?>
</div>
<?php
$data_map = json_encode( $data_map , JSON_FORCE_OBJECT );
$data_style_map = '[{featureType: "road.highway",elementType: "geometry",stylers: [{ hue: "#ff0022" },{ saturation: 60 },{ lightness: -20 }]}]';
switch( $style_map ) {
    case"normal":
        $data_style_map = '[{featureType: "road.highway",elementType: "geometry",stylers: [{ hue: "#ff0022" },{ saturation: 60 },{ lightness: -20 }]}]';
        break;
    case"midnight":
        $data_style_map = '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative.country","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":"0"}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"13"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":"-100"},{"lightness":"-20"},{"invert_lightness":true}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#bebebe"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"-47"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"lightness":"-33"},{"weight":"0.52"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#b5b5b5"},{"saturation":"-1"},{"gamma":"0.00"},{"weight":"2.22"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"lightness":"0"},{"visibility":"on"},{"weight":"2.8"},{"color":"#585858"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#909090"},{"lightness":"2"},{"weight":"0.2"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"lightness":"16"},{"color":"#595959"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"lightness":"-63"},{"weight":"1"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"lightness":"10"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"28"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"weight":"0.1"},{"lightness":"-96"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#12161a"},{"lightness":17}]}]';
        break;
    case"family_fest":
        $data_style_map = '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"saturation":"-6"}]},{"featureType":"poi","elementType":"geometry.stroke","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"on"},{"weight":"1.30"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#52978e"},{"visibility":"on"}]}]';
        break;
    case"open_dark":
        $data_style_map = '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#293c4d"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#293c4d"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#1f3035"},{"lightness":-37}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"transit","elementType":"labels.icon","stylers":[{"hue":"#00d1ff"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#193341"}]}]';
        break;
    case"riverside":
        $data_style_map = '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"on"},{"color":"#716464"},{"weight":"0.01"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"poi.attraction","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.government","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#787878"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"},{"color":"#a05519"},{"saturation":"-13"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#fcfcfc"},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#636363"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"weight":"4.27"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"on"},{"weight":"0.01"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#84afa3"},{"lightness":52}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#7ca0a4"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]}]';
        break;
    case"ozan":
        $data_style_map = '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"weight":1},{"color":"#003867"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"weight":8}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#E1001A"},{"weight":0.4}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#edeff1"},{"weight":0.2}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#edeff1"},{"weight":0.4}]}]';
        break;
}
?>
<script>
    jQuery(function ($) {

        var map_full_height =  parseInt($(window).height() ) ;
        if ($("#st_header_wrap").length){
            map_full_height -= $("#st_header_wrap").outerHeight(true);
        }
        if ($("#main-footer").length){
            map_full_height -= $("#main-footer").outerHeight();
            $("#main-footer").addClass('mt0');
        }
        if ($("#wpadminbar").length){
            map_full_height -= $("#wpadminbar").outerHeight(true);
        }

        <?php if (!empty($auto_height) and $auto_height =='fixed') {?>
        var map_height = <?php echo esc_html($height); ?>;
        <?php }else {?>
        var map_height = map_full_height;
        <?php } ?>

        //alert($(window).height());
        // get full height          
        var my_div_map = jQuery('#list_half_map');
        var data_show = <?php echo balanceTags($data_map) ?>;


        var style_map = <?php echo balanceTags($data_style_map)?>;
        var map_zoom =<?php echo esc_html($zoom) ?>;
        var location_center =<?php echo esc_html($location_center) ?>;

        var fit_bounds = '<?php echo esc_html($fit_bounds)?>';

        /////////////////////////////////////////////////
        // Hotel search map
        /////////////////////////////////////////////////
        var hotel_search_half_map = $('#hotel_search_half_map');
        $('#hotel_search_half_map .btn_search').click(function () {
            var $this = $(this);
            var options = {
                url: st_params.ajax_url,
                dataType: 'json',
                beforeSend: function () {
                    jQuery('#st-gmap-loading').show();
                    jQuery('.st-gmap-loading-bg').show();
                    $this.html(st_params.text_loading);
                    $('.data_list_hafl_map').css('opacity', '0.5');
                },
                success: function (data) {
                    console.log(data);
                    $('#list_half_map').gmap3({
                        action: 'destroy'
                    });
                    var container = $('#list_half_map').parent();
                    $('#list_half_map').remove();
                    container.append('<div id="list_half_map"></div>');
                    $('#list_half_map').height(map_height);
                    $('#list_half_map').attr('data-fitbounds',fit_bounds);

                    if(data.location_center == "[0,0]"){
                        $('#list_map').attr('data-fitbounds','on');
                    }

                    location_center = [data.map_lat_center, data.map_lng_center]
                    init_list_half_map($('#list_half_map'), data.data_map, location_center, data.zoom, style_map);
                    $('.data_list_hafl_map .content').html('');
                    var count = 0;
                    for (var key in data.data_map) {
                        var tmp_data = data.data_map[key];
                        console.log(tmp_data);
                        $('.data_list_hafl_map .content').append('<div class="col-md-6">' + tmp_data.content_adv_html + '</div>');
                        count++;
                    }
                    $('.count_advan_saerch').html("("+count+")");
                    if(count == 0){
                        $('.data_list_hafl_map .content').append('<div class="alert alert-warning"> <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span> </button> <p class="text-small">'+st_list_map_params.text_no_result+'</p> </div>');
                    }
                    $('.data_list_hafl_map').css('opacity', '1');
                    $this.html($this.data('title'));
                },
                complete: function() {
                    jQuery('#st-gmap-loading').fadeOut(700);
                    jQuery('.st-gmap-loading-bg').fadeOut(700);
                }
            };
            hotel_search_half_map.ajaxForm(options);

        });

        /////////////////////////////////////////////////
        // Change Style
        /////////////////////////////////////////////////
        $('.st_list_half_map .map-view').click(function () {
            if ($(this).hasClass('view')) {
                $(this).removeClass('view')
                $('.st_list_half_map').find('.st-map-type').hide();
            } else {
                $(this).addClass('view')
                $('.st_list_half_map').find('.st-map-type').show();
            }

        });
        $('.st_list_half_map .st-map-type').click(function () {
            var name = $(this).data('name');
            var style = '';
            if(name == 'style_normal'){
                style = [{featureType: "road.highway",elementType: "geometry",stylers: [{ hue: "#ff0022" },{ saturation: 60 },{ lightness: -20 }]}];
            }
            if(name == 'style_midnight'){
                style = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative.country","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":"0"}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"13"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":"-100"},{"lightness":"-20"},{"invert_lightness":true}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#bebebe"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"-47"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"lightness":"-33"},{"weight":"0.52"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#b5b5b5"},{"saturation":"-1"},{"gamma":"0.00"},{"weight":"2.22"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"lightness":"0"},{"visibility":"on"},{"weight":"2.8"},{"color":"#585858"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#909090"},{"lightness":"2"},{"weight":"0.2"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"lightness":"16"},{"color":"#595959"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"lightness":"-63"},{"weight":"1"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"lightness":"10"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"28"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"weight":"0.1"},{"lightness":"-96"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#12161a"},{"lightness":17}]}];
            }
            if(name == 'style_family_fest'){
                style = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"saturation":"-6"}]},{"featureType":"poi","elementType":"geometry.stroke","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"on"},{"weight":"1.30"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#52978e"},{"visibility":"on"}]}];
            }
            if(name == 'style_open_dark'){
                style = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#293c4d"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#293c4d"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#1f3035"},{"lightness":-37}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"transit","elementType":"labels.icon","stylers":[{"hue":"#00d1ff"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#193341"}]}];
            }
            if(name == 'style_riverside'){
                style = [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"on"},{"color":"#716464"},{"weight":"0.01"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"poi.attraction","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.government","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#787878"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"},{"color":"#a05519"},{"saturation":"-13"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#fcfcfc"},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#636363"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"weight":"4.27"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"on"},{"weight":"0.01"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#84afa3"},{"lightness":52}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#7ca0a4"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]}];
            }
            if(name == 'style_ozan'){
                style = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"weight":1},{"color":"#003867"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"weight":8}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#E1001A"},{"weight":0.4}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#edeff1"},{"weight":0.2}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#edeff1"},{"weight":0.4}]}];
            }
            init_list_half_map(my_div_map, '', location_center, map_zoom, style);
            $('.st_list_half_map .map-view').removeClass('view');
            $('.st-map-type').hide();
        });
        /////////////////////////////////////////////////
        // Init Map
        /////////////////////////////////////////////////
        init_list_half_map($('#list_half_map'), data_show, location_center, map_zoom, style_map);


        function init_list_half_map(div_map, data_map, map_center, data_zoom, style) {
            var map = div_map;
            var list = [];
            data_zoom = parseInt(data_zoom);
            var bounds = new google.maps.LatLngBounds();
            for (var key in data_map) {
                var tmp_data = data_map[key];
                var myLatLng= new google.maps.LatLng(tmp_data.lat, tmp_data.lng);
                bounds.extend(myLatLng);
                list.push({
                    latLng: [tmp_data.lat, tmp_data.lng],
                    options: {
                        icon: tmp_data.icon_mk
                    },
                    tag: "st_tag_" + tmp_data.id,
                    data: tmp_data
                });
            }
            console.log(map_center);
            map.gmap3({
                map: {
                    options: {
                        center: map_center,
                        zoom: data_zoom,
                        mapTypeId: google.maps.MapTypeId.TERRAIN,
                        styles: style,
                        disableDefaultUI: true,
                        zoomControl: false,
                        navigationControl: true,
                        scrollwheel: false,
                        streetViewControl: true,
                        scaleControl: true,
                        mapTypeControl: true,
                    },
                    events: {
                        zoom_changed: function (map) {
                            $(this).attr('data-zoom', map.getZoom());
                        },
                        tilesloaded:function(map){
                            jQuery('#st-gmap-loading').fadeOut(700);
                            jQuery('.st-gmap-loading-bg').fadeOut(700);
                        }
                    }
                },
                marker: {
                    values: list,
                    events: {
                        mouseover: function (marker, event, context) {
                          //  icon_tmp = (marker.icon);
                           // marker.setIcon(icon_hover);
                        },
                        mouseout: function (marker, event, context) {
                           //vs marker.setIcon(icon_tmp);
                        },
                        click: function (marker, event, context) {
                            var zoom = parseInt(map.attr('data-zoom'));
                            if (!zoom)zoom = data_zoom;
                            var map_g = $(this).gmap3("get");
                            map_g.panTo(marker.getPosition());
                            $(this).gmap3(
                                {clear: "overlay"},
                                {
                                    overlay: {
                                        pane: "floatPane",
                                        latLng: marker.getPosition(),
                                        options: {
                                            content: context.data.content_html,
                                            offset: {
                                                x: 20,
                                                y: -210
                                            }
                                        }
                                    }
                                });
                        }
                    }
                }
            });

            if(map.data('fitbounds') == 'on'){
                console.log('fitbounds --> ok')
                var gmap_object=map.gmap3('get');
                gmap_object.fitBounds(bounds);
            }
        }
    });
</script>