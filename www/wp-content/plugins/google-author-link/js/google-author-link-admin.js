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
	
	//for page Goolge snippet test
	$("#galink_g_snippet_tool_page_link_id").change(function(){
		var url_val = $(this).val();
		if( url_val == "" ){
			$("#galink_g_snippet_tool_page_test_button_id").attr('disabled', 'disabled');
		}else{
			$("#galink_g_snippet_tool_page_test_button_id").removeAttr('disabled');
			$("#galink_g_snippet_tool_page_test_button_id").attr('href', 'http://www.google.com/webmasters/tools/richsnippets?q=' + url_val );
		}
		
	});
	
	//for post Goolge snippet test
	$("#galink_g_snippet_tool_post_link_id").change(function(){
		var url_val = $(this).val();
		if( url_val == "" ){
			$("#galink_g_snippet_tool_post_test_button_id").attr('disabled', 'disabled');
		}else{
			$("#galink_g_snippet_tool_post_test_button_id").removeAttr('disabled');
			$("#galink_g_snippet_tool_post_test_button_id").attr('href', 'http://www.google.com/webmasters/tools/richsnippets?q=' + url_val );
		}
		
	});
	
	$(".galink-cpost-dropdown").live('change', function(){
		var post_type = $(this).attr('rel');
		var url_val = $(this).val();
		if( url_val == "" ){
			$("#galink_g_snippet_tool_cpost_" + post_type + "_test_button_id").attr('disabled', 'disabled');
		}else{
			$("#galink_g_snippet_tool_cpost_" + post_type + "_test_button_id").removeAttr('disabled');
			$("#galink_g_snippet_tool_cpost_" + post_type + "_test_button_id").attr('href', 'http://www.google.com/webmasters/tools/richsnippets?q=' + url_val );
		}
	});
	
	$("#galink_reset_galink_exclude_pages_id").click(function(){
		$("#galink_exclude_pages_id").val("");
	});
	$("#galink_reset_galink_exclude_custom_post_type_id").click(function(){
		$("#galink_exclude_custom_post_type_id").val("");
	});
	$("#galink_reset_galink_exclude_post_categories_id").click(function(){
		$("#galink_exclude_post_categories_id").val("");
	});
});
