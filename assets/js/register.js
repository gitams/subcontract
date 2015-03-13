/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $(document).on('change', '#country_name', function () {
        if (this.value == 0) {
            alert('Please select proper country');
            return false;
        }
        var dest = '#state_name';
        $.ajax({
            url: BASEURL + 'landing/getStates',
            type: 'POST',
            data: {'countryId': this.value, 'rand': Math.round(Math.random() * 1000000)},
            datatype: 'html',
            beforeSend: function () {
                $(dest).text('<option value="0">Please wait .. </option>');
            },
            error: function () {
                $(dest).text('<option value="0">Error....</option>');
            },
            success: function (data) {
                $(dest).text('').append(data);
            }
        });
    });
    $(document).on('change', '#state_name', function () {
        if (this.value == 0) {
            alert('Please select proper state');
            return false;
        }
        var dest = '#city_name';
        $.ajax({
            url: BASEURL + 'landing/getCities',
            type: 'POST',
            data: {'stateId': this.value, 'rand': Math.round(Math.random() * 1000000)},
            datatype: 'html',
            beforeSend: function () {
                $(dest).text('<option value="0">Please wait .. </option>');
            },
            error: function () {
                $(dest).text('<option value="0">Error....</option>');
            },
            success: function (data) {
                $(dest).text('').append(data);
            }
        });
    });

});
