<div id="gmap_wrapper" class="st_list_map_new">
    <div class="content_map" style="height: <?php echo esc_html( $height ) ?>px">
        <div id="list_map_new" data-circle-color="#008BB2" data-check-zoom="true" class="gmap3" style="height: <?php echo esc_html( $height ) ?>px; width: 100%"></div>
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
            <span class="map-view"><i class="fa fa-picture-o"></i><?php _e("View",ST_TEXTDOMAIN) ?></span>
            <div class="map_type">
                <span class="map-type-1 st-map-type" data-name="style_normal"><?php _e("Normal",ST_TEXTDOMAIN) ?></span>
                <span class="map-type-2 st-map-type" data-name="style_midnight"><?php _e("Midnight",ST_TEXTDOMAIN) ?></span>
                <span class="map-type-3 st-map-type" data-name="style_family_fest"><?php _e("Family Fest",ST_TEXTDOMAIN) ?></span>
                <span class="map-type-4 st-map-type" data-name="style_open_dark"><?php _e("Open dark",ST_TEXTDOMAIN) ?></span>
                <span class="map-type-5 st-map-type" data-name="style_riverside"><?php _e("Riverside",ST_TEXTDOMAIN) ?></span>
                <span class="map-type-6 st-map-type" data-name="style_ozan"><?php _e("Ozan",ST_TEXTDOMAIN) ?></span>
            </div>
            <span class="st_my_location_list_map_new" style="display: block;"><i class="fa fa-map-marker"></i><?php _e("My Location",ST_TEXTDOMAIN) ?></span>
            <span class="st-gmap-full-new" data-full='<i class="fa fa-arrows-alt"></i><?php _e("Fullscreen",ST_TEXTDOMAIN) ?>'
                  data-no-full='<i class="fa fa-square-o"></i><?php _e("Default",ST_TEXTDOMAIN) ?>'>
                <i class="fa fa-arrows-alt"></i><?php _e("Fullscreen",ST_TEXTDOMAIN) ?>
            </span>
        </div>
        <input type="text" id="google-default-search" name="google-default-search" placeholder="<?php _e( 'Google Maps Search' , ST_TEXTDOMAIN );?>" value="" class="advanced_select  form-control">
        <div id="st_gmapzoomplus" class="gmapzoomplus"><i class="fa fa-plus"></i></div>
        <div id="st_gmapzoomminus" class="gmapzoomminus"><i class="fa fa-minus"></i></div>
    </div>
