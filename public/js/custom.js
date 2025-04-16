jQuery(function ($) {
    $(window).on('scroll', function(){
        if($(this).scrollTop()>=500){
            $('.fixed_menu_bottom_cont').addClass("fixedNow");
        }else{
            $('.fixed_menu_bottom_cont').removeClass("fixedNow");
            $('body').removeClass("show_sharch_area");
        }
    });



    $("#toggleSearchBtn").on('click', function(){
        $('body').toggleClass('show_sharch_area');
    });


});