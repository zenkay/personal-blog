/*
 A little bit of jQuery to make use of meta box more comfortable for users
 Source : http://codex.wordpress.org/AJAX_in_Plugins
 Really really basic, could have been improved by far but it's working fine and it allows you to skip some useless actions to get specific option on meta box...
*/

jQuery(document).ready(function($) {

	//by default hide this
	
	if ($("#twitterCardType").val() == 'photo') { $('.further-photo').show();  } else { $('.further-photo').hide(); }
	if ($("#twitterCardType").val() == 'product') {  $('.further-product').show(); } else { $('.further-product').hide(); }
	if ($("#twitterCardType").val() == 'gallery') { $('.further-gallery').show();  } else { $('.further-gallery').hide(); }
	if ($("#twitterCardType").val() == 'player') { $('.further-player').show(); $('.resizer').hide(400); } else { $('.further-player').hide(); }
	
	//just hide if cancel
	$('#twitterCardCancel').bind("change",function(){
		if ($(this).val() == 'yes') {
		   $('.further').hide(400);
		} else {
		   $('.further').show(400);
		}
	});

	
	//hide an show if gallery
	$('#twitterCardType').bind("change",function(){
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
	//player
		if ($(this).val() == 'player') {
		   $('.further-player').show(400);
		   $('.resizer').hide(400);
		} else {
		   $('.further-player').hide(400);
		}	
		
	});
	
	//hide if cardImage is fulfilled
	$('#twitterCardImage').bind("change",function(){	
		if ( $.trim( $(this).val() ) !== "" ) {
		   $('.resizer').hide(400);
		} else {
		   $('.resizer').show(400);
		}
	});
	
});