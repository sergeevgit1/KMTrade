document.addEventListener("DOMContentLoaded", function () {
  const filterForm = document.getElementById("catalog-filters");
  const productsContainer = document.getElementById("products-grid");
  const loadingOverlay = document.getElementById("loading-overlay");

  if (filterForm) {
    // Обработка изменений в форме фильтров
    filterForm.addEventListener("change", function (e) {
      if (
        e.target.matches('input[type="checkbox"], input[type="radio"], select')
      ) {
        updateProducts();
      }
    });

    // Обработка изменения цены
    const priceInputs = filterForm.querySelectorAll('input[type="number"]');
    priceInputs.forEach((input) => {
      input.addEventListener("change", debounce(updateProducts, 500));
    });
  }

  function updateProducts() {
    if (!productsContainer) return;

    // Показываем оверлей загрузки
    if (loadingOverlay) {
      loadingOverlay.classList.remove("hidden");
    }

    const formData = new FormData(filterForm);
    formData.append("action", "km_trade_filter_products");
    formData.append("nonce", kmTradeFilters.nonce);

    // Собираем данные атрибутов
    const attributes = {};
    filterForm.querySelectorAll("[data-attribute]").forEach((element) => {
      const taxonomy = element.dataset.attribute;
      if (element.checked) {
        if (!attributes[taxonomy]) {
          attributes[taxonomy] = [];
        }
        attributes[taxonomy].push(element.value);
      }
    });
    formData.append("attributes", JSON.stringify(attributes));

    fetch(kmTradeFilters.ajaxUrl, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          productsContainer.innerHTML = data.data.html;
          updateProductCount(data.data.found);
          updateUrl(formData);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      })
      .finally(() => {
        if (loadingOverlay) {
          loadingOverlay.classList.add("hidden");
        }
      });
  }

  function updateProductCount(count) {
    const countElement = document.querySelector(".woocommerce-result-count");
    if (countElement) {
      countElement.textContent = `Найдено ${count} товаров`;
    }
  }

  function updateUrl(formData) {
    const params = new URLSearchParams(window.location.search);
    for (const [key, value] of formData.entries()) {
      if (value) {
        params.set(key, value);
      } else {
        params.delete(key);
      }
    }
    window.history.replaceState(
      {},
      "",
      `${window.location.pathname}?${params.toString()}`
    );
  }

  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }
});
