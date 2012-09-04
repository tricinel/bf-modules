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
				self.uploadStarted();
			}
		},

		uploadStarted: function() {
			var self = this, i = 0;

			self.$file_list.empty();

			for(i;i<self.elem.files.length;i++){
				file = self.files[i];
				self.upload(file, i)
					.done(function( results ) {
						//upload was successful
						if ( typeof self.options.uploadFinished === 'function' ) {
							self.options.uploadFinished.apply( self.elem, arguments );
						}
						//attach file to list of files uploaded
						//self.appendFileToList(file);

					})
					.fail(function( results ) {
						//upload failed
						if ( typeof self.options.uploadError === 'function' ) {
							self.options.uploadError.apply( self.elem, arguments );
						}
					});
			}
		},

		upload: function(file, i) {
			var self = this, formdata = false;
			if (window.FormData) {
        		formdata = new FormData();
        		formdata.append("pics[]", file);
    		}

			if (formdata) {
			    return $.ajax({
			        url: self.options.url,
			        type: "POST",
			        data: formdata,
			        processData: false,
			        contentType: false
			    });
			}
		},

		appendFileToList: function(file) {
			var self = this;
			console.log(file);
			//self.$file_list.append('<li>Uploaded: ' + file.name + '</li>');
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
