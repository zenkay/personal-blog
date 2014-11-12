//Radio buttons for quote decoration start
    var value = $$('input[name=marked_text_uline_style]:checked')[0].get('value');
    $$('.tip').setStyle('border-bottom-style', value);
    if (value == 'none'){
        $$('.thiknesTR').hide();
    } else {
        $$('.thiknesTR').show();
    }
    $$('.tip').addEvents({
        mouseout: function(){
            this.setStyle('border-bottom-style', value);
        }
    });

    $$('.borderTD .radio').addEvent('click', function(){
        var value = $$('input[name=marked_text_uline_style]:checked')[0].get('value');
        $$('.tip').setStyle('border-bottom-style', value);
        if (value == 'none'){
            $$('.thiknesTR').hide();
        } else {
            $$('.thiknesTR').show();
        }
        $$('.tip').addEvents({
            mouseout: function(){
                this.setStyle('border-bottom-style', value);
            }
        });
    });

    // Radio buttons for quote decoration end

    // Radio buttons for design start
    var value2 = $$('input[name=td_action_design]:checked')[0].get('value');
    $('cloud').setAttribute('class','');
    $('cloud').addClass(value2);
    if (value2 == 'edgebirdDsgn'){
        $$('.actionBgTR').show(); 
        $$('.edgebirdDsgn').setStyle('border-color', $('cubeBgColor').getStyle('background-color'));
        $$('.edgebirdDsgn .arrowRight').setStyle('border-top-color', $('cubeBgColor').getStyle('background-color'));
        $$('.bird').setStyle('background-color', $('cubeActionColor').getStyle('background-color'));
        $$('.edgebirdDsgn').setStyle('background', '#ffffff');
    } else if (value2 == 'blankyDsgn'){
        $$('.actionBgTR').hide();
        $$('.blankyDsgn .arrow').setStyle('border-top-color', $('cubeActionColor').getStyle('background-color'));
        $$('.blankyDsgn').setStyle('background', '#ffffff');
    } else if (value2 == 'defaultDsgn'|| value == 'coginuDsgn'){
        $$('.actionBgTR').show();   
        $$('.arrow').setStyle('border-top-color', $('cubeBgColor').getStyle('background-color'));
        $$('.defaultDsgn').setStyle('background', $('cubeBgColor').getStyle('background-color'));
    } else if (value2 == 'gigabugDsgn') {
        $$('.actionBgTR').show();   
        var bgC = $('cubeBgColor').getStyle('background-color');
        var newC = ColorLuminance( bgC, 0.99);
        $$('.gigabugDsgn .arrowRght').setStyle('border-top-color', bgC);
        $$('.gigabugDsgn').setStyle('border-color', bgC);
        $$('.gigabugDsgn').setStyle('background', bgC);
        $$('.gigabugDsgn').setStyle('background', '-moz-linear-gradient(top,' +  newC + ',' + bgC +')');
        $$('.gigabugDsgn').setStyle('background', '-webkit-linear-gradient(top,' +  newC + ',' + bgC +')');
        $$('.gigabugDsgn').setStyle('background', '-webkit-gradient(linear, left top, left bottom, color-stop(0%,' +  newC + '), color-stop(100%,' + bgC +'))');
        $$('.gigabugDsgn').setStyle('background', '-o-linear-gradient(top,' +  newC + ',' + bgC +')'); 
        $$('.gigabugDsgn').setStyle('background', '-ms-linear-gradient(top,' +  newC + ',' + bgC +')');
        $$('.gigabugDsgn').setStyle('background', 'linear-gradient(top,' +  newC + ',' + bgC +')');

    } else if (value2 == 'coginuDsgn') {
        $$('.actionBgTR').show();  
        $$('.coginuDsgn').setStyle('background', $('cubeBgColor').getStyle('background-color'));
        $$('.coginuDsgn .cloudBrd').setStyle('background', $('cubeBgColor').getStyle('background-color'));
        $$('.coginuDsgn .arrowRght2').setStyle('border-top-color', $('cubeBgColor').getStyle('background-color'));

    }

    $$('.designTD .radio').addEvent('click', function(){
        var value = $$('input[name=td_action_design]:checked')[0].get('value');
        $('cloud').setAttribute('class','');
        $('cloud').addClass(value);
                refreshDes();
        if (value == 'edgebirdDsgn'){
            $$('.actionBgTR').show(); 
            $$('.edgebirdDsgn').setStyle('border-color', $('cubeBgColor').getStyle('background-color'));    
            $$('.edgebirdDsgn .arrowRight').setStyle('border-top-color', $('cubeBgColor').getStyle('background-color'));
            $$('.bird').setStyle('background-color', $('cubeActionColor').getStyle('background-color'));
            $$('.edgebirdDsgn').setStyle('background', '#ffffff');
        } else if (value == 'blankyDsgn'){    
            $$('.actionBgTR').hide();
            $$('.blankyDsgn .arrow').setStyle('border-top-color', $('cubeActionColor').getStyle('background-color'));
            $$('.blankyDsgn').setStyle('background', '#ffffff');
        } else if (value == 'defaultDsgn'){
            $$('.actionBgTR').show();   
            $$('.arrow').setStyle('border-top-color', $('cubeBgColor').getStyle('background-color'));
            $$('.defaultDsgn').setStyle('background', $('cubeBgColor').getStyle('background-color'));
        } else if (value == 'gigabugDsgn') {
            $$('.actionBgTR').show();   
            var bgC = $('cubeBgColor').getStyle('background-color');
            var newC = ColorLuminance( bgC, 0.99);
            $$('.gigabugDsgn').setStyle('border-color', bgC);
            $$('.gigabugDsgn .arrowRght').setStyle('border-top-color', bgC);
            $$('.gigabugDsgn').setStyle('background', bgC);
            $$('.gigabugDsgn').setStyle('background', '-moz-linear-gradient(top,' +  newC + ',' + bgC +')');
            $$('.gigabugDsgn').setStyle('background', '-webkit-linear-gradient(top,' +  newC + ',' + bgC +')');
            $$('.gigabugDsgn').setStyle('background', '-webkit-gradient(linear, left top, left bottom, color-stop(0%,' +  newC + '), color-stop(100%,' + bgC +'))');
            $$('.gigabugDsgn').setStyle('background', '-o-linear-gradient(top,' +  newC + ',' + bgC +')'); 
            $$('.gigabugDsgn').setStyle('background', '-ms-linear-gradient(top,' +  newC + ',' + bgC +')');
            $$('.gigabugDsgn').setStyle('background', 'linear-gradient(top,' +  newC + ',' + bgC +')');

        } else if (value == 'coginuDsgn') {
            $$('.actionBgTR').show();  
            
            $$('.coginuDsgn .cloudBrd').setStyle('background', $('cubeBgColor').getStyle('background-color'));
            $$('.coginuDsgn .arrowRght2').setStyle('border-top-color', $('cubeBgColor').getStyle('background-color'));
                        $$('.coginuDsgn').setStyle('background', $('cubeBgColor').getStyle('background-color'));

        }
                refreshDes();
    });
        function setPreposition () {
            var value = $$('input[name=tweet_pretext]:checked')[0].get('value');
            $$('.tweetCnt .by_rt').set('text',value);
            $$('.tweetCnt .twcnt_rt').set('text',  '@' + $('twAthr').get('value'));
            $$('.tweetCnt .by').set('text',value);
            $$('.tweetCnt .twcnt').set('text',  '@' + $('twAthr').get('value'));

            if (value == 'none') {
                    $$('.tweetCnt .by').hide();
                    $$('.tweetCnt .by_rt').hide();
                    $$('.tweetCnt .twcnt_rt').hide();
                    $$('.tweetCnt .twcnt').hide();
            } else if (value == 'RT') {
                    $$('.tweetCnt .by').hide();
                    $$('.tweetCnt .twcnt').hide();
                    $$('.tweetCnt .by_rt').show();
                    $$('.tweetCnt .twcnt_rt').show();
            }  else {
                    $$('.tweetCnt .by_rt').hide();
                    $$('.tweetCnt .twcnt_rt').hide();
                    $$('.tweetCnt .twcnt').show();
                    $$('.tweetCnt .by').show();                
            }
        }
        
        setPreposition();

    $$('.prtxtTD .radio').addEvent('click', setPreposition);
    
    
    function setShortener () {
            var val = $$('input[name=url_shortener]:checked')[0].get('value');
            $$('.tweetCnt a').set('href','http://' + val + '/d7s924w');
            $$('.tweetCnt a').set('text','http://' + val + '/d7s924w');
            
            if ( val == 'bit.ly' ) {
                $$('div#bitlyCreds').show();
            } else {
                $$('div#bitlyCreds').hide();
            }
        }
        
        setShortener();
        
    $$('.shrtUrlTD .radio').addEvent('click', setShortener);

    // Radio buttons for SHORTENER end
        
        
    
    
    // Radio buttons for tweet font family start
        
    $$('.fontfamilyTd .radio').addEvent('click', function(){
        var value = $$('input[name=tweet_fontfamily]:checked')[0].get('value');
        $('cloudP').setStyle('font-family',value);
        $('tooltip').setStyle('font-family',value);
    });

    // Radio buttons for tweet font family end

    // Slider for text-decoration start
    var slider = $('slider');
    var valsl2 = $$('input[id=borderWidth]')[0].get('value');
    valsl2 = valsl2.replace(/px$/, "");
    new Slider(slider, slider.getElement('.knob'), {
        range: [1, 4],
        initialStep: valsl2,
        onChange: function(value){
            if (value) $('tweet').setStyle('border-bottom-width', value);
            if (value) $('borderWidth').setAttribute('value', value + 'px');
            var margTop = $('cloud').offsetHeight + 10;
            $('cloud').setStyle('marginTop', '-' + margTop + 'px'); 
        }
    });

    // Slider for text-decoration end

    // Slider for font-size start    

    var valsl = $$('input[id=cloudFntSz]')[0].get('value');
    valsl = valsl.replace(/px$/, "");
    var slider1 = $('slider2');
    var ctaSlider =new Slider(slider1, slider1.getElement('.knob'), {
        id: "slider123",
        range: [12, 20],
        initialStep: valsl,
        onChange: function(value){
            if (value) $('cloudP').setStyle('font-size', value);
            if (value) $('cloudFntSz').setAttribute('value', value + 'px');
            if (value) $('cloud').setStyle('marginLeft', '-' + $('cloud').offsetWidth/2 + 'px');
            var margTop = $('cloud').offsetHeight + 10;
            if (value) $('cloud').setStyle('marginTop', '-' + margTop + 'px'); 
        }
    });