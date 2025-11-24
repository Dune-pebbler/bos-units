// Global Variables
var togglePosition = 0;
var isMobile = /Mobi|Android/i.test(navigator.userAgent);
var mainHeader = jQuery("header"); // Adjust selector if necessary

// Document Ready
jQuery(document).ready(function () {
  startOwlSlider(); // Ensure the Owl Carousel initializes on load
  initPartnersSlider(); // Initialize partners slider
  setHamburgerActiveToggle();
  postcodeAutofill();
  setOnBtnAjaxFilter();
  if (window.location.pathname === "/") {
    setColorChangeLogo();
  }

  hideHeaderOnScroll();
});

// Window Events
jQuery(window).scroll(function () {
  // hideOnScroll();
});

jQuery(window).resize(function () {
  // Add resize-specific logic here if needed
});

document.addEventListener("DOMContentLoaded", function () {
  const mobileNavLinks = document.querySelectorAll(".mobile-nav a");
  mobileNavLinks.forEach((link) => {
    link.setAttribute("target", "_blank");
  });
});

/**
 * Initializes the Owl Carousel slider with default options.
 */
function startOwlSlider() {
  if (jQuery(".owl-carousel").length) {
    jQuery(".owl-carousel").owlCarousel({
      center: true,
      loop: true,
      nav: true,
      dots: false,
      navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8L2 12L6 16"/><path d="M46 12H2"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M42 8L46 12L42 16"/><path d="M2 12H46"/></svg>',
      ],
      items: 1,
      autoplay: true, // Enable autoplay
      autoplayTimeout: 3000, // Set the autoplay speed (in milliseconds)
      autoplayHoverPause: true, // Pause autoplay on hover
      responsive: {
        0: {
          items: 1,
          stagePadding: 0,
          margin: 0,
        },
        767: {
          stagePadding: 100,
          margin: 20,
        },
        1000: {
          stagePadding: 200,
          margin: 30,
        },
      },
    });
  }
}

/**
 * Initializes the Partners Owl Carousel slider
 */
function initPartnersSlider() {
  if (jQuery(".partners-slider").length) {
    jQuery(".partners-slider").owlCarousel({
      items: 3,
      loop: false,
      margin: 30,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      navText: [
        '<svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>',
        '<svg viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>',
      ],
      responsive: {
        0: {
          items: 1,
          nav: false,
          dots: false,
          margin: 15,
        },
        768: {
          items: 2,
          nav: false,
          dots: false,
          margin: 20,
        },
        1024: {
          items: 3,
          nav: false,
          dots: false,
          margin: 30,
        },
      },
    });
  }
}

/**
 * Toggles hamburger menu states.
 */
function setHamburgerActiveToggle() {
  jQuery(".hamburger").on("click", function () {
    jQuery(".hamburger").addClass("is-active");
    jQuery("#nav-items").addClass("is-active");
    jQuery("body, html").addClass("stop-scrolling");
  });

  jQuery("#cross").on("click", function () {
    jQuery(".hamburger").removeClass("is-active");
    jQuery("#nav-items").removeClass("is-active");
    jQuery("body, html").removeClass("stop-scrolling");
  });
}

/**
 * Hides or shows the header on scroll.
 */
function hideOnScroll() {
  var currentScrollTop = jQuery(window).scrollTop();
  if (
    togglePosition < currentScrollTop &&
    currentScrollTop > 180 &&
    !isMobile
  ) {
    mainHeader.addClass("hide");
  } else {
    mainHeader.removeClass("hide");
  }
  togglePosition = currentScrollTop;
}

/**
 * Autofills form fields based on postcode input.
 */
function postcodeAutofill() {
  console.log("main.js loaded");
  jQuery("#input_3_7").on("change", function () {
    var postcodeValue = jQuery("#input_3_3").val();
    var houseNumberValue = jQuery(this).val();

    jQuery.ajax({
      url:
        "https://postcode.tech/api/v1/postcode?postcode=" +
        encodeURIComponent(postcodeValue) +
        "&number=" +
        encodeURIComponent(houseNumberValue),
      headers: {
        Authorization: "Bearer 28d9bd81-3f4d-4cec-a05d-4ec732e9f578",
      },
      method: "GET",
      success: function (data) {
        jQuery("#input_3_5").val(data.city);
        console.log(data);
      },
      error: function (error) {
        console.error("Error fetching postcode data:", error);
      },
    });
  });
}

