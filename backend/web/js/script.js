$(document).ready(function() {
    $('body').on('click', '.delete-color', function () {
        console.log('qweqwe');
        if ($(this).attr('data-id')) {
            $.post('/site/delete-color', {id: $(this).attr('data-id')}, function (data) {
                if(data.result) {
                    bootbox.alert('Цвет яблока удален');
                } else {
                    bootbox.alert(data.message);
                }
            });
        }
        $(this).closest('tr').remove();

    }).on('click', '.add-color', function () {
        let id = (new Date()).getTime();
        $('.table-color').append('<tr>' +
            '<td></td>' +
            '<td>' +
            '<input type="text" id="color-2-color" class="form-control" name="Color['+ id +'][color]" value="" aria-invalid="false">' +
            '</td>' +
            '<td><button type="button" class="btn btn-danger delete-color" data-id="">-</button></td>' +
            '</tr>');
    })
});