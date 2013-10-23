$(function(){
    $('.delete-page').click(function(){
        event.preventDefault();

        $.ajax({
            type: 'delete',
            url: $(this).data('url'),
            statusCode: {
                200: function () {
                    $(this).parents('tr').fadeOut();
                },
                404: function () {
                    window.location.reload();
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