/**
 * Handles AJAX-based filtering for projects.
 */
function setOnBtnAjaxFilter() {
  jQuery(".filter-change").on("change", function () {
    jQuery("#all-projects").addClass("fade-out");
    jQuery("#loader").show();

    jQuery.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "filter_projects",
        filters: {
          budget: {
            budgetFrom: jQuery("input[name='budget-from']").val(),
            budgetTo: jQuery("input[name='budget-to']").val(),
            field: "budget",
          },
          stays: {
            staysAmount: jQuery("#filter-stays").val(),
            field: "aantal_nachten",
          },
          people: {
            peopleAmount: jQuery("#filter-people").val(),
            field: "max_aantal_bruiloftsgasten",
          },
        },
      },
      success: function (response) {
        var responseData = JSON.parse(response);
        var htmlContent = responseData.html;
        var postCount = responseData.postCount;

        jQuery("#loader").hide();
        jQuery("#all-projects").html(htmlContent);
        jQuery("#all-projects").css("opacity", 1);
        jQuery("#all-projects").removeClass("fade-out");
        jQuery("#filter-results").text(postCount);
      },
    });
  });
}
function setColorChangeLogo() {
  // Your existing animation code remains unchanged
  const colorSequences = ["#fff"];
  const group537Paths = document.querySelectorAll("#Group_537 path");
  let currentColorIndex = 0;

  function animateColors() {
    group537Paths.forEach((path, index) => {
      const pathColorIndex =
        (currentColorIndex + index) % colorSequences.length;
      setTimeout(() => {
        path.style.transition = "fill 0.5s ease-in-out";
        path.style.fill = colorSequences[pathColorIndex];
      }, index * 100);
    });
    currentColorIndex = (currentColorIndex + 1) % colorSequences.length;
  }

  animateColors();
}
function hideHeaderOnScroll() {
  let lastScrollTop = 0;
  let upScrollDistance = 0;
  const header = jQuery("header");
  const SCROLL_THRESHOLD = 200;

  jQuery(window).on("scroll", function () {
    let scrollTop = jQuery(window).scrollTop();

    if (scrollTop < 0) {
      scrollTop = 0;
    }

    if (scrollTop < lastScrollTop) {
      // Scrolling up
      upScrollDistance += lastScrollTop - scrollTop;

      if (upScrollDistance >= SCROLL_THRESHOLD || scrollTop < 240) {
        header.css("transform", "translateY(0)");
      }
    } else if (scrollTop > lastScrollTop) {
      // Scrolling down
      upScrollDistance = 0;
      header.css("transform", "translateY(-100%)");
    }

    lastScrollTop = scrollTop;
  });
}
document.addEventListener("DOMContentLoaded", function () {
  const hamburgerButton = document.querySelector(".hamburger-button");
  const mobileMenu = document.querySelector(".mobile-menu-overlay");
  let scrollPosition = 0;

  /**
   * Locks the scroll and jumps to the top of the page.
   */
  function lockScroll() {
    scrollPosition = window.pageYOffset; // Save current scroll position
    document.body.style.overflow = "hidden";
    document.body.style.position = "fixed";
    document.body.style.top = `-${scrollPosition}px`;
    document.body.style.width = "100%";

    // Jump to the top of the page
    window.scrollTo(0, 0);
  }

  /**
   * Unlocks the scroll and restores previous position.
   */
  function unlockScroll() {
    document.body.style.removeProperty("overflow");
    document.body.style.removeProperty("position");
    document.body.style.removeProperty("top");
    document.body.style.removeProperty("width");
    window.scrollTo(0, scrollPosition); // Return to previous scroll position
  }

  /**
   * Toggles the mobile menu and scroll behavior.
   */
  hamburgerButton.addEventListener("click", function () {
    mobileMenu.classList.toggle("active");
    if (mobileMenu.classList.contains("active")) {
      lockScroll();
    } else {
      unlockScroll();
    }
  });

  /**
   * Closes the mobile menu when clicking outside the content.
   */
  mobileMenu.addEventListener("click", function (event) {
    if (!event.target.closest(".mobile-menu-content")) {
      mobileMenu.classList.remove("active");
      unlockScroll();
    }
  });

  /**
   * Closes the menu on Escape key press.
   */
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape" && mobileMenu.classList.contains("active")) {
      mobileMenu.classList.remove("active");
      unlockScroll();
    }
  });
});
