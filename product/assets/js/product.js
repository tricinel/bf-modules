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

//function sets default, thumb, small_image, large_image values
function setImageProperty(field_name,index){
	var container = $('#dropbox').find('.controls'),
		allFields = container.find('input[name^="'+field_name+'"]'),
		activeField = container.find('input[name="'+field_name+index+'"]');

	allFields.val(0);
	activeField.val(1);
	return false;
}