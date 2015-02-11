/**
 * Created by New account name on 12/18/14.
 */
function getPageName() {
    var
        pathName = window.location.pathname,
        pageName = "";

    if (pathName.indexOf("/") != -1) {
        pageName = pathName.split("/").pop();
    } else {
        pageName = pathName;
    }
    return pageName;
}
function navigateToPage() {

    var pageName = getPageName();
    jQuery('.contentpanel > div > div > .content').hide();//.html().fadeIn();
    jQuery('#loader-body').fadeIn().find('#loader-body-status').fadeIn();
    //jQuery('.contentpanel > div > div > .content').find('#loader-body-status').fadeIn();
    jQuery.ajax({
        type: "GET",
        url: '#/'+pageName,
        success: function(html){
            jQuery('#loader-body').hide();
            jQuery('.contentpanel > div > div > .content').html(html).fadeIn('slow');

        }
    })

}

function toUrl(url){
    if (Modernizr.history) {
        var remoteUrl = url;

        if ( history.pushState ) window.history.pushState(null, "", remoteUrl);
        navigateToPage();
    }
}
jQuery(document).ready(function() {
    /*$(function(){
        Path.listen();
    });

    Path.rescue(function(){

    });
    Path.map("#/:page").to(function(){
        var page = this.params['page'];
        jQuery.ajax({
            type: "GET",
            url: page,
            success: function(html){
                jQuery('.contentpanel > div > div > .panel').hide().html(html).fadeIn('slow');
            }
        })
    });
    $('.nav > li > a[data-toggle="tab"]').on('click',function(e){
        location.href = $(this).data('remote-url');

    });*/
    jQuery(window).bind('popstate', navigateToPage);

    $('.menu-icon a').on('click',function(e){
        $('.menu-icon a').each(function(){
            $(this).removeClass('btn-primary').addClass('btn-white');
        })
        $(this).addClass('btn-primary').removeClass('btn-white');
        if (Modernizr.history) {
            e.preventDefault();
            var remoteUrl = $(this).data('remote-url');
            if ( history.pushState )
                history.pushState(null, "", remoteUrl);
            navigateToPage();
        }

    });
    // Page Preloader
    jQuery('#status').fadeOut();
    jQuery('#preloader').delay(350).fadeOut(function(){
        jQuery('body').delay(350).css({'overflow':'visible'});
    });
    jQuery('.tooltips').tooltip({ container: 'body'});
    $('.menu-icon a').each(function(){
        $(this).removeClass('btn-primary').addClass('btn-white');
    })
});
