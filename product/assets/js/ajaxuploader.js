// Utility
if ( typeof Object.create !== 'function' ) {
	Object.create = function( obj ) {
		function F() {};
		F.prototype = obj;
		return new F();
	};
}

/**
 * Utility method to format bytes into the most logical magnitude (KB, MB,
 * or GB).
 */
//Only add this implementation if one does not already exist.
if (Number.prototype.formatBytes == null) {
	Number.prototype.formatBytes = function(){
   		var units = ['B', 'KB', 'MB', 'GB', 'TB'],
        	bytes = this,
        	i;

    	for (i = 0; bytes >= 1024 && i < 4; i++) {
        	bytes /= 1024;
    	}

    	return bytes.toFixed(2) + units[i];
    }
}

(function( $, window, document, undefined ) {
	var AjaxUpload = {
		init: function( options, elem ) {
			var self = this;

			self.elem = elem;
			self.$elem = $( elem );

			self.options = $.extend( {}, $.fn.ajaxUploader.options, options );

			self.allowed_extensions = self.allowedExtensions();
			self.$file_list = $( self.options.container );
			self._stored_files = [];
			self._queue = 0; //add files to it as they are uploaded or they fail to upload

			self.$elem.on('change', $.proxy( self.onFilesSelected, self ));
		},

		onFilesSelected: function() {
			this.files = this.elem.files;
			this.elem.files.length = this.elem.files.length;

			if(typeof this.options.onFilesSelect === 'function') {
				this.options.onFilesSelect.apply( this.elem, arguments );
			}

			this.beforeUpload(); //check for any errors
		},

		beforeUpload: function(){
			var self = this, errors = [];
			if(self.elem.files.length > self.options.maxfiles) {
				errors.push('You\'re trying to upload too many files!');
			}
			if(self.elem.files.length = 0){
				errors.push('Please select at least one file to upload!');
			}
			if(!self.areValidExtensions()) {
				errors.push('Only ' + self.options.allowed_extensions + ' files are allowed!');
			}
			if(errors && errors.length > 0) {
				self.options.error(errors.join("<br/>"));
			} else {
				self.storeFilesForUpload(); //store the files for upload
			}
		},

		storeFilesForUpload: function() {
			var i = 0, self = this;

			for(i;i<this.elem.files.length;i++){
				this._stored_files.push(this.files[i]);
				this.appendFileToList(this.files[i]);
			}

			//start upload on button click
			this.options.upload_btn.on('click',function(e){
				self.$file_list.empty();
				self.startUpload(); //start the upload
				e.preventDefault();
			});

			//TODO - cancel upload
		},

		startUpload: function() {
			var self = this;

			//upload files in turn
			$.each(self._stored_files, function() {
				self.upload(this);//actual upload of files
			});
		},

		upload: function(file) {
			var self = this, formdata = false;
			if (window.FormData) {
        		formdata = new FormData();
        		formdata.append("pics[]", file);
    		}

			if (formdata) {
        		var xhr = XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

        		xhr.open("POST", self.options.url);

  				xhr.onreadystatechange = function(){
    				if ( xhr.readyState == 4 ) {
    					//self.handleUploadResult(xhr.responseText);
      					if ( xhr.status == 200 ) {
    						self.uploadComplete(xhr.responseText);
      					} else {
    						self.uploadFailed(xhr.responseText);
      					}
    				}
  				};

        		xhr.upload.onprogress = function(e){
					if (e.lengthComputable) self.uploadProgress(e,file);
				};

        		xhr.send(formdata);
			}
		},

		uploadProgress: function(e,file) {
			//li.curr not working TODO
          	var percentComplete = Math.round(e.loaded * 100 / e.total), id = this.generateFileID();
          	this.$file_list.append('<li class="curr"><span class="file_name">'+ file.name +'</span><div class="progress progress-striped active pull-right"><div class="bar bar-success" style="width:'+percentComplete.toString()+'%"></div></div></li>');
		},

		uploadComplete: function(response) {
			var data = $.parseJSON(response), curr = this.$file_list.find('li.curr');

			curr.children('div.progress').removeClass('progress-striped').addClass('progress-success');
			curr.children('span.file_name').html('Successfully uploaded' + data.client_name).closest('li.curr').removeClass('curr');

			this._queue++;

			var self = this;

			if(this._queue == this._stored_files.length && typeof this.options.uploadFinished === 'function') {
				this.options.uploadFinished.apply( self.elem, arguments );
			}
		},

		uploadFailed: function(response) {
			this.appendFileToList($.parseJSON(response));

			this._queue++;

			var self = this;

			if(this._queue == this._stored_files.length && typeof this.options.uploadFinished === 'function') {
				this.options.uploadFinished.apply( self.elem, arguments );
			}

			if(typeof this.options.uploadError === 'function') {
				this.options.uploadError.apply( self.elem, arguments );
			}
		},

		appendFileToList: function(data) {
			this.$file_list.append('<li>'+ data.name + ' '+ data.size.formatBytes() +'</li>');

			// if(data.error) {
			// 	this.$file_list.append('<li class="error">Failed to upload ' + data.file.name + '<span class="pull-right">' + data.error + '</span></li>');
			// } else {
			// 	this.$file_list.append('<li>Successfully uploaded ' + data.client_name + '</li>');
			// }
			// if ( this.$file_list.is(':hidden')) this.$file_list.show();
		},

		allowedExtensions: function(){
			var self = this;
			return (self.options.allowed_extensions != null) ? self.options.allowed_extensions.split(',') : false;
		},

		areValidExtensions: function(){
			var self = this, i=0, ext;
			for(i;i<self.elem.files.length;i++) {
				ext = self.files[i]['name'].split('.').pop();
				if(!$.inArray(ext, self.allowed_extensions)) {
					return false;
				}
				return true;
			}
		},

		generateFileID: function() {
			var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz", len = 8, id = '';
			for (var i=0; i<len; i++) {
				var num = Math.floor(Math.random() * chars.length);
				id += chars.substring(num,num+1);
			}

			return id;
		},

	};

	$.fn.ajaxUploader = function( options ) {
		return this.each(function() {
			var ajaxupload = Object.create( AjaxUpload );

			ajaxupload.init( options, this );
		});
	};

	$.fn.ajaxUploader.options = {
		url: null,
		maxfiles: 5,
		allowed_extensions: null,
		container: '#file_list',
		upload_btn: '#upload_btn',
		onFilesSelect: null,
		uploadError: null,
		progressUpdated: null,
		uploadFinished: null
	};

	/**
	 * TODO

		1. auto-upload feature: upload files on select, without the need for an upload button

	**/

})( jQuery, window, document );
