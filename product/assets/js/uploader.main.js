//this is the application.js file from the example code//
(function(){
    var imageInput = $('#product_image'),
        uploadbtn = $('a#doupload'),
        deletedbtn = $('a#dodelete');

    uploadbtn.on('click', function(e){
        e.preventDefault();

        upload().done(function( results ) {
            console.log(results);
        }).fail(function(){
            alert('failed to upload');
        });
    });

    deletedbtn.on('click', function(e){
        e.preventDefault();
        $('#product_image').val('');
    });

    function upload() {
        return $.ajax({
            url: 'http://127.0.0.1:8888/bonfire/admin/content/product/upload_image/',
            type: 'POST',
            data: { userfile: imageInput.attr('name') },
            dataType: 'json'
        });
    }
})();