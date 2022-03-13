document.addEventListener("DOMContentLoaded", function (event) {
  window.scrollTo(0, 0);
});

// /*	-----------------------------------------------------------------------------
//   SMOOTH SCROLL START
// --------------------------------------------------------------------------------- */
// function initScroll() {
//   new SmoothScroll(document, 20, 10);
//   // new SmoothScroll(document.getElementById("quiz_popup_content"), 20, 12);
// }

// var pos = 0;

// function SmoothScroll(target, speed, smooth) {
//   if (target === document)
//     target =
//       document.scrollingElement ||
//       document.documentElement ||
//       document.body.parentNode ||
//       document.body; // cross browser support for document scrolling

//   var moving = false;
//   var frame =
//     target === document.body && document.documentElement
//       ? document.documentElement
//       : target; // safari is the new IE

//   target.addEventListener("mousewheel", scrolled, { passive: false });
//   target.addEventListener("DOMMouseScroll", scrolled, { passive: false });

//   function scrolled(e) {
//     e.preventDefault(); // disable default scrolling

//     var delta = normalizeWheelDelta(e);

//     pos += -delta * speed;
//     pos = Math.max(
//       0,
//       Math.min(pos, target.scrollHeight + 20 - frame.clientHeight)
//     ); // limit scrolling

//     if (!moving) update();
//   }

//   function normalizeWheelDelta(e) {
//     if (e.detail) {
//       if (e.wheelDelta)
//         return (e.wheelDelta / e.detail / 40) * (e.detail > 0 ? 1 : -1);
//       // Opera
//       else return -e.detail / 3; // Firefox
//     } else return e.wheelDelta / 120; // IE,Safari,Chrome
//   }

//   function update() {
//     moving = true;

//     var delta = (pos - target.scrollTop) / smooth;

//     target.scrollTop += delta;

//     if (Math.abs(delta) > 0.5) requestFrame(update);
//     else moving = false;
//   }

//   var requestFrame = (function () {
//     // requestAnimationFrame cross browser
//     return (
//       window.requestAnimationFrame ||
//       window.webkitRequestAnimationFrame ||
//       window.mozRequestAnimationFrame ||
//       window.oRequestAnimationFrame ||
//       window.msRequestAnimationFrame ||
//       function (func) {
//         window.setTimeout(func, 1000 / 50);
//       }
//     );
//   })();
// }
// /*	-----------------------------------------------------------------------------
//   SMOOTH SCROLL END
// --------------------------------------------------------------------------------- */

function AddReadMore() {
  //This limit you can set after how much characters you want to show Read More.
  var carLmt = 210;
  // Text to show when text is collapsed
  var readMoreTxt = "Read More";
  // Text to show when text is expanded
  var readLessTxt = "Read Less";

  //Traverse all selectors with this class and manupulate HTML part to show Read More
  jQuery(".addReadMore").each(function () {
    if (jQuery(this).find(".firstSec").length) return;

    var allstr = jQuery(this).text();
    if (allstr.length > carLmt) {
      var firstSet =
        allstr.substring(0, carLmt) + '<span class="dots">...</span>';
      var secdHalf = allstr.substring(carLmt, allstr.length);
      var strtoadd =
        firstSet +
        "<span class='SecSec'>" +
        secdHalf +
        "</span><span class='readMore'  title='Click to Show More'>" +
        readMoreTxt +
        "</span><span class='readLess' title='Click to Show Less'>" +
        readLessTxt +
        "</span>";
      jQuery(this).html(strtoadd);
    }
  });
}

function swiperInit() {
  if (
    jQuery("body").hasClass("page-template-tmplt-artist") ||
    jQuery("body").hasClass("woocommerce-shop")
  ) {
    jQuery(".artist_slider").slick({
      arrows: false,
      slidesToShow: 1,
      centerMode: true,
    });
  }
  if (jQuery("body").hasClass("page-template-tmplt-business")) {
    jQuery(".business_slider").slick({
      arrows: false,
      slidesToShow: 1,
      centerMode: true,
    });
  }

  if (jQuery("body").hasClass("page-template-tmplt-collector")) {
    jQuery(".collector_slider").slick({
      arrows: false,
      slidesToShow: 1,
      centerMode: true,
    });
  }
}

