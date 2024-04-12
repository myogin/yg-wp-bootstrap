/*--------------------------------------------------------------
Theme JS
--------------------------------------------------------------*/

jQuery(function ($) {
  // Close offcanvas on click a, keep .dropdown-menu open (see https://github.com/bootscore/bootscore/discussions/347)
  $(".offcanvas a:not(.dropdown-toggle, .remove_from_cart_button)").on(
    "click",
    function () {
      $(".offcanvas").offcanvas("hide");
    }
  );

  // Search collapse button hide if empty
  // Deprecated v5.2.3.4, done by php if (is_active_sidebar('top-nav-search')) in header.php
  // Remove in v6
  if ($("#collapse-search").children().length == 0) {
    $(".top-nav-search-md, .top-nav-search-lg").remove();
  }

  // Searchform focus
  $("#collapse-search").on("shown.bs.collapse", function () {
    $(".top-nav-search input:first-of-type").trigger("focus");
  });

  // Close collapse if click outside searchform
  $(document).on("click", function (event) {
    if ($(event.target).closest("#collapse-search").length === 0) {
      $("#collapse-search").collapse("hide");
    }
  });

  // Scroll to top Button
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 500) {
      $(".top-button").addClass("visible");
    } else {
      $(".top-button").removeClass("visible");
    }
  });

  // div height, add class to your content
  $(".height-50").css("height", 0.5 * $(window).height());
  $(".height-75").css("height", 0.75 * $(window).height());
  $(".height-85").css("height", 0.85 * $(window).height());
  $(".height-100").css("height", 1.0 * $(window).height());
}); // jQuery End

/*!
 * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
 * Copyright 2011-2023 The Bootstrap Authors
 * Licensed under the Creative Commons Attribution 3.0 Unported License.
 */

(() => {
  "use strict";

  const getStoredTheme = () => localStorage.getItem("theme");
  const setStoredTheme = (theme) => localStorage.setItem("theme", theme);

  const getPreferredTheme = () => {
    const storedTheme = getStoredTheme();
    if (storedTheme) {
      return storedTheme;
    }

    return window.matchMedia("(prefers-color-scheme: dark)").matches
      ? "dark"
      : "light";
  };

  const setTheme = (theme) => {
    if (theme === "auto") {
      document.documentElement.setAttribute(
        "data-bs-theme",
        window.matchMedia("(prefers-color-scheme: dark)").matches
          ? "dark"
          : "light"
      );
    } else {
      document.documentElement.setAttribute("data-bs-theme", theme);
    }
  };

  setTheme(getPreferredTheme());

  const showActiveTheme = (theme, focus = false) => {
    const themeSwitcher = document.querySelector("#bd-theme");

    if (!themeSwitcher) {
      return;
    }

    const themeSwitcherText = document.querySelector("#bd-theme-text");
    const activeThemeIcon = document.querySelector(
      `[data-bs-theme-value-icon="${theme}"]`
    );
    const btnToActive = document.querySelector(
      `[data-bs-theme-value="${theme}"]`
    );
    // const svgOfActiveBtn = btnToActive
    //   .querySelector("svg use")
    //   .getAttribute("href");

    document.querySelectorAll("[data-bs-theme-value]").forEach((element) => {
      element.classList.remove("active");
      element.setAttribute("aria-pressed", "false");
    });

    btnToActive.classList.add("active");
    btnToActive.setAttribute("aria-pressed", "true");

    document
      .querySelectorAll("[data-bs-theme-value-icon]")
      .forEach((element) => {
        element.classList.remove("d-block");
        element.classList.add("d-none");
      });
    activeThemeIcon.classList.remove("d-none");
    // activeThemeIcon.setAttribute("href", svgOfActiveBtn);
    const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`;
    themeSwitcher.setAttribute("aria-label", themeSwitcherLabel);

    if (focus) {
      themeSwitcher.focus();
    }
  };

  window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", () => {
      const storedTheme = getStoredTheme();
      if (storedTheme !== "light" && storedTheme !== "dark") {
        setTheme(getPreferredTheme());
      }
    });

  window.addEventListener("DOMContentLoaded", () => {
    showActiveTheme(getPreferredTheme());

    document.querySelectorAll("[data-bs-theme-value]").forEach((toggle) => {
      toggle.addEventListener("click", () => {
        const theme = toggle.getAttribute("data-bs-theme-value");
        setStoredTheme(theme);
        setTheme(theme);
        showActiveTheme(theme, true);
      });
    });
  });
})();
