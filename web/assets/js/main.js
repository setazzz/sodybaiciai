$(function() {
    if ($('#form_duration').length>0) {
        $('#form_duration').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            drops: "up",
            isInvalidDate: function (date) {
                var ans = 0;
                bookings.forEach(function (entry) {
                    if (date >= moment(entry.start) && date <= moment(entry.end)) {
                        ans = 1;
                    }
                });
                if (ans === 1) {
                    return true
                } else {
                    return false
                }
            },
            minDate: moment(new Date().toJSON().slice(0, 10)),
        });
    }
    if ($('.sonata-ba-form-actions').children().length===0 && $("body").hasClass("sonata-bc")) {
        $('form input[type=text]').attr("disabled",true);
        $('form select').attr("disabled",true);
        $('.sonata-ba-form-actions').hide();
    }
    if ($('#category').length>0) {
        $("#category").change(function () {
            document.location.href = $(this).val();
        });
    }
});
