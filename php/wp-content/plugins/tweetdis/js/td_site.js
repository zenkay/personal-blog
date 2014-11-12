jQuery(document).ready(function () {
     jQuery(".tip").hover(          
          function () {
            jQuery(this).find(".defaultDsgn").show();
            jQuery(this).find(".blankyDsgn").show();
            jQuery(this).find(".edgebirdDsgn").show();
            jQuery(this).find(".coginuDsgn").show();
            jQuery(this).find(".gigabugDsgn").show();
            jQuery(this).find(".gigabugDsgn").show();
            jQuery(this).find(".cloud").addClass("act_move");
          },
          function () {
            jQuery(this).find(".defaultDsgn").hide();
            jQuery(this).find(".blankyDsgn").hide();
            jQuery(this).find(".edgebirdDsgn").hide();
            jQuery(this).find(".coginuDsgn").hide();
            jQuery(this).find(".gigabugDsgn").hide();
            jQuery(this).find(".cloud").removeClass("act_move");
          }
    );
    
    jQuery(".tweet").mousemove(function (pos) { 
            var hint_val = jQuery(".hint_type").val();
            var with_bl = jQuery(this).find(".cloud").width();
            var offset = jQuery(this).offset();
            var pos_x = pos.pageX - offset.left-(with_bl/2)-7;
            if(hint_val == "hint_4"){
                pos_x = pos.pageX - offset.left + 7;      
            }else if(hint_val == "hint_5"){
                 pos_x = pos.pageX - offset.left - 7;
            }
            
 
            jQuery(".act_move").css("left",( pos_x)+"px").css("top",(pos.pageY - offset.top - 30)+"px"); 
       });
});
function colorLuminance2(hex, lum) {
        // validate hex string
        hex = String(hex).replace(/[^0-9a-f]/gi, "");
        if (hex.length < 6) {
            hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
        }
        lum = lum || 0;
        // convert to decimal and change luminosity
        var rgb = "#", c, i;
        for (i = 0; i < 3; i++) {
            c = parseInt(hex.substr(i*2,2), 16);
            c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
            rgb += ("00"+c).substr(c.length);
        }
        return rgb;
    }