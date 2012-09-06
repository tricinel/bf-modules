(function(){
	// /**
	//  * Utility method to format bytes into the most logical magnitude (KB, MB,
	//  * or GB).
	//  */
	// //Only add this implementation if one does not already exist.
	// if (Number.prototype.formatBytes==null) Number.prototype.formatBytes = function(){
	//    var units = ['B', 'KB', 'MB', 'GB', 'TB'],
	//         bytes = this,
	//         i;

	//     for (i = 0; bytes >= 1024 && i < 4; i++) {
	//         bytes /= 1024;
	//     }

	//     return bytes.toFixed(2) + units[i];
	// }

	//Handle selected files
	var file_input = $('#file_input'),
	    file_list_container = $('#file_list'),
	    file_list = file_list_container.find('.controls ul'),
	    upload_btn = $('#upload_btn');

	//file_input.on('change', onFilesSelected);

	/**
	 * Loops through the selected files, displays their file name and size
	 * in the file list, and enables the submit button for uploading.
	 */
	// function onFilesSelected(e) {
	//     var files = e.target.files,
	//     	file;

	//     // for (var i = 0; i < files.length; i++) {
	//     // 	file = files[i];
	//     // 	file_list.append('<li>' + files[i].name + ' <span class="pull-right">' + files[i].size.formatBytes() + '</span></li>');
	//     // }

	//     // file_list_container.show();
	//     upload_btn.removeClass('disabled').attr('href','#');
	// }

	// upload_btn.on('click',function(e){
	// 	e.preventDefault();
	// 	if(file_input.val()) {
	// 		file_input.ajaxUploader({
	//         	url: 'http://127.0.0.1:8888/boardcoverz/manage/content/product/upload',
	//         	allowed_extensions: 'jpeg,jpg,gif,png',
	//         	container: file_list,
	//         	uploadError: function(results){
	//         		console.log('error: ' + results);
	//         	},
	//         	uploadFinished: function(){
	//         		console.log('Upload finished');
	//         	},
	//         	progressUpdated: function(data){
	//         		console.log(data);
	//         	}
	//         });
	// 	}
 //    });

		file_input.ajaxUploader({
        	url: 'http://127.0.0.1:8888/boardcoverz/manage/content/product/upload',
        	allowed_extensions: 'jpeg,jpg,gif,png',
        	container: file_list,
        	upload_btn: upload_btn,
        	onFilesSelect: function(){
        		file_list_container.show();
        		upload_btn.removeClass('disabled').attr('href','#');
        	},
        	uploadError: function(results){
        		console.log('error: ' + results);
        	},
        	uploadFinished: function(){
        		console.log('Upload finished');
        	},
        	progressUpdated: function(data){
        		console.log(data);
        	}
        });
})();