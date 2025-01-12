document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("quick-order-form");

  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(form);
      formData.append("action", "km_trade_quick_order");
      formData.append("nonce", kmTradeData.quickOrderNonce);

      const submitButton = form.querySelector('button[type="submit"]');
      submitButton.disabled = true;

      fetch(kmTradeData.ajaxUrl, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            showNotification("success", "Заявка успешно отправлена");
            form.reset();
          } else {
            showNotification("error", data.message || "Произошла ошибка");
          }
        })
        .catch((error) => {
          showNotification("error", "Произошла ошибка при отправке");
          console.error("Error:", error);
        })
        .finally(() => {
          submitButton.disabled = false;
        });
    });
  }
});

function showNotification(type, message) {
  const notification = document.createElement("div");
  notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg ${
    type === "success" ? "bg-green-500" : "bg-red-500"
  } text-white flex items-center space-x-2 z-50`;

  const icon =
    type === "success"
      ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
      : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';

  notification.innerHTML = `${icon}<span>${message}</span>`;
  document.body.appendChild(notification);

  setTimeout(() => notification.remove(), 3000);
}
