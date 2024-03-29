jQuery(document).ready(function($) {
	$('#form-booking-admin input[name="item_id"]').change(function(event) {
		var item_id = $(this).val();
		get_rental_info(item_id);
	});
	
	if($('#form-booking-admin input[name="item_id"]').val() != "" && parseInt($('#form-booking-admin input[name="item_id"]').val()) > 0){
		var item_id = $('#form-booking-admin input[name="item_id"]').val();
		get_rental_info(item_id);
	}
	function get_rental_info(item_id){
		$('#form-booking-admin span.item_price, #form-booking-admin span.extra_price').addClass('is-active');
		$('#form-booking-admin input#item_price').val('');
		
		if(typeof item_id != 'undefined' && parseInt(item_id) > 0){
			data = {
				action: 'st_getRentalInfo',
				rental_id: item_id
			};
			$.post(ajaxurl, data, function(respon, textStatus, xhr) {
				$('#form-booking-admin span.item_price, #form-booking-admin span.extra_price').removeClass('is-active');
				$('#form-booking-admin span.item_price').removeClass('is-active');
				if(typeof respon == 'object'){
					$('#form-booking-admin input#item_price').val(respon.price);
					$('#extra-price-wrapper').html(respon.extras)
				}
			}, 'json');
		}else{
			$('#form-booking-admin span.item_price, #form-booking-admin span.extra_price').removeClass('is-active');
		}
	}
});