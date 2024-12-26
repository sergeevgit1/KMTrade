document.addEventListener("DOMContentLoaded", function () {
  const catalogButton = document.getElementById("catalog-button");
  const megaMenu = document.getElementById("mega-menu");
  const overlay = document.querySelector(".mega-menu-overlay");
  const body = document.body;
  let isActive = false;
  let timeoutId = null;

  function toggleMenu(show) {
    clearTimeout(timeoutId);
    isActive = show;

    if (show) {
      body.classList.add("catalog-active");
    } else {
      timeoutId = setTimeout(() => {
        body.classList.remove("catalog-active");
      }, 100);
    }
  }

  if (catalogButton && megaMenu) {
    // Обработка наведения
    catalogButton.addEventListener("mouseenter", () => toggleMenu(true));
    megaMenu.addEventListener("mouseenter", () => toggleMenu(true));

    // Обработка ухода мыши
    catalogButton.addEventListener("mouseleave", () => {
      if (!megaMenu.matches(":hover")) {
        toggleMenu(false);
      }
    });

    megaMenu.addEventListener("mouseleave", () => {
      if (!catalogButton.matches(":hover")) {
        toggleMenu(false);
      }
    });

    // Закрытие по Escape
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && isActive) {
        toggleMenu(false);
      }
    });
  }
});
