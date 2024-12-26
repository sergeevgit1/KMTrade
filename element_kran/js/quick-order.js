jQuery(document).ready(function ($) {
  // Открытие модального окна
  $(".quick-order-btn").click(function (e) {
    e.preventDefault();
    $(".quick-order-modal").fadeIn();
  });

  // Закрытие модального окна
  $(".close-modal").click(function () {
    $(".quick-order-modal").fadeOut();
  });

  // Закрытие по клику вне формы
  $(window).click(function (e) {
    if ($(e.target).is(".quick-order-modal")) {
      $(".quick-order-modal").fadeOut();
    }
  });

  // Отправка формы
  $("#quick-order-form").submit(function (e) {
    e.preventDefault();

    var form = $(this);
    var submitButton = form.find('button[type="submit"]');

    // Блокируем кнопку на время отправки
    submitButton.prop("disabled", true);

    $.ajax({
      url: quickOrderAjax.url,
      type: "POST",
      data: {
        action: "quick_order",
        nonce: quickOrderAjax.nonce,
        name: $("#name").val(),
        phone: $("#phone").val(),
        email: $("#email").val(),
        company: $("#company").val(),
        crane_manufacturer: $("#crane_manufacturer").val(),
        crane_model: $("#crane_model").val(),
        message: $("#message").val(),
      },
      success: function (response) {
        if (response.success) {
          alert("Спасибо! " + response.data);
          form[0].reset();
        } else {
          alert("Ошибка: " + response.data);
        }
      },
      error: function () {
        alert("Произошла ошибка при отправке формы");
      },
      complete: function () {
        submitButton.prop("disabled", false);
      },
    });
  });
});
