function onchangeWidth() {
    jQuery('#px_fontsize').html(jQuery('#rangeP').val() + 'px');
    jQuery('#tweet-box p').css('font-size', jQuery('#rangeP').val() + 'px');
    var line_h = jQuery('#rangeP').val()/2;
    line_h = line_h.toFixed(0);
    jQuery('#tweet-box p').css('line-height', parseInt(jQuery('#rangeP').val())+parseInt(line_h) + 'px');
}

function onchangeWidthMV() {
    jQuery('#px_marginver').html(jQuery('#rangePMV').val() + 'px');
    jQuery('#tweet-box').css('margin', jQuery('#rangePMV').val() + 'px' + ' '+ jQuery('#rangePMH').val() + 'px');
}                 
function onchangeThikness() {
    jQuery('#px_thikness').html('0.'+jQuery('#rangeThiknes').val() + 'px');
    jQuery('#tweet').css('border-bottom-width', jQuery('#rangeThiknes').val() + 'px');
    //jQuery('#tweet-box').css('margin', jQuery('#rangePMV').val() + 'px' + ' '+ jQuery('#rangePMH').val() + 'px');
}

function onchangeWidthMH() {
    jQuery('#px_marginhor').html(jQuery('#rangePMH').val() + 'px');
     jQuery('#tweet-box').css('margin', jQuery('#rangePMV').val() + 'px' + ' '+ jQuery('#rangePMH').val() + 'px');
}
function onchangeWidthFS() {
    jQuery('#px_fs').html(jQuery('#rangeFS').val() + 'px');
    jQuery('.click-to-tweet').css('font-size', jQuery('#rangeFS').val() + 'px');
}