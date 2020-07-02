$(document).ready(function () {
    //make the mobile nav icon turn red on click
    $('.mobile-nav ul li').click(() => {
        $('.mobile-nav ul li').addClass('active').siblings().removeClass('active');
    })
    //prevent aside link from loading
    $('aside .container ul li').click((e) => {
        e.preventDefault();
    })
    //aside mobile view slide
    $('.aside-close').click(() => {
        $('aside').css('width', '0px');
        $('aside').css('transform', 'translate(-20px)')
    })
    $('.mobile-category').click(() => {
        $('aside').css('width', '100%');
        $('aside').css('transform', 'translate(0px)')
        //        console.log('hello')
    })
})
