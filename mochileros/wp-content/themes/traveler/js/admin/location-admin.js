jQuery(document).ready(function($){  
    $(this).on("click","#post_type-all",function(){
    	var status = $(this).prop( "checked" );
       	$(this).parent().parent(".edit_form_line").find("input").not("#post_type-all").prop('checked', status);
    });  
    $(this).on("click","#star_list-all",function(){
    	var status = $(this).prop( "checked" );
       	$(this).parent().parent(".edit_form_line").find("input").not("#star_list-all").prop('checked', status);
    });  
});
jQuery(document).on('click', '.option-tree-list-item-add', function(e) {
	e.preventDefault();
	//OT_UI.add(this,'list_item');

});