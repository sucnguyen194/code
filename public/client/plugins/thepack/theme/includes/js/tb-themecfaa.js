(function ($) {   
"use strict";
 
  var TbFtCarou = function ($scope, $) {

    $scope.find('.post-carousel').each(function () {

        var slider_elem = $(this);
        var settings = slider_elem.data('slick');

        slider_elem.not('.slick-initialized').slick({
          autoplay:settings['auto'],
          slidesToShow:settings['items'],
          dots:settings['dots'],
          arrows: settings['arrows'],  
          centerMode: settings['center'],
          prevArrow:'<i class="fa fa-chevron-left"></i>',
          nextArrow:'<i class="fa fa-chevron-right"></i>', 
          fade: settings['transition'],
          centerMode: settings['center'],
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow:settings['item_tab'],
                centerMode: false,
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow:1,
                centerMode: false,
              }
            }
          ] 

        });
    

    });    

  };

    var MasonBlog = function ($scope, $) {

        $scope.find('.ashelement-grid').each(function () {
            var slider_elem = $(this);

            if (slider_elem.hasClass('masonry-on')) {
                var container = slider_elem;
                container.imagesLoaded(function() {
                    container.masonry({
                        isAnimated: true
                    });
                });

            }

        }); 

    };

    var Header3 = function ($scope, $) {

        $scope.find('#header3').each(function () {
            var slider_elem = $(this);                
            var hclass = $scope.find('.offmenu');
            var hclassanim = $scope.find('.header-one');

            if ( hclass.hasClass('tbsticky-header') ) {
              var navscrollheight = hclass.offset().top + 200;
              $(window).on('scroll', function() {

                  if ($(window).scrollTop() < navscrollheight) {
                      hclass.addClass('absolut');
                      hclassanim.removeClass('is-fixed animated slideInDown');
                  } else {
                      hclass.removeClass('absolut');
                      hclassanim.addClass('is-fixed animated slideInDown');
                  }

              });        
            }

              $('.navbar-toggle,.nav-icons').on('click',function(){
                var target = $(this);
                if ( target.is( ".navbar-toggle" ) ) {
                  $('body').removeClass('menu-is-closed').addClass('menu-is-opened');
                } else {
                  $('body').removeClass('search-is-closed').addClass('search-is-opened');
                }
                
              });

              $('.close-menu, .click-capture').on('click', function(){
                $('body').removeClass('menu-is-opened search-is-opened').addClass('menu-is-closed search-is-closed');
                $('.menu-list ul').slideUp(300);
              });
                  
        }); 

    };

    var OpHead1 = function ($scope, $) {

        $scope.find('#opnav1').each(function () {  
          var slider_elem = $(this);         
            if (slider_elem.hasClass('stickyon')){

                 var c, currentScrollTop = 0,
                     navbar = $('#opnav1');

                 $(window).scroll(function () {
                    var a = $(window).scrollTop();
                    var b = navbar.height();
                   
                    currentScrollTop = a;
                   
                    if (c < currentScrollTop && a > b + b) {
                      navbar.addClass("scrollUp");
                      
                    } else if (c > currentScrollTop && !(a <= b)) {
                      navbar.removeClass("scrollUp");
                      
                    }
                    c = currentScrollTop;

                    if (a > (b+150)){
                      navbar.addClass("fixed");
                    } else {
                      navbar.removeClass("fixed");
                    }
                    
                });

            }

            $('a[href*="#"]').on("click", function(e) {
                $("html,body").animate( {
                    scrollTop: $($(this).attr("href")).offset().top - 100
                }
                , 500);
                e.preventDefault();
            }
            );
            $("#menu-toggle").on("click",function() {
                $("#menu-toggle").toggleClass("closeMenu");
                $("ul").toggleClass("showMenu");
                $("li").on("click", ()=> {
                    $("ul").removeClass("showMenu");
                    $("#menu-toggle").removeClass("closeMenu");
                }
                );
            }
            );               

        }); 

    };

    var Header4 = function ($scope, $) {

        $scope.find('#header-4').each(function () {  
          var slider_elem = $(this);         
          var settings = slider_elem.data('xld');
               
          $('.xldtap,.nav-icons').on('click',function(){
            var target = $(this);
            if ( target.is( ".xldtap" ) ) {
              $('body').removeClass('menu-is-closed').addClass('menu-is-opened');
            } else {
              $('body').removeClass('search-is-closed').addClass('search-is-opened');
            }
            
          });

          $('.close-menu, .click-capture').on('click', function(){
            $('body').removeClass('menu-is-opened search-is-opened').addClass('menu-is-closed search-is-closed');
            $('.menu-list ul').slideUp(300);
          });
          $('.scrollbar-macosx').css({'height': settings['mxscrollh']});
          var a = $(".menu-list");
          a.find(".menu-item-has-children > a").append("<span class='menu-icon'><i class='nst "+settings['picon']+"'></i></span>");

        }); 

    };

    var Header2 = function ($scope, $) {

        $scope.find('#header-2').each(function () {
            var slider_elem = $(this);
            var settings = slider_elem.data('xld');                 
            $('body').addClass('header2');
            $('a.nav-main-trigger').on('click', function () {
        
            $('#header-2').toggleClass('opened');
            $('.nav-main-trigger span').toggleClass('is-clicked');
            });
            var left = settings['wrapwidth']-settings['mbarwidth'];
            var onResize = function() {
                if($(window).width() < 1025) {
                    
                    $('#header-2').css("left", -left);
                  
                } else {
                    $('body').css("margin-left", settings['wrapwidth']); 
                }
            }

            $(document).ready(onResize);
            $(window).resize(onResize);

            var offsetTop = $('.menu-footer').outerHeight()+50;
            var mainHeight = $('.offsidebar').height();
            var heightOp = 550;
            $('.scrollbar-macosx').css({'height': heightOp});
            var a = $(".menu-list");
            a.find(".menu-item-has-children > a").append("<span class='menu-icon'><i class='nst "+settings['picon']+"'></i></span>");

        }); 

    };

    var CScrollBar = function ($scope, $) {

        $scope.find('.scrollbar-macosx').each(function () {
            var slider_elem = $(this);              
            var a = $(".menu-list");
            a.length && (a.children("li").addClass("menu-item-parent"), a.find(".menu-item-has-children > a").on("click", function(e) {
                e.preventDefault();
                $(this).toggleClass("opened");
                var n = $(this).next(".sub-menu"),
                    s = $(this).closest(".menu-item-parent").find(".sub-menu");
                a.find(".sub-menu").not(s).slideUp(250), n.slideToggle(250)
            }));
            
        }); 

    };

    var TbBlogSlide = function ($scope, $) { 

      var slider_elem = $scope.find('.simpost-carousel').eq(0);
      var settings = slider_elem.data('slick');  
      if (typeof settings === 'undefined'){
        return false;
      }
      $(".simpost-carousel").not('.slick-initialized').slick({
        autoplay:settings['auto'],
        autoplaySpeed:settings['speed'],
        speed:600,
        slidesToShow:settings['items'],
        dots:settings['dots'],
        arrows: settings['arrows'],
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: settings['item_tab']
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              arrows: false,
            }
          }
        ]       
      });

    };

    var TbBgSlide = function ($scope, $) { 

      var slider_elem = $scope.find('.bg_carousel').eq(0);
      var settings = slider_elem.data('xld');
 
      if (typeof settings === 'undefined'){
        return false;
      }

        if ( settings['arrow'] ){
          var parrow = '<span class="tbslick-prev"><i class="' + settings['picon']+ '"></i></span>';
          var narrow = '<span class="tbslick-next"><i class="' + settings['nicon']+ '"></i></span>';
        }

      $(".bg_carousel").not('.slick-initialized').slick({
        autoplay:settings['auto'],
        autoplaySpeed:settings['speed'],
        speed:600,
        slidesToShow:settings['item'],
        dots:settings['dot'],
        arrows: settings['arrow'],
          prevArrow:parrow,
          nextArrow:narrow,

        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: settings['item_tab']
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              arrows: false,
            }
          }
        ]       
      });

    };


    var TbPostShare = function ($scope, $) {

        $scope.find('.xld_share_post').each(function () {
             var togle = $(this).find('.xld_btn-toggle');
             var main = $(this);
             togle.on('click', function(e){
                main.toggleClass("show-secondary");
                e.preventDefault();
            });
             
        });

    };


    var Header1 = function ($scope, $) {

        $scope.find('.tbheader-aside').each(function () {

          $(".open-nav").on("click", function(e){
           e.preventDefault();
           $(".tb_mobile_navwrp").addClass("active");
           $(".tb_off_nav").addClass("active");
           $("body").addClass("menu-is-opened");
          })

          $(".close-nav").on("click", function(e){
           e.preventDefault();
           $(".tb_mobile_navwrp").removeClass("active");
           $(".tb_off_nav").removeClass("active");
           $("body").removeClass("menu-is-opened");
          })
             
        });

    };

    $(window).on('elementor/frontend/init', function () {

        if (elementorFrontend.isEditMode()) {

            elementorFrontend.hooks.addAction('frontend/element_ready/tb-header1.default', Header1);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb-header2.default', Header2);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb-header3.default', Header3);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb-header4.default', Header4);
            elementorFrontend.hooks.addAction('frontend/element_ready/widget', CScrollBar);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb-headerop1.default', OpHead1);
            elementorFrontend.hooks.addAction('frontend/element_ready/ae_blogmason.default', MasonBlog);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb_blog_slide.default', TbBlogSlide);
            elementorFrontend.hooks.addAction('frontend/element_ready/ae_blogbg.default', TbBgSlide);
            elementorFrontend.hooks.addAction('frontend/element_ready/ae_blgcro.default', TbFtCarou);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb_pshar.default', TbPostShare);

        }
        else {

            elementorFrontend.hooks.addAction('frontend/element_ready/tb-header1.default', Header1);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb-header2.default', Header2);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb-header3.default', Header3);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb-header4.default', Header4);
            elementorFrontend.hooks.addAction('frontend/element_ready/widget', CScrollBar);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb-headerop1.default', OpHead1);
            elementorFrontend.hooks.addAction('frontend/element_ready/ae_blogmason.default', MasonBlog);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb_blog_slide.default', TbBlogSlide);
            elementorFrontend.hooks.addAction('frontend/element_ready/ae_blogbg.default', TbBgSlide);
            elementorFrontend.hooks.addAction('frontend/element_ready/ae_blgcro.default', TbFtCarou);
            elementorFrontend.hooks.addAction('frontend/element_ready/tb_pshar.default', TbPostShare);

        }
    });    

})(jQuery);  