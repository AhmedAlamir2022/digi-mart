"use strict";

var notyf = new Notyf();

$(document).on("click", ".add-cart", function (e) {
    e.preventDefault();

    const id = $(this).data("id");
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        method: "POST",
        url: `/add-cart/${id}`,
        data: {
            _token: csrfToken,
        },
        beforeSend: function () {
            $(`#cart-btn-${id}`).text("Adding...");
        },
        success: function (data) {
            if (data.status == "success") {
                $("#cart-count").text(data.cart_count);
                notyf.success(data.message);
                $(`#cart-btn-${id}`).text("Add to cart");
            }
        },
        error: function (xhr) {
            $(`#cart-btn-${id}`).text("Add to cart");
            notyf.error(xhr.responseJSON?.message ?? "Something went wrong");
        },
    });
});

/** remove cart item */
$(".cart-item-remove").on("click", function (e) {
    e.preventDefault();
    const id = $(this).data("id");

    $.ajax({
        method: "DELETE",
        url: `/delete-cart/${id}`,
        data: {
            _token: csrfToken,
        },

        success: function (data) {
            if (data.status == "success") {
                window.location.reload();
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});
