jQuery(document).ready(function($) {
    $('.nav-tabs').on('shown.bs.tab', function(){ 
        //console.log(current_location.location_map_zoom);
        var st_location_gmap3 = $("#list_map").gmap3({
            trigger: "resize",
            map: {
                options: {
                    center: [current_location.map_lat, current_location.map_lng],
                    zoom: parseInt(current_location.location_map_zoom)
                }
            }
        });
        var st_location_gmap3_new = $("#list_map_new").gmap3({
            trigger: "resize",
            map: {
                options: {
                    center: [current_location.map_lat, current_location.map_lng],
                    zoom: parseInt(current_location.location_map_zoom)
                }
            }
        });
    });

    


});