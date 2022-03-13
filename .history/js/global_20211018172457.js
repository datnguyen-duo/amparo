(function ($) {
$(document).on("ready", function () {
  gsap.registerPlugin(ScrollTrigger);
});

$(window).on("beforeunload", function () {
  $(window).scrollTop(0);
});

/*	-----------------------------------------------------------------------------
  SMOOTH SCROLL START
--------------------------------------------------------------------------------- */
function initScroll() {
  new SmoothScroll(document, 30, 12);
  // new SmoothScroll(document.getElementById("quiz_popup_content"), 20, 12);
}

var pos = 0;

setTimeout(function(){
  pos = $(document).scrollTop();
}, 500)

function SmoothScroll(target, speed, smooth) {
  if (target === document)
      target = (document.scrollingElement ||
          document.documentElement ||
          document.body.parentNode ||
          document.body) // cross browser support for document scrolling

  var moving = false
  var frame = target === document.body &&
      document.documentElement ?
      document.documentElement :
      target // safari is the new IE

  target.addEventListener('mousewheel', scrolled, { passive: false })
  target.addEventListener('DOMMouseScroll', scrolled, { passive: false })

  function scrolled(e) {
      e.preventDefault(); // disable default scrolling

      var delta = normalizeWheelDelta(e)

      pos += -delta * speed
      pos = Math.max(0, Math.min(pos, target.scrollHeight + 20 - frame.clientHeight)) // limit scrolling

      if (!moving) update()
  }

  function normalizeWheelDelta(e) {
      if (e.detail) {
          if (e.wheelDelta)
              return e.wheelDelta / e.detail / 40 * (e.detail > 0 ? 1 : -1) // Opera
          else
              return -e.detail / 3 // Firefox
      } else
          return e.wheelDelta / 120 // IE,Safari,Chrome
  }

  function update() {
      moving = true

      var delta = (pos - target.scrollTop) / smooth

      target.scrollTop += delta

      if (Math.abs(delta) > 0.5)
          requestFrame(update)
      else
          moving = false
  }

  var requestFrame = function() { // requestAnimationFrame cross browser
      return (
          window.requestAnimationFrame ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          window.oRequestAnimationFrame ||
          window.msRequestAnimationFrame ||
          function(func) {
              window.setTimeout(func, 1000 / 50);
          }
      );
  }()
}

/*	-----------------------------------------------------------------------------
  SMOOTH SCROLL END
--------------------------------------------------------------------------------- */

$(document).on("ready", function () {
  initScroll();

  $("a[href^='#']").click(function(e) {
      e.preventDefault();
      pos = $($(this).attr('href')).offset().top;
      
      $('html, body').animate({
          scrollTop: $($(this).attr('href')).offset().top
      }, 1000);
  });

  $(".buttons_holder .big_button").hover(
    function() {
      var i = $(this).index()
      $(".home_wrap .image_holder img").eq(i).addClass("active")
      $(".landing_popup").addClass("transparent")
    },
    function() {
      $(".home_wrap .image_holder img").removeClass("active")
      $(".landing_popup").removeClass("transparent")
    }
  )

  $(".landing_popup .big_button:not(.null)").on("click", function () {
    var i = $(this).index()

    $(".home_wrap .image_holder img").eq(i).addClass("clicked")
    $(".landing_popup_wrap").fadeOut("slow");

    $("body").removeClass("no_scroll");

    var tl = gsap.timeline({
      onComplete: function () {
        // console.log("complete");
      },
    });

    let hero = $(".hero_wrap");
    let heroContent = $(".hero_content");
    let heroButtons = $(".hero_buttons");
    let text = $(".hero_content .word_wrap span");
    let body = $("body, html");

    tl.to(hero, { top: 0, width: "100%" });
    tl.to(text, { x: "0%", opacity: 1, duration: 0.1 });
    tl.to(heroContent, { opacity: 1 });
    tl.to(heroButtons, { opacity: 1 });
    tl.to(body, { overflow: "initial" });
  });

  $(".letter_wrap").each(function () {
    var words = jQuery(this).text().split(" ");
    jQuery(this)
      .empty()
      .html(function () {
        for (i = 0; i < words.length; i++) {
          if (i == 0) {
            jQuery(this).append(
              '<div class="single_word">' + words[i] + "</div>"
            );
          } else {
            jQuery(this).append(
              ' <div class="single_word">' + words[i] + "</div>"
            );
          }
        }
      });
  });

  $(".single_word").html(function (index, html) {
    return html.replace(/\S/g, '<div class="word_wrap"><span>$&</span></div>');
  });

  $(".image_stack .single_image_wrap").each(function () {
    $('.single_pagination').last().clone().appendTo( ".images_pagination" );
  });

  /*	-----------------------------------------------------------------------------
  quizz logic
  --------------------------------------------------------------------------------- */
  // setTimeout(function(){
  //   $('.single_pagination').first().addClass('active');
  // }, 1000)

  // var url_string = window.location.href; //window.location.href
  // var url = new URL(url_string);
  // var paramValue = url.searchParams.get("quizz");

  // var stackImagesIntro = gsap.timeline({
  //   paused:true, 
  //   onComplete: function () {
  //     $(".image_stack .single_image_wrap").addClass('intro_done');
  //   },
  // });

  // let singleImage = $(".single_image_wrap");
  // let quiz_popup = $(".quiz_popup");
  // let quiz_popup_content = $(".quiz_popup_content");
  
  // stackImagesIntro.set(quiz_popup, {css:{zIndex:999}})
  // stackImagesIntro.to(quiz_popup, { visibility: 'visible', height: '100vh', duration: 0.7, ease: "power2.inOut" });
  // stackImagesIntro.to(quiz_popup_content, { visibility: 'visible', opacity: 1, duration: 0.7, ease: "power2.inOut" });
  // stackImagesIntro.to(singleImage, { opacity: 1, duration: 0.6, stagger: -0.2 });

  // $(".quiz_header_button, .quiz_contact_button").on("click", function () {
  //   stackImagesIntro.reverse();
  //   $('.quiz_popup').fadeOut();
  // })

  // $(".take_quiz").on("click", function () {
  //   var currentUrl = $(this).data('url');
  //   newUrl = '?quizz=true';
  //   window.history.pushState("", "", newUrl);
  //   $('.quiz_popup').fadeIn('fast');
  //   stackImagesIntro.play();
  //   var quizBackground = $('.single_image_wrap.active').data('color');
  //   $('.quiz_popup').css('background-color', quizBackground);
  // })

  // if (paramValue == 'true') {
  //   $(".take_quiz").trigger('click');
  //   $(".landing_popup .big_button:not(.null)").trigger('click')
  // }
  
  // $(".answer").on("click", function () {
  //   $('.single_pagination.active').last().next().addClass('active');
    
  //   $(".single_image_wrap.active").removeClass('new');
  //   let currentArt = $(".single_image_wrap.active");

  //   var removeImage = gsap.timeline({
  //     onComplete: function () {
  //       $(currentArt).remove();

  //       if($('.single_image_wrap').length < 1){
  //         $('.result_image').addClass('active');
  //         $('.quiz_popup').css('background-color', '#4b58aa');
  //         $('.results_marquee').addClass('active');
  //         $('.quiz_popup').addClass('final_result');
  //         $(".answer").fadeOut('fast');
  //         $(".left .left_description").addClass('result');
  //       }

  //       $(".image_stack .single_image_wrap").first().addClass('new');
  //       $(".image_stack .single_image_wrap").first().addClass('active');

  //       var quizBackground = $('.single_image_wrap.active').data('color');
  //       $('.quiz_popup').css('background-color', quizBackground);
  //     },
  //   });

  //   if($(this).hasClass('love')){
  //     removeImage.to(currentArt, { scale: 1.1, duration: 0.5 });
  //     removeImage.to(currentArt, { x: "250%",rotate: '180deg', duration: 0.4 });
  //   } else{
  //     removeImage.to(currentArt, { scale: 1.1, duration: 0.5 });
  //     removeImage.to(currentArt, { x: "-250%",rotate: '180deg', duration: 0.4 });
  //   }
  // });

  /*	-----------------------------------------------------------------------------
    end of quizz logic
  --------------------------------------------------------------------------------- */
});

/*	-----------------------------------------------------------------------------
  MARQUEE TEXT
--------------------------------------------------------------------------------- */
$(window).on("load", function () {
  var marquees = $(".marquee");
  gsap.to(marquees, { opacity: 1 });

  marquees.each(function () {
    let marquee = $(this);
    var marqueeContainer = marquee.parent();
    var w = marquee.width();
    var x = Math.round(marqueeContainer.width() / w) + 1;

    for (var i = 0; i < x; i++) {
      marquee.find("> *:first-of-type").clone().appendTo(marquee);
    }
    gsap.to(marquee, {
      duration: 2,
      ease: "none",
      x: "-=" + w,
      modifiers: {
        x: gsap.utils.unitize((x) => parseFloat(x) % w),
      },
      repeat: -1,
    });
  });
});

// $(window).on("load", function () {
//   var marquees = $(".results_marquee_content");
//   gsap.to(marquees, { opacity: 1 });

//   marquees.each(function () {
//     let marquee = $(this);
//     var marqueeContainer = marquee.parent();
//     var w = marquee.width();
//     var x = Math.round(marqueeContainer.width() / w) + 1;

//     for (var i = 0; i < x; i++) {
//       marquee.find("> *:first-of-type").clone().appendTo(marquee);
//     }
//     gsap.to(marquee, {
//       duration: 4,
//       ease: "none",
//       x: "-=" + w,
//       modifiers: {
//         x: gsap.utils.unitize((x) => parseFloat(x) % w),
//       },
//       repeat: -1,
//     });
//   });
// });

$(window).on("load", function () {
  var vmarquees = $(".vmarquee");
  gsap.to(vmarquees, { opacity: 1 });
  var windowWidth = $(window).width();
  vmarquees.each(function () {
    let vmarquee = $(this);
    var vmarqueeContainer = vmarquee.parent();
    var w = vmarquee.find("p").width() + 20;

    if( windowWidth < 1023){
      var x = Math.round(vmarqueeContainer.width() / w) + 1;

      for (var i = 0; i < x; i++) {
        vmarquee.find("> *:first-of-type").clone().appendTo(vmarquee);
      }
      gsap.to(vmarquee, {
        duration: 3,
        ease: "none",
        x: "-=" + w,
        modifiers: {
          x: gsap.utils.unitize((x) => parseFloat(x) % w),
        },
        repeat: -1,
      });
    } else{
      var x = Math.round(vmarqueeContainer.height() / w) + 1;
      for (var i = 0; i < x; i++) {
        vmarquee.find("> *:first-of-type").clone().appendTo(vmarquee);
      }
      gsap.to(vmarquee, {
        duration: 3,
        ease: "none",
        y: "-=" + w,
        modifiers: {
          y: gsap.utils.unitize((x) => parseFloat(x) % w),
        },
        repeat: -1,
      });
    }    
  });
});

$(window).on("scroll", function () {
  // fadeIn();
  var currentScroll = $(document).scrollTop() / 100;

  $(".first_section_content .headline_wrap img").css({
    transform: "rotate(" + currentScroll + "rad)",
  });
});

/*	-----------------------------------------------------------------------------
  SCROLL TRIGGERS
--------------------------------------------------------------------------------- */

ScrollTrigger.matchMedia({
	
	// desktop
	"(min-width: 800px)": function() {
		$(window).on("load", function () {
      let animationTrigger = $(".fadein_wrap");
    
      animationTrigger.each(function () {
        let trigger = $(this);
        let headlineClasssName = "in-view";
    
        gsap.to(animationTrigger, {
          scrollTrigger: {
            trigger: trigger,
            start: "top 60%",
            onEnter: function() {
              $(trigger).addClass("in-view")
            },
          },
        });
      });
    });

    $(window).on("load", function () {
      let sections = $(".home_wrap .second_section .single_box");
      let container = $(".home_wrap .second_section  .container");
      sections.each(function () {
        let trigger = $(this);
        let className = "bg-" + trigger.index();
    
        gsap.to(container, {
          scrollTrigger: {
            trigger: trigger,
            start: "top 40%",
            end: "bottom 20%",
            toggleClass: { targets: container, className: className },
          },
        });
      });
    });
  }, 
  
	// mobile
	"(max-width: 799px)": function() {
		$(window).on("load", function () {
      let animationTrigger = $(".fadein_wrap");
    
      animationTrigger.each(function () {
        let trigger = $(this);
        let headlineClasssName = "in-view";
    
        gsap.to(animationTrigger, {
          scrollTrigger: {
            trigger: trigger,
            start: "top 90%",
            onEnter: function() {
              $(trigger).addClass("in-view")
            },
          },
        });
      });
    });


    $(window).on("load", function () {
      let sections = $(".home_wrap .second_section .single_box");
      let container = $(".home_wrap .second_section  .container");
      sections.each(function () {
        let trigger = $(this);
        let className = "bg-" + trigger.index();
    
        gsap.to(container, {
          scrollTrigger: {
            trigger: trigger,
            start: "top 80%",
            end: "bottom 20%",
            toggleClass: { targets: container, className: className },
          },
        });
      });
    });
  }, 
  
	// all 
	"all": function() {
		// ScrollTriggers created here aren't associated with a particular media query,
		// so they persist.
	}
  
});

})(jQuery);
