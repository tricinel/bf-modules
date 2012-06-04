<?php
	$bool = array(1 => 'Yes',0 => 'No');
?>

(function(){
	
	var dropbox = $('#dropbox'),
		message = $('.message', dropbox),
		count = 0;

	dropbox.filedrop({
		// The name of the $_FILES entry:
		paramname:'pics[]',
		
		maxfiles: 5,
    	maxfilesize: 2,
		url: 'upload',
		
		uploadFinished:function(i,file,response){
			$.data(file).addClass('done');
			appendFormData(count,response);
			count++;
		},
		
    	error: function(err, file) {
			switch(err) {
				case 'BrowserNotSupported':
					showMessage('Your browser does not support HTML5 file uploads!');
					break;
				case 'TooManyFiles':
					alert('Too many files! Please select 5 at most! (configurable)');
					break;
				case 'FileTooLarge':
					alert(file.name+' is too large! Please upload files up to 2mb (configurable).');
					break;
				default:
					break;
			}
		},
		
		// Called before each upload is started
		beforeEach: function(file){
			if(!file.type.match(/^image\//)){
				alert('Only images are allowed!');
				
				// Returning false will cause the
				// file to be rejected
				return false;
			}
		},
		
		uploadStarted:function(i, file, len){
			var index = (i == '0' && count > 0) ? count : i;
			console.log('count is '+count);
			console.log('i is '+i);
			console.log('index is '+index);
			createImage(file,index);
		},
		
		progressUpdated: function(i, file, progress) {
			$.data(file).find('.progress').width(progress);
		},

		afterAll: function(){
			$('input[name="images_count"]').val(count);
		}
    	 
	});
	
	var template = '<div class="control-group images-group">'+
						'<div class="preview">'+
							'<span class="imageHolder">'+
								'<img />'+
								'<span class="uploaded"></span>'+
							'</span>'+
							'<div class="progressHolder">'+
								'<div class="progress"></div>'+
							'</div>'+
						'</div>'+
					'</div>'; 
	
	
	function createImage(file,i){

		var preview = $(template), 
			image = $('img', preview);

		preview.attr('id','image_'+i);
			
		var reader = new FileReader();
		
		image.width = 100;
		image.height = 100;
		
		reader.onload = function(e){
			
			// e.target.result holds the DataURL which
			// can be used as a source of the image:
			
			image.attr('src',e.target.result);
		};
		
		// Reading the file as a DataURL. When finished,
		// this will trigger the onload function above:
		reader.readAsDataURL(file);
		
		message.hide();
		preview.appendTo(dropbox);
		
		// Associating a preview container
		// with the file, using jQuery's $.data():
		
		$.data(file,preview);
	}

	function showMessage(msg){
		message.html(msg);
	}

	function appendFormData(i, data){

		var file_name = data.image.file_name,
			container = $('#image_'+i+''),
			fields = '<div class="controls">'+
						'<input id="image_src_'+i+'" type="hidden" name="image_src_'+i+'" value="'+file_name+'"  /><input id="is_default_'+i+'" type="hidden" name="is_default_'+i+'" value="0"/><input id="is_thumb_'+i+'" type="hidden" name="is_thumb_'+i+'" value="0"/><input id="is_small_image_'+i+'" type="hidden" name="is_small_image_'+i+'" value="0"/>'+
						'<div><label>Image label:</label><input id="image_label_'+i+'" type="text" name="image_label_'+i+'" maxlength="250" value=""  /></div><div><label>Image position:</label><input id="image_position_'+i+'" type="text" name="image_position_'+i+'" maxlength="250" value=""  /></div><div><label>Default</label><input type="radio" name="image_is_default" value="default" onclick="setImageProperty(\'is_default_\','+i+')"></div><div><label>Thumb</label><input type="radio" name="image_type_thumb" value="thumb" onclick="setImageProperty(\'is_thumb_\','+i+')"></div><div><label>Small</label><input type="radio" name="image_type_small_image" value="small_image" onclick="setImageProperty(\'is_small_image_\','+i+')"></div>'+
						'<div class="actions"><a id="delete-image" class="btn btn-danger" href="#" onclick="deleteImage(\''+i+'\',\''+file_name+'\')"><i class="icon-trash icon-white"></i> Delete</a></div>'+
					'</div>';

		container.append(fields);

	}

})();