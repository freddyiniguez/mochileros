jQuery(document).ready(function($) {
	if($('#form-booking-admin input#item_id').val()){
		hotel_id = $('#form-booking-admin input#item_id').val();
		room_id = $('#room-id-wrapper').data('room-id');
		if(typeof room_id == "undefined"){
			room_id = "";
		}
		get_list_room(hotel_id,room_id);
	}
	$('#form-booking-admin').on('change', 'input#item_id', function(event) {
		event.preventDefault();
		hotel_id = $(this).val();
		room_id = $('#room-id-wrapper').data('room-id');
		if(typeof room_id == "undefined"){
			room_id = "";
		}
		get_list_room(hotel_id,room_id);
	});
	$('#form-booking-admin').on('change','select[name="room_id"]',function(event) {
		var room_id = $(this).val();
		get_room_info(room_id);
	});

	function get_room_info(room_id){
		$('#form-booking-admin span.item_price, #form-booking-admin span.extra_price').addClass('is-active');
		$('#form-booking-admin input[name="item_price"]').val('');
		if(typeof room_id != 'undefined' && parseInt(room_id) > 0){
			data = {
				action: 'st_getRoomHotelInfo',
				room_id: room_id
			};
			$.post(ajaxurl, data, function(respon, textStatus, xhr) {
				$('#form-booking-admin span.item_price, #form-booking-admin span.extra_price').removeClass('is-active');
				if(typeof respon == 'object'){
					$('input#item_price').val(respon.price);
					$('#extra-price-wrapper').html(respon.extras)
				}
			}, 'json');
		}else{
			$('#form-booking-admin span.item_price, #form-booking-admin span.extra_price').removeClass('is-active');
		}
	}

	function get_list_room(hotel_id, room_id){
		if(typeof hotel_id != 'undefined' && parseInt(hotel_id)){
			$('#form-booking-admin span.room_id').addClass('is-active');
			$('#form-booking-admin input[name="item_price"]').val('');
			data = {
				action: 'st_getRoomHotel',
				room_id : room_id,
				hotel_id : hotel_id
			};

			$.post(ajaxurl, data, function(respon, textStatus, xhr) {
		$('#form-booking-admin span.room_id').removeClass('is-active');
				if(respon != ""){
					$('#form-booking-admin #room-id-wrapper').html(respon);
					if($('#form-booking-admin #room-id-wrapper select#room_id').val() != ""){
						room_id = $('#form-booking-admin #room-id-wrapper select#room_id').val();
						get_room_info(room_id);
					}
				}
			});
		}
	}
});