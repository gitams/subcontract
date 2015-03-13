/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $('#userlogin').validate({
        rules: {
            userpassword: {
                required: true
            },
            useremail: {
                required: true,
                email: true
            }
        },
        messages: {
            userpassword: {
                required: "Please specify your password"
            },
            useremail: {
                required: "Please enter Email address",
                email: "Enter a valid Emailaddress"
            }
        }
    });
    if ($(".alert").show()) {
        $(".alert").delay(6000).fadeOut();
    }
});