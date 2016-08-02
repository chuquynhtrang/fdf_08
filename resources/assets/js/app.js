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

    $('.filterable .btn-filter').click(function() {

        var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');

        if ($filters.prop('disabled')) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e) {

        var code = e.keyCode || e.which;
        if (code == '9') return;

        var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');

        var $filteredRows = $rows.filter(function() {
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });

        $table.find('tbody .no-result').remove();

        $rows.show();
        $filteredRows.hide();

        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' +  $table.find('.filters th').length + '">No result found</td></tr>'));
        }
    });

    $("#myTable #checkall").click(function () {
        if ($("#myTable #checkall").is(':checked')) {
            $("#myTable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
        } else {
            $("#myTable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });

    $("[data-toggle=tooltip]").tooltip();

    $('#checkAll').click(function(e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });
});
