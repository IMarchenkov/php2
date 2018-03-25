$(document).ready(function () {

    $('#basket_data').mouseleave(function () {
        $('#basket_data').fadeOut();
    });
    $('#basket').mouseenter(function () {
        $('#basket_data').css("display", "block");
    });
    $(document).mouseup(function (e) {
        var container = $("#basket_data");
        if (container.has(e.target).length === 0) {
            container.hide();
        }
    });

    var basket = new Basket('basket');
    basket.render($('#basket'));

    var big_basket = new BigBasket('basket');
    big_basket.render($('#big_basket'));

    $('#goods').on('click', '.buy', function (e) {
        console.log(this);
        var id = parseInt($(this).attr('data-id'));
        console.log(id);
        basket.add(id);
        e.preventDefault();
    });

    $('#basket_data').on('click', '.cancel', function () {
        var id = parseInt(this.parentElement.dataset.id);
        basket.delete(id);
        big_basket.delete(id);
    });

    $('#big_basket').on('click', '.cancel', function () {
        var id = parseInt(this.parentElement.parentElement.dataset.id);
        big_basket.delete(id);
        basket.delete(id);
    });

    $('#big_basket').on('change', '.quantity', function () {
        var quantity = $(this).val();
        var item_id = parseInt(this.parentElement.parentElement.dataset.item_id);
        console.log(quantity);
        if (quantity > 0) {
            big_basket.change(item_id, quantity);
            basket.refresh();
        }
        else {
            var id = parseInt(this.parentElement.parentElement.dataset.id);
            big_basket.delete(id);
            basket.delete(id);
        }
    });

    $('#order').on('click', function (e) {
        console.log(this);
        $.post({
            beforeSend: function(){$(this).attr('disabled', true)},
            url: '/orders/add',
            data: {
                delivery_id: '1',
                payment_id: '1'
            },
            dataType: 'json',
            context: this,
            success: function (data) {
                console.log(data);
                if (data.result == 0){
                    $('#warning').html(data.errorMessage);
                }else if(data.result == 1){
                    console.log(location.href);
                    var newLocation = location.href.split('/', 3).join('/')+'/account';
                    console.log(newLocation);
                    window.location.replace(newLocation);
                }
            }
        });
        e.preventDefault();
        //         console.log(data);
        //         if (data.result == 1) {
        //             big_basket.refresh();
        //             basket.refresh();
        //             $('#warning').text('');
        //         } else {
        //             $('#warning').text(data.errorMessage);
        //         }
        //     }
        // });
    });


});