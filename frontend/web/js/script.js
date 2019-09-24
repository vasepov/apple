$(document).ready(function() {
    $('.eat-apple').click(function () {
        let id = $(this).attr('data-id'), size = $('.slider-eat-' + id).val();
        $.post('eat-apple', {id: id, size: size}, function (data) {
            alert(data.message);
            if (data.result) {
                if (size == 100) {
                    $('.tr-apple-' + id).remove();
                }
            }
        });
    });
});