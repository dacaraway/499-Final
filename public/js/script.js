$(function() {

    $(document).on('click.modal.data-api', '[data-toggle="modal"]', function (e) {
        window.pinLink = $(this).data('url');
        if($(this).data('cat')){
            window.pinCat = $(this).data('cat');
        }
    });

    $('#myModal').on('shown', function(e){
        $('#picture-url').val(window.pinLink);
        if(window.pinCat){
            $('#picture-cat').val(window.pinCat);
        }

    });

});


