document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const closeMobileMenu = document.getElementById("close-mobile-menu");
  const mobileMenu = document.getElementById("mobile-menu");
  const mobileMenuOverlay = mobileMenu.querySelector(".absolute");
  const mobileMenuContent = mobileMenu.querySelector(".absolute.right-0");

  function openMobileMenu() {
    mobileMenu.classList.remove("hidden");
    setTimeout(() => {
      mobileMenuOverlay.classList.add("opacity-50");
      mobileMenuContent.classList.remove("translate-x-full");
    }, 50);
    document.body.classList.add("overflow-hidden");
  }

  function closeMobileMenu() {
    mobileMenuOverlay.classList.remove("opacity-50");
    mobileMenuContent.classList.add("translate-x-full");
    setTimeout(() => {
      mobileMenu.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
    }, 300);
  }

  mobileMenuButton?.addEventListener("click", openMobileMenu);
  closeMobileMenu?.addEventListener("click", closeMobileMenu);
  mobileMenuOverlay?.addEventListener("click", closeMobileMenu);
});
