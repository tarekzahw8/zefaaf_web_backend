$(document).ready(function () {

    $('#sidebarCollapse,.close-menu').on('click', function (event) {
        $('#sidebar').toggleClass('active');
        event.stopPropagation();
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest('#sidebar').length) {
            $('#sidebar').removeClass('active');
        }
    });
   
    $('.login-btn,.activation-form1 .main-btn').click(function(){
        $('.login-form').hide();
        $('.activation-form1').hide();
        $('.mainmenu-header').show();
    });

    $('.logout-btn').click(function(){
        $('.mainmenu-header').hide();
        $('.login-form').show();
    });

    $('.forgot-psw').click(function(){
        $('.login-form').hide();
        $('.forgot-password').show();
    });

    $('.follow-btn').click(function(){
        $('.forgot-password').hide();
        $('.activation-form1').show();
    });

    $('.register-btn').click(function(){
        $('.register-input').hide();
        $('.register-form .activation-form').show();
    });

    $('.activation-btn').click(function(){
        $('.register-form .activation-form').hide();
        $('.register-steps').show();
    });
        
    $('.sidemenu li').on('click', function(){
        $('.sidemenu li').parent().find('li').removeClass('activeitem');
        $(this).addClass('activeitem');
    })

    $('.select-option img').click(function(){
        $('.select-option img').removeClass('active');
        $(this).addClass('active');
    });

    // change theme color 
    $('.theme-color').click(function(){
        $(this).parents().find('.wrapper').toggleClass('sec-theme');
    });

    // packages slider
    $(".packages").owlCarousel({
        center: true,
        items:3,
        loop:true,
        autoplay:true,
        autoplaySpeed:1000
    });

    // chat footer
    $('#chatTxt').on('keyup keypress', function(e) {
        if($(this).val().length > 0) {
              $('.mic').hide();
              $('.send').show();
        }
      });

      $('#chatTxt').on('keyup', function() {
        if($(this).val().length == 0) {
            $('.mic').show();
            $('.send').hide();
        }
      })
      
    // set range values
    var slider = document.getElementById('slider');

    noUiSlider.create(slider, {
        start: [20, 30],
        connect: true,
        range: {
            'min': 0,
            'max': 60
        },
        tooltips: true,
        format: wNumb({
            decimals: 0
        })
    });
});
