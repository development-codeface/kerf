(function ($) {
  
  "user strict";

  $(document).ready(function() {
  // preloader
  $(".loader").delay(700).animate({
    "opacity": "0"
  }, 700, function () {
      $(".loader").css("display", "none");
  });


  // Tooltip Js Start
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  // Tooltip Js End
  
// ============== Header Hide Click On Body Js Start ========
$('.navbar-toggler').on('click', function() {
	$('.body-overlay').toggleClass('show-overlay')
  }); 
  $('.body-overlay').on('click', function() {
	$('.navbar-toggler').trigger('click')
	$(this).removeClass('show-overlay');
  }); 
  // =============== Header Hide Click On Body Js End =========


  // nice-select
  $('.nice-select').niceSelect();
  background();

  // chosen-select
  var config = {
    '.chosen-select'           : {},
    '.chosen-select-deselect'  : {allow_single_deselect:true},
    '.chosen-select-no-single' : {disable_search_threshold:10},
    '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
    '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      jQuery(selector).chosen(config[selector]);
  }
});

$(window).on('load', function() {
})

/*---------------====================
     11.WOW Active
  ================-------------------*/

  if ($('.wow').length) {
    var wow = new WOW({
      boxClass: 'wow',
      // animated element css class (default is wow)
      animateClass: 'animated',
      // animation css class (default is animated)
      offset: 0,
      // distance to the element when triggering the animation (default is 0)
      mobile: false,
      // trigger animations on mobile devices (default is true)
      live: true // act on asynchronously loaded content (default is true)

    });
    wow.init();
  }

//Create Background Image
function background() {
  var img = $('.bg_img');
  img.css('background-image', function () {
    var bg = ('url(' + $(this).data('background') + ')');
    return bg;
  });
}

  // var fixed_top = $(".header-section");
  // $(window).on("scroll", function(){
  //     if( $(window).scrollTop() > 300){  
  //         fixed_top.addClass("animated fadeInDown header-fixed");
  //     }
  //     else{
  //         fixed_top.removeClass("animated fadeInDown header-fixed");
  //     }
  // });

  // // navbar-click
  // $(".navbar li a").on("click", function () {
  //   var element = $(this).parent("li");
  //   if (element.hasClass("show")) {
  //     element.removeClass("show");
  //     element.find("li").removeClass("show");
  //   }
  //   else {
  //     element.addClass("show");
  //     element.siblings("li").removeClass("show");
  //     element.siblings("li").find("li").removeClass("show");
  //   }
  // });

  // scroll-to-top
  // var ScrollTop = $(".scrollToTop");
  // $(window).on('scroll', function () {
  //   if ($(this).scrollTop() < 500) {
  //       ScrollTop.removeClass("active");
  //   } else {
  //       ScrollTop.addClass("active");
  //   }
  // });

// Animate the scroll to top
// $(".scrollToTop").on("click", function(event) {
// 	event.preventDefault();
// 	$("html, body").animate({scrollTop: 0}, 300);
// });



//Banner Slider
var swiper = new Swiper('.banner-slider', {
  slidesPerView: 1,
  spaceBetween: 0,
  autoHeight:true,
  loop: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
 
 
  autoplay: {
    speed: 2000,
    delay: 3000,
  },
  speed: 2000,
  breakpoints: {
    991: {
      slidesPerView: 1,
    },
    767: {
      slidesPerView: 1,
    },
    575: {
      slidesPerView: 1,
    },
  }
});

// slider
var swiper = new Swiper('.client-slider', {
  slidesPerView: 2,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    speed: 2000,
    delay: 3000,
  },
  speed: 1000,
  breakpoints: {
    991: {
      slidesPerView: 1,
    },
    767: {
      slidesPerView: 1,
    },
    575: {
      slidesPerView: 1,
    },
  }
});

var swiper = new Swiper('.choose-slider', {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  autoplay: {
    speed: 2000,
    delay: 3000,
  },
  speed: 2000,
  breakpoints: {
    991: {
      slidesPerView: 1,
    },
    767: {
      slidesPerView: 1,
    },
    575: {
      slidesPerView: 1,
    },
  }
});

var swiper = new Swiper('.booking-slider', {
  slidesPerView: 5,
  spaceBetween: 30,
  loop: false,
  navigation: {
    nextEl: '.ruddra-next',
    prevEl: '.ruddra-prev',
  },
  autoplay: {
    speeds: 1000,
    delay: 2000,
  },
  speed: 1000,
  breakpoints: {
    1400: {
      slidesPerView: 4,
    },
    1199: {
      slidesPerView: 3,
    },
    991: {
      slidesPerView: 2,
    },
    767: {
      slidesPerView: 2,
    },
    575: {
      slidesPerView: 1,
    },
  }
});

var swiper = new Swiper('.brand-wrapper', {
  slidesPerView: 6,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    speeds: 1000,
    delay: 2000,
  },
  speed: 1000,
  breakpoints: {
    991: {
      slidesPerView: 2,
    },
    767: {
      slidesPerView: 2,
    },
    575: {
      slidesPerView: 2,
    },
  }
});

$('.faq-wrapper .faq-title').on('click', function (e) {
  var element = $(this).parent('.faq-item');
  if (element.hasClass('open')) {
    element.removeClass('open');
    element.find('.faq-content').removeClass('open');
    element.find('.faq-content').slideUp(300, "swing");
  } else {
    element.addClass('open');
    element.children('.faq-content').slideDown(300, "swing");
    element.siblings('.faq-item').children('.faq-content').slideUp(300, "swing");
    element.siblings('.faq-item').removeClass('open');
    element.siblings('.faq-item').find('.faq-title').removeClass('open');
    element.siblings('.taq-item').find('.faq-content').slideUp(300, "swing");
  }
});

// overview Tab
var tabWrapper = $('.overview-tab-wrapper'),
tabMnu = tabWrapper.find('.tab-menu li'),
tabContent = tabWrapper.find('.tab-cont > .tab-item');
tabContent.not(':nth-child(2)').fadeOut(10);
tabMnu.each(function (i) {
$(this).attr('data-tab', 'tab' + i);
});
tabContent.each(function (i) {
$(this).attr('data-tab', 'tab' + i);
});
tabMnu.on('click', function () {
var tabData = $(this).data('tab');
tabWrapper.find(tabContent).fadeOut(10);
tabWrapper.find(tabContent).filter('[data-tab=' + tabData + ']').fadeIn(10);
});
$('.tab-menu > li').on('click', function () {
var before = $('.tab-menu li.active');
before.removeClass('active');
$(this).addClass('active');
});

// add-class
$('.clearfix > li > a').on('click', function () {
  var before = $('.clearfix li a.active');
  before.removeClass('active');
  $(this).addClass('active');
});

})(jQuery);        