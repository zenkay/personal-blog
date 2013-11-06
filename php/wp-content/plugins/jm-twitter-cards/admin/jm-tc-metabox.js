/*
 A little bit of jQuery to make use of meta box more comfortable for users
 Source : http://codex.wordpress.org/AJAX_in_Plugins
 Really really basic, could have been improved by far but it's working fine and it allows you to skip some useless actions to get specific option on meta box...
*/

jQuery(document).ready(function($) {

	// By default hide this
	$('.further-photo').hide()
	$('.further-product').hide();
	$('.further-gallery').hide();
	
	//just hide if cancel
	$('#twitterCardCancel').change(function(){
		if ($(this).val() == 'yes') {
		   $('.further').hide(400);
		} else {
		   $('.further').show(400);
		}
	});

	
	//hide an show if gallery
	$('#twitterCardType').change(function(){
		if ($(this).val() == 'gallery') {
		   $('.furthermore-non-gallery').hide(400);
		   $('.further-gallery').show(400);
		} else {
		   $('.furthermore-non-gallery').show(400);
		   $('.further-gallery').hide(400);
		}
	
	//show if specific to photo or product
		if ($(this).val() == 'photo') {
		   $('.further-photo').show(400);
		} else {
		   $('.further-photo').hide(400);
		}

		if ($(this).val() == 'product') {
		   $('.further-product').show(400);
		} else {
		   $('.further-product').hide(400);
		}
	});
	
	//hide if cardImage is fulfilled
	$('#twitterCardImage').change(function(){	
		if ( $.trim( $(this).val() ) !== "" ) {
		   $('.resizer').hide(400);
		} else {
		   $('.resizer').show(400);
		}
	});
	
});