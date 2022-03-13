gsap.registerPlugin(ScrollTrigger);
document.addEventListener("DOMContentLoaded", function (event) {
  window.scrollTo(0, 0);
});

/*	-----------------------------------------------------------------------------
  SMOOTH SCROLL START
--------------------------------------------------------------------------------- */
function initScroll() {
  new SmoothScroll(document, 20, 10);
  // new SmoothScroll(document.getElementById("quiz_popup_content"), 20, 12);
}

var pos = 0;

function SmoothScroll(target, speed, smooth) {
  if (target === document)
    target =
      document.scrollingElement ||
      document.documentElement ||
      document.body.parentNode ||
      document.body; // cross browser support for document scrolling

  var moving = false;
  var frame =
    target === document.body && document.documentElement
      ? document.documentElement
      : target; // safari is the new IE

  target.addEventListener("mousewheel", scrolled, { passive: false });
  target.addEventListener("DOMMouseScroll", scrolled, { passive: false });

  function scrolled(e) {
    e.preventDefault(); // disable default scrolling

    var delta = normalizeWheelDelta(e);

    pos += -delta * speed;
    pos = Math.max(
      0,
      Math.min(pos, target.scrollHeight + 20 - frame.clientHeight)
    ); // limit scrolling

    if (!moving) update();
  }

  function normalizeWheelDelta(e) {
    if (e.detail) {
      if (e.wheelDelta)
        return (e.wheelDelta / e.detail / 40) * (e.detail > 0 ? 1 : -1);
      // Opera
      else return -e.detail / 3; // Firefox
    } else return e.wheelDelta / 120; // IE,Safari,Chrome
  }

  function update() {
    moving = true;

    var delta = (pos - target.scrollTop) / smooth;

    target.scrollTop += delta;

    if (Math.abs(delta) > 0.5) requestFrame(update);
    else moving = false;
  }

  var requestFrame = (function () {
    // requestAnimationFrame cross browser
    return (
      window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimationFrame ||
      function (func) {
        window.setTimeout(func, 1000 / 50);
      }
    );
  })();
}

/*	-----------------------------------------------------------------------------
  SMOOTH SCROLL END
--------------------------------------------------------------------------------- */

/*	-----------------------------------------------------------------------------
  BEFORE ENTER
--------------------------------------------------------------------------------- */

