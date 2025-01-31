(function ($) {
    // Toggle sidebar navigation
    if ($(".toggle-nav").length) {
      $(".toggle-nav").click(function () {
        if ($("#sidebar-links .nav-menu").length) {
          $("#sidebar-links .nav-menu").css("left", "0px");
        }
      });
    }

    if ($(".mobile-back").length) {
      $(".mobile-back").click(function () {
        if ($("#sidebar-links .nav-menu").length) {
          $("#sidebar-links .nav-menu").css("left", "-410px");
        }
      });
    }

    // Manage page wrapper class based on localStorage
    if ($(".page-wrapper").length) {
      var pageWrapperClass = localStorage.getItem("page-wrapper");
      if (pageWrapperClass) {
        $(".page-wrapper").attr("class", "page-wrapper " + pageWrapperClass);
      } else {
        $(".page-wrapper").addClass("compact-wrapper");
      }
    }

    // Left sidebar and vertical menu
    if ($("#pageWrapper").hasClass("compact-wrapper") && $(".sidebar-title").length) {
      $(".sidebar-title").append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');

      $(".sidebar-title").click(function () {
        $(".sidebar-title")
          .removeClass("active")
          .find("div")
          .replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        $(".sidebar-submenu, .menu-content").slideUp("normal");
        if ($(this).next().is(":hidden")) {
          $(this).addClass("active");
          $(this).find("div").replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
          $(this).next().slideDown("normal");
        }
      });

      $(".sidebar-submenu, .menu-content").hide();

      if ($(".submenu-title").length) {
        $(".submenu-title").append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        $(".submenu-title").click(function () {
          $(".submenu-title").removeClass("active").find("div").replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
          $(".submenu-content").slideUp("normal");
          if ($(this).next().is(":hidden")) {
            $(this).addClass("active");
            $(this).find("div").replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            $(this).next().slideDown("normal");
          }
        });
        $(".submenu-content").hide();
      }
    } else if ($("#pageWrapper").hasClass("horizontal-wrapper") && $(".sidebar-title").length) {
      var smallSize = false, bigSize = false;
      const horizontalMenu = () => {
        var contentwidth = $(window).width();
        if (contentwidth <= 992 && !smallSize) {
          smallSize = true;
          bigSize = false;
          $("#pageWrapper")
            .removeClass("horizontal-wrapper")
            .addClass("compact-wrapper");
          $(".page-body-wrapper")
            .removeClass("horizontal-menu")
            .addClass("sidebar-icon");

          $(".submenu-title").append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
          $(".submenu-title").click(function () {
            $(".submenu-title")
              .removeClass("active")
              .find("div")
              .replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            $(".submenu-content").slideUp("normal");
            if ($(this).next().is(":hidden")) {
              $(this).addClass("active");
              $(this).find("div").replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
              $(this).next().slideDown("normal");
            }
          });
          $(".submenu-content").hide();

          $(".sidebar-title").append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
          $(".sidebar-title").click(function () {
            $(".sidebar-title")
              .removeClass("active")
              .find("div")
              .replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
            $(".sidebar-submenu, .menu-content").slideUp("normal");
            if ($(this).next().is(":hidden")) {
              $(this).addClass("active");
              $(this).find("div").replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
              $(this).next().slideDown("normal");
            }
          });
          $(".sidebar-submenu, .menu-content").hide();
        }
        if (contentwidth > 992 && !bigSize) {
          smallSize = false;
          bigSize = true;
          $("#pageWrapper")
            .removeClass("compact-wrapper")
            .addClass("horizontal-wrapper");
          $(".sidebar-title .according-menu").remove();
        }
      };

      horizontalMenu();
      addEventListener("resize", (event) => {
        horizontalMenu();
      });
    } else if ($("#pageWrapper").hasClass("compact-sidebar") && $(".sidebar-title").length) {
      var contentwidth = $(window).width();
      if (contentwidth > 992) {
        $('<div class="bg-overlay1"></div>').appendTo($("body"));
      }

      $(".sidebar-title").click(function () {
        $(".sidebar-title").removeClass("active");
        $(".bg-overlay1").removeClass("active");
        $(".sidebar-submenu").removeClass("close-submenu").slideUp("normal");
        $(".sidebar-submenu, .menu-content").slideUp("normal");
        $(".menu-content").slideUp("normal");

        if ($(this).next().is(":hidden")) {
          $(this).addClass("active");
          $(this).next().slideDown("normal");
          $(".bg-overlay1").addClass("active");

          $(".bg-overlay1").on("click", function () {
            $(".sidebar-submenu, .menu-content").slideUp("normal");
            $(this).removeClass("active");
          });
        }
        if (contentwidth < 992) {
          $(".bg-overlay").addClass("active");
        }
      });
      $(".sidebar-submenu, .menu-content").hide();

      if ($(".submenu-title").length) {
        $(".submenu-title").append('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
        $(".submenu-title").click(function () {
          $(".submenu-title")
            .removeClass("active")
            .find("div")
            .replaceWith('<div class="according-menu"><i class="fa fa-angle-right"></i></div>');
          $(".submenu-content").slideUp("normal");
          if ($(this).next().is(":hidden")) {
            $(this).addClass("active");
            $(this).find("div").replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
            $(this).next().slideDown("normal");
          }
        });
        $(".submenu-content").hide();
      }
    }

    // Toggle sidebar
    if ($(".sidebar-wrapper").length && $(".page-header").length) {
      var $nav = $(".sidebar-wrapper");
      var $header = $(".page-header");
      var $toggle_nav_top = $(".toggle-sidebar");

      $toggle_nav_top.click(function () {
        $nav.toggleClass("close_icon");
        $header.toggleClass("close_icon");
        $(window).trigger("overlay");
      });

      $(window).on("overlay", function () {
        var $bgOverlay = $(".bg-overlay");
        var $isHidden = $nav.hasClass("close_icon");
        if ($(window).width() <= 1184 && !$isHidden && $bgOverlay.length === 0) {
          $('<div class="bg-overlay active"></div>').appendTo($("body"));
        }

        if ($isHidden && $bgOverlay.length > 0) {
          $bgOverlay.remove();
        }
      });

      $(".sidebar-wrapper .back-btn").on("click", function (e) {
        $(".page-header").toggleClass("close_icon");
        $(".sidebar-wrapper").toggleClass("close_icon");
        $(window).trigger("overlay");
      });

      $("body").on("click", ".bg-overlay", function () {
        $header.addClass("close_icon");
        $nav.addClass("close_icon");
        $(this).remove();
      });

      var $body_part_side = $(".body-part");
      $body_part_side.click(function () {
        $toggle_nav_top.attr("checked", false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
      });

      var $window = $(window);
      var widthwindow = $window.width();
      if (widthwindow <= 1184) {
        $toggle_nav_top.attr("checked", false);
        $nav.addClass("close_icon");
        $header.addClass("close_icon");
      }

      $(window).resize(function () {
        var widthwindaw = $window.width();
        if (widthwindaw <= 1184) {
          $toggle_nav_top.attr("checked", false);
          $nav.addClass("close_icon");
          $header.addClass("close_icon");
        } else {
          $toggle_nav_top.attr("checked", true);
          $nav.removeClass("close_icon");
          $header.removeClass("close_icon");
        }
      });
    }

    // Horizontal arrows (assuming their behavior and event binding)
    if ($(".toggle-nav").length) {
      $(".toggle-nav").click(function () {
        $("#sidebar-links .nav-menu").css("left", "0px");
      });
      $(".mobile-back").click(function () {
        $("#sidebar-links .nav-menu").css("left", "-410px");
      });
    }

  })(jQuery);
