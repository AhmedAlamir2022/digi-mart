"user strict"

// Notyf init
var notyf = new Notyf();

$(function() {

    /** add to cart */
    $('.add-cart').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        $.ajax({
            method: 'POST',
            url: route('cart.store', id),
            data: {
                _token: csrfToken
            },
            beforeSend: function() {
                $(`#cart-btn-${id}`).text('Adding...');
            },

            success: function(data) {
                if(data.status == 'success') {
                    $('#cart-count').text(data.cart_count);
                    notyf.success(data.message);
                    $(`#cart-btn-${id}`).text('Add to cart');
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                $(`#cart-btn-${id}`).text('Add to cart');

                notyf.error(errorMessage);
            }
        })
    })

    /** remove cart item */
    $('.cart-item-remove').on('click', function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        $.ajax({
            method: 'DELETE',
            url: route('cart.destroy', id),
            data: {
                _token: csrfToken
            },

            success: function(data) {
                if(data.status == 'success') {
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        })
    });
})