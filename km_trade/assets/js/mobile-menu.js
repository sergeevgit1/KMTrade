document.addEventListener("DOMContentLoaded", function () {
  const burgerButton = document.getElementById("burger-menu");
  const mobileMenu = document.getElementById("mobile-menu");
  const menuContent = mobileMenu?.querySelector(".absolute.left-0");
  const overlay = mobileMenu?.querySelector(".absolute.inset-0");
  const closeButton = mobileMenu?.querySelector(
    'button[data-action="close-menu"]'
  );

  function openMenu() {
    mobileMenu.classList.remove("hidden");
    setTimeout(() => {
      menuContent.classList.remove("-translate-x-full");
    }, 10);
    document.body.classList.add("overflow-hidden");
  }

  function closeMenu() {
    menuContent.classList.add("-translate-x-full");
    setTimeout(() => {
      mobileMenu.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
    }, 300);
  }

  // Открытие по клику на бургер
  burgerButton?.addEventListener("click", openMenu);

  // Закрытие по клику на крестик
  closeButton?.addEventListener("click", closeMenu);

  // Закрытие по клику на оверлей
  overlay?.addEventListener("click", closeMenu);

  // Закрытие по Escape
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && !mobileMenu.classList.contains("hidden")) {
      closeMenu();
    }
  });
});
