/* http://keith-wood.name/countdown.html
   Mongolian initialisation for the jQuery countdown extension
   Written by coden */
(function($) {
    $.countdown.regional['mn'] = {
                
        labels: ['жил', 'сар', 'долоо хоног', 'өдөр', 'цаг', 'минут', 'секунд'],
        labels1: ['жил', 'сар', 'долоо хоног', 'өдөр', 'цаг', 'минут', 'секунд'],
        compactLabels: ['жил', 'сар', 'долоо хоног', 'өдөр'],
        whichLabels: null,
		digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
        timeSeparator: ':', isRTL: false};
    $.countdown.setDefaults($.countdown.regional['mn']);
})(jQuery);