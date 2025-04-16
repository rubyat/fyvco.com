jQuery(function ($) {
    $(window).scroll(function(){
        if($(this).scrollTop()>=500){
            $('.fixed_menu_bottom_cont').addClass("fixedNow");
        }else{
            $('.fixed_menu_bottom_cont').removeClass("fixedNow");
        }
    });


});