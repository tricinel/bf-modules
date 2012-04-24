$.subscribe('list-view/list-item/click', function(id) {
	$('#content').load('<?php echo site_url(SITE_AREA .'/content/category/edit') ?>/'+ id);
});