$(function(){

    $('.alert').delay(7000).fadeOut();

});

$(document).keydown(function(e) {
    if (e.keyCode === 8 && !elid) {
        return false;
    };
});
