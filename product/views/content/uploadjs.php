(function(){
	var file_input = $('#file_input'),
	    file_list_container = $('#file_list'),
	    file_list = file_list_container.find('.controls ul'),
	    upload_btn = $('#upload_btn'),
	    cancel_btn = $('#cancel_btn');

		file_input.ajaxUploader({
        	url: 'http://127.0.0.1:8888/boardcoverz/manage/content/product/upload',
        	allowed_extensions: 'jpeg,jpg,gif,png',
        	container: file_list,
        	upload_btn: upload_btn,
        	cancel_btn: cancel_btn,
        	onFilesSelect: function(){
        		file_list_container.show();
        		upload_btn.removeClass('disabled').attr('href','#');
        		cancel_btn.removeClass('disabled').attr('href','#');
        	},
        	afterEach: function(results,id){
        		appendImageToForm(results.file_name);
        	},
        	uploadFinished: function(){
        		console.log('Upload finished');
        	}
        });

	var container = $('#upload_list'),
		images = container.find('table tbody'),
		current_image = container.find('input[name="images_count"]');

	function appendImageToForm(file_name) {
		var i = current_image.val(),
			image_container = $('<tr/>').attr('id','#image_'+i+''),
			table_fields = '<td><img src="<?php echo site_url("images/'+file_name+'?assets=media/catalog&size=50")?>"/></td><td><input type="text" name="image_label_'+i+'" class="input-large" value=""/></td><td><input type="radio" name="is_thumb" value="0" onclick="setImageProperty(this)"></td><td><input type="radio" name="is_small_image" value="0" onclick="setImageProperty(this)"></td><td><input type="radio" name="is_default" value="0" onclick="setImageProperty(this)"></td><td><a href="" title="Delete" class="btn btn-danger"><i class="icon-trash icon-white"></i></td>';

		i++;
		current_image.val(i);

		image_container.append(table_fields);
		images.append(image_container);
	}
})();