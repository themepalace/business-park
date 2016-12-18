( function( $ ) {
  $(window).load(function() {
  
    $("body").css({display:"block"});
  /*------------------------------------------------
                  LOADER
  ------------------------------------------------*/
    $('#loader').hide();
    $('#loader-container').hide();

  /*------------------------------------------------
                  BACK TO TOP
  ------------------------------------------------*/
    $(window).scroll(function(){
      if ($(this).scrollTop() > 1) {
      $('.backtotop').css({bottom:"25px"});
      } else {
      $('.backtotop').css({bottom:"-100px"});
      }
    });

    $('.backtotop').click(function(){
      $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

  /*------------------------------------------------
                  MENU
  ------------------------------------------------*/
    $(".menu-toggle").click(function() {
        $(".main-navigation").show();
        $(".main-navigation").addClass("menu-active");
    });

    $(".menu-close .fa").click(function() {
        $(".main-navigation").removeClass("menu-active");
    });

    $(".social-menu ul").addClass("social-icons");


  /*------------------------------------------------
                  HOMEPAGE BREADCRUMB
  ------------------------------------------------*/

    if ( $('body section').hasClass('featured-banner') ){
      $('body').addClass('banner-section-enabled');
    }
    else {
      $('body').addClass('banner-section-disabled');
    }
  
  /*------------------------------------------------
                  SEARCH
  ------------------------------------------------*/
    $("#search .fa-search").click(function() {
        $("#search form").show();
        $(".search-contents").show();
        $("#content").hide();
    });

    $("#search .fa-close").click(function() {
        $("#search form").hide();
        $(".search-contents").hide();
        $("#content").show();
    });

    $(".found-results .fa-close").click(function() {
        $(".found-results").fadeOut();
    });

    $("#search .search-field").focus(function() {
        $(".loading-search-results").show();
        $(".loader-search-dots").hide();
    });

    $(document).keyup(function(e) {
      if (e.keyCode === 27) {
        $("#search form").hide();
        $(".search-contents").hide();
        $("#content").show();
      }
    });
  /*------------------------------------------------
                  SLIDERS
  ------------------------------------------------*/
    var $easing = $('#main-slider .regular').data('effect');

    $('#main-slider .regular').slick({
     cssEase: $easing
    });

  /*------------------------------------------------
                  SLIDER AND BANNER DISABLED
  ------------------------------------------------*/ 
  if( $('body section').hasClass('featured-slider') ) {
    $('body').addClass('slider-banner-enabled');
  } 

  else if ( $('body section').hasClass('featured-banner') ) {
    $('body').addClass('slider-banner-enabled');
  }
  else {
    $('body').addClass('slider-banner-disabled');
  }

  /*------------------------------------------------------------
              FEATURES IMAGE ACTIVE
  -------------------------------------------------------------*/
    $(".features-list li:not(:last-child) a").hover(function() {
      $(".features-list li a").removeClass("active");
      $(this).addClass("active");

      if ($(".features-list li:nth-child(1) a").hasClass("active")) {
        $(".featured-images-list .feature-image").removeClass("active");
        $(".featured-images-list .feature-image:nth-child(1)").addClass("active");
      }
      else if ($(".features-list li:nth-child(2) a").hasClass("active")) {
        $(".featured-images-list .feature-image").removeClass("active");
        $(".featured-images-list .feature-image:nth-child(2)").addClass("active");
      }
      else if ($(".features-list li:nth-child(3) a").hasClass("active")) {
        $(".featured-images-list .feature-image").removeClass("active");
        $(".featured-images-list .feature-image:nth-child(3)").addClass("active");
      }
      else if ($(".features-list li:nth-child(4) a").hasClass("active")) {
        $(".featured-images-list .feature-image").removeClass("active");
        $(".featured-images-list .feature-image:nth-child(4)").addClass("active");
      }
      else if ($(".features-list li:nth-child(5) a").hasClass("active")) {
        $(".featured-images-list .feature-image").removeClass("active");
        $(".featured-images-list .feature-image:nth-child(5)").addClass("active");
      }
    });

  /*----END JQUERY---*/

  });
} )( jQuery );
