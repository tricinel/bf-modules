(function(){
	$('#product_special_price_from_date').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});
	$('#product_special_price_to_date').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});

					if( !('product_description' in CKEDITOR.instances)) {
						CKEDITOR.replace( 'product_description' );
					}

})();

//stock manangement fields show/hide
(function(){
	var manage_stock = $('select[name=manage_stock]'),
		qty = $('input[name=qty]'),
		low_stock_qty = $('input[name=low_stock_qty]'),
		show;

	show = manageStock();
	
	function manageStock(){
		return (manage_stock.val() == 0) ? show = false : show = true;
	}

	manage_stock.change(function(){
		show = manageStock();
		if (!show) {
			qty.attr('disabled', 'disabled');
			low_stock_qty.attr('disabled', 'disabled');
		} else {
			qty.removeAttr('disabled');
			low_stock_qty.removeAttr('disabled');
		}
	});

})();

//function to delete an image
function deleteImage(index,file_name){
	var container = $('#image_'+index+''),
		images_count = $('input[name="images_count"]'),
		count = images_count.val();

	$.ajax({
		url: 'delete_image',
		type: 'POST',
		data: { file_name: file_name }
	}).done(function() { 
		//replace this alert with a bootstrap alert
		alert('Image deleted!');
		container.empty().remove();
		count--;
		images_count.val(count);
		if(count == '0') $('span.message').show();
	});

	return false;
}


//function sets default, thumb, small_image, large_image values
function setImageProperty(field_name,index){
	var container = $('#dropbox').find('.controls'),
		allFields = container.find('input[name^="'+field_name+'"]'),
		activeField = container.find('input[name="'+field_name+index+'"]');

	allFields.val(0);
	activeField.val(1);
	return false;
}

//function builds category tree
$(function () {
	$("#cats").jstree({ 
		"json_data" : {
			//"data" : buildTree()
			"ajax" : {
				"url" : "/boardcoverz/manage/content/category/build_tree",
				"data" : function (n) { 
					return { id : 0 }; 
				}
			}
		},
		"plugins" : [ "json_data", "ui" ]
	}).bind("select_node.jstree", function (e, data) {
		$('input[name="category_url"]').val($(data.rslt.obj).data('url'));
	});
});