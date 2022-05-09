(function ($, elementor) {
   "use strict";

   var Instive = {

       init: function () {

           var widgets = {
              
               'instive-main-slider.default': Instive.Main_Slider,
               'instive-content-slider.default': Instive.Content_Slider,
               'instive-testimonial.default': Instive.Testimonial,
               'instive-team-slider.default': Instive.Team_Slider,
               'instive-post-slider.default': Instive.Post_Slider,
               'instive-insurance.default': Instive.instive_insurance,
               'instive-popup.default': Instive.instive_popup,
               'instive-client-logo.default': Instive.Client_Logo,
               'instive-quote-slider.default': Instive.Quote_Slider,
           };
           $.each(widgets, function (widget, callback) {
               elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
           });

       },
       
       Main_Slider: function ($scope) {

        var $container = $scope.find('.main-slider');

        var controls= JSON.parse($container.attr('data-controls'));
             
        var navShow = Boolean(controls.show_nav?true:false);
        var autoslide = Boolean(controls.auto_nav_slide?true:false);
        var dot_nav_show = Boolean(controls.dot_nav_show?true:false);
        var ts_slider_speed = parseInt(controls.ts_slider_speed);
        
        if ($container.length > 0) {
           $container.owlCarousel({
              items: 1,
              loop: true,
              autoplay: autoslide,
              nav: navShow,
              dots: dot_nav_show,
              autoplayTimeout: ts_slider_speed,
              autoplayHoverPause: true,
              mouseDrag: false,
              smartSpeed: 1100,
              navText: ['<i class="icon icon-left-arrow2">', '<i class="icon icon-right-arrow2">'],
              responsive: {
                 0: {
                    items: 1,
                    nav: false,
                 },
                 600: {
                    items: 1,
                    nav: false,
                 },
                 1000: {
                    nav: navShow,
                 }
              }
        
           });
        }
    },


  // content slider 
 Content_Slider: function ($scope) {
     var $container = $scope.find('.content-slider');
     var controls_data = $container.attr('data-controls');

     var autoslide = false;
     var navShow = true;
     var dot_nav_show = true;
        if(controls_data){
           var controls= JSON.parse($container.attr('data-controls'));
           var navShow = Boolean(controls.show_nav?true:false);
           var autoslide = Boolean(controls.auto_nav_slide?true:false);
           var dot_nav_show = Boolean(controls.dot_nav_show?true:false);
        }
   
     
     if ($container.length > 0) {
        $container.owlCarousel({
           items: 1,
           loop: true,
           autoplay: autoslide,
           nav: navShow,
           dots: dot_nav_show,
           autoplayHoverPause: true,
           mouseDrag: false,
           smartSpeed: 1100,
           animateOut: 'fadeOut',
           navText: ['<i class="icon icon-left-arrow2">', '<i class="icon icon-right-arrow2">'],
         });
     }
  },
    Post_Slider: function ($scope) {

        var $container = $scope.find('.blog-post');

        var controls= JSON.parse($container.attr('data-controls'));
             
        var navShow = Boolean(controls.show_nav?true:false);
        var autoslide = Boolean(controls.auto_nav_slide?true:false);
        var dot_nav_show = Boolean(controls.dot_nav_show?true:false);
        var ts_slider_speed = parseInt(controls.ts_slider_speed);
        
        if ($container.length > 0) {
           $container.owlCarousel({
              items: 2,
              loop: true,
              autoplay: autoslide,
              nav: navShow,
              dots: dot_nav_show,
              autoplayTimeout: ts_slider_speed,
              autoplayHoverPause: true,
              mouseDrag: false,
              smartSpeed: 1100,
              navText: ['<i class="icon icon-left-arrow2">', '<i class="icon icon-right-arrow2">'],
              responsive: {
                 0: {
                    items: 1,
                    nav: false,
                 },
                 600: {
                    items: 1,
                    nav: false,
                 },
                 1000: {
                    items: 2,
                    nav: navShow,
                 }
              }
        
           });
        }
       
  
    },

    instive_insurance: function ($scope) {

        var $container = $scope.find('.ts-service-slider');

        var controls_data = $container.attr('data-controls');

        var autoslide = false;
        var slide_count = '4';
        var dot_nav_show = true;
           if(controls_data){
              var controls= JSON.parse($container.attr('data-controls'));
              var dot_nav_show = Boolean(controls.dot_nav_show?true:false);
              var slide_count = parseInt(controls.item_count);
           }

        if ($container.length > 0) {
           $container.owlCarousel({
              items: slide_count,
              loop: true,
              autoplay: autoslide,
              dots: dot_nav_show,
              autoplayHoverPause: true,
              mouseDrag: true,
              smartSpeed: 1100,
             
              responsive: {
                 0: {
                    items: 1,
                    nav: false,
                 },
                 600: {
                    items: 2,
                    nav: false,
                 },
                 768: {
                    items: 3,
                 },
                 1000: {
                    items: slide_count,
                 }
              }
        
           });
        }
       
  
    },

    Testimonial: function ($scope) {

     var $container = $scope.find('.ts-testimonial-sync1');

     if ($('.testimonial-slider').length > 0) {
        var testimonial = $scope.find('.testimonial-slider');
        testimonial.owlCarousel({
           items: 1,
           mouseDrag: true,
           loop: true,
           touchDrag: true,
           autoplay:false,
           dots: true,
           center: true,
           autoplayTimeout: 5000,
           margin:0,
           autoplayHoverPause: true,
           smartSpeed: 1000,
        });
       
     }
     if ($('.ts-testimonial-slider').length > 0) {
        var testimonial = $scope.find('.ts-testimonial-slider');
        testimonial.owlCarousel({
           items: 5,
           mouseDrag: true,
           loop: true,
           touchDrag: true,
           autoplay:false,
           dots: true,
           center: true,
           autoplayTimeout: 5000,
           margin:0,
           autoplayHoverPause: true,
           smartSpeed: 1000,
           responsive: {
              0: {
                 items: 3,
              },
              600: {
                 items: 3,
              },
              1000: {
                 items: 5,
              }
           }
     
        });
       
     }

     if ($('.ts-testimonial-slider-three').length > 0) {
      
        var testimonialSlider = $scope.find('.ts-testimonial-slider-three');
        var owl = testimonialSlider.owlCarousel({
           items 	 : 1,
           center	   : true, 
           nav        : false,
           dots       : true,
           loop       : false,
           margin     : 10,
           dotsContainer: '.testimonial-controls',
           navText: ['<i class="fas fa-arrow-right"></i>','<i class="fas fa-arrow-left"></i>'],
        });
     
        $('.testimonial-thumb').on('click', 'li', function(e) {
           owl.trigger('to.owl.carousel', [$(this).index(), 300]);
        });  
       
     }
     
    },
     
    Team_Slider: function ($scope){
        var $container = $scope.find('.ts-team-slider');
        var controls= JSON.parse($container.attr('data-controls'));
           
        var navShow = Boolean(controls.show_nav?true:false);
        var autoslide = Boolean(controls.auto_nav_slide?true:false);
        var dot_nav_show = Boolean(controls.dot_nav_show?true:false);
        var ts_team_loop = Boolean(controls.ts_team_loop?true:false);
        var ts_slider_speed = parseInt(controls.ts_slider_speed);
        var ts_slider_item = parseInt(controls.ts_slider_item);

        if ($('.ts-team-slider').length > 0) {
           var team_slider = $scope.find('.ts-team-slider');
           team_slider.owlCarousel({
              items: ts_slider_item,
              mouseDrag: true,
              loop: ts_team_loop,
              touchDrag: true,
              nav: navShow,
              navText: ['<i class="icon icon-left-arrow2">', '<i class="icon icon-right-arrow2">'],
              autoplay:autoslide,
              dots: dot_nav_show,
              autoplayTimeout: ts_slider_speed,
              autoplayHoverPause: true,
              smartSpeed: 1000,
             responsive: {
              0: {
                 items: 1,
                 nav: false,
              },
              600: {
                 items: 2,
                 nav: false,
              },
              1000: {
                 items: ts_slider_item,
                 nav: navShow,
              }
           }
           });
        }
     },

     Quote_Slider: function ($scope){
        var $container1 = $scope.find('.instive-popup');
        $($container1).each(function(){
           $container1.magnificPopup({ 
              removalDelay: 300,
              type: 'inline',
              closeOnContentClick: false,
              midClick: true,
              callbacks: {
              beforeOpen: function() {
                 this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure' + this.st.el.attr('data-effect'));
              }
              },
           });
        });

        var $container = $scope.find('.ts-quote-slider');
        var controls= JSON.parse($container.attr('data-controls'));
           
        var navShow = Boolean(controls.show_nav?true:false);
        var autoslide = Boolean(controls.auto_nav_slide?true:false);
        var dot_nav_show = Boolean(controls.dot_nav_show?true:false);
        var ts_slider_speed = parseInt(controls.ts_slider_speed);
        var ts_slider_item = parseInt(controls.ts_slider_item);

        if ($('.ts-quote-slider').length > 0) {
           var quote_slider = $scope.find('.ts-quote-slider');
           quote_slider.owlCarousel({
              items: ts_slider_item,
              mouseDrag: true,
              loop: false,
              touchDrag: true,
              nav: navShow,
              navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
              autoplay:autoslide,
              dots: dot_nav_show,
              autoplayTimeout: ts_slider_speed,
              autoplayHoverPause: true,
              smartSpeed: 1000,
             responsive: {
              0: {
                 items: 1,
                 nav: false,
              },
              600: {
                 items: 2,
                 nav: false,
              },
              1000: {
                 items: ts_slider_item,
                 nav: navShow,
              }
           }
           });
        }
     },
     
     instive_popup: function ($scope) {
        var $container = $scope.find('.instive-popup');
           $container.magnificPopup({ 
              removalDelay: 300,
              type: 'inline',
              closeOnContentClick: false,
              midClick: true,
              callbacks: {
              beforeOpen: function() {
                 this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure' + this.st.el.attr('data-effect'));
              }
           },
           });
     },

     Client_Logo: function ($scope) {
        var $log_carosel = $scope.find('.elementskit-clients-slider');
        $log_carosel.each(function () {
           // //console.log($(this).data('right_icon'));
           var leftArrow = '<button type="button" class="slick-prev"><i class="icon icon-left-arrow2"></i></button>';

           var rightArrow = '<button type="button" class="slick-next"><i class="icon icon-right-arrow2"></i></button>';

           var slidestoshowtablet = $(this).data('slidestoshowtablet');
           var slidestoscroll_tablet = $(this).data('slidestoscroll_tablet');
           var slidestoshowmobile = $(this).data('slidestoshowmobile');
           var slidestoscroll_mobile = $(this).data('slidestoscroll_mobile');
           var arrow = $(this).data('show_arrow') === 'yes' ? true : false;
           var dot = $(this).data('show_dot') === 'yes' ? true : false;
           var autoPlay = $(this).data('autoplay') === 'yes' ? true : false;
           var centerMode = $(this).data('data-center_mode') === 'yes' ? true : false;

           $(this).not('.slick-initialized').slick({
              rtl: $(this).data('rtl') ? true : false,
              slidesToShow: ($(this).data('slidestoshow') !== 'undefined') ? $(this).data('slidestoshow') : 4,
              slidesToScroll: ($(this).data('slidestoscroll') !== 'undefined') ? $(this).data('slidestoscroll') : 4,
              autoplay: ($(this).data('autoplay') !== 'undefined') ? autoPlay : true,
              autoplaySpeed: ($(this).data('speed') !== 'undefined') ? $(this).data('speed') : 1000,
              arrows: ($(this).data('show_arrow') !== 'undefined') ? arrow : true,
              dots: ($(this).data('show_dot') !== 'undefined') ? dot : true,
              pauseOnHover: ($(this).data('pause_on_hover') == 'yes') ? true : false,
              prevArrow: ($(this).data('left_icon') !== 'undefined') ? '<button type="button" class="slick-prev"><i class="' + $(this).data('left_icon') + '"></i></button>' : leftArrow,
              nextArrow: ($(this).data('right_icon') !== 'undefined') ? '<button type="button" class="slick-next"><i class="' + $(this).data('right_icon') + '"></i></button>' : rightArrow,
              rows: ($(this).data('rows') !== 'undefined') ? $(this).data('rows') : 1,
              vertical: ($(this).data('vertical_style') == 'yes') ? true : false,
              infinite: ($(this).data('autoplay') !== 'undefined') ? autoPlay : true,
              responsive: [{
                    breakpoint: 1024,
                    settings: {
                       slidesToShow: slidestoshowtablet,
                       slidesToScroll: slidestoscroll_tablet,
                    }
                 },
                 {
                    breakpoint: 600,
                    settings: {
                       slidesToShow: slidestoshowtablet,
                       slidesToScroll: slidestoscroll_tablet
                    }
                 },
                 {
                    breakpoint: 480,
                    settings: {
                       arrows: false,
                       slidesToShow: slidestoshowmobile,
                       slidesToScroll: slidestoscroll_mobile
                    }
                 }
              ]

           });

        });
     },
     
     
   };
   $(window).on('elementor/frontend/init', Instive.init);
}(jQuery, window.elementorFrontend));


