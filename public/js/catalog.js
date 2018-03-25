var $catalog = $('#goods');
getCount();

if ($('#add_item').length > 0){
    $('#add_item').on('submit', function (e) {
        var item = $(this).serializeArray();
        console.log(item);
        $.post({
            url: '/ajax/catalog.php',
            data: {
                action: "add",
                item: item
            },
            dataType: 'json',
            context: this,
            success: function (data) {
                console.log(data);
                if (data > 0){
                    $('#goods').empty();
                    getMore(0, 4);
                }
            }
        });
        e.preventDefault();
    })

    $('#goods').on('click', '.delete_item', function (e) {
        $.post({
            url: '/ajax/catalog.php',
            data: {
                action: "delete",
                id: this.id
            },
            dataType: 'json',
            context: this,
            success: function (data) {
                console.log(data);
                if (data > 0){
                    $(this).parent().remove();
                    getCount();
                }
            }
        });
        $(this).parent().remove();
        getCount();
        e.preventDefault();
    })
}

function addBtn() {
    $catalog.append('<button id="more">Еще</button>');
    $('#more').on('click', function () {
        getMore();
    });
}

function getCount() {
    var itemsCount = $catalog.children().length;
    var count;
    $.post({
        url: '/ajax/catalog.php',
        data: {
            action: "count"
        },
        dataType: 'json',
        context: this,
        success: function (data) {
            count = data;
            if (count > itemsCount) {
                addBtn();
            }
        }
    });
    return count;
}

function getMore(start, count) {
    if(start === undefined){
        start = $('#goods').children().length-1;
    }
    if(count === undefined){
        count = 4;
    }
    var items;
    $.post({
        url: '/ajax/catalog.php',
        data: {
            action: "get",
            start: start,
            count: count
        },
        dataType: 'json',
        context: this,
        success: function (data) {
            items = data;
            console.log(data);
            $('#more').remove();

            var newItems = '';
            for (var i = 0; i < data.length; i++) {
                var item = data[i];
                newItems += '<div class="fetured_item">' +
                    '<img src="/' + item['IMAGES'][0]['PATH'] + '" alt="' + item['NAME'] + '">' +
                    '<a class="fetured_item_text" href="/catalog/view/' + item['CODE'] + '">' +
                    '<p>' + item['NAME'] + '</p>' +
                    '<span class="stars">';
                var arRating = item['RATING'].split('.');
                var n = 0;
                if (arRating[0] > 0) {
                    for (var j = 0; j < arRating[0]; j++) {
                        n++;
                        newItems += '<i class="fa fa-star"></i>';
                    }
                }
                if (arRating[1] > 0) {
                    n++;
                    newItems += '<i class="fa fa-star-half-o"></i>';
                }
                if (n < 5) {
                    for (var j = 0; j < 5; j++) {
                        newItems += '<i class="fa fa-star-o"></i>';
                    }
                }
                newItems += '</span><span>&#36;' + item['PRICE'] + '</span></a>' +
                    '<a class="fetured_item_hover buy" href="/catalog/view/' + item['CODE'] + '" data-id="' + item['id'] + '">' +
                    '<div class="flex"><img src="img/forma-1-copy.png" alt="copy">' +
                    '<span> Add to Cart </span></div></a>'

                if ($('#catalog_admin').length > 0) {
                    newItems += '<button id="' + item['id'] + '" class="delete_item">Удалить</button>';
                }
                newItems += '</div>';
            }
            $catalog.append(newItems);
            getCount();
        }
    });
}