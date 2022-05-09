jQuery(function($) {


    $(document).on('click', '.ash_loadmore:not(.disabled)', function(event) {

        var me = $(this);
        wa_load_posts(me);

    });

  $.fn.timeline = function() {
    var selectors = {
      id: $(this),
      item: $(this).find(".timeline-item"),
      activeClass: "timeline-item--active",
      img: ".featured-img"
    };
    selectors.item.eq(0).addClass(selectors.activeClass);
    selectors.id.css(
      "background-image",
      "url(" +
        selectors.item
          .first()
          .find(selectors.img)
          .attr("src") +
        ")"
    );
    var itemLength = selectors.item.length;
    $(window).scroll(function() {
      var max, min;
      var pos = $(this).scrollTop();
      selectors.item.each(function(i) {
        min = $(this).offset().top;
        max = $(this).height() + $(this).offset().top;
        var that = $(this);
        if (i == itemLength - 2 && pos > min + $(this).height() / 2) {
          selectors.item.removeClass(selectors.activeClass);
          selectors.id.css(
            "background-image",
            "url(" +
              selectors.item
                .last()
                .find(selectors.img)
                .attr("src") +
              ")"
          );
          selectors.item.last().addClass(selectors.activeClass);
        } else if (pos <= max - 40 && pos >= min) {
          selectors.id.css(
            "background-image",
            "url(" +
              $(this)
                .find(selectors.img)
                .attr("src") +
              ")"
          );
          selectors.item.removeClass(selectors.activeClass);
          $(this).addClass(selectors.activeClass);
        }
      });
    });
  };

    function wa_load_posts(me) {

        var button = me.parent().parent();
        var cat = button.find('.current').data('id');
        var posts = button.data('posts');
        var template = button.data('template');
        var meta = button.data('meta');
        var thumb = button.data('thumb');
        var para = button.data('para');
        var excerpt = button.data('excerpt');
        var container = me.parent().prev();
        var dir = me.data('dir');
        
        var ajmx = button.find('.xyz').data('max');
        var disabled = me;

        if (dir === 'more') {
            container.addClass("loading_bg");
        } else {
          container.append('<div class="load-wrap"><div class="loader"></div></div>');  
        }
        if (ajmx){
            var max_paged = button.find('.xyz').data('max');
        } else {
           var max_paged = button.data('max'); 
        }

        data = {
            'action': 'loadmore',
            'page': misha_loadmore_params.current_page,
            'posts': posts,
            'cat': cat,
            'thumb': thumb,
            'meta': meta,
            'excerpt': excerpt,
            'template': template,
            'dir': dir,
        };

        $.ajax({
            url: misha_loadmore_params.ajaxurl, 
            data: data,
            type: 'POST',
            success: function(data) {
 
                if (data) {
                    if (dir === 'more') {
                        container.append(data);
                        container.removeClass("loading_bg");
                    } else {
                        container.html(data);
                        
                        $('html, body').animate({
                            scrollTop: button.offset().top - 20
                        }, 'slow');

                    }

                    if (dir === 'nxt' || dir === 'more') {
                        misha_loadmore_params.current_page++;
                    }

                    if (dir === 'prev') {
                        misha_loadmore_params.current_page--;
                    }

                    button.attr('data-cpag', misha_loadmore_params.current_page);

                    if (misha_loadmore_params.current_page <= 1) {
                        disabled.addClass('disabled');
                    } else {
                        disabled.prev().removeClass('disabled');
                    }

                    if (misha_loadmore_params.current_page == max_paged) {
                        disabled.addClass('disabled');
                    } else {
                        disabled.next().removeClass('disabled');
                    }

                }
            },

        });

    }


    $(document).on('click', '.cat_tab:not(.current)', function(event) {
        var me = $(this);
        $(this).addClass("current").siblings().removeClass("current");
        wa_tab_cat(me);
    }); 

  function wa_tab_cat(me) {
        var cat_id = me.data('id');
        var container = me.parent().next();
        var rooty = me.parent().parent();
        var thumb = rooty.data('thumb');
        var posts = rooty.data('posts');
        var template = rooty.data('template');
        var excerpt = rooty.data('excerpt');
        container.append('<div class="load-wrap"><div class="loader"></div></div>');
        rooty.attr('data-catid',cat_id);
 
        data = {
            'action':'tabcat',
            'catid':cat_id,
            'thumb':thumb,
            'template': template,
            'excerpt': excerpt,
            'posts':posts,
            'posts': posts,
            'page': '1',
        }; 
        $.ajax({
            url: misha_loadmore_params.ajaxurl, 
            data: data,
            type: 'POST',
            success: function(data) {
                container.removeClass('loader');              
                if (data) {
                    container.html(data);
                    var max = container.find('.xyz').data('max');
                    rooty.attr('data-max', max);
                    misha_loadmore_params.current_page='1';

                    if ('1' == max) {
                        rooty.find('.ash_loadmore').addClass('disabled');
                    } else {
                        rooty.find('.ash_loadmore').removeClass('disabled');
                    }

                }
            },


        });

    }
  
});