$(document).ready(function () {


    var $display = $('#display');
    var data = {};
    data.num1 = "";
    data.num2 = "";
    data.action;
    var isFirstNum = true;
    var action;

    function sendForm(data) {
        $.ajax({
            type: "POST",
            url: "../ajax/calculator.php",
            async: false,
            data: data,
            success: function (data) {
                $('#display').val(data);
            }
        });
    }

    function numEnter(e) {
        if (e.type == "keyup") {
            var tmp = e.which > 60 ? e.which - 96 : e.which - 48;
        } else if (e.type == "click") {
            var tmp = e.target.innerText;
        }
        console.log(tmp);
        if (isFirstNum) {
            data.num1 += tmp;
            $display.val(data.num1);
        }
        else {
            data.num2 += tmp;
            $display.val(data.num1 + " " + action + " " + data.num2);
        }
    }

    function actEnter(e) {
        if (e.type == "keyup") {
            switch (e.which) {
                case 106:
                    var tmp = 'mult';
                    var tmpText = "*";
                    break;
                case 107:
                    var tmp = 'sum';
                    var tmpText = "+";
                    break;
                case 109:
                    var tmp = 'minus';
                    var tmpText = "-";
                    break;
                case 111:
                    var tmp = 'div';
                    var tmpText = "/";
                    break;
            }
        } else if (e.type == "click") {
            console.log(e.target);
            var tmp = e.target.id;
            var tmpText = e.target.innerText;
        }
        if (isFirstNum) {
            isFirstNum = false;
            data.action = tmp;
            action = tmpText;
            $display.val(data.num1 + " " + tmpText);
        } else {
            sendForm(data);
            data.num1 = 0;
            data.num1 = $('#display').val();
            data.num2 = '';
            data.action = tmp;
            isFirstNum = false;
            action = tmpText;
            console.log('tmpTex'+tmpText);
            $display.val(data.num1 + " " + tmpText);
        }
    }

    function enter(e) {
        sendForm(data);
        if (e.type == "click")
            e.preventDefault();
    }

        $('.numbers').on("click", "div", numEnter);
        $('.actions').on("click", "div", actEnter);
        $('#equel').on("click", enter);
        $('.clear').on("click", function (e) {
            data.num1 = "";
            data.num2 = "";
            data.action = "";
            isFirstNum = true;
            action = "";
            $display.val('');
            e.preventDefault();
        });

$(document).keyup(function (e) {
    switch (e.which) {
        case 96:
        case 97:
        case 98:
        case 99:
        case 100:
        case 101:
        case 102:
        case 103:
        case 104:
        case 105:
        case 48:
        case 49:
        case 50:
        case 51:
        case 52:
        case 53:
        case 54:
        case 55:
        case 56:
        case 57:
            numEnter(e);
            break;
        case 106:
        case 107:
        case 109:
        case 111:
            actEnter(e);
            break;
        case 13:
            enter(e);
            break;
    }
})


})
;