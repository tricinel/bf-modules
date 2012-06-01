<div class="admin-box">
	<h3>Product</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Product.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Sku</th>
					<th>Price</th>
					<th>Special Price</th>
					<th>Cost</th>
					<th>Name</th>
					<th>Is New</th>
					<th>Is Active</th>
					<th>Url</th>
					<th>Added on</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Product.Content.Delete')) : ?>
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
					<?php if ($this->auth->has_permission('Product.Content.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Product.Content.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/content/product/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->product_sku) ?></td>
				<?php else: ?>
				<td><?php echo $record->product_sku ?></td>
				<?php endif; ?>		
			
				<td><?php echo $record->product_price?></td>
				<td><?php echo $record->product_special_price?></td>
				<td><?php echo $record->product_cost?></td>
				<td><?php echo $record->product_name?></td>
				<td><?php echo $record->product_is_new?></td>
				<td><?php echo $record->product_is_active?></td>
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