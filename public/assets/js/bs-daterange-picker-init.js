(function($) {
    "use strict"

    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        locale: {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Uygula",
            "cancelLabel": "Vazgeç",
            "fromLabel": "Dan",
            "toLabel": "a",
            "customRangeLabel": "Seç",
            "daysOfWeek": [
                "Pt",
                "Sl",
                "Çr",
                "Pr",
                "Cm",
                "Ct",
                "Pz"
            ],
            "monthNames": [
                "Ocak",
                "Şubat",
                "Mart",
                "Nisan",
                "Mayıs",
                "Haziran",
                "Temmuz",
                "Ağustos",
                "Eylül",
                "Ekim",
                "Kasım",
                "Aralık"
            ],
            "firstDay": 1
        }
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: false,
        format: 'DD/MM/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '01/05/2024',
        maxDate: '31/12/2024',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
})(jQuery);
