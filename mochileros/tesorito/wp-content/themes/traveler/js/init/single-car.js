/**
 * Created by me664 on 3/2/15.
 */

jQuery(document).ready(function($){

    var message_box = $('.car_booking_form .message_box');
    var car_booking_form = $('.car_booking_form');
    
    $('.car_booking_form input[type=submit]').click(function(){
        if(validate_car_booking()){
            car_booking_form.submit();
        }else
        {
            return false;
        }

    });
    $('.car_booking_form .btn_booking_modal').click(function(){
        if(validate_car_booking()){
            var tar_get=$(this).data('target');

            $.magnificPopup.open({
                items: {
                    type: 'inline',
                    src: tar_get
                }

            });
        }
    });

    function validate_car_booking()
    {
        var form_validate=true;

        message_box.html('');
        message_box.removeClass('alert');

        try{
            if(typeof st_car_booking_validate!="undefined"){

                for(i = 0; i < st_car_booking_validate.required.length; i++){
                    var field_name=st_car_booking_validate.required[i];
                    console.log(car_booking_form.find('[name='+field_name+']').val());
                    if(!car_booking_form.find('[name='+field_name+']').val()){
                        form_validate = false;
                    }
                }
            }

            if(!form_validate){
                form_validate=false;
                $('.popup-text[href=#search-dialog]').trigger('click');
            }

        }catch(e){
            console.log(e);
        }

        return form_validate;
    }
	
});

jQuery(document).ready(function($) {
    booking_period = $('#search-dialog').data('booking-period');
    if(typeof booking_period != 'undefined' && parseInt(booking_period) > 0){
        var data = {
            booking_period : booking_period,
            action: 'st_getBookingPeriod'
        };
        $.post(st_params.ajax_url, data, function(respon) {
            if(respon != ''){
                $('input.car_pick-up-date, input.car_drop-off-date').datepicker('setRefresh',true);
                $('input.car_pick-up-date, input.car_drop-off-date').datepicker('setDatesDisabled',respon); 
            }
        },'json');

        $( document ).ajaxStop(function() {
            $('.overlay-form').fadeOut(500); 
        });
    }else{
        $('.overlay-form').fadeOut(500); 
    }
});