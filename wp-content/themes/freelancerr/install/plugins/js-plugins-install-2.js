var plugins_to_install_count = 0;
var plugins_count = 0;

ff_on_body_active_interval = setInterval(function(){ff_deactivate_body()},100);

function ff_deactivate_body(){
    if( jQuery('body').length ){
        jQuery('body').append('<div id="installing_background"></div>');
        jQuery('#installing_background')
            .css('background', '#000000')
            .css('opacity', '0.5')
            .css('z-index', 999999)
            .css('top', 0)
            .css('left', 0)
            .css('width', jQuery(window).width() + 'px' )
            .css('height', jQuery(window).height() + 'px' )
            .css('position','fixed');

        jQuery('body').append('<div id="installing_front"><p></p></div>');
        jQuery('#installing_front p').append("<span>Wise Guys Installation - step 2/4</span>");
        jQuery('#installing_front p').append("<span id='info'>Selecting plugins for installation</span>");
        jQuery('#installing_front p').append("<span> &nbsp; </span>");

        jQuery('#installing_front p').append("<span id='wrum_wrum' style='background: url(./images/wpspin_light-2x.gif) no-repeat;height:32px; padding:0 0 0 40px'> Loading ... </span>");

        jQuery('#installing_front p span').css('display','block');
        jQuery('#installing_front p')
            .css('border-radius', '20px')
            .css('border', '2px solid #AAAAAA')
            .css('line-height', '30px')
            .css('font-size', '23px')
            .css('font-family', "HelveticaNeue-Light, 'Helvetica Neue Light', 'Helvetica Neue', sans-serif")
            .css('background', '#FFFFFF')
            .css('z-index', 9999999)
            .css('top', '200px')
            .css('left', (jQuery(window).width() - 500)/2 + 'px' )
            .css('padding', '20px 40px')
            .css('width', '400px' )
            .css('position','fixed');

        window.clearInterval( ff_on_body_active_interval );
    }
}

jQuery(document).ready(function () {
    if( 0 == jQuery('#installing_front p span').length ){
        window.clearInterval( ff_on_body_active_interval );
        ff_deactivate_body();
    }

    jQuery('#wrum_wrum').remove();

    //jQuery('#installing_front p').append("<span style='text-align: right'><a href='#' id='autoinstall_abort' style='color:#FF0000'>Abort</a> | <a href='#' id='autoinstall_continue'>Next Step</a></span>");
    jQuery('#installing_front p').append("<span style='text-align: right'><a href='#' id='autoinstall_continue'>Next Step</a></span>");

    jQuery('#installing_front span').css('display','block');
    jQuery('#installing_front p a').css('text-align','right').css('text-decoration','none');

    jQuery('#tgmpa-plugins .plugins #the-list tr').each( function(index){
        if( 'Not Installed' == jQuery(this).find('.column-status').html() ){
            jQuery(this).find('.check-column input').attr('checked','checked');
            plugins_to_install_count ++;
        }
    });
    
    jQuery('#installing_front #autoinstall_abort').click( function(){
        location.replace("./admin.php?page=foptions&all_plugins_installed=true&install_action=1");
    });
    
    if( 0 < jQuery('#tgmpa-plugins .plugins #the-list .no-items').length ){
        jQuery('#installing_front #info').html('All done - all plugins are installed');
        jQuery('#installing_front #autoinstall_continue').html('Finish');
        jQuery('#installing_front #autoinstall_continue').click( function(){
            location.replace("./admin.php?page=foptions&all_plugins_installed=true&install_action=1");
        });
    } else if( 0 != plugins_to_install_count ){
        jQuery('#installing_front #autoinstall_continue').click( function(){
            jQuery('#tgmpa-plugins #cb-select-all-1').attr('checked','checked');
            jQuery('#tgmpa-plugins #cb-select-all-2').attr('checked','checked');
            jQuery('#tgmpa-plugins select').val('tgmpa-bulk-install');
            jQuery('#tgmpa-plugins #doaction').click();
        });
    }
});