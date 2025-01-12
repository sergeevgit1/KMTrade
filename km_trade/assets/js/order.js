document.addEventListener("DOMContentLoaded", function () {
  const orderModal = document.getElementById("order-modal");
  const orderForm = document.getElementById("order-form");
  const partsList = document.getElementById("parts-list");
  const closeModalButtons = document.querySelectorAll("[data-close-modal]");

  // Открытие модального окна заказа
  window.addToOrder = function (productName) {
    if (orderModal && partsList) {
      // Добавляем товар в список
      const currentList = partsList.value;
      partsList.value = currentList
        ? `${currentList}\n${productName}`
        : productName;

      // Открываем модальное окно
      orderModal.classList.remove("hidden");
      document.body.classList.add("overflow-hidden");
    }
  };

  // Закрытие модального окна
  function closeModal() {
    if (orderModal) {
      orderModal.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
    }
  }

  // Обработчики закрытия
  closeModalButtons.forEach((button) => {
    button.addEventListener("click", closeModal);
  });

  // Закрытие по клику вне модального окна
  if (orderModal) {
    orderModal.addEventListener("click", function (e) {
      if (e.target === orderModal) {
        closeModal();
      }
    });
  }

  // Обработка отправки формы
  if (orderForm) {
    orderForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(orderForm);
      formData.append("action", "km_trade_submit_order");
      formData.append("nonce", kmTradeData.orderNonce);

      const submitButton = orderForm.querySelector('button[type="submit"]');
      submitButton.disabled = true;

      fetch(kmTradeData.ajaxUrl, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            showNotification("success", "Заявка успешно отправлена");
            orderForm.reset();
            closeModal();
          } else {
            showNotification("error", data.data.message || "Произошла ошибка");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showNotification("error", "Произошла ошибка при отправке");
        })
        .finally(() => {
          submitButton.disabled = false;
        });
    });
  }
});
