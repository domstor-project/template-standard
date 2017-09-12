var pageYLabel = 0; //переменная будет хранить координаты прокрутки

$(window)
        .on('load', function () {
            var pageY = $(window).scrollTop();
            if (pageY > 100) {
                $("#up").show();
            } //при загрузке страницы если прокрутка больше 200px - показывать кнопку вверх
        })
        .scroll(function (e) {
            var pageY = $(window).scrollTop();
            var innerHeight = $(window).innerHeight();
            var docHeight = $(document).height();
            if (pageY > innerHeight) {
                $("#up").show();
            } else {
                $("#up").hide();
            }

            if (pageY < innerHeight && pageYLabel >= innerHeight) {
                $("#down").show();
            } else {
                $("#down").hide();
            }
        }); //действия при прокрутке страницы

$("#up").click(
        function () {
            var pageY = $(window).scrollTop();
            pageYLabel = pageY; //запоминаем где был совершен клик
            $("html,body").animate({scrollTop: 0}, "slow");
        });
$("#down").click(
        function () {
            $("html,body").animate({scrollTop: pageYLabel}, "slow"); //при возврате прокручиваем страницу к месту клика по кнопке
        });