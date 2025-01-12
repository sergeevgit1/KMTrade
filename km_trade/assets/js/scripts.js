// Функция для переключения подменю в мобильной версии
function toggleSubmenu(button) {
  const submenu = button.closest("li").querySelector(".submenu");
  const icon = button.querySelector("svg");

  if (submenu) {
    submenu.classList.toggle("hidden");
    icon.classList.toggle("rotate-180");
  }
}

// Функция для переключения мобильного меню
function toggleMobileMenu() {
  const mobileMenu = document.getElementById("mobile-menu");
  const overlay = document.getElementById("mobile-menu-overlay");

  if (mobileMenu && overlay) {
    mobileMenu.classList.toggle("translate-x-full");
    overlay.classList.toggle("hidden");
    document.body.classList.toggle("overflow-hidden");
  }
}

// Закрытие мобильного меню при клике на оверлей
document.addEventListener("DOMContentLoaded", function () {
  const overlay = document.getElementById("mobile-menu-overlay");
  if (overlay) {
    overlay.addEventListener("click", toggleMobileMenu);
  }
});