</div>
<?php
$data_map       = json_encode( $data_map , JSON_FORCE_OBJECT );
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
<script type="text/javascript">
    var my_div_map = jQuery('#list_map_new');
    var data_show = <?php echo balanceTags($data_map) ?>;
    var map_height =<?php echo esc_html($height) ?>;
    var style_map = <?php echo balanceTags($data_style_map)?>;

    jQuery(function ($) {
        /////////////////////////////////////////////////
        // Change Style
        /////////////////////////////////////////////////
        $('.st_list_map_new .map-view').click(function () {
            if($(this).hasClass('view')){
                $(this).removeClass('view')
                $('.st_list_map_new').find('.st-map-type').hide();
            }else{
                $(this).addClass('view')
                $('.st_list_map_new').find('.st-map-type').show();
            }

        });
        $('.st_list_map_new .st-map-type').click(function () {
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
            my_div_map.attr('data-circle-color','transparent');
            var map_g = my_div_map.gmap3("get");
            var map_center = map_g.getCenter();
            var map_zoom = map_g.getZoom();
            init_list_map(my_div_map, '', map_center, map_zoom, style);
            map_g.panTo(map_center);
            map_g.setZoom(map_zoom);
            $('.st_list_map_new .map-view').removeClass('view');
            $('.st-map-type').hide();
        });

        /////////////////////////////////////////////////
        // Init Map
        /////////////////////////////////////////////////
        init_list_map(my_div_map, data_show, <?php echo esc_html($location_center) ?>, <?php echo esc_html($zoom) ?>, <?php echo balanceTags($data_style_map) ?>);
        function init_list_map(div_map, data_map, map_center, data_zoom, style_map) {
            var map = div_map;
            var list = [];
            var bounds = new google.maps.LatLngBounds();
            for (var key in data_map) {
                var tmp_data = data_map[key];
                var myLatLng= new google.maps.LatLng(tmp_data.lat, tmp_data.lng);
                bounds.extend(myLatLng);
                list.push({
                    latLng: [tmp_data.lat, tmp_data.lng],
                    options: {
                        icon: tmp_data.icon_mk,
                        animation: google.maps.Animation.DROP
                    },
                    tag: "st_tag_" + tmp_data.id,
                    data: tmp_data
                });
            }

            data_zoom = parseInt(data_zoom);
            map.gmap3({
                map: {
                    options: {
                        center: map_center,
                        zoom: data_zoom,
                        //mapTypeId: google.maps.MapTypeId.SATELLITE,
                        mapTypeId: google.maps.MapTypeId.TERRAIN,
                        styles: style_map,
                        navigationControl: true,
                        scrollwheel: false,
                        streetViewControl: true,
                        scaleControl: true,
                        mapTypeControl: true,
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.DEFAULT,
                            mapTypeIds: [
                                google.maps.MapTypeId.ROADMAP,
                                google.maps.MapTypeId.TERRAIN
                            ]
                        },
                        disableDefaultUI: true,
                        zoomControl: false,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.SMALL
                        }
                    },
                    events: {
                        zoom_changed: function (map) {
                            $(this).attr('data-zoom', map.getZoom());
                        },
                        tilesloaded:function(map){
                            var is_check_room = $(this).attr('data-check-zoom');
                            var tmp_zoom = map.getZoom();
                            if(tmp_zoom > data_zoom && is_check_room == 'true'){
                                map.setZoom(data_zoom);
                            }
                            $(this).attr('data-check-zoom', 'false');
                            jQuery('#st-gmap-loading').fadeOut(700);
                            jQuery('.st-gmap-loading-bg').fadeOut(700);
                        }
                    }
                },
                circle:{
                    options: {
                        center: <?php echo esc_html($location_center) ?>,
                        radius : <?php echo esc_attr($range*1000) ?>,
                        fillColor :  map.attr('data-circle-color'),
                        strokeColor : "transparent"
                    }
                },
                marker: {
                    values: list,
                    cluster: {
                        radius: 50, 0: {content: '<div class="cluster cluster-1">CLUSTER_COUNT</div>', width: 53, height: 52},
                        // This style will be used for clusters with more than 20 markers
                        20: {content: '<div class="cluster cluster-2">CLUSTER_COUNT</div>', width: 56, height: 55},
                        // This style will be used for clusters with more than 50 markers
                        50: {content: '<div class="cluster cluster-3">CLUSTER_COUNT</div>', width: 66, height: 65},
                        events: {click:function(cluster, event, data) {cluster.main.map.panTo(data.data.latLng);cluster.main.map.setZoom(cluster.main.map.getZoom()+2);}}
                    },
                    events: {
                        mouseover: function (marker, event, context) {
                            icon_tmp = (marker.icon);
                           // marker.setIcon( icon_hover );
                        },
                        mouseout: function (marker, event, context) {
                          //  marker.setIcon(icon_tmp);
                        },
                        click: function (marker, event, context) {
                            var zoom = parseInt(map.attr('data-zoom'));
                            if (!zoom)zoom = data_zoom;
                            var map_g = $(this).gmap3("get");
                            map_g.panTo(marker.getPosition());
                            $(this).gmap3({clear: "overlay"}, {overlay: {pane: "floatPane", latLng: marker.getPosition(), options: {content: context.data.content_html, offset: {x: 20, y: -210}}}});
                        }

                    }
                }
            });

           // var gmap_object=map.gmap3('get');
           // gmap_object.fitBounds(bounds);

        }
    });
</script>