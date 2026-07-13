$(document).ready(function(){
    $(".menu-link ul").hide();
    // $(".menu-link ul").find('li').hide();
    $('.menu-link').click(function() {
        $(this).children('ul').find('li').show();
        $(this).children('ul').slideToggle();
    });
});