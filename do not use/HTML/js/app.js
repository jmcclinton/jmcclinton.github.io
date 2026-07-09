/* Theme Name:Selfme - Responsive Personal Portfolio Template
   Author: Themesdesign
   Version: 1.0.0
   File Description: Main JS file of the template
*/
! function($) {
    "use strict";

    var SelfMeApp = function() {};

    SelfMeApp.prototype.initStickyMenu = function() {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 50) {
                $(".sticky").addClass("nav-sticky");
            } else {
                $(".sticky").removeClass("nav-sticky");
            }
        });
    },

    SelfMeApp.prototype.initSmoothLink = function() {
        $('.navbar-nav a').on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 0
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    },

    SelfMeApp.prototype.initScrollspy = function() {
        $("#navbarCollapse").scrollspy({
            offset: 20
        });
    },

    SelfMeApp.prototype.initcounterUp = function() {
        var a = 0;
        $(window).scroll(function() {
            var oTop = $('#counter').offset().top - window.innerHeight;
            if (a == 0 && $(window).scrollTop() > oTop) {
                $('.counter-value').each(function() {
                    var $this = $(this),
                        countTo = $this.attr('data-count');
                    $({
                        countNum: $this.text()
                    }).animate({
                            countNum: countTo
                        },

                        {

                            duration: 2000,
                            easing: 'swing',
                            step: function() {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function() {
                                $this.text(this.countNum);
                                //alert('finished');
                            }

                        });
                });
                a = 1;
            }
        });
    },

    SelfMeApp.prototype.initPortfolioFilter = function() {

        $(window).on('load', function () {
            //PORTFOLIO FILTER 
            var $container = $('.projects-wrapper');
            var $filter = $('#filter');
            // Initialize isotope 
            $container.isotope({
                filter: '*',
                layoutMode: 'masonry',
                animationOptions: {
                    duration: 750,
                    easing: 'linear'
                }
            });

            // Filter items when filter link is clicked
            $filter.find('a').on("click",function() {
                var selector = $(this).attr('data-filter');
                $filter.find('a').removeClass('active');
                $(this).addClass('active');
                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        animationDuration: 750,
                        easing: 'linear',
                        queue: false,
                    }
                });
                return false;
            });
        });
        
    },    

    SelfMeApp.prototype.initMagnificPopup = function() {
        $('.mfp-image').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-fade',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            }
        });
        $('.video-play-icon-trigger').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    },

    SelfMeApp.prototype.initTestimonial = function() {
        $("#testi").owlCarousel({
            autoPlay: 3000,
            stopOnHover: true,
            navigation: false,
            paginationSpeed: 1000,
            goToFirstSpeed: 2000,
            singleItem: true,
            autoHeight: true
        });
    },

    SelfMeApp.prototype.init = function() {
        this.initStickyMenu();
        this.initSmoothLink();
        this.initScrollspy();
        this.initcounterUp();
        this.initPortfolioFilter();
        this.initMagnificPopup();
        this.initTestimonial();
    },
    //init
    $.SelfMeApp = new SelfMeApp, $.SelfMeApp.Constructor = SelfMeApp
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.SelfMeApp.init();
}(window.jQuery);