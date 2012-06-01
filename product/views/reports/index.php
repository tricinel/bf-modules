<div class="admin-box">
	<h3>Product</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Product.Reports.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Product Sku</th>
					<th>Product Price</th>
					<th>Product Special Price</th>
					<th>Product Special Price From Date</th>
					<th>Product Special Price To Date</th>
					<th>Product Cost</th>
					<th>Product Name</th>
					<th>Product Description</th>
					<th>Product Meta Title</th>
					<th>Product Meta Description</th>
					<th>Product Meta Keywords</th>
					<th>Product Is New</th>
					<th>Product Is Active</th>
					<th>Product Weight</th>
					<th>Product Url</th>
					<th>Created</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Product.Reports.Delete')) : ?>
				<tr>
					<td colspan="20">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('product_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Product.Reports.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Product.Reports.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/reports/product/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->product_sku) ?></td>
				<?php else: ?>
				<td><?php echo $record->product_sku ?></td>
				<?php endif; ?>		
			
				<td><?php echo $record->product_price?></td>
				<td><?php echo $record->product_special_price?></td>
				<td><?php echo $record->product_special_price_from_date?></td>
				<td><?php echo $record->product_special_price_to_date?></td>
				<td><?php echo $record->product_cost?></td>
				<td><?php echo $record->product_name?></td>
				<td><?php echo $record->product_description?></td>
				<td><?php echo $record->product_meta_title?></td>
				<td><?php echo $record->product_meta_description?></td>
				<td><?php echo $record->product_meta_keywords?></td>
				<td><?php echo $record->product_is_new?></td>
				<td><?php echo $record->product_is_active?></td>
				<td><?php echo $record->product_weight?></td>
				<td><?php echo $record->product_url?></td>
				<td><?php echo $record->created_on?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="20">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>