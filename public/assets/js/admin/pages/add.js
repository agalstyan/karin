$(function(){
    var form = $('#page-form');
    form.find('textarea').ckeditor();
    form.find('button[type=submit]').click(function(){
        event.preventDefault();

        $(this).text($(this).data('text-tmp'));
        $(this).addClass('disabled');
        $('.error').remove();
        $('.has-error').removeClass('has-error');

        $.ajax({
            type: 'post',
            url: form.attr('action'),
            data: form.serialize(),
            statusCode: {
                200: function () {
                    window.location.href = form.data('success-url');
                },
                400: function (response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (index, value){
                        var input = $('[name=' + index + ']');
                        input.parents('.form-group').addClass('has-error');
                        input.after('<div class="help-block error">' + value + '</div>');
                    });
                },
                404: function () {
                    window.location.href = form.data('success-url');
                }
            },
            context: this
        }).complete(function(){
                $(this).text($(this).data('text-default'));
                $(this).removeClass('disabled');
            });

        return false;
    });

    form.find('button[type=reset]').click(function(){
        $('.error').remove();
        $('.has-error').removeClass('has-error');
    });
});
