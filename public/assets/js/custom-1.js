(function ($) {
  ("use strict");

  $(".sidebar-button").on("click", function () {
    $(this).toggleClass("active");
  });

  const sidebarButton = document.querySelector(".sidebar-button");

  if (sidebarButton) {
    sidebarButton.addEventListener("click", () => {
      document.querySelector(".main-menu").classList.toggle("show-menu");
    });
  }

  $(".menu-close-btn").on("click", function () {
    $(".main-menu").removeClass("show-menu");
  });

  // sidebar
  $(".right-sidebar-button").on("click", function () {
    $(".right-sidebar-menu").addClass("show-right-menu");
  });
  $(".right-sidebar-close-btn").on("click", function () {
    $(".right-sidebar-menu").removeClass("show-right-menu");
  });

  $(".menu-btn").on("click", function () {
    $(".sidebar-menu").addClass("active");
  });
  $(".sidebar-menu-close").on("click", function () {
    $(".sidebar-menu").removeClass("active");
  });

  jQuery(".dropdown-icon").on("click", function () {
    jQuery(this).toggleClass("active").next("ul").slideToggle();
    jQuery(this).parent().siblings().children("ul").slideUp();
    jQuery(this).parent().siblings().children(".active").removeClass("active");
  });
  jQuery(".dropdown-icon2").on("click", function () {
    jQuery(this).toggleClass("active").next(".submenu-list").slideToggle();
    jQuery(this).parent().siblings().children(".submenu-list").slideUp();
    jQuery(this).parent().siblings().children(".active").removeClass("active");
  });

  // sticky header
  window.addEventListener("scroll", function () {
    const header = document.querySelector(".header-area");
    if (header) {
      header.classList.toggle("sticky", window.scrollY > 0);
    }
  });

  const header = document.querySelector(".home1-header");
  const eventSection = document.querySelector(".home1-event-section");

  if (header) {
    window.addEventListener("scroll", function () {
      const scrollY = window.scrollY;

      // Default sticky behavior
      if (scrollY > 0) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }

      // Extra logic: Remove sticky inside event section
      if (eventSection) {
        const rect = eventSection.getBoundingClientRect();

        if (rect.top <= 0 && rect.bottom >= 0) {
          header.classList.remove("sticky");
        }
      }
    });
  }

  // FancyBox Js
  $('[data-fancybox="gallery-01"]').fancybox({
    buttons: ["close"],
    loop: false,
    protect: true,
  });
  $('[data-fancybox="video-player"]').fancybox({
    buttons: ["close"],
    loop: false,
    protect: true,
  });

  //Counter up
  $(".counter").counterUp({
    delay: 10,
    time: 1000,
  });
  
  // Room And Suites Slider
  var swiper = new Swiper(".room-and-suites-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    loop: true,
    autoplay: {
      delay: 2500, // Autoplay duration in milliseconds
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".room-and-suites-slider-next",
      prevEl: ".room-and-suites-slider-prev",
    },
    breakpoints: {
      280: {
        slidesPerView: 1,
      },
      386: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      992: {
        slidesPerView: 3,
      },
      1200: {
        slidesPerView: 3,
      },
      1400: {
        slidesPerView: 3,
      },
    },
  });
  document
    .querySelectorAll(".room-and-suites-card-slider")
    .forEach((slider, index) => {
      // Add unique pagination class
      $(slider)
        .next(".slider-pagi-wrap")
        .children(".room-and-suites-card-pagi")
        .addClass(`room-and-suites-card-pagi-${index}`);
      setTimeout(() => {
        new Swiper(slider, {
          slidesPerView: 1,
          speed: 1600,
          spaceBetween: 30,
          autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
          pagination: {
            el: `.room-and-suites-card-pagi-${index}`,
            clickable: true,
          },
          breakpoints: {
            280: {
              slidesPerView: 1,
            },
            386: {
              slidesPerView: 1,
            },
            576: {
              slidesPerView: 1,
            },
            768: {
              slidesPerView: 2,
            },
            992: {
              slidesPerView: 3,
            },
            1200: {
              slidesPerView: 3,
            },
            1400: {
              slidesPerView: 3,
            },
          },
        });
      }, 0);
    });
  // Home Banner Slider
  var swiper = new Swiper(".home2-banner-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    loop: true,
    autoplay: {
      delay: 2500, // Autoplay duration in milliseconds
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".room-and-suites-slider-next",
      prevEl: ".room-and-suites-slider-prev",
    },
    breakpoints: {
      280: {
        slidesPerView: 1,
      },
      386: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 15,
      },
      1200: {
        slidesPerView: 3,
      },
      1400: {
        slidesPerView: 3,
      },
    },
  });
  var swiper = new Swiper(".home1-banner-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 3000,
      pauseOnMouseEnter: true,
      disableOnInteraction: false,
    },
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    navigation: {
      nextEl: ".banner-slider-next",
      prevEl: ".banner-slider-prev",
    },
    pagination: {
      el: ".banner-pagination",
      clickable: true,
    },
  });
  var swiper = new Swiper(".home4-banner-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 3000,
      pauseOnMouseEnter: true,
      disableOnInteraction: false,
    },
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    pagination: {
      el: ".home4-banner-pagi",
      clickable: true,
    },
  });
  // Testimonial SLider
  var swiper = new Swiper(".home1-testimonial-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 3000,
      pauseOnMouseEnter: true,
      disableOnInteraction: false,
    },
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    navigation: {
      nextEl: ".testimonial-slider-next",
      prevEl: ".testimonial-slider-prev",
    },
  });
  var swiper = new Swiper(".home2-testimonial-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 2500, // Autoplay duration in milliseconds
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".home2-testimonial-card-slider-next",
      prevEl: ".home2-testimonial-card-slider-prev",
    },
    breakpoints: {
      280: {
        slidesPerView: 1,
      },
      386: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 15,
      },
      992: {
        slidesPerView: 2,
      },
      1200: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1400: {
        slidesPerView: 3,
      },
    },
  });
  var swiper = new Swiper(".home3-testimonial-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 2500, // Autoplay duration in milliseconds
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".home2-testimonial-card-slider-next",
      prevEl: ".home2-testimonial-card-slider-prev",
    },
    breakpoints: {
      280: {
        slidesPerView: 1,
      },
      386: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      992: {
        slidesPerView: 2,
      },
      1200: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1400: {
        slidesPerView: 2,
      },
    },
  });
  var swiper = new Swiper(".home4-testimonial-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 2500, // Autoplay duration in milliseconds
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".home4-testimonial-card-slider-next",
      prevEl: ".home4-testimonial-card-slider-prev",
    },
    breakpoints: {
      280: {
        slidesPerView: 1,
      },
      386: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      992: {
        slidesPerView: 2,
      },
      1200: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1400: {
        slidesPerView: 2,
      },
    },
  });
  var swiper = new Swiper(".dining-testimonial-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 2500, // Autoplay duration in milliseconds
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".home4-testimonial-card-slider-next",
      prevEl: ".home4-testimonial-card-slider-prev",
    },
    breakpoints: {
      280: {
        slidesPerView: 1,
      },
      386: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      992: {
        slidesPerView: 2,
      },
      1200: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1400: {
        slidesPerView: 3,
      },
    },
  });
  // Room Details Slider
  var swiper = new Swiper(".room-details-banner-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 3000,
      pauseOnMouseEnter: true,
      disableOnInteraction: false,
    },
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    pagination: {
      el: ".room-and-suites-card-pagi",
      clickable: true,
    },
  });
  // Home2 Top Offer Text Slider
  var swiper = new Swiper(".get-offer-text-slider", {
    slidesPerView: 1,
    speed: 1500,
    spaceBetween: 24,
    autoplay: {
      delay: 2500, // Autoplay duration in milliseconds
      disableOnInteraction: false,
    },
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    navigation: {
      nextEl: ".get-offer-text-slider-next",
      prevEl: ".get-offer-text-slider-prev",
    },
  });

  //wow js
  if (WOW) {
    WOW.prototype.resetAnimation = function (box) {
      if (box && typeof box.className === "string") {
        box.className = box.className
          .replace(this.config.animateClass, "")
          .trim();
      }
    };
  }

  jQuery(window).on("load", function () {
    window.wow = new WOW({
      boxClass: "wow",
      animateClass: "animated",
      offset: 80,
      mobile: true,
      live: false,
    });
    window.wow.init();
  });

  // niceSelect
  if ($("select").length) {
    $("select").niceSelect();
  }

  // Language Btn
  $(".language-btn, .currency-btn").on("click", function (e) {
    let parent = $(this).parent();
    parent.find(".language-list, .currency-list").toggleClass("active");
    e.stopPropagation();
  });
  $(document).on("click", function (e) {
    if (!$(e.target).closest(".language-btn, .currency-btn").length) {
      $(".language-list, .currency-list").removeClass("active");
    }
  });

  //Quantity Increment
  $(".quantity__minus").on("click", function (e) {
    e.preventDefault();
    var input = $(this).siblings(".quantity__input");
    var value = parseInt(input.val(), 10);
    if (value > 1) {
      value--;
    }
    input.val(value.toString().padStart(2, "0"));
  });
  $(".quantity__plus").on("click", function (e) {
    e.preventDefault();
    var input = $(this).siblings(".quantity__input");
    var value = parseInt(input.val(), 10);
    value++;
    input.val(value.toString().padStart(2, "0"));
  });

  if ($("body").not(".is-mobile").hasClass("tt-magic-cursor")) {
    if ($(window).width() > 1024) {
      gsap.config({
        nullTargetWarn: false,
        trialWarn: false,
      });
      $(".magnetic-item").wrap('<div class="magnetic-wrap"></div>');

      if ($("a.magnetic-item").length) {
        $("a.magnetic-item").addClass("not-hide-cursor");
      }

      var $mouse = { x: 0, y: 0 }; // Cursor position
      var $pos = { x: 0, y: 0 }; // Cursor position
      var $ratio = 0.15; // delay follow cursor
      var $active = false;
      var $ball = $("#ball");

      var $ballWidth = 20; // Ball default width
      var $ballHeight = 20; // Ball default height
      var $ballOpacity = 0.5; // Ball default opacity
      var $ballBorderWidth = 2; // Ball default border width

      gsap.set($ball, {
        // scale from middle and style ball
        xPercent: -50,
        yPercent: -50,
        width: $ballWidth,
        height: $ballHeight,
        borderWidth: $ballBorderWidth,
        opacity: $ballOpacity,
      });

      document.addEventListener("mousemove", mouseMove);

      function mouseMove(e) {
        $mouse.x = e.clientX;
        $mouse.y = e.clientY;
      }

      gsap.ticker.add(updatePosition);

      function updatePosition() {
        if (!$active) {
          $pos.x += ($mouse.x - $pos.x) * $ratio;
          $pos.y += ($mouse.y - $pos.y) * $ratio;

          gsap.set($ball, { x: $pos.x, y: $pos.y });
        }
      }

      $(".magnetic-wrap").mousemove(function (e) {
        parallaxCursor(e, this, 2); // magnetic ball = low number is more attractive
        callParallax(e, this);
      });

      function callParallax(e, parent) {
        parallaxIt(e, parent, parent.querySelector(".magnetic-item"), 25); // magnetic area = higher number is more attractive
      }

      function parallaxIt(e, parent, target, movement) {
        var boundingRect = parent.getBoundingClientRect();
        var relX = e.clientX - boundingRect.left;
        var relY = e.clientY - boundingRect.top;

        gsap.to(target, {
          duration: 0.3,
          x: ((relX - boundingRect.width / 2) / boundingRect.width) * movement,
          y:
            ((relY - boundingRect.height / 2) / boundingRect.height) * movement,
          ease: Power2.easeOut,
        });
      }

      function parallaxCursor(e, parent, movement) {
        var rect = parent.getBoundingClientRect();
        var relX = e.clientX - rect.left;
        var relY = e.clientY - rect.top;
        $pos.x =
          rect.left + rect.width / 2 + (relX - rect.width / 2) / movement;
        $pos.y =
          rect.top + rect.height / 2 + (relY - rect.height / 2) / movement;
        gsap.to($ball, { duration: 0.3, x: $pos.x, y: $pos.y });
      }

      // Magic cursor behavior
      // ======================

      // Magnetic item hover.
      $(".magnetic-wrap")
        .on("mouseenter mouseover", function (e) {
          $ball.addClass("magnetic-active");
          gsap.to($ball, { duration: 0.3, width: 70, height: 70, opacity: 1 });
          $active = true;
        })
        .on("mouseleave", function (e) {
          $ball.removeClass("magnetic-active");
          gsap.to($ball, {
            duration: 0.3,
            width: $ballWidth,
            height: $ballHeight,
            opacity: $ballOpacity,
          });
          gsap.to(this.querySelector(".magnetic-item"), {
            duration: 0.3,
            x: 0,
            y: 0,
            clearProps: "all",
          });
          $active = false;
        });

      // Alternative cursor style on hover.
      $(
        ".cursor-alter, .tt-main-menu-list > li > a, .tt-main-menu-list > li > .tt-submenu-trigger > a"
      )
        .not(".magnetic-item") // omit from selection.
        .on("mouseenter", function () {
          gsap.to($ball, {
            duration: 0.3,
            borderWidth: 0,
            opacity: 0.2,
            backgroundColor: "#CCC",
            width: "90px",
            height: "90px",
          });
        })
        .on("mouseleave", function () {
          gsap.to($ball, {
            duration: 0.3,
            borderWidth: $ballBorderWidth,
            opacity: $ballOpacity,
            backgroundColor: "transparent",
            width: $ballWidth,
            height: $ballHeight,
            clearProps: "backgroundColor",
          });
        });

      // Cursor view on hover (data attribute "data-cursor="...").
      $("[data-cursor]").each(function () {
        $(this)
          .on("mouseenter", function () {
            $ball
              .addClass("ball-view")
              .append('<div class="ball-view-inner"></div>');
            $(".ball-view-inner").append($(this).attr("data-cursor"));
            gsap.to($ball, {
              duration: 0.3,
              yPercent: -75,
              width: 82,
              height: 82,
              opacity: 1,
              borderWidth: 0,
            });
            gsap.to(".ball-view-inner", {
              duration: 0.3,
              scale: 1,
              autoAlpha: 1,
            });
          })
          .on("mouseleave", function () {
            gsap.to($ball, {
              duration: 0.3,
              yPercent: -50,
              width: $ballWidth,
              height: $ballHeight,
              opacity: $ballOpacity,
              borderWidth: $ballBorderWidth,
            });
            $ball.removeClass("ball-view").find(".ball-view-inner").remove();
          });
        $(this).addClass("not-hide-cursor");
      });

      // Cursor drag on hover (class "cursor-drag"). For Swiper sliders.
      $(".swiper").each(function () {
        if ($(this).parent().attr("data-simulate-touch") === "true") {
          if ($(this).parent().hasClass("cursor-drag")) {
            $(this)
              .on("mouseenter", function () {
                $ball.append('<div class="ball-drag"></div>');
                gsap.to($ball, {
                  duration: 0.3,
                  width: 60,
                  height: 60,
                  opacity: 1,
                });
              })
              .on("mouseleave", function () {
                $ball.find(".ball-drag").remove();
                gsap.to($ball, {
                  duration: 0.3,
                  width: $ballWidth,
                  height: $ballHeight,
                  opacity: $ballOpacity,
                });
              });
            $(this).addClass("not-hide-cursor");

            // Ignore "data-cursor" on hover.
            $(this)
              .find("[data-cursor]")
              .on("mouseenter mouseover", function () {
                $ball.find(".ball-drag").remove();
                return false;
              })
              .on("mouseleave", function () {
                $ball.append('<div class="ball-drag"></div>');
                gsap.to($ball, {
                  duration: 0.3,
                  width: 60,
                  height: 60,
                  opacity: 1,
                });
              });
          }
        }
      });

      // Cursor drag on mouse down / click and hold effect (class "cursor-drag-mouse-down"). For Swiper sliders.
      $(".swiper").each(function () {
        if ($(this).parent().attr("data-simulate-touch") === "true") {
          if ($(this).parent().hasClass("cursor-drag-mouse-down")) {
            $(this)
              .on("mousedown pointerdown", function (e) {
                if (e.which === 1) {
                  // Affects the left mouse button only!
                  gsap.to($ball, {
                    duration: 0.2,
                    width: 60,
                    height: 60,
                    opacity: 1,
                  });
                  $ball.append('<div class="ball-drag"></div>');
                }
              })
              .on("mouseup pointerup", function () {
                $ball.find(".ball-drag").remove();
                if ($(this).find("[data-cursor]:hover").length) {
                } else {
                  gsap.to($ball, {
                    duration: 0.2,
                    width: $ballWidth,
                    height: $ballHeight,
                    opacity: $ballOpacity,
                  });
                }
              })
              .on("mouseleave", function () {
                $ball.find(".ball-drag").remove();
                gsap.to($ball, {
                  duration: 0.2,
                  width: $ballWidth,
                  height: $ballHeight,
                  opacity: $ballOpacity,
                });
              });

            // Ignore "data-cursor" on mousedown.
            $(this)
              .find("[data-cursor]")
              .on("mousedown pointerdown", function () {
                return false;
              });

            // Ignore "data-cursor" on hover.
            $(this)
              .find("[data-cursor]")
              .on("mouseenter mouseover", function () {
                $ball.find(".ball-drag").remove();
                return false;
              });
          }
        }
      });

      // Cursor close on hover.
      $(".cursor-close").each(function () {
        $(this).addClass("ball-close-enabled");
        $(this)
          .on("mouseenter", function () {
            $ball.addClass("ball-close-enabled");
            $ball.append('<div class="ball-close">Close</div>');
            gsap.to($ball, {
              duration: 0.3,
              yPercent: -75,
              width: 80,
              height: 80,
              opacity: 1,
            });
            gsap.from(".ball-close", { duration: 0.3, scale: 0, autoAlpha: 0 });
          })
          .on("mouseleave click", function () {
            $ball.removeClass("ball-close-enabled");
            gsap.to($ball, {
              duration: 0.3,
              yPercent: -50,
              width: $ballWidth,
              height: $ballHeight,
              opacity: $ballOpacity,
            });
            $ball.find(".ball-close").remove();
          });

        // Hover on "cursor-close" inner elements.
        $(
          ".cursor-close a, .cursor-close button, .cursor-close .tt-btn, .cursor-close .hide-cursor"
        )
          .not(".not-hide-cursor") // omit from selection (class "not-hide-cursor" is for global use).
          .on("mouseenter", function () {
            $ball.removeClass("ball-close-enabled");
          })
          .on("mouseleave", function () {
            $ball.addClass("ball-close-enabled");
          });
      });

      // ================================================================
      // Scroll between anchors
      // ================================================================

      $('a[href^="#"]')
        .not('[href$="#"]') // omit from selection
        .not('[href$="#0"]') // omit from selection
        .on("click", function () {
          var target = this.hash;

          // If fixed header position enabled.
          if ($("#tt-header").hasClass("tt-header-fixed")) {
            var $offset = $("#tt-header").height();
          } else {
            var $offset = 0;
          }

          // You can use data attribute (for example: data-offset="100") to set top offset in HTML markup if needed.
          if ($(this).data("offset") != undefined)
            $offset = $(this).data("offset");

          return false;
        });

      // Show/hide magic cursor
      // =======================

      // Hide on hover.
      $(
        "a, button, .tt-btn, .tt-form-control, .tt-form-radio, .tt-form-check, .hide-cursor"
      ) // class "hide-cursor" is for global use.
        .not(".not-hide-cursor") // omit from selection (class "not-hide-cursor" is for global use).
        .not(".cursor-alter") // omit from selection
        .not(".tt-main-menu-list > li > a") // omit from selection
        .not(".tt-main-menu-list > li > .tt-submenu-trigger > a") // omit from selection
        .on("mouseenter", function () {
          gsap.to($ball, { duration: 0.3, scale: 0, opacity: 0 });
        })
        .on("mouseleave", function () {
          gsap.to($ball, { duration: 0.3, scale: 1, opacity: $ballOpacity });
        });

      // Hide on click.
      $("a")
        .not('[target="_blank"]') // omit from selection.
        .not('[href^="#"]') // omit from selection.
        .not('[href^="mailto"]') // omit from selection.
        .not('[href^="tel"]') // omit from selection.
        .not(".lg-trigger") // omit from selection.
        .not(".video-player") // omit from selection.
        .not(".tt-btn-disabled") // omit from selection.
        .on("click", function () {
          gsap.to($ball, { duration: 0.3, scale: 1.3, autoAlpha: 0 });
        });

      // Show/hide on document leave/enter.
      $(document)
        .on("mouseleave", function () {
          gsap.to("#magic-cursor", { duration: 0.3, autoAlpha: 0 });
        })
        .on("mouseenter", function () {
          gsap.to("#magic-cursor", { duration: 0.3, autoAlpha: 1 });
        });

      // Show as the mouse moves.
      $(document).mousemove(function () {
        gsap.to("#magic-cursor", { duration: 0.3, autoAlpha: 1 });
      });
    }
  }

  // Back To Top

  var progressPath = document.querySelector(
    ".progress-wrap .progress-circle path"
  );
  if (progressPath) {
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "none";
    progressPath.style.strokeDasharray = pathLength + " " + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition =
      "stroke-dashoffset 10ms linear";
    var updateProgress = function () {
      var scroll = $(window).scrollTop();
      var height = $(document).height() - $(window).height();
      var progress = pathLength - (scroll * pathLength) / height;
      progressPath.style.strokeDashoffset = progress;
    };
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 50;
    var duration = 550;
    jQuery(window).on("scroll", function () {
      if (jQuery(this).scrollTop() > offset) {
        jQuery(".progress-wrap").addClass("active-progress");
      } else {
        jQuery(".progress-wrap").removeClass("active-progress");
      }
    });
    jQuery(".progress-wrap").on("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // Fast Counter
  $(".count").each(function () {
    $(this)
      .prop("Counter", 0)
      .animate(
        {
          Counter: $(this).text(),
        },
        {
          duration: 4000,
          easing: "swing",
          step: function (now) {
            $(this).text(Math.ceil(now));
          },
        }
      );
  });

  document.addEventListener("DOMContentLoaded", function () {
    const text = document.querySelector(".circular-text .text");
    if (text) {
      text.innerHTML = text.innerText
        .split("")
        .map(
          (char, i) =>
            `<span style="transform:rotate(${i * 13}deg)">${char}</span>`
        )
        .join("");
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    const text = document.querySelector(".circular-text .text");
    if (text) {
      text.innerHTML = text.innerText
        .split("")
        .map(
          (char, i) =>
            `<span style="transform:rotate(${i * 13}deg)">${char}</span>`
        )
        .join("");
    }
  });

  // Hover effect for service-list
  $(".item-list li").on("mouseenter", function () {
    var index = $(this).index();

    // Add active class to the corresponding image
    $(".item-img-list li").removeClass("show");
    $(".item-img-list li").eq(index).addClass("show");

    // Manage .prev class
    $(".item-list li").removeClass("prev");
    if (index > 0) {
      $(".item-listt li")
        .eq(index - 1)
        .addClass("prev");
    }
  });

  $(".item-list li").on("mouseleave", function () {
    // Remove active class from all images when mouse leaves
    $(".item-img-list li").removeClass("show");
  });

  // Click effect for service-list
  function setupServiceImageInteraction() {
    const isMobile = window.innerWidth <= 991;

    // Remove previous bindings to avoid stacking
    $(".item-list li").off("click");

    $(".item-list li").on("click", function () {
      var index = $(this).index();

      // Update active class on service list
      $(".item-list li").removeClass("active");
      $(this).addClass("active");

      // Update image preview
      $(".item-img-list li").removeClass("active");
      $(".item-img-list li").eq(index).addClass("active");

      // Manage .prev class
      $(".item-list li").removeClass("prev");
      if (index > 0) {
        $(".item-list li")
          .eq(index - 1)
          .addClass("prev");
      }

      // Extra scroll behavior for mobile
      if (isMobile) {
        $("html, body").animate(
          {
            scrollTop: $(".item-img-list").offset().top - 100,
          },
          600
        );
      }
    });
  }
  // Initial setup and on resize
  setupServiceImageInteraction();
  $(window).on("resize", setupServiceImageInteraction);

  // BTN Hover
  $(".btn-hover")
    .on("mouseenter", function (e) {
      var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
      $(this).find("span").css({ top: 0, left: 0 });
      $(this).find("span").css({ top: relY, left: relX });
    })
    .on("mouseout", function (e) {
      var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
      $(this).find("span").css({ top: 0, left: 0 });
      $(this).find("span").css({ top: relY, left: relX });
    });

  //Project Info Flow
  const infoflow1TextItem = document.querySelectorAll(
    ".comfort-signature-card"
  );
  function followImageCursor(event, infoflow1TextItem) {
    const contentBox = infoflow1TextItem.getBoundingClientRect();
    const dx = event.clientX - contentBox.x;
    const dy = event.clientY - contentBox.y;
    infoflow1TextItem.children[1].style.transform = `translate(${dx}px, ${dy}px)`;
  }

  infoflow1TextItem.forEach((item, i) => {
    item.addEventListener("mousemove", (event) => {
      setInterval(followImageCursor(event, item), 100);
    });
  });

  // Feature Banner
  const buttons = document.querySelectorAll(
    ".feature-list .feature-single-item"
  );
  const stage = document.querySelector("#background-panel");

  buttons.forEach((button) => {
    button.onmouseover = function () {
      document.querySelector(button.dataset.show).style.opacity = 1;
      jQuery(button.dataset.show).addClass("active");
    };
    button.onmouseout = function () {
      document.querySelector(button.dataset.show).style.opacity = 0;
      jQuery(button.dataset.show).removeClass("active");
    };
  });

  $(".comfort-vibes-link").each(function () {
    $(this).on("mouseover", function () {
      $(".comfort-vibes-item").removeClass("active");
      $(this).parent().addClass("active");
    });
  });

  //list grid view
  $(".grid-view li").on("click", function () {
    // Get the class of the clicked li element
    var clickedClass = $(this).attr("class");
    // Extract the class name without "item-" prefix
    var className = clickedClass.replace("item-", "");
    // Add a new class to the target div and remove old classes
    var targetDiv = $(".list-grid-product-wrap");
    targetDiv
      .removeClass()
      .addClass("list-grid-product-wrap " + className + "-wrapper");
    // Remove the 'selected' class from siblings and add it to the clicked element
    $(this).siblings().removeClass("active");
    $(this).addClass("active");
  });

  // Filter sidebar
  $(".filter-btn").on("click", function (e) {
    e.stopPropagation();

    $(".room-sidebar-area").toggleClass("slide");
    $(this).toggleClass("active"); // Toggle active class on filter button
  });

  $(document).on("click", function (e) {
    if (!$(e.target).closest(".room-sidebar-area, .filter-btn").length) {
      $(".room-sidebar-area").removeClass("slide");
      $(".filter-btn").removeClass("active"); // Remove active class when clicked outside
    }
  });

  $(".filter-btn").on("click", function (e) {
    e.stopPropagation();

    $(".blog-sidebar-area").toggleClass("slide");
    $(this).toggleClass("active"); // Toggle active class on filter button
  });

  $(document).on("click", function (e) {
    if (!$(e.target).closest(".blog-sidebar-area, .filter-btn").length) {
      $(".blog-sidebar-area").removeClass("slide");
      $(".filter-btn").removeClass("active"); // Remove active class when clicked outside
    }
  });

  $(".offer-topbar-close-btn").on("click", function () {
    $(".header-offer-topbar-wrap").addClass("offer-topbar-close");
  });

  // Wait until the DOM is fully loaded
  document.addEventListener("DOMContentLoaded", function () {
    // Select all circular text items
    const circularTexts = document.querySelectorAll(".circular-text-item");

    if (circularTexts.length) {
      circularTexts.forEach((item) => {
        // Initialize CircleType for each item
        new CircleType(item).forceHeight(true).forceWidth(true);
      });
    }
  });

  //Home1 Event Card
  let panels = gsap.utils.toArray(".panel");

  panels.forEach((panel, i) => {
    if (i !== panels.length - 1) {
      ScrollTrigger.create({
        trigger: panel,
        start: "top top",
        end: "bottom top",
        scrub: true,
        pin: true,
        pinSpacing: false,
      });
    }
  });

  // Quantity Increment Room
  $(".room-quantity__plus").on("click", function (e) {
    e.preventDefault();
    var input = $(this).siblings(".quantity__input");
    var value = parseInt(input.val(), 10);

    value++;
    $("#room-qty").text(value.toString());
    input.val(value.toString());
  });

  $(document).ready(function () {
    $(".filter-item-list .single-item").on("click", function () {
      var $clickedItem = $(this);
      var index = $clickedItem.index();

      // Add 'active' class to clicked item and remove from others
      $clickedItem.addClass("active").siblings().removeClass("active");

      // Show corresponding .filter-input by index
      $(".filter-input-wrap .filter-input")
        .removeClass("show")
        .eq(index)
        .addClass("show");
    });
  });

  // Contact DropDown Btn
  $(".contact-dropdown-btn").on("click", function (e) {
    let parent = $(this).parent();
    parent.find(".contact-list").toggleClass("active");
    e.stopPropagation();
  });
  $(document).on("click", function (e) {
    if (!$(e.target).closest(".contact-dropdown-btn").length) {
      $(".contact-list").removeClass("active");
    }
  });

  // Handle click on the input item
  $(".custom-select-dropdown").on("click", function () {
    $(".custom-select-wrap").toggleClass("active");
  });

  $(".single-search-box, .single-field").each(function () {
    var $box = $(this);
    var $dropdown = $box.find(".custom-select-dropdown");
    var $input = $dropdown.find("input");
    var $wrap = $box.find(".custom-select-wrap");
    var $searchInput = $wrap.find(".custom-select-search-area input");

    // Toggle dropdown on click
    $dropdown.on("click", function (e) {
      e.stopPropagation();
      $(".custom-select-wrap").removeClass("active"); // Close others
      $wrap.toggleClass("active");
    });

    // Handle option click
    $wrap.find(".option-list-destination li").on("click", function () {
      var country = $(this).find(".destination h6").text();
      var destination = $(this).find(".destination span").text();
      const countryDestinationHtml = `<div class="destination"><h6>${country}</h6> <span>${destination}</span></div>`;
      $box.find(".input-field-value").empty().html(countryDestinationHtml); // ✅ FIXED
      $input.val(country + destination);
      $wrap.removeClass("active");
    });

    $wrap.find(".option-list li").on("click", function () {
      var value = $(this).find("h6").text();
      $input.val(value);
      $wrap.removeClass("active");
    });

    // Search filter
    $searchInput.on("input", function () {
      var searchText = $(this).val().toLowerCase();
      $wrap
        .find(".option-list-destination li, .option-list li")
        .each(function () {
          var destinationText = $(this)
            .find(".destination h6, h6")
            .text()
            .toLowerCase();
          $(this).toggle(destinationText.includes(searchText));
        });
    });

    // Close dropdown on click outside
    $(document).on("click", function (event) {
      if (!$(event.target).closest($box).length) {
        $wrap.removeClass("active");
      }
    });
  });

  // calender
  $(function () {
    const today = moment();
    const checkOutDefault = moment().add(3, "days");
    const tomorrow = moment().add(1, "days");

    // ----------- General Calendar: inOut (Per Dropdown) ------------
    $('input[name="inOut"]').each(function () {
      const $input = $(this);
      const $display = $input
        .closest(".custom-select-dropdown")
        .find(".selected-date");

      $input.daterangepicker(
        {
          singleDatePicker: true,
          startDate: today,
          minYear: 2025,
          maxYear: 2026,
          locale: {
            format: "DD-MMM-YYYY",
          },
        },
        function (start) {
          const formattedDayMonth = start.format("D MMMM");
          const formattedDayYear = start.format("dddd YYYY");
          const formattedDate = `<div class="selected-date"><h6>${formattedDayMonth}</h6><span>${formattedDayYear}</span></div>`;
          $display.html(formattedDate);
        }
      );

      // Initialize default
      $display.html(
        `<div class="selected-date"><h6>${today.format(
          "D MMMM"
        )}</h6><span>${today.format("dddd YYYY")}</span></div>`
      );
    });
    $('input[name="inOut2"]').each(function () {
      const $input = $(this);

      $input.daterangepicker(
        {
          singleDatePicker: true,
          showDropdowns: true,
          startDate: "01-Jan-2005",
          minYear: 1980,
          maxYear: 2020,
          locale: {
            format: "DD-MMM-YYYY",
          },
        },
        function (start) {
          var years = moment().diff(start, "years");
        }
      );
    });

    // ----------- Hotel Check-In (Scoped) ------------
    $("input.hotel-checkin").each(function () {
      const $input = $(this);
      const $display = $input
        .closest(".custom-select-dropdown, .hotel-box, .date-box")
        .find(".hotel-selected-date-checkin");
      const $display2 = jQuery(document).find(".hotel-selected-date-checkout");

      $input.daterangepicker(
        {
          opens: "center",
          startDate: today,
          endDate: checkOutDefault,
          minYear: 2025,
          maxYear: 2026,
          locale: {
            format: "DD-MMM",
          },
        },
        function (start, end) {
          const formatted = start.format("D MMMM");
          $display.html(`<h6>${formatted}</h6><span>Заезд</span>`);

          const formattedCheckOut = end.format("D MMMM");
          $display2.html(`<h6>${formattedCheckOut}</h6><span>Отъезд</span>`);
        }
      );
      $("#hotel-details-calendar").toggleClass("active");
      // Default display before selection
      $display.html(`<h6>${today.format("D MMMM")}</h6><span>Заезд</span>`);
      $display2.html(
        `<h6>${checkOutDefault.format("D MMMM")}</h6><span>Отъезд</span>`
      );
    });

    $("input.book-modal-hotel-checkin").each(function () {
      const $input = $(this);
      const $display = $input
        .closest(".custom-select-dropdown, .hotel-box, .date-box")
        .find(".book-modal-hotel-selected-date-checkin");
      const $display2 = jQuery(document).find(
        ".book-modal-hotel-selected-date-checkout"
      );

      $input.daterangepicker(
        {
          opens: "center",
          startDate: today,
          endDate: checkOutDefault,
          minYear: 2025,
          maxYear: 2026,
          locale: {
            format: "DD/MM/YY",
          },
        },
        function (start, end) {
          const formatted = start.format("DD/MM/YY");
          $display.html(`<h6>${formatted}</h6>`);

          const formattedCheckOut = end.format("DD/MM/YY");
          $display2.html(`<h6>${formattedCheckOut}</h6>`);
        }
      );
      // Default display before selection
      $display.html(`<h6>${today.format("DD/MM/YY")}</h6>`);
      $display2.html(`<h6>${checkOutDefault.format("DD/MM/YY")}</h6>`);
    });

    $("input.booking-form-hotel-checkin").each(function () {
      const $input = $(this);
      const $display = $input
        .closest(".custom-select-dropdown, .hotel-box, .date-box")
        .find(".booking-form-hotel-selected-date-checkin");
      const $display2 = jQuery(document).find(
        ".booking-form-hotel-selected-date-checkout"
      );

      $input.daterangepicker(
        {
          opens: "center",
          startDate: today,
          endDate: checkOutDefault,
          minYear: 2025,
          maxYear: 2026,
          locale: {
            format: "DD/MM/YY",
          },
        },
        function (start, end) {
          const formatted = start.format("DD/MM/YY");
          $display.html(`<h6>${formatted}</h6>`);

          const formattedCheckOut = end.format("DD/MM/YY");
          $display2.html(`<h6>${formattedCheckOut}</h6>`);
        }
      );
      // Default display before selection
      $display.html(`<h6>${today.format("DD/MM/YY")}</h6>`);
      $display2.html(`<h6>${checkOutDefault.format("DD/MM/YY")}</h6>`);
    });
    $("input.check-availability-hotel-checkin").each(function () {
      const $input = $(this);
      const $display = $input
        .closest(".custom-select-dropdown, .hotel-box, .date-box")
        .find(".check-availability-hotel-selected-date-checkin");
      const $display2 = jQuery(document).find(
        ".check-availability-hotel-selected-date-checkout"
      );

      $input.daterangepicker(
        {
          opens: "center",
          startDate: today,
          endDate: checkOutDefault,
          minYear: 2025,
          maxYear: 2026,
          locale: {
            format: "DD/MM/YY",
          },
        },
        function (start, end) {
          const formatted = start.format("DD/MM/YY");
          $display.html(`<h6>${formatted}</h6>`);

          const formattedCheckOut = end.format("DD/MM/YY");
          $display2.html(`<h6>${formattedCheckOut}</h6>`);
        }
      );
      // Default display before selection
      $display.html(`<h6>${today.format("DD/MM/YY")}</h6>`);
      $display2.html(`<h6>${checkOutDefault.format("DD/MM/YY")}</h6>`);
    });

    // hotel details checkout

    $(".hotel-selected-date-checkin").html(
      `<h6>${tomorrow.format("D MMMM")}</h6><span>Заезд</span>`
    );
    $(".hotel-selected-date-checkout").html(
      `<h6>${checkOutDefault.format("D MMMM")}</h6><span>Отъезд</span>`
    );
    $(
      ".hotel-details-wrapper .booking-area .date-field, .hotel-details-wrapper .booking-area .date-field .custom-select-dropdown"
    ).click(function () {
      $("#hotel-details-calendar").toggleClass("active");
    });

    $("body").on("click", "#hotel-calendar-check", function (e) {
      e.preventDefault();
      $("#hotel-details-calendar").removeClass("active");
    });

    $("body").on("click", "#tour-calendar-check", function (e) {
      e.preventDefault();
      $("#tour-booking-calendar").removeClass("active");
    });

    // Tour details
    $(".booking-modal .selected-date").html(
      `<h6>${moment(today).format("D MMMM")}</h6><span>Booking Date</span>`
    );
    $(
      ".booking-modal .modal-content .date-field,.booking-modal .modal-content .date-field .custom-select-dropdown,.booking-modal .selected-date"
    ).click(function () {
      $("#tour-booking-calendar").toggleClass("active");
    });
    $(document).click(function (e) {
      if (
        !$(e.target).closest(
          "#tour-booking-calendar, .date-field, .custom-select-dropdown, .selected-date"
        ).length
      ) {
        $("#tour-booking-calendar").removeClass("active");
      }
    });
  });

  //Quantity Increment Guest
  function updateGuestSummary($root) {
    // Adult + Child counters
    let totalAdults = 0;
    let totalChildren = 0;

    $root.find('input[name="adult_quantity"]').each(function () {
      totalAdults += parseInt($(this).val(), 10) || 0;
    });

    $root.find('input[name="child_quantity"]').each(function () {
      totalChildren += parseInt($(this).val(), 10) || 0;
    });

    // Update only the spans inside this block
    $root.find(".adult-qty").text(totalAdults);
    $root.find(".child-qty").text(totalChildren);
  }

  function updateRoomTitles() {
    $(".room-list .single-room").each(function (index) {
      $(this)
        .find(".room-title h6")
        .text(`Room-${index + 1}`);
    });
  }

  function updateRoomSummary() {
    const roomCount = $(".room-list .single-room").length;
    $(".custom-select-dropdown span strong").text(roomCount);

    if (roomCount <= 1) {
      $(".room-delete-btn").hide();
    } else {
      $(".room-delete-btn").show();
    }
  }

  function createNewRoom() {
    const $lastRoom = $(".room-list .single-room").last();
    const $newRoom = $lastRoom.clone();

    // Reset values
    $newRoom.find('input[name="adult_quantity"]').val(1);
    $newRoom.find('input[name="child_quantity"]').val(0);
    $newRoom.find(".guest-count").hide();
    $newRoom.removeClass("active-room");

    return $newRoom;
  }

  // Add new room
  const maxRooms = 5;

  $(".add-btn").on("click", function () {
    const roomCount = $(".room-list .single-room").length;

    if (roomCount >= maxRooms) {
      $(this).prop("disabled", true).addClass("disabled");
      return;
    }

    const $newRoom = createNewRoom();

    // Remove active state from others and hide
    $(".room-list .single-room")
      .removeClass("active-room")
      .find(".guest-count")
      .slideUp(0);

    // Append the new room
    $(".room-list").append($newRoom);

    // Show the new one
    $newRoom.addClass("active-room").find(".guest-count").slideDown(200);

    updateRoomTitles();
    updateRoomSummary();
    updateGuestSummary();

    // Disable button if max reached
    if ($(".room-list .single-room").length >= maxRooms) {
      $(this).prop("disabled", true).addClass("disabled");
    }
  });

  // Event delegation for plus/minus buttons
  $(document).on(
    "click",
    ".guest-quantity__plus, .guest-quantity__minus",
    function (e) {
      e.preventDefault();

      const $btn = $(this);

      // Determine nearest parent container for this guest counter
      let $root;

      if ($btn.closest(".single-field").length) {
        $root = $btn.closest(".single-field");
      } else if ($btn.closest(".room-field").length) {
        $root = $btn.closest(".room-field");
      } else {
        $root = $btn.closest(".single-search-box"); // fallback
      }

      const $input = $btn.siblings(".quantity__input");
      const type = $btn.data("type");
      let value = parseInt($input.val(), 10) || 0;

      // Minus
      if ($btn.hasClass("guest-quantity__minus")) {
        if (type === "adult" && value > 1) value--;
        if (type === "child" && value > 0) value--;
      }
      // Plus
      else {
        value++;
      }

      $input.val(value);

      // Update summary for this block only
      updateGuestSummary($root);
    }
  );

  // Optional: Initialize all summaries on page load
  $(document).ready(function () {
    $(".single-field, .room-field").each(function () {
      updateGuestSummary($(this));
    });
  });

  // Delete room
  $(document).on("click", ".room-delete-btn", function (e) {
    e.stopPropagation();

    $(this).closest(".single-room").remove();

    updateRoomTitles();
    updateRoomSummary();
    updateGuestSummary();

    const $rooms = $(".room-list .single-room");

    if ($rooms.length > 0) {
      $rooms.removeClass("active-room").find(".guest-count").slideUp(0);
      $rooms.last().addClass("active-room").find(".guest-count").slideDown(200);
    }

    // Re-enable add button if room count is below max
    if ($rooms.length < maxRooms) {
      $(".add-btn").prop("disabled", false).removeClass("disabled");
    }
  });

  // Accordion toggle
  $(document).on("click", ".room-title", function () {
    const $thisRoom = $(this).closest(".single-room");

    if ($thisRoom.hasClass("active-room")) return;

    $(".single-room")
      .not($thisRoom)
      .removeClass("active-room")
      .find(".guest-count")
      .slideUp(200);
    $thisRoom.addClass("active-room").find(".guest-count").slideDown(200);
  });

  // Initial setup
  $(document).ready(function () {
    $(".room-list .single-room").first().find(".guest-count").show();
    $(".room-list .single-room").first().addClass("active-room");
    updateRoomSummary();
  });

  $(document).ready(function () {
    $(".filter-item-list .single-item").on("click", function () {
      var $clickedItem = $(this);
      var index = $clickedItem.index();

      // Add 'active' class to clicked item and remove from others
      $clickedItem.addClass("active").siblings().removeClass("active");

      // Show corresponding .filter-input by index
      $(".filter-input-wrap .filter-input")
        .removeClass("show")
        .eq(index)
        .addClass("show");
    });
  });

  // Accordion toggle
  $(document).on("click", ".room-title", function () {
    const $thisRoom = $(this).closest(".single-room");

    if ($thisRoom.hasClass("active-room")) return;

    $(".single-room")
      .not($thisRoom)
      .removeClass("active-room")
      .find(".guest-count")
      .slideUp(200);
    $thisRoom.addClass("active-room").find(".guest-count").slideDown(200);
  });

  //Progress Bar
  document.querySelectorAll(".rating-progress-bar-wrap").forEach((wrap) => {
    const bar = wrap.querySelector(".rating-progress-bar-per");
    const percentDisplay = wrap.querySelector(".data-per");
    const target = parseFloat(bar.getAttribute("data-per")); // e.g., 90
    const duration = 1000; // in milliseconds

    let startTime = null;

    function animate(timestamp) {
      if (!startTime) startTime = timestamp;
      const elapsed = timestamp - startTime;
      const progress = Math.min(elapsed / duration, 1); // Ensure it doesn't go over 1

      const current = Math.floor(target * progress);
      bar.style.width = current + "%";
      percentDisplay.textContent = current + "%";

      if (progress < 1) {
        requestAnimationFrame(animate);
      }
    }

    requestAnimationFrame(animate);
  });

  // star-rating
  $(".rating-container .star-icon").each(function () {
    let self = $(this);

    self.on("mouseenter", function () {
      $(this).prevAll().addBack().addClass("hovered");
    });

    self.on("mouseleave", function () {
      $(".star-icon").removeClass("hovered");
    });

    self.on("click", function () {
      const rating = $(this).prevAll().length + 1;
      const parent = $(this).parent();
      parent.attr("data-rating", rating);

      parent.find(".star-icon").removeClass("selected");
      parent.find(".star-icon").each(function (index) {
        if (index < rating) {
          $(this).addClass("selected");
        }
      });
    });

    // On load or if data-rating already exists
    const parent = self.parent();
    const initRating = parseInt(parent.attr("data-rating")) || 0;
    parent.find(".star-icon").each(function (index) {
      if (index < initRating) {
        $(this).addClass("selected");
      }
    });
  });
})(jQuery);
