jQuery(function ($) {
    /////////////////////////////////////////////////
    // Full Map
    /////////////////////////////////////////////////
    $('.st-gmap-full').click(function () {
        var is_full = $('.st_list_map').hasClass('full');
        if (is_full) {
            $('.st_list_map').find('#list_map').removeClass('fullmap');
            $('.st').each(function () {
                //$(this).css('z-index', '0');
            });
            $('#main-footer').show();
            $(this).html($(this).data('full'));
            $(this).removeClass('spanselected');
            $('.st_list_map').removeClass('full');
            $('.st_gmap').css('z-index','0');
            $('.st_list_map').find('.search_list_map').removeClass('full_div');
            $('.search_list_map').show();

        } else {
            $('.st_list_map').find('#list_map').addClass('fullmap');
            $('.st').each(function () {
               // $(this).css('z-index', '999');
            });
            $('#main-footer').hide();
            $(this).html($(this).data('no-full'));
            $(this).addClass('spanselected');
            $('.st_list_map').addClass('full');

            $('.st_list_map').find('.search_list_map').addClass('full_div');
            $('.st_gmap').css('z-index','1040');
            $('.search_list_map').hide();
        }
        $('.st_list_map').find('#list_map').gmap3({trigger: "resize"});
    });
    $('.st-gmap-full-new').click(function () {
        var is_full = $('.st_list_map_new').hasClass('full');
        if (is_full) {
            $('.st_list_map_new').find('#list_map_new').removeClass('fullmap');
            $('#main-footer').show();
            $(this).html($(this).data('full'));
            $(this).removeClass('spanselected');
            $('.st_list_map_new').removeClass('full');
            $('.st_gmap').css('z-index','0');

        } else {
            $('.st_list_map_new').find('#list_map_new').addClass('fullmap');
            $('#main-footer').hide();
            $(this).html($(this).data('no-full'));
            $(this).addClass('spanselected');
            $('.st_list_map_new').addClass('full');
            $('.st_gmap').css('z-index','1040');
        }
        $('.st_list_map_new').find('#list_map_new').gmap3({trigger: "resize"});
    });

    $('.st-gmap-full-half').click(function () {
        var is_full = $('.st_list_half_map').hasClass('full');
        if (is_full) {
            $('.st_list_half_map').find('#list_half_map').removeClass('fullmap');
            $('.st').each(function () {
                //$(this).css('z-index', '0');
            });
            $('#main-footer').show();
            $(this).html($(this).data('full'));
            $(this).removeClass('spanselected');
            $('.st_list_half_map').removeClass('full');
            $('.st_gmap').css('z-index','0');

        } else {
            $('.st_list_half_map').find('#list_half_map').addClass('fullmap');
            $('.st').each(function () {
              //  $(this).css('z-index', '999');
            });
            $('#main-footer').hide();
            $(this).html($(this).data('no-full'));
            $(this).addClass('spanselected');
            $('.st_list_half_map').addClass('full');
            $('.st_gmap').css('z-index','1040')
        }
        $('.st_list_half_map').find('#list_half_map').gmap3({trigger: "resize"});
    });

    /////////////////////////////////////////////////
    // Hover Item Half Map
    /////////////////////////////////////////////////

    $(document).on({
        mouseenter: function () {
            var $tag = $(this).data('tag');
            if ($tag) {
                var markers = $("#list_half_map").gmap3({get: {name: "marker", tag: $tag, all: true}});
                $.each(markers, function (i, marker) {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                });
            }
        },
        mouseleave: function () {
            var $tag = $(this).data('tag');
            if ($tag) {
                var markers = $("#list_half_map").gmap3({get: {name: "marker", tag: $tag, all: true}});
                $.each(markers, function (i, marker) {
                    marker.setAnimation(null);
                });
            }
        }
    }, ".reset_map .item_map"); //pass the element as an argument to .on

    /////////////////////////////////////////////////
    // Scroll
    /////////////////////////////////////////////////
    if(typeof niceScroll=='function')
    {
        $('.reset_map').niceScroll({
            cursorcolor: "#000",
            cursorborder: "0px solid #fff",
            railpadding: {
                top: 0,
                right: 0,
                left: 0,
                bottom: 0
            },
            cursorwidth: "10px",
            cursorborderradius: "0px",
            cursoropacitymin: 0,
            cursoropacitymax: 0.7,
            boxzoom: true,
            horizrailenabled: false,
            zindex: 9999
        });
    }

    /////////////////////////////////////////////////
    // My location
    /////////////////////////////////////////////////
    $('.st_my_location_list_map').click(function () {
        if (!!navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                $('#list_map').gmap3(
                    {
                        map: {
                            options: {
                                center: geolocate,
                                zoom: 16,
                                mapTypeId: google.maps.MapTypeId.TERRAIN
                            }
                        },
                        marker: {
                            values: [{
                                latLng: [geolocate.lat(), geolocate.lng()],
                                options: {
                                    icon: st_list_map_params.mk_my_location,
                                    animation: google.maps.Animation.DROP
                                },
                                tag: "st_tag_my_location",
                                data: ''
                            }]
                        }
                    },
                    {
                        overlay: {
                            pane: "floatPane",
                            latLng: geolocate,
                            options: {
                                content: '<div class="my_location">'+st_list_map_params.text_my_location+'</div>',
                                offset: {
                                    x: -35,
                                    y: 10
                                }
                            }
                        }
                    });
            });
        }
    });
    /////////////////////////////////////////////////
    // My location
    /////////////////////////////////////////////////
    $('.st_my_location_list_map_new').click(function () {
        if (!!navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                console.log(st_list_map_params.mk_my_location);
                var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                console.log(geolocate);
                $('#list_map_new').gmap3(
                    {
                        map: {
                            options: {
                                center: geolocate,
                                zoom: 16,
                                mapTypeId: google.maps.MapTypeId.TERRAIN
                            }
                        },
                        marker: {
                            values: [{
                                latLng: [geolocate.lat(), geolocate.lng()],
                                options: {
                                    icon: st_list_map_params.mk_my_location,
                                    animation: google.maps.Animation.DROP
                                },
                                tag: "st_tag_my_location",
                                data: ''
                            }]
                        }
                    },
                    {
                        overlay: {
                            pane: "floatPane",
                            latLng: geolocate,
                            options: {
                                content: '<div class="my_location">'+st_list_map_params.text_my_location+'</div>',
                                offset: {
                                    x: -35,
                                    y: 10
                                }
                            }
                        }
                    });
            });
        }
    });
    /////////////////////////////////////////////////
    // My location Half Map
    /////////////////////////////////////////////////
    $('.st_my_location_list_half_map').click(function () {
        console.log(st_list_map_params.mk_my_location);
        if (!!navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                $('#list_half_map').gmap3(
                    {
                        map: {
                            options: {
                                center: geolocate,
                                zoom: 16,
                                mapTypeId: google.maps.MapTypeId.TERRAIN
                            }
                        },
                        marker: {
                            values: [{
                                latLng: [geolocate.lat(), geolocate.lng()],
                                options: {
                                    icon: st_list_map_params.mk_my_location,
                                    animation: google.maps.Animation.DROP
                                },
                                tag: "st_tag_my_location",
                                data: ''
                            }]
                        }
                    },
                    {
                        overlay: {
                            pane: "floatPane",
                            latLng: geolocate,
                            options: {
                                content: '<div class="my_location">'+st_list_map_params.text_my_location+'</div>',
                                offset: {
                                    x: -35,
                                    y: 10
                                }
                            }
                        }
                    });
            });
        }
    });

    /////////////////////////////////////////////////////////////////////////////////////////////////
    /// zoom
    /////////////////////////////////////////////////////////////////////////////////////////////////


    if( document.getElementById('st_gmapzoomplus') ){
        google.maps.event.addDomListener(document.getElementById('st_gmapzoomplus'), 'click', function () {
            if( document.getElementById('list_map') ){
                var map_g = $('#list_map').gmap3("get");
            }
            if( document.getElementById('list_half_map') ){
                var map_g = $('#list_half_map').gmap3("get");
            }
            if( document.getElementById('list_map_new') ){
                var map_g = $('#list_map_new').gmap3("get");
            }
            var current= parseInt( map_g.getZoom(),10);
            current++;
            if(current>20){
                current=20;
            }
            map_g.setZoom(current);
        });
    }


    if(  document.getElementById('st_gmapzoomminus') ){
        google.maps.event.addDomListener(document.getElementById('st_gmapzoomminus'), 'click', function () {
            if( document.getElementById('list_map') ){
                var map_g = $('#list_map').gmap3("get");
            }
            if( document.getElementById('list_half_map') ){
                var map_g = $('#list_half_map').gmap3("get");
            }
            if( document.getElementById('list_map_new') ){
                var map_g = $('#list_map_new').gmap3("get");
            }
            var current= parseInt( map_g.getZoom(),10);
            current--;
            if(current<0){
                current=0;
            }
            map_g.setZoom(current);
        });
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////
    //  map set search
    /////////////////////////////////////////////////////////////////////////////////////////////////
    if(  document.getElementById('list_map') ||  document.getElementById('list_half_map')){
        var gmarkers = [];
        var list_map = $('#list_map').gmap3("get");
        var list_half_map = $('#list_half_map').gmap3("get");



        function set_google_search(map){
            var input,searchBox,places;

            input = (document.getElementById('google-default-search'));
            //   map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
            searchBox = new google.maps.places.SearchBox(input);


            google.maps.event.addListener(searchBox, 'places_changed', function() {
                places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                var bounds = new google.maps.LatLngBounds();
                for (var i = 0, place; place = places[i]; i++) {
                    var image = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    var marker = new google.maps.Marker({
                        map: map,
                        icon: image,
                        title: place.name,
                        position: place.geometry.location
                    });

                    gmarkers.push(marker);

                    bounds.extend(place.geometry.location);

                }

                map.fitBounds(bounds);
                map.setZoom(15);
            });
        }
        set_google_search(list_map);
        set_google_search(list_half_map);
    }


    if( document.getElementById('list_half_map') ){
        var div_half_map = $('#list_half_map');
        var $width_half_map = div_half_map.width();
        if($width_half_map < 1200){
            div_half_map.parent().parent().find('.gmap-controls').css({'left':'auto','right':'0px'})
        }
        if($width_half_map < 768){
            div_half_map.parent().parent().find('#google-default-search').css({'left':'auto','right':'45px','top':'65px','width':'284px'})
        }
        $( window ).resize(function() {
            $width_half_map = div_half_map.width();
            if($width_half_map < 1200){
                div_half_map.parent().parent().find('.gmap-controls').css({'left':'auto','right':'0px'})
            }
            if($width_half_map < 768){
                div_half_map.parent().parent().find('#google-default-search').css({'left':'auto','right':'45px','top':'65px','width':'284px'})
            }
        });
    }
    if( document.getElementsByClassName('div_fleid_search_map') ){
        var h = $('.div_fleid_search_map').height();
        $('.div_btn_search_map').find('.btn_search_2').height(h);
        $(function(){
            var h = $('.div_fleid_search_map').height();
            $('.div_btn_search_map').find('.btn_search_2').height(h);
        });
        setTimeout(function(){
            var h = $('.div_fleid_search_map').height();
            $('.div_btn_search_map').find('.btn_search_2').height(h);
        },1000);
        $( window ).resize(function() {
            var h = $('.div_fleid_search_map').height();
            $('.div_btn_search_map').find('.btn_search_2').height(h);
        });
        $('#required_dropoff , .expand_search_box').on('ifClicked', function (event) {
            setTimeout(function(){
                var h = $('.div_fleid_search_map').height();
                $('.div_btn_search_map').find('.btn_search_2').height(h);
            },200);
        });
    }

    $('.btn_search_2').click(function(){
      $(this).parent().parent().find('.btn_search').click();
    });

});


