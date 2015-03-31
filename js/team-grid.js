/**
 * JS
 */
jQuery(document).ready(function($) {
    $('.employee-bio').hide();

    var divs = $(".employee-team > .employee");
    for(var i = 0; i < divs.length; i+=3) {
      divs.slice(i, i+3).wrapAll("<div class='row clearfix'></div>");
    }

    $('.dashicons').click(function() {
        $(this).parent().next('.employee-bio').slideToggle();
    });
});