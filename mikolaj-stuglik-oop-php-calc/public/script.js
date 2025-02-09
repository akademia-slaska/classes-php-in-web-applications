$(document).ready(function() {
    $('#calc').on('click', function () {
        let request = {};
        request.toCalc = $('#calculator').val();
        $.ajax({
            url: '/calc/',
            method: 'POST',
            data: request,
            success: function (response) {
                response = JSON.parse(response);
                $('.wynik').prepend(request.toCalc + ' = ' + response.result + '<br>');
                $('#calculator').val('');
            },
            fail: function (response) {
                alert(response.result);
            }
        });
    });

});