/*	-----------------------------------------------------------------------------
  BEFORE ENTER
--------------------------------------------------------------------------------- */
(function ($) {
  function shopFilters() {
    if ($(window).width() > 1100) {
      $(".mobile_shop_filter").find("input").prop("disabled", true);
      $(".desktop_shop_filters").find("input").prop("disabled", false);
    } else {
      $(".mobile_shop_filter").find("input").prop("disabled", false);
      $(".desktop_shop_filters").find("input").prop("disabled", true);
    }
  }

  function artistsFilters() {
    if ($(window).width() > 1100) {
      $(".mobile_artist_filter").find("input").prop("disabled", true);
      $(".desktop_artist_filter").find("input").prop("disabled", false);
    } else {
      $(".mobile_artist_filter").find("input").prop("disabled", false);
      $(".desktop_artist_filter").find("input").prop("disabled", true);
    }
  }

  function woocomerce_cart() {
    var customSideCart = $(".custom_side_cart");
    var customSideCartOverlay = $(".custom_cart_overlay");
    var customSideCartOpener = $(".cart_opener");
    var bookableSingleProductPage = $(".single_booking_product_page_container");
    var checkOutPage = $(".woocommerce-checkout");

    function openSideCart() {
      customSideCart.addClass("active");
      customSideCartOverlay.fadeIn();
    }

    function closeSideCart() {
      customSideCart.removeClass("active");
      customSideCartOverlay.fadeOut();
    }

    customSideCartOpener.on("click", function () {
      openSideCart();
    });

    customSideCart.find(".close_cart").on("click", function () {
      closeSideCart();
    });

    customSideCartOverlay.on("click", function () {
      closeSideCart();
    });

    //Update items in shopping cart
    function updateShoppingCart(isItemAddedToCart, openCart = true) {
      var responseDiv = document.getElementById("cart_items_response");

      $.ajax({
        url: customSideCart.data("action"),
        data: {
          action: "updateshoppingcart",
          addedToCart: isItemAddedToCart,
        }, // form data
        type: "POST", // POST
        beforeSend: function (xhr) {},
        success: function (data) {
          responseDiv.innerHTML = data;
        },
        complete: function (xhr, status) {
          if (openCart) {
            openSideCart();
          }

          if (
            customSideCart.hasClass("checkout_page") &&
            !customSideCart.find(".items .item").length
          ) {
            window.location.href = "/";
          }
        },
      });

      $.ajax({
        url: customSideCart.data("action"),
        data: {
          action: "update_cart_total_items",
        }, // form data
        type: "POST", // POST
        beforeSend: function (xhr) {},
        success: function (data) {
          document.getElementById("cart_total_items_response").innerHTML =
            "(" + data + ")";
        },
      });
    }
    //Update items in shopping cart END

    //Event after adding to cart action
    $("body").on("added_to_cart", function () {
      updateShoppingCart(1);
    });
    //Event after adding to cart action END

    $("body").on("updated_checkout", function () {
      updateShoppingCart(0, false);
    });

    //Remove item from cart function
    customSideCart.on("click", ".remove_item", function (event) {
      event.preventDefault();
      let cartItemKey = $(this).data("target");
      $.ajax({
        url: $(".custom_side_cart").data("action"),
        data: {
          action: "woo_custom_remove_from_cart",
          cartItemKey: cartItemKey,
        },
        type: "POST", // POST
        beforeSend: function (xhr) {
          $("#cart_item_" + cartItemKey).slideUp(250);
        },
        success: function (data) {
          if (bookableSingleProductPage.length) {
            wc_bookings_booking_form.wc_bookings_date_picker.init();
          }

          if (checkOutPage.length) {
            $("body").trigger("update_checkout");
          }

          setTimeout(function () {
            updateShoppingCart();
          }, 250);
        },
        complete: function (xhr, status) {},
      });
    });
    //Remove item from cart function END
  }

  function beforeEnterFunctions() {
    gsap.registerPlugin(ScrollTrigger);

    setTimeout(() => {
      gsap.to(".cta_fixed_popup", { opacity: 1 });
    }, 10000);

    $(".close_fixed_popup").on("click", function () {
      $(".cta_fixed_popup").fadeOut();
    });

    if ($("body").hasClass("page-template-tmplt-artist")) {
      if (window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        $("html, body").animate(
          {
            scrollTop: parseInt($("#" + hash).offset().top),
          },
          100
        );
      }
    }

    const loader = $(this.container).find(".wpcf7-spinner");
    if (!loader.length) {
      $("div.wpcf7 > form").each(function () {
        wpcf7.init($(this)[0]);
      });
    }

    /*	-----------------------------------------------------------------------------
      Homepage start
    --------------------------------------------------------------------------------- */

    /*	-----------------------------------------------------------------------------
      Homepage end
    --------------------------------------------------------------------------------- */

    /*	-----------------------------------------------------------------------------
      Homepage dragger
    --------------------------------------------------------------------------------- */
    const drag = document.querySelector(".home_wrap .artist_work_grid"),
      container = document.querySelector(".home_wrap .artist_work_wrap");
    Draggable.create(drag, {
      bounds: container,
      edgeResistance: 0.95,
      type: "y,x",
      inertia: true,
      onDrag: function () {
        document.body.classList.add("dragging");
      },
      onDragEnd: function () {
        document.body.classList.remove("dragging");
      },
    });

    // gsap.set(".cursor", { xPercent: -50, yPercent: -50 });

    // var cursor = document.querySelector(".cursor");
    var pos = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
    var mouse = { x: pos.x, y: pos.y };
    var speed = 0.1;

    var fpms = 60 / 1000;

    // var xSet = gsap.quickSetter(cursor, "x", "px");
    // var ySet = gsap.quickSetter(cursor, "y", "px");

    document.body.addEventListener("mousemove", (e) => {
      mouse.x = e.x;
      mouse.y = e.y;
    });

    // gsap.ticker.add((time, deltaTime) => {
    //   var delta = deltaTime * fpms;
    //   var dt = 1.0 - Math.pow(1.0 - speed, delta);

    //   pos.x += (mouse.x - pos.x) * dt;
    //   pos.y += (mouse.y - pos.y) * dt;
    //   xSet(pos.x);
    //   ySet(pos.y);
    // });

    /*	-----------------------------------------------------------------------------
      END OF HOMEPAGE DRAGGER
    --------------------------------------------------------------------------------- */

    $(".artist_slider").slick({
      arrows: false,
      slidesToShow: 1,
      centerMode: true,
    });

    jQuery(".artist_work_wrap_slider.mobile").slick({
      arrows: false,
      slidesToShow: 1,
      centerMode: true,
      rows: 0,
    });

    if ($("body").hasClass("page-template-tmplt-about")) {
      $(".hero_wrap").mousemove(function (event) {
        $(".hero_image").each(function (index, element) {
          var xPos = event.clientX / $(window).width() - 0.5,
            yPos = event.clientY / $(window).height() - 0.5,
            box = element;

          TweenLite.to(box, 1, {
            x: xPos * 100,
            y: yPos * 100,
            ease: Power1.easeOut,
          });
        });
      });
    }

    /*	-----------------------------------------------------------------------------
    quizz logic 
    --------------------------------------------------------------------------------- */

    // setTimeout(function () {
    //   $(".pagination_holder.mobile .single_pagination")
    //     .first()
    //     .addClass("active");
    // }, 1000);
    // setTimeout(function () {
    //   $(".pagination_holder.desktop .single_pagination")
    //     .first()
    //     .addClass("active");
    // }, 1000);

    // var url_string = window.location.href; //window.location.href
    // var url = new URL(url_string);
    // var paramValue = url.searchParams.get("quizz");

    // var stackImagesIntro = gsap.timeline({
    //   paused: true,
    //   onComplete: function () {
    //     $(".image_stack .single_image_wrap").addClass("intro_done");
    //   },
    // });

    // let singleImage = $(".single_image_wrap");
    // let quiz_popup = $(".quiz_popup");
    // let quiz_popup_content = $(".quiz_popup_content");

    // stackImagesIntro.set(quiz_popup, { css: { zIndex: 999 } });
    // stackImagesIntro.to(quiz_popup, {
    //   visibility: "visible",
    //   height: "100vh",
    //   duration: 0.7,
    //   ease: "power2.inOut",
    // });
    // stackImagesIntro.to(quiz_popup_content, {
    //   visibility: "visible",
    //   opacity: 1,
    //   duration: 0.7,
    //   ease: "power2.inOut",
    // });
    // stackImagesIntro.to(singleImage, {
    //   opacity: 1,
    //   duration: 0.6,
    //   stagger: -0.2,
    // });

    // // $(".quiz_header_button, .quiz_contact_button").on("click", function () {
    // //   stackImagesIntro.reverse();
    // //   $('.quiz_popup').fadeOut();
    // // });

    // $(".take_quiz").on("click", function () {
    //   $(".popup_container").fadeOut();
    //   var currentUrl = $(this).data("url");
    //   var newUrl = "?quizz=true";
    //   window.history.pushState("", "", newUrl);
    //   $(".quiz_popup").fadeIn("fast");
    //   stackImagesIntro.play();
    //   var quizBackground = $(".single_image_wrap.active").data("color");
    //   $(".quiz_popup").css("background-color", quizBackground);
    // });

    // if (paramValue == "true") {
    //   $(".take_quiz").trigger("click");
    //   $(".landing_popup .big_button:not(.null)").trigger("click");
    // }

    // $(".close_quiz").on("click", function () {
    //   stackImagesIntro.reverse();
    //   var newUrl = "?";
    //   window.history.pushState("", "", newUrl);
    // });

    // $(".answer").on("click", function () {
    //   $(".pagination_holder.mobile .single_pagination.active")
    //     .last()
    //     .next()
    //     .addClass("active");
    //   $(".pagination_holder.desktop .single_pagination.active")
    //     .last()
    //     .next()
    //     .addClass("active");

    //   $(".single_image_wrap.active").removeClass("new");
    //   let currentArt = $(".single_image_wrap.active");

    //   var removeImage = gsap.timeline({
    //     onComplete: function () {
    //       $(currentArt).remove();

    //       if ($(".single_image_wrap").length < 1) {
    //         $(".results_holder").fadeIn();
    //         $(".result_image").addClass("active");
    //         $(".quiz_popup").css("background-color", "#4b58aa");
    //         $(".results_marquee").addClass("active");
    //         $(".quiz_popup").addClass("final_result");
    //         $(".answer").fadeOut("fast");
    //         $(".left .left_description").addClass("result");

    //         $(".quizz_answers").fadeOut();
    //         $(".image_stack").fadeOut();
    //         $(".social_wrap img").addClass("white");

    //         var result_marquees = $(".results_marquee_content");
    //         gsap.to(result_marquees, { opacity: 1 });

    //         result_marquees.each(function () {
    //           let marquee = $(this);
    //           var marqueeContainer = marquee.parent();
    //           var w = marquee.width();
    //           var x = Math.round(marqueeContainer.width() / w) + 1;

    //           for (var i = 0; i < x; i++) {
    //             marquee.find("> *:first-of-type").clone().appendTo(marquee);
    //           }
    //           gsap.to(marquee, {
    //             duration: 14,
    //             ease: "none",
    //             x: "-=" + w,
    //             modifiers: {
    //               x: gsap.utils.unitize((x) => parseFloat(x) % w),
    //             },
    //             repeat: -1,
    //           });
    //         });
    //       }

    //       $(".image_stack .single_image_wrap").first().addClass("new");
    //       $(".image_stack .single_image_wrap").first().addClass("active");

    //       var quizBackground = $(".single_image_wrap.active").data("color");
    //       $(".quiz_popup").css("background-color", quizBackground);
    //     },
    //   });

    //   if ($(this).hasClass("love")) {
    //     removeImage.to(currentArt, { scale: 1.1, duration: 0.5 });
    //     removeImage.to(currentArt, {
    //       x: "250%",
    //       rotate: "180deg",
    //       duration: 0.4,
    //     });
    //   } else {
    //     removeImage.to(currentArt, { scale: 1.1, duration: 0.5 });
    //     removeImage.to(currentArt, {
    //       x: "-250%",
    //       rotate: "180deg",
    //       duration: 0.4,
    //     });
    //   }
    // });

    /*	-----------------------------------------------------------------------------
      end of quizz logic
    --------------------------------------------------------------------------------- */
    if ($("body").hasClass("single-product")) {
      // var buttonCursorText = document.querySelector(".swiper_indicator_desktop span");
      var buttonCursor = document.querySelector(".swiper_indicator_desktop");
      var followArea = document.querySelector(
        ".artist_info_holder .right .right_content"
      );
      var pageCursor = document.querySelector(
        ".artist_info_holder .right .right_content"
      );

      var moveCircle = (e) => {
        gsap.to(buttonCursor, 0.25, {
          css: {
            left: e.pageX,
            top: e.pageY,
          },
        });
      };

      followArea.addEventListener("mouseover", () => {
        gsap.to(buttonCursor, 0.25, {
          scale: 1,
          autoAlpha: 1,
        });

        pageCursor.addEventListener("mousemove", moveCircle);
      });

      followArea.addEventListener("mouseout", () => {
        gsap.to(buttonCursor, 0.25, {
          scale: 0.5,
          autoAlpha: 0,
        });
      });

      followArea.addEventListener("mousedown", () => {
        gsap.to(buttonCursor, 0.5, {
          css: { transform: `translate(-50%, -50%) scale(0.75)` },
        });
      });

      followArea.addEventListener("mouseup", () => {
        gsap.to(buttonCursor, 0.5, {
          css: { transform: `translate(-50%, -50%) scale(1)` },
        });
      });
    }

    if ($("body").hasClass("home")) {
      var buttonCursor = document.querySelector(".home_indicator_desktop");
      var followArea = document.querySelector(".artist_work_grid");
      var pageCursor = document.querySelector(".artist_work_grid");

      var moveCircle = (e) => {
        gsap.to(buttonCursor, 0.25, {
          css: {
            left: e.pageX,
            top: e.pageY,
          },
        });
      };

      followArea.addEventListener("mouseover", (e) => {
        gsap.to(buttonCursor, 0.25, {
          scale: 1,
          autoAlpha: 1,
        });

        pageCursor.addEventListener("mousemove", moveCircle);
      });

      followArea.addEventListener("mouseout", (e) => {
        gsap.to(buttonCursor, 0.25, {
          scale: 0.5,
          autoAlpha: 0,
        });
      });

      followArea.addEventListener("mousedown", () => {
        gsap.to(buttonCursor, 0.5, {
          css: { transform: `translate(-50%, -50%) scale(0.75)` },
        });
      });

      followArea.addEventListener("mouseup", () => {
        gsap.to(buttonCursor, 0.5, {
          css: { transform: `translate(-50%, -50%) scale(1)` },
        });
      });
    }

    /*	-----------------------------------------------------------------------------
      Singlee Product
    --------------------------------------------------------------------------------- */
    if ($("body").hasClass("single-product")) {
      $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if (scroll > $(".hero_wrap").height() / 2) {
          $(".product_filters").fadeOut();
          $(".global_filters").fadeOut();
          $(".product_filters li").removeClass("active");
          $(".single_product .hero_wrap").removeClass("active");
        } else {
          $(".product_filters").fadeIn();
        }
      });

      $("#single-product-color-picker").spectrum({
        type: "flat",
        showAlpha: false,
        showPalette: false,
        showInput: true,
        preferredFormat: "hex", // Here
        change: function (color) {
          $(".single_product .hero_wrap .image_holder").css(
            "background-color",
            color.toHexString()
          );
        },
        move: function (color) {
          $(".single_product .hero_wrap .image_holder").css(
            "background-color",
            color.toHexString()
          );
        },
      });

      function getRandomColor() {
        var letters = "0123456789ABCDEF";
        var newcolor = "#";
        for (var i = 0; i < 6; i++) {
          newcolor += letters[Math.floor(Math.random() * 16)];
        }

        $(".single_product .hero_wrap .image_holder").css(
          "background-color",
          newcolor
        );

        return newcolor;
      }

      function setRandomClass() {
        var rooms = $(".single_product .buttons_holder");
        var items = rooms.find("a");
        var number = items.length;
        var random = Math.floor(Math.random() * number);
        items.eq(random).trigger("click");
      }

      $(".surprise_button a").on("click", function () {
        setRandomClass();
        getRandomColor();
      });

      $(".single_product .global_filters .buttons_holder a").on(
        "click",
        function () {
          $(".single_product .global_filters .buttons_holder a").removeClass(
            "active"
          );
          $(this).addClass("active");

          $(".single_product .hero_wrap .room.background").attr(
            "src",
            $(this).data("background")
          );

          $(".single_product .hero_wrap .room.foreground").attr(
            "src",
            $(this).data("foreground")
          );
        }
      );

      $(".single_product .room_type span").on("click", function () {
        $(".single_product .room_type span").removeClass("active");
        $(this).addClass("active");

        var currentFilter = $(this).data("type");
        $(".single_product .global_filters .buttons_holder").removeClass(
          "active"
        );

        $(".single_product .global_filters .buttons_holder").each(function () {
          if ($(this).data("type") == currentFilter) {
            $(this).addClass("active");
            $(this).find(">:first-child").addClass("active");
            $(".single_product .hero_wrap .room.background").attr(
              "src",
              $(this).find(">:first-child").data("background")
            );
            $(".single_product .hero_wrap .room.foreground").attr(
              "src",
              $(this).find(">:first-child").data("foreground")
            );
          }
        });
      });

      // Draggable images
      const drag = document.querySelector(".product_image img"),
        container = document.querySelector(".product_image");
      Draggable.create(drag, {
        bounds: container,
        edgeResistance: 01,
        type: "y,x",
        inertia: true,
      });
    }

    let productsAnimationTrigger = $(".artist_work_wrap").not(".mobile");
    let singleProduct = $(".artist_work_wrap")
      .not(".mobile")
      .find(".single_work");
    singleProduct.each(function () {
      gsap
        .timeline({
          scrollTrigger: {
            trigger: productsAnimationTrigger,
            start: "top bottom",
            scroller: "body",
          },
        })
        .set(
          singleProduct,
          {
            className: "single_work animate",
            stagger: 0.2,
            ease: "power2.inOut",
          },
          "+=1"
        );
    });

    /*	-----------------------------------------------------------------------------
      end of Single Product
    --------------------------------------------------------------------------------- */

    AddReadMore();

    /*	-----------------------------------------------------------------------------
      Shop Page
    --------------------------------------------------------------------------------- */
    if ($(".shop_all").length) {
      shopFilters();
      const $productsForm = $("#products-shop-form");
      const $productsResponse = $("#products_response");
      const $productsPageInput = $("#products-page-num-input");
      const $filterInputs = $(
        ".desktop_shop_filters .global_filters input, .mobile_shop_filter .filters_holder input"
      );
      const $sortFilterInputs = $(
        ".desktop_shop_filters .sort_filter_holder input, .mobile_shop_filter .mobile_shop_filter_header input"
      );
      const $mobileSearchInput = $(".mobile_shop_filter #search_input");
      let timer;

      window.history.replaceState(
        "",
        "",
        window.location.origin + window.location.pathname
      );

      $filterInputs.on("change", function () {
        $productsPageInput.val(1);
        filterPosts();
      });

      $sortFilterInputs.on("change", function () {
        filterPosts();
      });

      $mobileSearchInput.keyup(function () {
        $productsPageInput.val(1);

        // Clear timer
        clearTimeout(timer);

        // Wait for X ms and then process the request
        timer = setTimeout(function () {
          filterPosts();
        }, 500);
      });

      $productsForm.on("submit", function (event) {
        event.preventDefault();
        // filterPosts();
        $(".filters_holder").slideUp();
      });

      function filterPosts() {
        $productsResponse.addClass("loading");

        setTimeout(function () {
          $.ajax({
            url: "/wp-admin/admin-ajax.php",
            data: $productsForm.serialize(),
            type: "GET",
            beforeSend: function (xhr) {},
            success: function (data) {
              document.getElementById("products_response").innerHTML = data;
            },
            complete: function (data) {
              $productsResponse.removeClass("loading");

              $(".single_work").each(function (index) {
                $(this).addClass("animate");
              });
            },
          });
        }, 300);
      }

      $productsResponse.on("click", ".pagination-page", function () {
        $productsPageInput.val($(this).data("page"));
        filterPosts();
      });
    }
    /*	-----------------------------------------------------------------------------
      end of Shop Page
    --------------------------------------------------------------------------------- */

    /*	-----------------------------------------------------------------------------
      Artist Page
    --------------------------------------------------------------------------------- */
    if ($(".artists_wrap").length) {
      artistsFilters();
      const $artistsForm = $("#artists_form");
      const $artistsResponse = $("#artists_response");
      const $artistsPageInput = $("#artists_page_num_input");
      const $categoriesFilterInputs = $(
        ".desktop_artist_filter input, .mobile_artist_filter input"
      );

      $categoriesFilterInputs.on("change", function () {
        $artistsPageInput.val(1);
        filterArtists();
      });

      function filterArtists() {
        $artistsResponse.addClass("loading");

        setTimeout(function () {
          $.ajax({
            url: "/wp-admin/admin-ajax.php",
            data: $artistsForm.serialize(),
            type: "GET",
            beforeSend: function (xhr) {},
            success: function (data) {
              document.getElementById("artists_response").innerHTML = data;
            },
            complete: function (data) {
              $artistsResponse.removeClass("loading");

              $(".single_artist").each(function (index) {
                $(this).addClass("animate");
              });
            },
          });
        }, 300);
      }

      $artistsResponse.on("click", ".pagination-page", function () {
        $artistsPageInput.val($(this).data("page"));
        filterArtists();
      });

      let artistsAnimationTrigger = $(".artists_list");
      let singleArtists = $(".single_artist");
      singleArtists.each(function () {
        gsap
          // .timeline({
          //   scrollTrigger: {
          //     trigger: artistsAnimationTrigger,
          //     start: "top bottom",
          //     scroller: "body",
          //   },
          // })
          .set(
            singleArtists,
            {
              className: "single_artist animate",
              stagger: 0.2,
              ease: "power2.inOut",
            },
            "+=1"
          );
      });
    }
    /*	-----------------------------------------------------------------------------
      end of artist page
    --------------------------------------------------------------------------------- */

    $(".simmilar_art").slick({
      arrows: false,
      slidesToShow: 1,
      centerPadding: "20%",
      infinite: true,
      centerMode: true,
      slidesToScroll: 1,
    });

    $(".main_filters_mobile ul li a").on("click", function (e) {
      e.stopImmediatePropagation();
      $(this).toggleClass("active");
      $(this).next().slideToggle().css("display", "flex");
    });

    $(".mobile_filters_holder").on("click", function (e) {
      e.stopImmediatePropagation();
      $(".search_input_holder").slideUp();
      $(".filters_holder").slideToggle();
      $("body").toggleClass("no_scroll");
    });

    $(".search_action").click(function () {
      $(".filters_holder").slideUp();
      $(".search_input_holder").slideToggle();
      $("#search_input").focus();
    });

    let teamMembersAnimationTrigger = $(".team_wrap_content");
    let singleTeamMember = $(".single_team_wrap");
    singleTeamMember.each(function () {
      gsap
        .timeline({
          scrollTrigger: {
            trigger: teamMembersAnimationTrigger,
            start: "top bottom",
            scroller: "body",
          },
        })
        .set(
          singleTeamMember,
          {
            className: "single_team_wrap active animate",
            stagger: 0.2,
            ease: "power2.inOut",
          },
          "+=1"
        );
    });

    if ($(window).width() > 1000) {
      // $(".single_team_wrap").on("click", function () {
      //   var currentName = $(this).find(".name").text();
      //   var position = $(this).find(".name").text();
      //   $(this).toggleClass("active");
      // });

      $(".single_team_wrap").hover(
        function () {
          console.log("hovered");
          $(this).removeClass("active");
        },
        function () {
          $(this).addClass("active");
        }
      );
    } else {
      $(".single_team_wrap").on("click", function () {
        var currentName = $(this).find(".position").text();
        var currentDescription = $(this).find(".single_team p").text();
        var currentImage = $(this)
          .find(".single_team .team_image_holder img")
          .attr("src");

        $(".close_about_popup").fadeIn("fast");
        $(".single_team_popup_holder").fadeIn();
        $(".cart_opener, .menu_opener").fadeOut("fast");
        $(".single_team_popup_holder .popup_team_title").text(currentName);
        $(".single_team_popup_holder p").text(currentDescription);
        $(".single_team_popup_holder .single_team .team_image_holder img").attr(
          "src",
          currentImage
        );
      });

      $(".close_about_popup").on("click", function () {
        $(".close_about_popup").fadeOut();
        $(".single_team_popup_holder").fadeOut();
        $(".cart_opener, .menu_opener").fadeIn("fast");
      });
    }

    $(".single_accoridion").on("click", function () {
      $(this).find(".description").slideToggle();
      $(this).find(".arrow_icon").toggleClass("active");
    });

    var currrentFilter;
    $(".filter_nav ul li").on("click", function (e) {
      e.preventDefault();
      if (!$(this).hasClass("active")) {
        $(".global_filters").slideUp();
        $(".filter_nav ul li").removeClass("active");

        currrentFilter = $(this).text().toLowerCase().replaceAll(/\s/g, "");
        $(".global_filters." + currrentFilter).slideDown();
        $(".global_filters." + currrentFilter + ".flex")
          .slideDown()
          .css("display", "flex");
        $(this).parent().addClass("active");
        $(this).addClass("active");

        if (currrentFilter != "surpriseme") {
          $(".single_product .hero_wrap").addClass("active");
        } else {
          $(".single_product .hero_wrap").removeClass("active");
        }
      } else {
        $(this).removeClass("active");
        $(this).parent().removeClass("active");
        $(".global_filters").slideUp();

        $(".single_product .hero_wrap").removeClass("active");
      }
      // e.preventDefault();
    });

    $(".single_artist").on("hover", function () {
      $(this).find(".description").slideToggle();
      $(this).find(".arrow_icon").toggleClass("active");
    });

    $(".single_artist").hover(
      function () {
        $(".artist_image").addClass("visible");
        $(".artist_image img").attr("src", $(this).data("image"));
      },
      function () {
        $(".artist_image").removeClass("visible");
      }
    );

    /*	-----------------------------------------------------------------------------
      menu openeer
    --------------------------------------------------------------------------------- */
    gsap.to($("header"), { top: 0, duration: 0.5 });

    var leftMenuContent = $(".nav_content .left ul li");
    var rightMenuBanner = $(".nav_content .right .banner");
    var rightMenuContent = $(".nav_content .right .right_content_wrap");

    var menuOpenerAnimation = gsap.timeline({
      paused: true,
      reversed: true,
      onComplete: function () {
        // console.log("complete");
      },
    });

    menuOpenerAnimation.to(leftMenuContent, {
      opacity: 1,
      duration: 0.7,
      stagger: 0.2,
      delay: 0.5,
    });
    menuOpenerAnimation.to(rightMenuBanner, { opacity: 1, duration: 0.7 }, "<");
    menuOpenerAnimation.to(rightMenuContent, { opacity: 1, duration: 0.7 });

    var counterHeaderMarquee = 0;

    $(".menu_opener").on("click", function () {
      menuOpenerAnimation.reversed()
        ? menuOpenerAnimation.play()
        : menuOpenerAnimation.reverse();

      if (counterHeaderMarquee == 0) {
        var headerMarquees = $(".header_marquee");
        gsap.to(headerMarquees, { opacity: 1 });
        var windowWidth = $(window).width() - 65;

        headerMarquees.each(function () {
          let header_marquee = $(this);
          var header_marqueeContainer = header_marquee.parent();
          var w = header_marqueeContainer.width() + 165;

          if (windowWidth < 1023) {
            var x = Math.round(header_marqueeContainer.width() / w) + 5;

            for (var i = 0; i < x; i++) {
              header_marquee
                .find("> *:first-of-type")
                .clone()
                .appendTo(header_marquee);
            }
            gsap.to(header_marquee, {
              duration: 3,
              ease: "none",
              x: "-=" + w,
              modifiers: {
                x: gsap.utils.unitize((x) => parseFloat(x) % w),
              },
              repeat: -1,
            });
          } else {
            var x = Math.round(header_marqueeContainer.height() / w) + 1;
            for (var i = 0; i < x; i++) {
              header_marquee
                .find("> *:first-of-type")
                .clone()
                .appendTo(header_marquee);
            }
            gsap.to(header_marquee, {
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
      }

      counterHeaderMarquee++;

      $(".website_navigation").fadeToggle();

      if ($(".filter_nav").hasClass("product_filters")) {
        $("header").toggleClass("dark");
        $(".buttons_holder, .filter_nav li, .filter_nav li a").toggleClass(
          "white"
        );
      }

      if ($(this).text() == "MENU") {
        $(this).text("CLOSE");
        $(this).attr("data-text", "CLOSE");
      } else {
        $(this).text("MENU");
        $(this).attr("data-text", "MENU");
      }
    });

    /*	-----------------------------------------------------------------------------
      menu openeer end
      --------------------------------------------------------------------------------- */

    var mySplitText = new SplitText($(".letter_wrap, .letter_wrap_scroll"), {
      type: "lines, words, chars",
      wordsClass: "word word++",
      linesClass: "line line++",
      charsClass: "char char++",
    });

    $(".image_stack .single_image_wrap").each(function () {
      $(".pagination_holder .single_pagination")
        .last()
        .clone()
        .appendTo(".images_pagination");
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
      $("#single-product-color-picker").spectrum("hide");
      var currentScroll = $(document).scrollTop() / 100;

      $(
        ".first_section_content .headline_wrap img, .about_wrap .first_section .first_section_content img"
      ).css({
        transform: "rotate(" + currentScroll + "rad)",
      });
    });

    /*	-----------------------------------------------------------------------------
      SCROLL TRIGGERS
    --------------------------------------------------------------------------------- */
    var resizeTimer;

    $(window).on("resize", function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if ($(".shop_all").length) {
          shopFilters();
          filterPosts();
        }

        if ($(".artists_wrap").length) {
          artistsFilters();
          filterArtists();
        }
      }, 250);
    });

    ScrollTrigger.matchMedia({
      // desktop
      "(min-width: 800px)": function () {
        let sections = $(
          ".home_wrap .second_section .single_box, .single_product .shipping_section .single_box, .about_wrap .second_section .single_box"
        );
        let container = $(
          ".home_wrap .second_section  .container, .single_product .shipping_section .container, .about_wrap .second_section  .container"
        );
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
        let sections = $(
          ".home_wrap .second_section .single_box, .single_product .shipping_section .single_box, .about_wrap .second_section .single_box"
        );
        let container = $(
          ".home_wrap .second_section  .container, .single_product .shipping_section .container, .about_wrap .second_section  .container"
        );
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
          var letter = trigger.querySelectorAll(".char");

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

    $(".nav_content ul li a").each(function () {
      let text = $(this).text();
      $(this).attr("data-text", text);
    });

    $(".loader_overlay").fadeOut();
  }

  $(document).on("ready", function () {
    document
      .querySelectorAll("#wpadminbar a")
      .forEach((item) => item.setAttribute("data-barba-prevent", "self"));
    document
      .querySelectorAll("#wcfm-main-content")
      .forEach((item) => item.setAttribute("data-barba-prevent", "all"));
    document
      .querySelectorAll(".woocommerce-checkout")
      .forEach((item) => item.setAttribute("data-barba-prevent", "all"));

    $(window).on("load", function () {
      $(".loader_overlay").fadeOut();
    });

    /*	-----------------------------------------------------------------------------
      LOADER ANIMATION
    --------------------------------------------------------------------------------- */
    var loaderPlay = sessionStorage.getItem("loader");
    var popupCookie = sessionStorage.getItem("popupCookie");

    $(".close_popup").on("click", function () {
      $(".popup_container").fadeOut();
    });

    if (
      $("body").hasClass("home") &&
      popupCookie != "true" &&
      loaderPlay == "true"
    ) {
      setTimeout(function () {
        sessionStorage.setItem("popupCookie", "true");
        $(".popup_container").fadeIn().css("display", "flex");
      }, 3000);
    }

    if (!$("body").hasClass("home") && loaderPlay != "true") {
      sessionStorage.setItem("loader", "true");
    }

    if ($("body").hasClass("home") && loaderPlay != "true") {
      sessionStorage.setItem("loader", "true");

      setTimeout(function () {
        sessionStorage.setItem("popupCookie", "true");
        $(".popup_container").fadeIn().css("display", "flex");
      }, 10000);

      $(".loader_overlay").css("display", "block");
      $("body").addClass("no_scroll");
      var gif = $(".loader");

      var loaderAnimation = gsap.timeline({
        onStart: function () {
          $("body").addClass("no_scroll");
        },
        onComplete: function () {
          $("body").removeClass("no_scroll");
          $("html").addClass("loaded");
        },
      });
      loaderAnimation.set(gif, { background: "#4b58aa" });
      loaderAnimation.to(gif, { opacity: 1, visibility: "visible" });
      loaderAnimation.to(gif, { opacity: 0, delay: 4 });
      loaderAnimation.to(gif, { visibility: "hidden" });
      loaderAnimation.to(gif, { display: "none" });

      // $("#page").css("position", "relative");
      // $("#page").css("z-index", "1");

      // var loaderImage = $(".artist_work_grid .single_work:nth-child(3) img")
      //   .clone()
      //   .appendTo("#page")
      //   .addClass("loader_image");
      // var loaderOverlay = $(".loader_overlay");

      // $(".artist_work_grid .single_work:nth-child(3) img").on(
      //   "load",
      //   function () {
      //     // var loaderImagePostionLeft = $(
      //     //   ".artist_work_grid .single_work:nth-child(3) img"
      //     // ).offset().left;
      //     // var loaderImagePostionTop = $(
      //     //   ".artist_work_grid .single_work:nth-child(3) img"
      //     // ).offset().top;
      //     // var loaderImageWidth = $(
      //     //   ".artist_work_grid .single_work:nth-child(3) img"
      //     // ).width();
      //     // var loaderImageHeight = $(
      //     //   ".artist_work_grid .single_work:nth-child(3) img"
      //     // ).height();
      //     var gif = $(".loader");
      //     loaderAnimation.to(gif, { opacity: 1, visibility: "visible" });
      //     loaderAnimation.to(loaderOverlay, { display: "none" });
      //     // loaderAnimation.to(loaderImage, { scale: 1, duration: 1.5 });
      //     loaderAnimation.to(gif, { opacity: 0, delay: 3 });
      //     loaderAnimation.to(gif, { visibility: "hidden" });
      //     // loaderAnimation.to(loaderImage, {
      //     //   x: loaderImagePostionLeft,
      //     //   y: loaderImagePostionTop,
      //     //   width: loaderImageWidth,
      //     //   height: loaderImageHeight,
      //     //   duration: 0.7,
      //     // });
      //     loaderAnimation.to(gif, { display: "none" });
      //     loaderAnimation.to(loaderImage, { display: "none" });
      //   }
      // );
    } else {
      $("html").addClass("loaded");
    }
    /*	-----------------------------------------------------------------------------
      END OF LOADER ANIMATION
    --------------------------------------------------------------------------------- */

    gsap.registerPlugin(ScrollTrigger);
    //Read More and Read Less Click Event binding
    $(document).on("click", ".readMore,.readLess", function () {
      $(this)
        .closest(".addReadMore")
        .toggleClass("showlesscontent showmorecontent");
    });

    AddReadMore();
    // swiperInit();
    woocomerce_cart();

    $(".buttons_holder .big_button").hover(
      function () {
        var i = $(this).index();
        $(".partners_wrap .image_holder img").eq(i).addClass("active");
        $(".landing_popup").addClass("transparent");
      },
      function () {
        $(".partners_wrap .image_holder img").removeClass("active");
        $(".landing_popup").removeClass("transparent");
      }
    );

    $(".landing_popup .big_button").on("click", function () {
      var i = $(this).index();

      $(".partners_wrap .image_holder img").eq(i).addClass("clicked");
      $(".landing_popup_wrap").fadeOut("slow");

      $("body").removeClass("no_scroll");

      $("nav ul li").eq(i).addClass("active");
    });
  });

  /*	-----------------------------------------------------------------------------
  BARBA
--------------------------------------------------------------------------------- */

  var currentProject;
  function delay(n) {
    n = n || 2000;
    return new Promise((done) => {
      setTimeout(() => {
        done();
      }, n);
    });
  }

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

  barba.hooks.beforeEnter((data) => {
    window.scrollTo(0, 0);
    // smoothScroll();
    // swiperInit();
  });

  barba.hooks.afterEnter((data) => {});

  // barba.hooks.beforeOnce((data) => {});

  barba.hooks.afterEnter((data) => {
    imagesLoaded(document.getElementById("page"), function () {
      beforeEnterFunctions();
      woocomerce_cart();
      AddReadMore();
    });
  });

  barba.init({
    sync: true,
    prevent: ({ el }) =>
      el.classList && el.classList.contains("wcfm_menu_item"),

    transitions: [
      {
        async leave(data) {
          const done = this.async();

          gsap.to(data.current.container, {
            opacity: 0,
          });

          await delay(650);

          done();
        },

        async enter(data) {
          gsap.from(data.next.container, {
            opacity: 0,
          });
        },

        // async once(data) {

        // },
      },
    ],

    views: [
      // {
      //   namespace: "Home",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "Partner",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "Shop All",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "About",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "FAQ",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "Artists",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "Business",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "Collector",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "Contact",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "Page",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "post",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
      // {
      //   namespace: "product",
      //   afterEnter({ next }) {
      //     imagesLoaded(document.getElementById("page"), function () {
      //       beforeEnterFunctions();
      //       woocomerce_cart();
      //       AddReadMore();
      //     });
      //   },
      // },
    ],
  });

  // function leave() {
  //   var letters = $(".letter_wrap .word_wrap span");
  //   var bgImg = $(".home_wrap .hero_wrap .image_holder img");

  //   var tl = gsap.timeline();
  //   tl.set(bgImg, { transition: "none" });
  //   gsap.to(letters, { xPercent: 100, opacity: 0 });
  //   tl.to(bgImg, { opacity: 0 });
  //   ScrollTrigger.getAll().forEach((st) => st.kill());
  // }

  // function enter() {
  //   var letters = $(".letter_wrap .word_wrap span");
  //   var bgImg = $(".home_wrap .hero_wrap .image_holder img");

  //   var tl = gsap.timeline();
  //   tl.set(bgImg, { transition: "none" });
  //   gsap.from(letters, { xPercent: 100, opacity: 0 });
  //   tl.from(bgImg, { opacity: 0 });
  // }

  // function indexLeave() {
  //   var tl = gsap.timeline();

  //   let hero = $(".hero_wrap");
  //   let heroContent = $(".hero_content");
  //   let heroButtons = $(".hero_buttons");
  //   let text = $(".hero_content .word_wrap span");
  //   let body = $("body, html");

  //   tl.to(hero, { top: 0, width: "100%" });
  //   tl.to(text, { x: "0%", opacity: 1, duration: 0.1 });
  //   tl.to(heroContent, { opacity: 1 });
  //   tl.to(heroButtons, { opacity: 1 });
  //   tl.to(body, { overflow: "initial" });
  // }

  // function indexEnter() {
  //   var letters = $(".letter_wrap .word_wrap span");
  //   var content = $(".home_wrap .hero_wrap .hero_content");
  //   gsap.from(letters, { xPercent: 100, opacity: 0 });
  //   gsap.from(content, { opacity: 0 });
  // }

  // function delay(n) {
  //   n = n || 2000;
  //   return new Promise((done) => {
  //     setTimeout(() => {
  //       done();
  //     }, n);
  //   });
  // }
  // barba.init({
  //   sync: true,

  //   transitions: [
  //     {
  //       name: "home",
  //       from: { namespace: ["home"] },
  //       to: { namespace: ["template"] },
  //       async leave(data) {
  //         const done = this.async();

  //         indexLeave();
  //         await delay(650);
  //         done();
  //       },
  //       async beforeEnter() {
  //         beforeEnterFunctions();
  //       },
  //       async enter() {
  //         indexEnter();
  //       },
  //     },
  //     {
  //       name: "template",
  //       to: { namespace: ["template"] },
  //       async leave(data) {
  //         const done = this.async();
  //         window.scrollTo(0, 0);
  //         leave();
  //         await delay(650);
  //         done();
  //       },

  //       async beforeEnter() {
  //         beforeEnterFunctions();
  //       },

  //       async enter(data) {
  //         enter();
  //       },
  //     },
  //     {
  //       async once(data) {
  //         if (
  //           document.body.classList.contains("page-template-tmplt-collector")
  //         ) {
  //           document
  //             .querySelector("nav ul li:nth-child(1)")
  //             .classList.add("active");
  //         } else if (
  //           document.body.classList.contains("page-template-tmplt-artist")
  //         ) {
  //           document
  //             .querySelector("nav ul li:nth-child(2)")
  //             .classList.add("active");
  //         } else if (
  //           document.body.classList.contains("page-template-tmplt-business")
  //         ) {
  //           document
  //             .querySelector("nav ul li:nth-child(3)")
  //             .classList.add("active");
  //         }
  //         beforeEnterFunctions();
  //         initScroll();
  //       },
  //     },
  //   ],
  //   views: [
  //     {
  //       namespace: "Contact",
  //       afterEnter({ next }) {
  //         imagesLoaded(document.getElementById("viewport"), function () {});
  //       },
  //     },
  //   ],
  // });
  // barba.hooks.afterLeave((data) => {
  //   var nextHtml = data.next.html;
  //   var response = nextHtml.replace(
  //     /(<\/?)body( .+?)?>/gi,
  //     "$1notbody$2>",
  //     nextHtml
  //   );
  //   var bodyClasses = $(response).filter("notbody").attr("class");
  //   $("body").attr("class", bodyClasses);
  // });

  // barba.hooks.beforeOnce((data) => {});

  // barba.hooks.afterEnter((data) => {
  //   swiperInit();
  // });
})(jQuery);
