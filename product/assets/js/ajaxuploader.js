// Utility
if ( typeof Object.create !== 'function' ) {
	Object.create = function( obj ) {
		function F() {};
		F.prototype = obj;
		return new F();
	};
}

(function( $, window, document, undefined ) {
	var AjaxUpload = {
		init: function( options, elem ) {
			var self = this;

			self.elem = elem;
			self.$elem = $( elem );

			self.options = $.extend( {}, $.fn.ajaxUploader.options, options );

			self.files = self.elem.files;
			self.elem.files.length = self.elem.files.length;
			self.allowed_extensions = self.allowedExtensions();
			self.$file_list = $( self.options.container );
			self._stored_files = [];

			self.beforeUpload();
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
				self.storeFilesForUpload();
			}
		},

		storeFilesForUpload: function() {
			var self = this, i = 0;

			self.$file_list.empty();

			for(i;i<self.elem.files.length;i++){
				self._stored_files.push(self.files[i]);
			}

			self.startUpload();
		},

		startUpload: function() {
			var self = this;

			$.each(self._stored_files, function() {
				self.upload(this);
			});
		},

		uploadProgress: function(e) {
          	var percentComplete = Math.round(e.loaded * 100 / e.total);
          	console.log(percentComplete.toString() + '%');
		},

		uploadComplete: function(response) {
			var file = $.parseJSON(response);
			this.appendFileToList(file);
		},

		uploadFailed: function(response) {
			var error = $.parseJSON(response);
			console.log(error);
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
      					if ( xhr.status == 200 ) {
    						self.uploadComplete(xhr.responseText);
      					} else {
    						self.uploadFailed(xhr.responseText);
      					}
    				}
  				};

        		xhr.upload.onprogress = function(e){
					if (xhr.readyState == 200 && xhr.status == 200 && e.lengthComputable){
						self.uploadProgress(e);
					}
				};

        		xhr.send(formdata);
			}
		},

		appendFileToList: function(file) {
			this.$file_list.append('<li>Uploaded: ' + file.file_name + '</li>');
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
		uploadError: null,
		progressUpdated: null,
		uploadFinished: null
	};

})( jQuery, window, document );
