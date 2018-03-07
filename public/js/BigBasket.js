function BigBasket(idBasket) {
    Container.call(this, idBasket);

    this.countGoods = 0; //Общее количество товаров
    this.amount = 0; //Общая стоимость товаров
    this.basketItems = []; //Массив для хранения товаров

    //Получаем все товары, при созаднии корзины
    this.loadBasketItems();
}

BigBasket.prototype = Object.create(Container.prototype);
BigBasket.prototype.constructor = BigBasket;

BigBasket.prototype.render = function (root) {
    var $basketDiv = $('<div />', {
        id: this.id
    });

    // var $basketItemsDiv = $('<div />', {
    //     id: this.id + '_items'
    // });
    //
    // $basketItemsDiv.appendTo($basketDiv);
    $basketDiv.appendTo(root);
};


/**
 * Метод получения/загрузки товаров
 */
BigBasket.prototype.loadBasketItems = function () {
    var appendId = '#' + this.id + '_items';

    //var self = this;
    $.post({
        url: '/basket/get',
        data: {
            action: "get"
        },
        dataType: 'json',
        context: this,
        success: function (data) {
            console.log(data);
            var $basketData = $('<div />', {
                id: 'basket_data'
            });
            if (data.result == 1) {
                data = data.items;
                this.countGoods = data.length;
                this.amount = data.amount;

                $basketData.append('<p>Всего товаров: ' + this.countGoods + '</p>');
                $basketData.append('<p>Общая сумма: ' + this.amount + '</p>');

                $basketData.appendTo(appendId);

                for (var itemKey in data) {
                    this.basketItems.push(data[itemKey]);
                }
                this.refresh();
            } else {
                console.warn(data.errorMessage);
            }
        }
    });
};

BigBasket.prototype.add = function (idProduct) {

    $.post({
        url: '/basket/add',
        data: {
            action: "add",
            item_id: idProduct
        },
        dataType: 'json',
        context: this,
        success: function (data) {
            if (data.result == 1) {
                data = data.items;
                var basketItem = data[idProduct];
                basketItem.quantity = 1;

                this.countGoods++;
                this.amount += basketItem.price;
                // this.basketItems.push(basketItem);
                var isNotInBasket = true;
                for (var itemKey in this.basketItems) {
                    if (basketItem.id === this.basketItems[itemKey].id) {
                        this.basketItems[itemKey].quantity += 1;
                        isNotInBasket = false;
                    }
                }
                if (isNotInBasket) {
                    this.basketItems.push(basketItem)
                }
                this.refresh(); //Перерисовываем корзину
            }
            else {
                console.warn(data.errorMessage);
            }

        }
    });

    // console.log(basketItem);


};

BigBasket.prototype.change = function (idProduct, quantity) {
    quantity = parseInt(quantity);
    $.post({
        url: '/basket/change',
        data: {
            action: "change",
            item_id: idProduct,
            quantity: quantity
        },
        dataType: 'json',
        context: this,
        success: function (data) {
            if (data.result == 1) {
                data = data.items;
                var basketItem = data[idProduct];
                console.log(idProduct);
                this.countGoods = 0;
                this.amount = 0;
                // this.basketItems.push(basketItem);
                for (var itemKey in this.basketItems) {
                    if (basketItem.id === this.basketItems[itemKey].id) {
                        this.basketItems[itemKey].quantity = basketItem.quantity;
                    }
                    this.countGoods += this.basketItems[itemKey].quantity;
                    this.amount += this.basketItems[itemKey].price * this.basketItems[itemKey].quantity;
                }

                this.refresh(); //Перерисовываем корзину
            }
            else {
                console.warn(data.errorMessage);
            }

        }
    });

    // console.log(basketItem);


};

BigBasket.prototype.delete = function (basket_id) {
    var idProduct = this.basketItems[basket_id].id;
    this.countGoods -= this.basketItems[basket_id].quantity;
    this.basketItems.splice(basket_id, 1);
    $.post({
        url: '/basket/delete',
        data: {
            action: "delete",
            item_id: idProduct
        },
        dataType: 'json',
        context: this,
        success: function (data) {
            this.refresh(); //Перерисовываем корзину
        }
    });
    this.refresh();
};

BigBasket.prototype.refresh = function () {
    var $basketData = $('#basket_items');
    $basketData.empty(); //Очищаем содержимое контейнера
    var basket_id = 0;
    this.amount = 0;
    this.countGoods = 0;
    if (this.basketItems.length > 0) {

        for (var itemKey in this.basketItems) {
            var rating = "<span>";
            var ar_rating = this.basketItems[itemKey].rating.toString().split(".");
            var n = 0;
            if (ar_rating[0]) {
                for (var i = 0; i < parseInt(ar_rating[0]); i++) {
                    n++;
                    rating += '<i class="fa fa-star"></i>';
                }
            }
            if (parseInt(ar_rating[1]) > 0) {
                n++;
                rating += '<i class = "fa fa-star-half-o" ></i>';
            }
            if (n < 5) {
                for (var i = n; i < 5; i++) {
                    rating += '<i class = "fa fa-star-o" ></i>';
                }
            }

            rating += "</span>"
            this.amount += this.basketItems[itemKey].price * this.basketItems[itemKey].quantity;
            this.countGoods += parseInt(this.basketItems[itemKey].quantity);

            $basketData.append('<div data-id = ' + basket_id + ' data-item_id = '+ this.basketItems[itemKey].id +' class="item_line"><div><img src="/' + this.basketItems[itemKey].image + '" alt="' + this.basketItems[itemKey].title + '"><h5>' + this.basketItems[itemKey].title + '</h5>' + rating + '</div><div>' + this.basketItems[itemKey].price + '</div> <div><input class="quantity" type="number" value="' + this.basketItems[itemKey].quantity + '"></div><div>Самовывоз</div><div> &#36;' + this.basketItems[itemKey].price + '</div><div><a class="cancel"  href="#"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></div></div>');
            basket_id++;
        }

        $("#total").html('Итого <span>&#36;' + this.amount + '</span>');
    } else {
        $("#total").html('Итого <span>0</span>');
        $basketData.append('<p class="total">EMPTY</p>');
    }
    $('#basket span').text(this.countGoods);
};

