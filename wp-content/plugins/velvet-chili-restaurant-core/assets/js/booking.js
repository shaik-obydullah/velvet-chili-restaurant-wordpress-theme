jQuery(document).ready(function ($) {
  $("#bookingForm").on("submit", function (e) {
    e.preventDefault();

    var form = $(this);
    var submitBtn = form.find(".booking-form__submit");
    var originalText = submitBtn.text();

    submitBtn.text("Sending...").prop("disabled", true);

    var formData = {
      action: "vcrc_booking",
      nonce: vcrc_ajax.nonce,
      name: form.find('[name="name"]').val(),
      email: form.find('[name="email"]').val(),
      phone: form.find('[name="phone"]').val(),
      party: form.find('[name="party"]').val(),
      date: form.find('[name="date"]').val(),
      time: form.find('[name="time"]').val(),
      notes: form.find('[name="notes"]').val(),
    };

    $.post(vcrc_ajax.ajax_url, formData, function (response) {
      if (response.success) {
        alert(response.data.message);
        form[0].reset();
      } else {
        var errors = response.data.errors;
        alert(errors ? errors.join("\n") : response.data.error);
      }
    })
      .fail(function (xhr) {
        console.error(xhr);
        alert("AJAX request failed. Check console for details.");
      })
      .always(function () {
        submitBtn.text(originalText).prop("disabled", false);
      });
  });
});
