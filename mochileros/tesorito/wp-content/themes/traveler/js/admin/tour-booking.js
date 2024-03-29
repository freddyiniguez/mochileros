jQuery(document).ready(function($) {
	
	$('#form-booking-admin input[name="item_id"]').change(function(event) {

		var item_id = $(this).val();
		getTourInfo(item_id);
	});
	
	if($('#form-booking-admin input[name="item_id"]').val() != "" && parseInt($('#form-booking-admin input[name="item_id"]').val()) > 0){
		var item_id = $('#form-booking-admin input[name="item_id"]').val();
		getTourInfo(item_id);
	}

	function getTourInfo(item_id){
		$parent = $('#form-booking-admin');
		$('span.spinner', $parent).addClass('is-active');
		if(typeof item_id != 'undefined' && parseInt(item_id) > 0){
			data = {
				action: 'st_getInfoTour',
				tour_id: item_id
			};
			$.post(ajaxurl, data, function(respon, textStatus, xhr) {
				$('span.spinner', $parent).removeClass('is-active');
				if(typeof respon == 'object'){
					$('#tour-type-wrapper', $parent).html(respon.type_tour);

					$('input#adult_price', $parent).val(respon.adult_price);
					$('input#child_price', $parent).val(respon.child_price);
					$('input#infant_price', $parent).val(respon.infant_price);
					$('input#max_people', $parent).val(respon.max_people);
                    if(respon.tour_text != 'daily_tour'){
                        $('input#duration').val('').parents('.form-row').hide();
                        $('input#check_out').parents('.form-row').show();
                    }else{
                        $('input#duration').val(respon.duration).parents('.form-row').show();
                        $('input#check_out').parents('.form-row').hide();
                    }
				}
			}, 'json');
		}
	}


	var TourCalendar = function(container){
        var self = this;
        this.container = container;
        this.calendar= null;
        this.form_container = null;

        this.init = function(){
            self.container = container;
            self.calendar = $('.calendar-content', self.container);
            self.form_container = $('.calendar-form', self.container);
            self.initCalendar();
        }

        this.initCalendar = function(){
            self.calendar.fullCalendar({
                firstDay: 1,
                lang:st_params.locale,
                customButtons: {
                    reloadButton: {
                        text: st_params.text_refresh,
                        click: function() {
                            self.calendar.fullCalendar( 'refetchEvents' );
                        }
                    }
                },
                header : {
                    left:   'today,reloadButton',
                    center: 'title',
                    right:  'prev, next'
                },
                selectable: true,
                select : function(start, end, jsEvent, view){
                    var start_date = new Date(start._d).toString("MM");
                    var end_date = new Date(end._d).toString("MM");
                    var today = new Date().toString("MM");
                    if(start_date < today || end_date < today){
                        self.calendar.fullCalendar('unselect');
                    }
                    
                },
                events:function(start, end, timezone, callback) {
                    $.ajax({
                        url: ajaxurl,
                        dataType: 'json',
                        type:'post',
                        data: {
                            action: 'st_get_availability_tour_frontend',
                            tour_id: $('input#tour_id').val(),
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(doc){
                            if(typeof doc == 'object'){
                                callback(doc);
                            }
                        },
                        error:function(e)
                        {
                            alert('Can not get the availability slot. Lost connect with your sever');
                        }
                    });
                },
                eventClick: function(event, element, view){
                    
                },
                eventMouseover: function(event, jsEvent, view){
                    $('.event-number-'+event.start.unix()).addClass('hover');
                },
                eventMouseout: function(event, jsEvent, view){
                    $('.event-number-'+event.start.unix()).removeClass('hover');
                },
                eventRender: function(event, element, view){
                    var html = event.day; 
                    var html_class = "none";
                    if(typeof event.date_end != 'undefined'){
                        html += ' - '+event.date_end;
                        html_class = "group";
                    }                    
                    var today_y_m_d = new Date().getFullYear() +"-"+(new Date().getMonth()+1)+"-"+new Date().getDate();                    
                    if(event.status == 'available'){
                        var title ="";
                        
                        if (event.adult_price != 0) {title += st_checkout_text.adult_price+': '+event.adult_price + " <br/>"; }
                        if (event.child_price != 0) {title += st_checkout_text.child_price+': '+event.child_price + " <br/>"; }
                        if (event.infant_price != 0) {title += st_checkout_text.infant_price+': '+event.infant_price ;  }
                        
                        html  = "<button data-placement='top' title  = '"+title+"' data-toggle='tooltip' class='"+html_class+" btn btn-available'>" + html;
                    }else {
                        html  = "<button disabled data-placement='top' title  = 'Disabled' data-toggle='tooltip' class='"+html_class+" btn btn-disabled'>" + html;
                    }         
                    if (today_y_m_d === event.date) {
                        html += "<span class='triangle'></span>";
                    }
                    html  += "</button>";
                    element.addClass('event-'+event.id)
                    element.addClass('event-number-'+event.start.unix());
                    $('.fc-content', element).html(html);
                    
                    element.bind('click', function() {
                        $('input#check_in').val(event.start._i);
                        if(typeof event.end != 'undefined' && event.end && typeof event.end._i != 'undefined'){
                                date = new Date(event.end._i);
                                date.setDate(date.getDate() - 1);
                                date = $.fullCalendar.moment(date).format("YYYY-MM-DD");
                            $('input#check_out').val(date);
                        }else{
                            $('input#check_out').val(event.start._i);
                        }
                        $('input#adult_price').val(event.adult_price);
                        $('input#child_price').val(event.child_price);
                        $('input#infant_price').val(event.infant_price);
                        $('#tour_time').qtip('hide');
                    });
                },
                loading: function(isLoading, view){
                    if(isLoading){
                        $('.overlay', self.container).addClass('open');
                    }else{
                        $('.overlay', self.container).removeClass('open');
                    }
                },

            });
        }
    };

    
    $('#tour_time').click(function(event) {
        /* Act on the event */
        return false;
    });
    $('#tour_time').qtip({
    	content: {
    		text: $('#tour_time_content').html()
    	},
    	show: { 
            when: 'click', 
            solo: true // Only show one tooltip at a time
        },
        hide: 'unfocus',
        api :{
        	onShow : function(){
	         	$('.calendar-wrapper').each(function(index, el) {
			        var t = $(this);
			        var tour = new TourCalendar(t);
			        tour.init();
			    });
			}    
        }
    });
});