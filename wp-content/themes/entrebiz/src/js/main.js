(function ($) {

    "use strict";

    $(document).ready(function () {
        SearchForm.init();
        LoadMore.init();
        MainMenu.init();
        StickyHeader.init();
        Sliders.init();
        Archives.init();
        Responsive.init();
        ScrollTo.init();
        FancyBoxGallery.init();
        Modernizer.init();
        SideBars.init();
        Animations.init();
        Paralax.init();
    });

    var Sliders = {
        init: function () {
            this.cover();
            this.prefooter();
        },

        cover: function () {
            var $slider = $('.rodller-cover-slider');

            if (empty($slider)) {
                return;
            }

            $slider.owlCarousel({
                rtl: rodller_options.rtl ? true : false,
                loop: false,
                items: 1,
                nav: true,
                autoplay: rodller_options.cover_autoplay === '1',
                autoplayTimeout: parseInt(rodller_options.cover_autoplay_time),
                navText: ['<i class="ion-ios-arrow-back"></i>', '<i class="ion-ios-arrow-forward"></i>']
            });
        },

        prefooter: function () {
            var $prefooter = $('#rodller-prefooter .instagram-pics');

            if (empty($prefooter)) {
                return;
            }

            $prefooter.addClass('owl-carousel');
            $prefooter.addClass('container');

            $prefooter.owlCarousel({
                rtl: rodller_options.rtl ? true : false,
                loop: true,
                items: 6,
                nav: true,
                navText: ['<i class="ion-ios-arrow-back"></i>', '<i class="ion-ios-arrow-forward"></i>'],
                autoWidth: false,
                center: true,
                fluidSpeed: 300,
                margin: 0,
                lazyLoad: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    729: {
                        items: 3
                    },
                    1024: {
                        items: 4
                    },
                    1200: {
                        items: 5
                    }
                }
            });
        }
    };

    var MainMenu = {

        init: function (){
            this.secondLevelOverflow();
            $(window).on('resize', this.secondLevelOverflow);
        },

        secondLevelOverflow: function (){

            if (window.matchMedia('(max-width: 992px)').matches) {
                return false;
            }

            var $subMenus = $('.rodller-main-menu .sub-menu');

            if ( empty($subMenus) ){
                return;
            }

            $.each($subMenus, function (){
                var $this = $(this),
                    $parent = $this.parent(),
                    thisLeft = $this.offset().left,
                    thisWidth = $this.width(),
                    $window = $(window),
                    windowWidth = $window.width();

                if((thisLeft + thisWidth > windowWidth) && !$this.hasClass('rodller-child-to-left')){
                    $parent.addClass('rodller-child-to-left');
                }
            });
        }
    };


    var StickyHeader = {

        lastTop: 0,

        init: function () {
            if (empty($('#rodller-sticky-header'))) {
                return false;
            }

            $(window).scroll(this.scrollCallback);
        },

        scrollCallback: function () {

            var $header = $('#rodller-main-header'),
                top = $(window).scrollTop();

            if (empty($header)) {
                return false;
            }

            var headerHeight = $header.height();

            if (StickyHeader.lastTop < top) { // scroll down
                if (headerHeight < top && !$header.hasClass('rodller-sticky-header-on')) {
                    $header.addClass('rodller-sticky-header-on');
                }
            }

            if (StickyHeader.lastTop > top) { // scroll up
                if (headerHeight > top && $header.hasClass('rodller-sticky-header-on')) {
                    $header.removeClass('rodller-sticky-header-on');
                }
            }

            StickyHeader.lastTop = top;
        }
    };

    var SideBars = {

        inResponsiveMenu: false,

        init: function () {
            $(window).on('load', this.sticky);
            $(window).on('resize', this.responsive);

            this.responsive();
        },

        sticky: function () {
            if (window.matchMedia('(max-width: 992px)').matches) {
                return false;
            }

            var adminBarHeight = !empty($('#wpadminbar')) ? $('#wpadminbar').height() : 0;
            var stickyHeaderHeight = !empty($('#rodller-sticky-header')) ? $('#rodller-sticky-header').height() : 0;

            $('.rodller-sticky-sidebar').stick_in_parent({
                parent: "aside",
                inner_scrolling: true,
                offset_top: 20 + adminBarHeight + stickyHeaderHeight
            });
        },

        responsive: function () {
            if (window.matchMedia('(max-width: 992px)').matches) {
                SideBars.moveSidebarToResponsiveMenu();
            } else {
                SideBars.moveSidebarToAside();
            }
        },

        moveSidebarToResponsiveMenu: function () {
            if (SideBars.inResponsiveMenu) {
                return;
            }

            var $widgets = $('#rodller-sidebar > .widget, .rodller-sticky-sidebar'),
                $responsiveMenu = $('#rodller-responsive-navigation');

            $widgets.appendTo($responsiveMenu);
            $(".rodller-sticky-sidebar").trigger("sticky_kit:detach");
            SideBars.inResponsiveMenu = true;
        },

        moveSidebarToAside: function () {
            if (!SideBars.inResponsiveMenu) {
                return;
            }

            var $widgets = $('#rodller-responsive-navigation > .widget, .rodller-sticky-sidebar'),
                $sidebar = $('#rodller-sidebar');

            $widgets.appendTo($sidebar);
            SideBars.sticky();
            SideBars.inResponsiveMenu = false;
        }
    };

    var SearchForm = {

        init: function () {
            $('body').on('click', '.rodller-searchform .rodller-searchform-opener', this.toggleSearchForm)
        },

        toggleSearchForm: function (e) {
            e.preventDefault();
            var $this = $(this),
                $search = $this.siblings('.rodller-search-input-wrapper'),
                left = $this.offset().left + $this.width() + 350,
                windowWidth = $(window).width();

            $search.removeClass('right');

            if (left > windowWidth) {
                $search.addClass('right');
            }

            $this.toggleClass('active');
            $search.toggleClass('active');
        }
    };

    var LoadMore = {

        working: false,
        done: false,
        window_push_obj: [{
            prev: window.location.href,
            next: '',
            offset: !empty($('#rodller-main > .rodller-posts:first-child')) ? $('#rodller-main > .rodller-posts:first-child').offset().top : 0,
            prev_title: window.document.title,
            next_title: window.document.title
        }],
        current: 0,
        lastScrollTop: 0,

        init: function () {
            $("body").on('click', '.rodller-load-more a', this.loadMoreClickCallBack);

            if (!empty($('.rodller-infinite-scroll'))) {
                $(window).scroll(this.infiniteScroll);
            }

            if (!empty($('.rodller-infinite-scroll')) || !empty($('.rodller-load-more'))) {
                $(window).scroll(this.onScrollPageNumInUrl);
            }
        },

        loadMoreClickCallBack: function (e) {

            e.preventDefault();

            LoadMore.loadMorePosts('.rodller-load-more > a');
        },

        infiniteScroll: function () {
            if (!empty($('.rodller-infinite-scroll')) && $(this).scrollTop() > ($('.rodller-infinite-scroll').offset().top) - $(this).height() - 200) {
                LoadMore.loadMorePosts('.rodller-infinite-scroll > a');
            }
        },

        loadMorePosts: function (elem) {

            if (LoadMore.working || LoadMore.done) {
                return false;
            }

            var start_url = window.location.href,
                prev_title = window.document.title,
                $elem = $(elem),
                nextURL = $elem.attr('href');

            LoadMore.working = true;

            LoadMore.showLoadMoreLoader();
            $("<div>").load(nextURL, function () {
                var $this = $(this),
                    $section = $('#rodller-main .rodller-posts'),
                    $newSection = $this.find('#rodller-main .rodller-posts'),
                    lastSectionCount = $section.data('count'),
                    sectionCount = !empty(lastSectionCount) ? lastSectionCount : 1;

                sectionCount++;
                $section.data('count', sectionCount);

                $newSection.imagesLoaded(function () {
                    var $newPosts = $newSection.find('article').hide().appendTo($section);
                    $newPosts.fadeIn(400);
                    if (!empty($('.rodller-posts .layout-a'))) {
                        $section.masonry('appended', $newPosts);
                    }

                    var next_title = $this.find('title').text(),
                        push_obj = {
                            prev: start_url,
                            next: nextURL,
                            offset: !empty($section.find('.rodller-post-' + sectionCount).first()) ? $section.find('.rodller-post-' + sectionCount).first().offset().top : 0,
                            prev_title: prev_title,
                            next_title: next_title
                        };

                    window.document.title = next_title;
                    window.history.pushState(push_obj, '', nextURL);

                    LoadMore.window_push_obj.push(push_obj);
                    var $newLoadMoreButton = $this.find(elem);

                    if (!empty($newLoadMoreButton)) {
                        $elem.attr('href', $newLoadMoreButton.attr('href'));
                    } else {
                        LoadMore.done = true;
                        $elem.fadeOut('fast', function () {
                            $elem.remove();
                        });
                    }
                    LoadMore.current++;
                    LoadMore.working = false;
                    LoadMore.hideLoadMoreLoader();
                    // Because of the sticky sidebar we need to trigger one scroll
                    $(document).trigger('scroll');
                });
            });
        },

        onScrollPageNumInUrl: function () {
            if ($('#rodller-main').isInViewport() && !empty($('#rodller-main > .rodller-posts'))) {
                var scrollTop = $(this).scrollTop();

                if (scrollTop > LoadMore.lastScrollTop) { // down scroll
                    if (!empty(LoadMore.window_push_obj[LoadMore.current + 1]) && LoadMore.window_push_obj[LoadMore.current + 1].offset < scrollTop) {
                        window.history.replaceState(LoadMore.window_push_obj[LoadMore.current + 1], '', LoadMore.window_push_obj[LoadMore.current + 1].next);
                        window.document.title = LoadMore.window_push_obj[LoadMore.current + 1].next_title;
                        LoadMore.current++;
                    }
                }

                if (scrollTop < LoadMore.lastScrollTop) { // up scroll
                    if (!$.isEmptyObject(LoadMore.window_push_obj[LoadMore.current]) && LoadMore.window_push_obj[LoadMore.current].offset > scrollTop) {
                        window.history.replaceState(LoadMore.window_push_obj[LoadMore.current], '', LoadMore.window_push_obj[LoadMore.current].prev);
                        window.document.title = LoadMore.window_push_obj[LoadMore.current].prev_title;
                        LoadMore.current--;
                    }
                }
                LoadMore.lastScrollTop = scrollTop;
            }
        },

        showLoadMoreLoader: function () {
            $('#rodller-pagination > a').slideUp('fast', function () {
                $('#rodller-pagination .spinner').fadeIn('fast');
            });
        },

        hideLoadMoreLoader: function () {
            $('#rodller-pagination .spinner').fadeOut('fast');
            if ($('#rodller-pagination').hasClass('rodller-load-more')) {
                $('#rodller-pagination > a').fadeIn('fast');
            }

            $(window).trigger('resize');
        }
    };

    var Archives = {
        init: function () {
            var layoutA = $('.rodller-posts .layout-a');

            if (empty(layoutA) || (layoutA.length < 2)) {
                return false;
            }

            $('body').imagesLoaded(function () {
                $('.rodller-posts').masonry();
                $(window).trigger('resize');
            });
        }
    };

    var Responsive = {

        init: function () {
            $('body').on('click', '#rodller-responsive-navigation-opener', this.responsiveMenuOpener);
            $('body').on('click', '#rodller-responsive-navigation a .rodller-responsive-menu-opener', this.subMenuOpener);
        },

        responsiveMenuOpener: function (e) {
            e.preventDefault();

            $('#rodller-responsive-navigation').toggleClass('rodller-responsive-navigation-active');
            $('body').toggleClass('rodller-lock');
            $(this).toggleClass('rodller-responsive-navigation-opened');
        },

        subMenuOpener: function (e) {
            e.preventDefault();

            var $this = $(this),
                $li = $this.closest('.menu-item-has-children'),
                $menu = $li.find('> .sub-menu');

            if (!$this.hasClass('rodller-active')) {
                $menu.slideDown('fast');
                $this.addClass('rodller-active');
            } else {
                $menu.slideUp('fast');
                $this.removeClass('rodller-active');
            }
        }
    };

    var ScrollTo = {

        init: function () {
            $("a[href*=\\#]").click(this.ahrefClickCallback);
        },

        ahrefClickCallback: function (e) {
            var $this = $(this),
                href = $this.attr('href'),
                hrefSplitted = href.split('#'),
                id = hrefSplitted.slice(-1),
                hash = '#' + id,
                $id = $(hash);

            if ((window.location.origin + window.location.pathname) !== hrefSplitted[0]) {
                return true;
            }

            if (empty($id)) {
                return true;
            }

            e.preventDefault();
            $('html, body').animate({
                scrollTop: ($id.offset().top - 100) + 'px'
            }, {
                duration: 600,
                done: function () {
                    $id.removeAttr('id');
                    window.location.hash = hash;
                    $id.attr('id', id);
                }
            });
        }
    };

    var FancyBoxGallery = {

        init: function () {
            $().fancybox({
                selector: '.wp-block-gallery li a, .rodller-entry-content .gallery .gallery-item a',
                caption: function (instance, item) {
                    if (item.type === 'image') {
                        return $(this).closest('figure').find('figcaption').html();
                    }
                }
            });
        }

    };

    var Modernizer = {

        init: function () {
            $('body').imagesLoaded(function () {
                objectFitImages('.obj-fit, #rodller-cover .rodller-cover-slider-item .rodller-cover-slider-item-img>a>img, .rodller-posts .layout-a .rodller-post-thumbnail>a>img, .rodller-cover-post img');
            });
        }

    };

    var Animations = {

        init: function() {
            setTimeout(Animations.animation, 300);
        },

        animation: function() {
            if ($('#rodller-primary').height() < $(window).height() ){
                return;
            }

            $('.zoom-out').attr('data-aos', 'zoom-out');
            $('.zoom-out').attr('data-aos-duration', 600);
            $('.zoom-out').attr('data-aos-offset', 200);

            $('.fade-from-left').attr('data-aos', 'fade-right');
            $('.fade-from-left').attr('data-aos-duration', 600);
            $('.fade-from-left').attr('data-aos-offset', 200);

            $('.fade-from-right').attr('data-aos', 'fade-left');
            $('.fade-from-right').attr('data-aos-duration', 600);
            $('.fade-from-right').attr('data-aos-offset', 200);

            $('.fade-from-down-slow').attr('data-aos', 'fade-up');
            $('.fade-from-down-slow').attr('data-aos-duration', 800);
            $('.fade-from-down-slow').attr('data-aos-offset', 200);

            $('.fade-from-down-fast').attr('data-aos', 'fade-up');
            $('.fade-from-down-fast').attr('data-aos-duration', 400);
            $('.fade-from-down-fast').attr('data-aos-offset', 200);

            $('.wp-block-media-text.fade-image-from-left .wp-block-media-text__media img').attr('data-aos', 'fade-left');
            $('.wp-block-media-text.fade-image-from-left .wp-block-media-text__media img').attr('data-aos-duration', 600);
            $('.wp-block-media-text.fade-image-from-left .wp-block-media-text__media img').attr('data-aos-offset', 200);

            $('.wp-block-media-text.fade-image-from-right .wp-block-media-text__media img').attr('data-aos', 'fade-right');
            $('.wp-block-media-text.fade-image-from-right .wp-block-media-text__media img').attr('data-aos-duration', 600);
            $('.wp-block-media-text.fade-image-from-right .wp-block-media-text__media img').attr('data-aos-offset', 200);

            $('.wp-block-media-text.fade-image-from-right .wp-block-media-text__content > *, .wp-block-media-text.fade-image-from-left .wp-block-media-text__content > *').attr('data-aos', 'fade-up');
            $('.wp-block-media-text.fade-image-from-right .wp-block-media-text__content > *, .wp-block-media-text.fade-image-from-left .wp-block-media-text__content > *').attr('data-aos-duration', 600);
            $('.wp-block-media-text.fade-image-from-right .wp-block-media-text__content > *, .wp-block-media-text.fade-image-from-left .wp-block-media-text__content > *').attr('data-aos-offset', 200);

            $('.single .rodller-entry-content > *').attr('data-aos', 'zoom-out');
            $('.single .rodller-entry-content > *').attr('data-aos-duration', 400);
            $('.single .rodller-entry-content > *').attr('data-aos-offset', 200);

            AOS.init();
        }
    };

    var Paralax = {
        init: function() {
            $('.paralax-image').each(function() {
                $(this).parallax({imageSrc: $(this).find('.rodller-container-image-wrap img').attr('src')});
            });
        }
    };

    /**
     * Checks if variable is empty or not
     *
     * @param variable
     * @returns {boolean}
     */
    function empty(variable) {

        if (typeof variable === 'undefined') {
            return true;
        }

        if (variable === 0 || variable === '0') {
            return true;
        }

        if (variable === null) {
            return true;
        }

        if (variable.length === 0) {
            return true;
        }

        if (variable === "") {
            return true;
        }

        if (variable === false) {
            return true;
        }

        if (typeof variable === 'object' && $.isEmptyObject(variable)) {
            return true;
        }

        return false;
    }

    $.fn.isInViewport = function () {

        var elementTop = $(this).offset().top,
            elementBottom = elementTop + $(this).outerHeight(),
            viewportTop = $(window).scrollTop(),
            viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

})(jQuery);

