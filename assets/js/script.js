header_elem = document.getElementById("header-container");

AOS.init();

window.onscroll = function () {
  header_change();
};

function header_change() {
  if (
    document.body.scrollTop > 100 ||
    document.documentElement.scrollTop > 100
  ) {
    header_elem.className = "header-scrolled";
  } else {
    header_elem.className = "";
  }
}
