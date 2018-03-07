var $catalog = $('#goods');
getCount();


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

function getMore() {
    var items;
    $.post({
        url: '/ajax/catalog.php',
        data: {
            action: "get"
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
                    '<span> Add to Cart </span></div></a></div>'
            }
            $catalog.append(newItems);
            getCount();
        }
    });
}