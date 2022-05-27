$(window).scroll(function(){
    if($(this).scrollTop() > 130){
        $('.navbar').addClass('navbar-fixed')
    } else {
        $('.navbar').removeClass('navbar-fixed')
    }
})