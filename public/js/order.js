$('#orders').on('change', '.status select', function () {
    var order_id = this.id.split('_')[1];
    var status_id = $(this).val();
    $.post({
        url: '/orders/status',
        data: {
            order_id: order_id,
            status_id: status_id
        },
        dataType: 'json',
        context: this,
        success: function (data) {
            console.log(data);
        }
    });
});