(function ($) {
  function beforeEnterFunctions() {
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
      return html.replace(
        /\S/g,
        '<div class="word_wrap"><span>$&</span></div>'
      );
    });

    $(".image_stack .single_image_wrap").each(function () {
      $(".single_pagination").last().clone().appendTo(".images_pagination");
    });

    /*	-----------------------------------------------------------------------------
      MARQUEE TEXT
    --------------------------------------------------------------------------------- */
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

    var vmarquees = $(".vmarquee");
    gsap.to(vmarquees, { opacity: 1 });
    var windowWidth = $(window).width();
    vmarquees.each(function () {
      let vmarquee = $(this);
      var vmarqueeContainer = vmarquee.parent();
      var w = vmarquee.find("p").width() + 20;

      if (windowWidth < 1023) {
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
      } else {
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
      "(min-width: 800px)": function () {
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
              onEnter: function () {
                container.addClass(className);
              },
              onLeaveBack: function () {
                container.removeClass(className);
              },
            },
          });
        });
      },

      // mobile
      "(max-width: 799px)": function () {
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
      },

      // all
      all: function () {
        let animationTrigger = $(".fadein_wrap");

        animationTrigger.each(function () {
          let trigger = $(this);

          gsap.to(
            {},
            {
              scrollTrigger: {
                trigger: trigger,
                start: "top 75%",
                onEnter: function () {
                  $(trigger).addClass("in-view");
                },
              },
            }
          );
        });

        const headlineTriggers = gsap.utils.toArray(
          ".letter_wrap:not(.main_headline)"
        );

        headlineTriggers.forEach((trigger) => {
          var letter = trigger.querySelectorAll("span");

          gsap.from(letter, {
            opacity: 0,
            xPercent: 100,
            ease: Expo.inOut,
            scrollTrigger: {
              trigger: trigger,
              start: "top 75%",
            },
          });
        });

        gsap.from(".featured_artist_content", {
          opacity: 0,
          y: 40,
          scrollTrigger: {
            trigger: ".featured_artist_content",
            start: "top 75%",
          },
        });
      },
    });

    setTimeout(() => {
      ScrollTrigger.getAll().forEach((st) => st.refresh());
    }, 1000);
  }

  $(document).on("ready", function () {

    $('.featured_artist_slider').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3
    });

    function AddReadMore() {
      //This limit you can set after how much characters you want to show Read More.
      var carLmt = 280;
      // Text to show when text is collapsed
      var readMoreTxt = "... Read More";
      // Text to show when text is expanded
      var readLessTxt = " Read Less";
  
  
      //Traverse all selectors with this class and manupulate HTML part to show Read More
      $(".addReadMore").each(function() {
          if ($(this).find(".firstSec").length)
              return;
  
          var allstr = $(this).text();
          if (allstr.length > carLmt) {
              var firstSet = allstr.substring(0, carLmt);
              var secdHalf = allstr.substring(carLmt, allstr.length);
              var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
              $(this).html(strtoadd);
          }
      });

      //Read More and Read Less Click Event binding
      $(document).on("click", ".readMore,.readLess", function() {
          $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
      });
    }

    AddReadMore();

    $(".buttons_holder .big_button").hover(
      function () {
        var i = $(this).index();
        $(".home_wrap .image_holder img").eq(i).addClass("active");
        $(".landing_popup").addClass("transparent");
      },
      function () {
        $(".home_wrap .image_holder img").removeClass("active");
        $(".landing_popup").removeClass("transparent");
      }
    );

    $(".landing_popup .big_button").on("click", function () {
      var i = $(this).index();

      $(".home_wrap .image_holder img").eq(i).addClass("clicked");
      $(".landing_popup_wrap").fadeOut("slow");

      $("body").removeClass("no_scroll");

      $("nav ul li").eq(i).addClass("active");
    });

    $("header nav ul li a").on("click", function () {
      $("nav ul li").removeClass("active");
      $(this).parent().addClass("active");
    });
  });

  /*	-----------------------------------------------------------------------------
  BARBA
--------------------------------------------------------------------------------- */

  function leave() {
    var letters = $(".letter_wrap .word_wrap span");
    var bgImg = $(".home_wrap .hero_wrap .image_holder img");

    var tl = gsap.timeline();
    tl.set(bgImg, { transition: "none" });
    gsap.to(letters, { xPercent: 100, opacity: 0 });
    tl.to(bgImg, { opacity: 0 });
    ScrollTrigger.getAll().forEach((st) => st.kill());
  }

  function enter() {
    var letters = $(".letter_wrap .word_wrap span");
    var bgImg = $(".home_wrap .hero_wrap .image_holder img");

    var tl = gsap.timeline();
    tl.set(bgImg, { transition: "none" });
    gsap.from(letters, { xPercent: 100, opacity: 0 });
    tl.from(bgImg, { opacity: 0 });
  }

  function indexLeave() {
    var tl = gsap.timeline();

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
  }

  function indexEnter() {
    var letters = $(".letter_wrap .word_wrap span");
    var content = $(".home_wrap .hero_wrap .hero_content");
    gsap.from(letters, { xPercent: 100, opacity: 0 });
    gsap.from(content, { opacity: 0 });
  }

  function delay(n) {
    n = n || 2000;
    return new Promise((done) => {
      setTimeout(() => {
        done();
      }, n);
    });
  }
  barba.init({
    sync: true,

    transitions: [
      {
        name: "home",
        from: { namespace: ["home"] },
        to: { namespace: ["template"] },
        async leave(data) {
          const done = this.async();

          indexLeave();
          await delay(650);
          done();
        },
        async beforeEnter() {
          beforeEnterFunctions();
        },
        async enter() {
          indexEnter();
        },
      },
      {
        name: "template",
        to: { namespace: ["template"] },
        async leave(data) {
          const done = this.async();
          window.scrollTo(0, 0);
          leave();
          await delay(650);
          done();
        },

        async beforeEnter() {
          beforeEnterFunctions();
        },

        async enter(data) {
          enter();
        },
      },
      {
        async once(data) {
          if (
            document.body.classList.contains("page-template-tmplt-collector")
          ) {
            document
              .querySelector("nav ul li:nth-child(1)")
              .classList.add("active");
          } else if (
            document.body.classList.contains("page-template-tmplt-artist")
          ) {
            document
              .querySelector("nav ul li:nth-child(2)")
              .classList.add("active");
          } else if (
            document.body.classList.contains("page-template-tmplt-business")
          ) {
            document
              .querySelector("nav ul li:nth-child(3)")
              .classList.add("active");
          }
          beforeEnterFunctions();
          initScroll();
        },
      },
    ],
  });
  barba.hooks.afterLeave((data) => {
    var nextHtml = data.next.html;
    var response = nextHtml.replace(
      /(<\/?)body( .+?)?>/gi,
      "$1notbody$2>",
      nextHtml
    );
    var bodyClasses = $(response).filter("notbody").attr("class");
    $("body").attr("class", bodyClasses);
  });

  barba.hooks.beforeOnce((data) => {});

  barba.hooks.afterEnter((data) => {});
})(jQuery);
