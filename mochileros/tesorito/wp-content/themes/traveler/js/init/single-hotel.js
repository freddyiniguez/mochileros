jQuery(document).ready(function($) {
	booking_period = $('.booking-item-dates-change').data('booking-period');
	if(typeof booking_period != 'undefined' && parseInt(booking_period) > 0){
		var data = {
            booking_period : booking_period,
            action: 'st_getBookingPeriod'
        };
        $.post(st_params.ajax_url, data, function(respon) {
            if(respon != ''){
                $('input.checkin_hotel, input.checkout_hotel').datepicker('setRefresh',true);
                $('input.checkin_hotel, input.checkout_hotel').datepicker('setDatesDisabled',respon); 
            }    
        },'json');


        $( document ).ajaxStop(function() {
            $('.overlay-form').fadeOut(500); 
        });
	}else{
        $('.overlay-form').fadeOut(500);
    }

    $('ul.paged_room a.paged_room').each(function(){
        $(this).attr('data-page',$(this).html());
    });

    $(document).on('click','.paged_item_room',function(){
        var paged = $(this).data('page');
        $('.booking-item-dates-change .paged_room').val(paged);
        $('.btn-do-search-room').click();
    });

    if($('#field-hotel-start, #field-hotel-end').length){
        var check_in = $('#field-hotel-start');
        var check_out = $('#field-hotel-end');
        $('#field-hotel-start, #field-hotel-end').datepicker({
            language:st_params.locale,
            autoclose: true,
            todayHighlight: true,
            startDate: 'today',
            format: $('[data-date-format]').data('date-format'),
            weekStart: 1,
        });
        check_in.on('changeDate', function (e) {
                var new_date = e.date;
                new_date.setDate(new_date.getDate() + 1);
                check_out.datepicker('setDates', new_date);
                check_out.datepicker('setStartDate', new_date);
                check_out.datepicker('show');
            }
        );
    }

    if($('.st-slider-list-room').length){
        $('.st-slider-list-room').owlCarousel({
            items: 3,
            itemsDesktop: [1200, 3],
            itemsDesktopSmall: [992, 3],
            itemsTablet: [768, 2],
            itemsMobile: [320, 1],
            slideSpeed: 1000,
            paginationSpeed: 1000,
            pagination: false,
        });
        var slider = $(".st-slider-list-room").data('owlCarousel');
        $('.st-slider-list-room-wrapper .control-left').click(function(event) {
            /* Act on the event */
            slider.prev();
            return false;
        });
        $('.st-slider-list-room-wrapper .control-right').click(function(event) {
            /* Act on the event */
            slider.next();
            return false;
        });
    }

});