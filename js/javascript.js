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

function add_reply(btn){
    //console.log("addCondition");
    //$(btn).parent().parent().value();
    $id = btn.id;
    console.log($id);
    $(btn).parent().append("<div class=reply><form action=index.php method=POST><input type=hidden name=hidden_id value="+ $id + "><textarea rows=4 cols=50 name=reply></textarea><input type=submit name=add_reply value=reply></form></div>");
    $(btn).attr('disabled','disabled');
}