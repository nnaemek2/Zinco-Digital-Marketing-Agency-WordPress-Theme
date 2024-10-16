jQuery(document).ready(function ($) {

    $('.ct-countdown').each(function () {
        var _this = $(this);
        var count_down = $(this).find('> div').data("count-down");
        setInterval(function () {
            var startDateTime = new Date().getTime();
            var endDateTime = new Date(count_down).getTime();
            var distance = endDateTime - startDateTime;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            var text_day = days !== 1 ? _this.attr('data-days') : _this.attr('data-day');
            var text_hour = hours !== 1 ? _this.attr('data-hours') : _this.attr('data-hour');
            var text_minu = minutes !== 1 ? _this.attr('data-minutes') : _this.attr('data-minute');
            var text_second = seconds !== 1 ? _this.attr('data-seconds') : _this.attr('data-second');
            days = days < 10 ? '0' + days : days;
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            _this.html(''
                + '<div class="countdown-item"><div class="countdown-item-inner"><span class="countdown-amount">' + days + '</span><span class="countdown-period">' + text_day + '</span></div></div>'
                + '<div class="countdown-item"><div class="countdown-item-inner"><span class="countdown-amount">' + hours + '</span><span class="countdown-period">' + text_hour + '</span></div></div>'
                + '<div class="countdown-item"><div class="countdown-item-inner"><span class="countdown-amount">' + minutes + '</span><span class="countdown-period">' + text_minu + '</span></div></div>'
                + '<div class="countdown-item"><div class="countdown-item-inner"><span class="countdown-amount">' + seconds + '</span><span class="countdown-period">' + text_second + '</span></div></div>'
            );
        }, 1000);

    });
});