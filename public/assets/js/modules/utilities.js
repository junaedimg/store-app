// Modul utilitas untuk fungsi-fungsi umum
export function toggleTheme() {
  $("#btn-theme").click(function () {
    let currTheme =
      $("html").attr("data-bs-theme") == "light" ? "dark" : "light";
    $("html").attr("data-bs-theme", currTheme);
  });
}

export function disableRedirectionNav() {
  document.querySelectorAll("nav ul li a").forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
    });
  });
}
