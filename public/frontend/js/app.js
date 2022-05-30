$(function(){
    $(window).scroll(function(){
        if($(this).scrollTop() > 130){
            $('.navbar').addClass('navbar-fixed')
        } else {
            $('.navbar').removeClass('navbar-fixed')
        }
    })

    if($('.navbar').find(`a[href="${window.location.href}"`).length){
        $('.navbar').find(`.active`).addClass('active')
        $('.navbar').find(`a[href="${window.location.href}"`).parent().addClass('active')
    } else {
        $('.nav-item:nth-child(1)').addClass('active')
    }
})