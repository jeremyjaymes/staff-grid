/* staff-grid.js */
jQuery(document).ready(function($) {
    $('.staff-bio').hide();

    var divs = $(".staff-grid > .staff-person");
    for(var i = 0; i < divs.length; i+=3) {
      divs.slice(i, i+3).wrapAll("<div class='row clearfix'></div>");
    }

    $('.dashicons').click(function() {
        $(this).parent().next('.staff-bio').slideToggle();
    });
});