jQuery(document).ready( function($) {
	$("#galink_remove_authorship_from_all_pages_yes_id").click(function(){
		if( $("#galink_remove_authorship_from_all_pages_yes_id").prop('checked') ){
			$("#galink_remove_authorship_from_pages_select_id").css("display", "none");
		}
	});
	$("#galink_remove_authorship_from_all_pages_no_id").click(function(){
		if( $("#galink_remove_authorship_from_all_pages_no_id").prop('checked') ){
			$("#galink_remove_authorship_from_pages_select_id").css("display", "block");
		}
	});
});
