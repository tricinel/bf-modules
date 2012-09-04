<?php
	$bool = array(1 => 'Yes',0 => 'No');
?>

$.jstree._themes = "<?php echo site_url('bonfire/themes/admin/images/jstree-themes').'/';?>";

$(function () {
	var uploader = new qq.FileUploader({
        element: $('#basicUploadSuccessExample')[0],
        action: "http://127.0.0.1:8888/boardcoverz/manage/content/product/upload",
        demoMode: false,
        debug: true,
        allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
        uploadButtonText: "Click Or Drop",
        onSubmit: function(id, fileName) {
        	//console.log('id is ' + id + ' and file name is ' + fileName);
        	//return false;
        },
        onComplete: function(id, fileName, response) {
        	console.log('id is ' + id + ' and file name is ' + fileName);
        	console.log(response);
        }
    });
});