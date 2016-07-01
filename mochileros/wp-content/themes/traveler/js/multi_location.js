jQuery(document).ready(function($) {
	if($("select.list-item-post-type").length){
		$("select.list-item-post-type").attr('name', 'multi_location[]');
		$select = $("select.list-item-post-type").selectize({
			create: false,
			createOnBlur: false,
			allowEmptyOption: true,
			persist: false,
			maxItems: 10

		});

		if(typeof list_location != 'undefined'){
			control = $select[0].selectize;
			list_location.list = JSON.parse(list_location.list);
            console.log(list_location);
            if (list_location.list){
            	for(var i= 0; i< list_location.list.length; i++){
					list_location.list[i] = '_'+list_location.list[i]+'_';
				}
				control.setValue(list_location.list);
            }
			
		}
	}	
});

