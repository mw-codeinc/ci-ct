$(document).ready(function() {
    $('#success-msg').hide();

    $('#productForm').on( 'submit', function(e) {
        $('#error-msg-cnt').empty();
        
        e.preventDefault();

        var token = $('input[name=_token]').val();
        var productName = $('input[name=productName]').val();
        var quantity = $('input[name=quantity]').val();
        var price = $('input[name=price]').val();

        if(e.handled !== true) {
            $.ajax({
                type: "POST",
                url: url,
                data: {_token: token, productName: productName, quantity: quantity, price: price },
            }).done(function( data ) {
                $('#success-msg').show();
                $('#product-table').prepend('' +
                    '<tr>' +
                        '<td>'+data.name+'</td>' +
                        '<td>'+data.qty+'</td>' +
                        '<td>'+data.price+'</td>' +
                        '<td>'+data.datetime+'</td>' +
                        '<td>'+data.total+'</td>' +
                    '</tr>' +
                '');
            }).error(function( xhr ) {
                var response = $.parseJSON(xhr.responseText);
                if(response && response.quantity.length !== 0) {
                    $('#error-msg-cnt').append('<div class="alert alert-danger" role="alert">'+response.quantity+'</div>');
                }
                if(response && response.price.length !== 0) {
                    $('#error-msg-cnt').append('<div class="alert alert-danger" role="alert">'+response.price+'</div>');
                }
            });
            e.handled = true;
        }
    });
});