document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const closeMobileMenu = document.getElementById("close-mobile-menu");
  const mobileMenu = document.getElementById("mobile-menu");
  const mobileMenuContent = document.getElementById("mobile-menu-content");
  const mainMenu = document.getElementById("main-menu");
  const mobileMenuSlide = mobileMenu.querySelector(".transform");

  // Клонируем основное меню для мобильной версии
  function cloneMenuForMobile() {
    const menuItems = mainMenu.querySelectorAll("a");
    mobileMenuContent.innerHTML = "";

    menuItems.forEach((item) => {
      const div = document.createElement("div");
      const link = item.cloneNode(true);

      // Определяем, является ли пункт меню специальной кнопкой
      const isSpecialButton = link.classList.contains("bg-primary");

      if (isSpecialButton) {
        // Для кнопок сохраняем только текст и стили
        link.className =
          "flex items-center w-full px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary-hover transition-colors";
      } else {
        // Для обычных пунктов меню
        link.className =
          "block px-4 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors";
      }

      div.appendChild(link);
      mobileMenuContent.appendChild(div);
    });
  }

  // Открытие мобильного меню
  function openMobileMenu() {
    mobileMenu.classList.remove("hidden");
    setTimeout(() => {
      mobileMenuSlide.classList.remove("translate-x-full");
    }, 10);
    document.body.style.overflow = "hidden";
  }

  // Закрытие мобильного меню
  function closeMobileMenu() {
    mobileMenuSlide.classList.add("translate-x-full");
    setTimeout(() => {
      mobileMenu.classList.add("hidden");
    }, 300);
    document.body.style.overflow = "";
  }

  // Обработчики событий
  mobileMenuButton.addEventListener("click", () => {
    cloneMenuForMobile();
    openMobileMenu();
  });

  closeMobileMenu.addEventListener("click", closeMobileMenu);

  // Закрытие при клике вне меню
  mobileMenu.addEventListener("click", (e) => {
    if (e.target === mobileMenu) {
      closeMobileMenu();
    }
  });

  // Закрытие при изменении размера экрана
  window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
      // md breakpoint
      closeMobileMenu();
    }
  });
});
