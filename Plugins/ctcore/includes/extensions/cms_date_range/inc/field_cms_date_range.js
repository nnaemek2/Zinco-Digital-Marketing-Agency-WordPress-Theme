jQuery(function ($) {
    if ($(".cms-datetime-range-from").length !== 0 && $(".cms-datetime-range-to").length !== 0) {
        var date_from = $(".cms-datetime-range-from").val(),
            date_to = $(".cms-datetime-range-to").val();
        var dateFormat = "yy-mm-dd",
            from = $(".cms-datetime-range-from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    dateFormat: dateFormat,
                    minDate: new Date()
                })
                .on("change", function () {
                    var date = getDate(this);
                    if (date) {
                        date.setDate(date.getDate() + 1);
                    }
                    to.datepicker("option", "minDate", date);
                }),
            to = $(".cms-datetime-range-to").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: dateFormat
            })
                .on("change", function () {
                    var date = getDate(this);
                    if (date) {
                        date.setDate(date.getDate() - 1);
                    }
                    from.datepicker("option", "maxDate", date);
                });
        if (date_to.length) {
            var new_date_to = $.datepicker.parseDate(dateFormat, date_to);
            if (new_date_to) {
                new_date_to.setDate(new_date_to.getDate() - 1);
            }
            from.datepicker("option", "maxDate", new_date_to);
        }
        if (date_from.length) {
            var new_date_from = $.datepicker.parseDate(dateFormat, date_from);
            if (new_date_from) {
                new_date_from.setDate(new_date_from.getDate() + 1);
            }
            to.datepicker("option", "minDate", new_date_from);
        }

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }

    }
    if ($(".cms-date").length !== 0) {
        var date_input = $(".cms-date").val();
        var dateFormat_date = "yy-mm-dd",
            cms_date = $(".cms-date").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: dateFormat_date,
                minDate: new Date()
            });
    }
});