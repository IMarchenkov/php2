$(document).ready(function () {
    function createPoster(name, link, image, text) {
        return '<div class="poster" style="background-image: url('+image+')"><a href="'+link+'"><h2>'+name+'</h2><p>'+text+'</p></a></div>'
    }
    function createSlider(data) {
        var $slider = $('#slider');
        var result = '';
        for (var i = 0; i < data.length; i++){
            result += createPoster(data[i]["name"], data[i]["link"], data[i]["image"], data[i]["text"]);
        }
        $slider.html(result);
        $('.poster:first').addClass('active');


        var $posters = $('.poster');
        var btnUp = $('#btnUp');
        var btnDown = $('#btnDown');
        var TIME = 2000;
        var buttons = $('.slider_container button');
        console.log($posters);
        $posters.not('.active').hide();

        function doBtnDown() {
            buttons.hide();
            if($posters.filter('.active').prev().hasClass('poster')){
                $posters.filter('.active')
                    .removeClass('active')
                    .slideUp(TIME)
                    .prev()
                    .addClass('active')
                    .slideDown(TIME);
            } else {
                console.log('No slides (left)');
                console.log($posters.last());
                $posters.filter('.active')
                    .removeClass('active')
                    .slideUp(TIME);
                $posters.last()
                    .addClass('active')
                    .slideDown(TIME);
            }
            setTimeout(function () {
                buttons.show();
            }, TIME);

            clearTimeout(btnUp);
            btnDown = setTimeout(doBtnDown, 10000);
        }

        function doBtnUp() {
            buttons.hide();
            if($posters.filter('.active').next().hasClass('poster')){
                $posters.filter('.active')
                    .removeClass('active')
                    .slideUp(TIME)
                    .next()
                    .addClass('active')
                    .slideDown(TIME);
            } else {
                console.log($posters.first());
                $posters.filter('.active')
                    .removeClass('active')
                    .slideUp(TIME);
                $posters.first()
                    .addClass('active')
                    .slideDown(TIME);
            }
            setTimeout(function () {
                buttons.show();
            }, TIME);
            clearTimeout(btnDown);
            btnUp = setTimeout(doBtnUp, 10000);

        }

        btnDown.on('click', doBtnDown);
        btnUp.on('click', doBtnUp);
        // setInterval(doBtnUp, 10000);

    }

    $.ajax({
        type: 'GET',
        url: 'json/slider.json',
        success: function (data) {
            createSlider(data["slider"]);
        },
        dataType: 'json'
    })




});