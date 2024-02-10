import { toggleTheme, disableRedirectionNav } from "./modules/utilities.js";
import { loadMain } from "./modules/request.js";

$(function () {
  // CHange Theme
  toggleTheme();
  // Disable redirection on tag <a>
  disableRedirectionNav();
  // Navigation
  $("nav ul li a").click(function () {
    $(".active-nav").removeClass("active-nav");
    $(this).addClass("active-nav");
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
