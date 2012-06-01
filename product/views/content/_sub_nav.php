<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/product') ?>"><?php echo lang('product_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Product.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/product/create') ?>" id="create_new"><?php echo lang('product_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>