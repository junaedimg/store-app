import { loadMain } from "./modules/utilities.js";
console.log(" ! main");

$(function () {
  
  // Change Theme
  $("#btn-theme").click(function () {
    let currTheme =
      $("html").attr("data-bs-theme") == "light" ? "dark" : "light";
    $("html").attr("data-bs-theme", currTheme);
  });

  // Disable redirection on tag <a>
  $("nav ul li a").each(function () {
    $(this).on("click", function (event) {
      event.preventDefault();
    });
  });

  // Navigation
  $("nav ul li a").click(function () {
    // Change navigation title
    $("header h1#nav-title").html($(this).children("span").html());
    // Remove active class from all navigation elements and add it to the currently selected one
    $(".active-nav").removeClass("active-nav");
    $(this).addClass("active-nav");
    // Load main content according to the selected href
    loadMain($(this).attr("href"));
    // Move the selected navigation indicator
    let activeNav = $(this).parent();
    let postTop = 0;
    activeNav
      .parent()
      .children()
      .filter(":not(span)")
      .each(function (index, elm) {
        if (!(elm === activeNav[0])) {
          postTop += elm.offsetHeight;
        } else {
          return false;
        }
      });
    $("nav ul span.nav-selected").css({ top: postTop + 5 });
  });
});
