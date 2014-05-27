$(document).ready(function(){

    $('.link_go').click(function() {
        window.open($(this).attr('data-url'), '_blank');
    });

});