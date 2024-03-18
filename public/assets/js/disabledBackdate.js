$(document).ready(function () {
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
    
        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;
    
        return [year, month, day].join('-');
    }
    
    // Set min attribute to today's date
    document.getElementById('str_date').setAttribute('min', formatDate(new Date()));
    // document.getElementById('Start_titile_datetime').setAttribute('min', formatDate(new Date()));
});