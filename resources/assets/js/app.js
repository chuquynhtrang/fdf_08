window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

$(document).ready(function () {
    $.ajaxSetup({
        beforeSend: function (xhr, settings) {
            if (settings.type == 'POST' || settings.type=='PUT' || settings.type=='DELETE') {
                xhr.setRequestHeader("X-CSRF-TOKEN", $('[name="csrf_token"]').attr('content'));
            }
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_url').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#login').on('click', function(e) {
        e.preventDefault();
        setTimeout(function() {
            $('#loginModal').modal('show');
        }, 230);
    });

    $("form[name='formLogin']").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: '/login',
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
            success: function(data, status) {
                if (data.success) {
                    window.location.assign(data.url);
                } else {
                    $('.alert-danger').text(data.messages).show();
                }
            },
        });
    });

    $('#register').on('click', function(e) {
        e.preventDefault();
        setTimeout(function() {
            $('#registerModal').modal('show');
        }, 230);
    });

    $("form[name='formRegister']").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: '/register',
            type: 'POST',
            dataType: 'JSON',
            data: form.serialize(),
            success: function(data, status) {
                if (data.success) {
                    window.location.assign(data.url);
                } else {
                    $('.alert-warning').text(data.messages).show();
                }
            },
        });
    });
});
