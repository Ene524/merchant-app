function getMinutesBetweenTwoDates(startDate, endDate) {
    var firstDate = new Date(startDate);
    var lastDate = new Date(endDate);

    if (reformatDatetimeTo_YYYY_MM_DD(firstDate) === reformatDatetimeTo_YYYY_MM_DD(lastDate)) {
        calculatedMinutes = (lastDate.getTime() - firstDate.getTime()) / 1000 / 60;
        return calculatedMinutes >= 480 ? 480 : calculatedMinutes;
    } else {
        totalMinutes = 0;
        var dates = getDatesInRange(firstDate, lastDate);
        $.each(dates, function (i, date) {
            if (reformatDatetimeTo_YYYY_MM_DD(firstDate) === reformatDatetimeTo_YYYY_MM_DD(date)) {
                calculatedMinutes = (new Date(reformatDatetimeTo_YYYY_MM_DD(date) + ' 18:00').getTime() - firstDate.getTime()) / 1000 / 60;
                totalMinutes += calculatedMinutes >= 480 ? 480 : calculatedMinutes;
            } else if (reformatDatetimeTo_YYYY_MM_DD(lastDate) === reformatDatetimeTo_YYYY_MM_DD(date)) {
                calculatedMinutes = (lastDate.getTime() - new Date(reformatDatetimeTo_YYYY_MM_DD(date) + ' 09:00').getTime()) / 1000 / 60;
                totalMinutes += calculatedMinutes >= 480 ? 480 : calculatedMinutes;
            } else {
                totalMinutes += 480;
            }
        });
        return totalMinutes;
    }
}

function minutesToString(minutes) {
    var remainingMinutes = minutes % 60;
    var hours = Math.floor(minutes / 60);
    // var remainingHours = hours % 8;
    // var days = Math.floor(hours / 8);

    return `${hours > 0 ? hours + ' Saat ' : ''}${remainingMinutes > 0 ? remainingMinutes + ' Dakika' : ''}`;
    // return days + ' days, ' + remainingHours + ' hours, ' + remainingMinutes + ' minutes';
}
