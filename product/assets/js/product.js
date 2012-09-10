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
	changeManageStock();

	function manageStock(){
		return (manage_stock.val() == 0) ? false : true;
	}

	function changeManageStock(){
		show = manageStock();
		if (!show) {
			qty.attr('disabled', 'disabled');
			low_stock_qty.attr('disabled', 'disabled');
		} else {
			qty.removeAttr('disabled');
			low_stock_qty.removeAttr('disabled');
		}
	}

	manage_stock.change(changeManageStock);

})();

//function sets default, thumb, small_image
function setImageProperty(el){
	var container = $('#upload_list'),
		name = el.getAttribute('name'),
		allFields = container.find('input[name^="'+name+'"]');

	allFields.val(0);
	el.setAttribute("value", "1");

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
		$('input[name="category_id"]').val($(data.rslt.obj).data('category_id'));
	});
});