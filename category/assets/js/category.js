//function builds category tree
$(function () {
	$("#cats").jstree({ 
		"json_data" : {
			//"data" : buildTree()
			"ajax" : {
				"url" : "/boardcoverz/manage/content/category/build_tree"
			}
		},
		"plugins" : [ "json_data", "ui" ]
	}).bind("select_node.jstree", function (e, data) {
		var obj = $(data.rslt.obj);
		$('input[name="parent_category_url"]').val(obj.data('url'));
		$('input[name="category_parent_id"]').val(obj.data('category_id'));
	});
});