jQuery(document).ready(function($) {
	$('#st-update-glocation').click(function(event) {
		$('.update-glocation-wrapper').toggleClass('open');
		return false;
	});

	$('.update-glocation-close').click(function(event) {
		close_update_popup();
		return false;
	});

	$(document).keyup(function(event) {
		if(event.which == 27){
			close_update_popup();
		}
	});

	$('.update-glocation-button').click(function(event) {
		var t = $(this);

		if(!t.hasClass('running')){
			t.addClass('running');

			get_date_glocation('st_hotel', 1, 0, $('.update-glocation-form input[name="reset_table"]:checked').val(), $('.update-glocation-form input[name="google_key"]').val());
		}
	});
	var progress_ajax;
	function close_update_popup(){
		if($('.update-glocation-wrapper').hasClass('open')){
			if($('.update-glocation-button').hasClass('running')){
				var  cf = confirm('Are you sure? If it is running, it will be canceled.');
				if(cf == true){
					progress_ajax.abort();
					$('.update-glocation-button .text').text('Start');
					$('.update-glocation-progress .progress-bar span').css('width', '0%');
					$('.update-glocation-button').removeClass('running');
					$('.update-glocation-wrapper').removeClass('open');
					$('.update-glocation-message').html('');
				}else{
					return false;
				}
			}else{
				$('.update-glocation-wrapper').removeClass('open');
				$('.update-glocation-button .text').text('Start');
				$('.update-glocation-progress .progress-bar span').css('width', '0%');
				$('.update-glocation-message').html('');
			}
			
		}
	}

	function get_date_glocation(post_type, page, start, reset_table, google_key){
		var data = {
				'action' : 'st_get_data_glocation',
				'post_type': post_type,
				'page' : page,
				'start' : start,
				'reset_table' : reset_table,
				'google_key' : google_key
			}

		$('.update-glocation-button .text').text('Running');
		$('.update-glocation-message').html('');
		progress_ajax = $.post(ajaxurl, data, function(respon, textStatus, xhr) {
			$('.update-glocation-message').html('');
			if(typeof respon == 'object'){
				$('.update-glocation-progress .progress-bar span').css('width', respon.progress+'%');

				if(respon.status == 'continue'){
					get_date_glocation(respon.post_type, respon.page, respon.start, '', respon.google_key);
				}else{
					$('.update-glocation-button').removeClass('running');
					if(respon.status == 'completed'){
						$('.update-glocation-button .text').text('Completed');
					}else{
						$('.update-glocation-button .text').text('Error');
						$('.update-glocation-message').html(respon.message);
					}
				}

			}
		}, 'json');
		
	}
});