(function ($) {
  "user strict";
  $(window).on('load', function () {
    $('.preloader').fadeOut(1000);
    var img = $('.bg_img');
    img.css('background-image', function () {
      var bg = ('url(' + $(this).data('background') + ')');
      return bg;
    });
    copyright();

  });
  $(".select-bar").select2();
  function copyright() {
    var copyRight = $('.fixed-copyright').height();
    $('body').css(`padding-bottom`, function(){
      return copyRight;
    })
  }
  $(document).ready(function () {
    //Menu Dropdown Icon Adding
    $(".menu>li>.submenu").parent("li").addClass("menu-item-has-children");
    // drop down menu width overflow problem fix
    $('ul').parent('li').hover(function () {
      var menu = $(this).find("ul");
      var menupos = $(menu).offset();
      if (menupos.left + menu.width() > $(window).width()) {
        var newpos = -$(menu).width();
        menu.css({
          left: newpos
        });
      }
    }); 
    $('.menu li a').on('click', function (e) {
      var element = $(this).parent('li');
      if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('li').removeClass('open');
        element.find('ul').slideUp(300, "swing");
      } else {
        element.addClass('open');
        element.children('ul').slideDown(300, "swing");
        element.siblings('li').children('ul').slideUp(300, "swing");
        element.siblings('li').removeClass('open');
        element.siblings('li').find('li').removeClass('open');
        element.siblings('li').find('ul').slideUp(300, "swing");
      }
    })
    // Scroll To Top
    var scrollTop = $(".scrollToTop");
    $(window).on('scroll', function () {
      if ($(this).scrollTop() < 500) {
        scrollTop.removeClass("active");
      } else {
        scrollTop.addClass("active");
      }
    });
    //header
    var header = $("header");
    $(window).on('scroll', function () {
      if ($(this).scrollTop() < 1) {
        header.removeClass("active");
      } else {
        header.addClass("active");
      }
    });
    //Click event to scroll to top
    $('.scrollToTop').on('click', function () {
      $('html, body').animate({
        scrollTop: 0
      }, 500);
      return false;
    });
    //Header Bar
    $('.header-bar').on('click', function () {
      $(this).toggleClass('active');
      $('.overlay').toggleClass('active');
      $('.menu-area').toggleClass('active');
    })
    $('.cross--btn').on('click', function () {
      $('.overlay').removeClass('active');
      $('.menu-area').removeClass('active');
      $('.header-bar').removeClass('active');
    })
    $('.overlay').on('click', function () {
      $('.menu-area, .overlay, .header-bar, .dashboard__sidebar').removeClass('active');
    });
    $('.faq__wrapper .faq__title').on('click', function (e) {
      var element = $(this).parent('.faq__item');
      if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('.faq__content').removeClass('open');
        element.find('.faq__content').slideUp(200, "swing");
      } else {
        element.addClass('open');
        element.children('.faq__content').slideDown(200, "swing");
        element.siblings('.faq__item').children('.faq__content').slideUp(200, "swing");
        element.siblings('.faq__item').removeClass('open');
        element.siblings('.faq__item').find('.faq__title').removeClass('open');
        element.siblings('.faq__item').find('.faq__content').slideUp(200, "swing");
      }
    });
    $('.banner-slider').owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      items: 1,
      autoplay: true,
      margin: 0,
  })
    $('.partner-slider').owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      items: 2,
      autoplay: true,
      margin: 30,
      responsive: {
        500: {
          items: 3
        },
        768: {
          items: 3
        },
        992: {
          items: 4
        },
        1200: {
          items: 6
        },
      }
    })
    $('.brances-slider').owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      items: 1,
      autoplay: true,
      margin: 30,
      responsive: {
        500: {
          items: 2
        },
        768: {
          items: 3
        },
        992: {
          items: 3
        },
        1200: {
          items: 4
        },
      }
    })
    
    
    var sync1 = $(".sync1");
    var sync2 = $(".sync2");
    var thumbnailItemClass = '.owl-item';
    var slides = sync1.owlCarousel({
      items: 1,
      autoplay: true,
      loop: true,
      margin: 0,
      mouseDrag: true,
      touchDrag: true,
      pullDrag: false,
      scrollPerPage: true,
      nav: false,
      dots: false,
    }).on('changed.owl.carousel', syncPosition);

    function syncPosition(el) {
      $owl_slider = $(this).data('owl.carousel');
      var loop = $owl_slider.options.loop;

      if (loop) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);
        if (current < 0) {
          current = count;
        }
        if (current > count) {
          current = 0;
        }
      } else {
        var current = el.item.index;
      }

      var owl_thumbnail = sync2.data('owl.carousel');
      var itemClass = "." + owl_thumbnail.options.itemClass;

      var thumbnailCurrentItem = sync2
        .find(itemClass)
        .removeClass("synced")
        .eq(current);
      thumbnailCurrentItem.addClass('synced');

      if (!thumbnailCurrentItem.hasClass('active')) {
        var duration = 500;
        sync2.trigger('to.owl.carousel', [current, duration, true]);
      }
    }
    var thumbs = sync2.owlCarousel({
        items: 3,
        loop: false,
        margin: 0,
        nav: false,
        dots: false,
        autoplay: true,
        responsive:{
            450:{
                items: 4,
            },
            600:{
                items: 5,
            },
        },
        onInitialized: function(e) {
          var thumbnailCurrentItem = $(e.target).find(thumbnailItemClass).eq(this._current);
          thumbnailCurrentItem.addClass('synced');
        },
      })
      .on('click', thumbnailItemClass, function(e) {
        e.preventDefault();
        var duration = 500;
        var itemIndex = $(e.target).parents(thumbnailItemClass).index();
        sync1.trigger('to.owl.carousel', [itemIndex, duration, true]);
      }).on("changed.owl.carousel", function(el) {
        var number = el.item.index;
        $owl_slider = sync1.data('owl.carousel');
        $owl_slider.to(number, 500, true);
    });
    sync1.owlCarousel();
    $( ".owl-prev").html('<i class="las la-angle-left"></i>');
    $( ".owl-next").html('<i class="las la-angle-right"></i>');
    $( "#datepicker" ).datepicker();
  });
})(jQuery);