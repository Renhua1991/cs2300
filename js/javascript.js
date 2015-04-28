$(document).ready(function(){


	$(window).bind('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.nav').css('position','fixed');
            $('.nav').css('width','100%');
            $('.nav').css('top','0px');
        }
        else {
            $('.nav').css('position', '');
        }
    });



});
