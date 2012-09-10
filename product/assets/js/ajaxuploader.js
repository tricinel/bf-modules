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

			//bind actions
			self.bindAll();
		},

		bindAll: function(){
			var self = this;

			//detect file input changes
			self.$elem.on('change', $.proxy( self.onFilesSelected, self ));

			//start upload on button click
			self.options.upload_btn.on('click',function(e){
				self.$file_list.empty();
				self.startUpload(); //start the upload
				e.preventDefault();
			});

			//TODO - cancel upload
			self.options.cancel_btn.on('click',function(e){
				e.preventDefault();
			});
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
			//TODO - turn this into a beforeEach
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
				this.$file_list.append('<li>'+ this.files[i].name + ' '+ this.files[i].size.formatBytes() +'</li>');
			}
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
			file.file_id = this.generateFileID();
			if (window.FormData) {
        		formdata = new FormData();
        		formdata.append("pics[]", file);
    		}

			if (formdata) {
        		var xhr = XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

        		xhr.open("POST", self.options.url);

  				xhr.onreadystatechange = function(){
    				if ( xhr.readyState == 4 ) {
    					self.uploadResult(xhr,file);
    				}
  				};

        		xhr.upload.onprogress = function(e){
					if (e.lengthComputable) self.uploadProgress(e,file);
				};

        		xhr.send(formdata);
			}
		},

		uploadProgress: function(e,file) {
          	var percentComplete = Math.round(e.loaded * 100 / e.total), id = this.generateFileID();
          	this.$file_list.append('<li id="'+ file.file_id +'"><span class="file_name">'+ file.name +'</span><div class="progress progress-striped active pull-right"><div class="bar bar-success" style="width:'+percentComplete.toString()+'%"></div></div></li>');
		},

		uploadResult: function(xhr,file) {
			var data = $.parseJSON(xhr.responseText),
				curr = this.$file_list.find('li#'+file.file_id+''),
				self = this,
				results = [];

			this._queue++;

			//did we get an error uploading?
			if(data.error) {
				curr.children('div.progress').removeClass('progress-striped').addClass('progress-danger');
				curr.children('span.file_name').html('Failed to upload ' + file.name).closest('li.curr').removeClass('curr'); //TODO include data.error server response

				results.push(data.error);
			} else {
				curr.children('div.progress').removeClass('progress-striped').addClass('progress-success');
				curr.children('span.file_name').html('Successfully uploaded ' + data.client_name).closest('li.curr').removeClass('curr');

				results.push(data,file.file_id);
			}

			if(typeof this.options.afterEach === 'function') {
				this.options.afterEach.apply( self.elem, results );
			}

			if(this._queue == this._stored_files.length && typeof this.options.uploadFinished === 'function') {
				this.options.uploadFinished.apply( self.elem );
			}

			if(this._queue == this._stored_files.length) {
				this.destroy();
			}
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

		destroy: function() {
			this._stored_files = [];
			this._queue = 0;
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
		cancel_btn: '#cancel_btn',
		onFilesSelect: null,
		progressUpdated: null,
		afterEach: null,
		uploadFinished: null
	};

	/**
	 * TODO

		1. auto-upload feature: upload files on select, without the need for an upload button
		2. add type of progress: graphic/numbers

	**/

})( jQuery, window, document );
