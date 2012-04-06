<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/content/product/create'); ?>">
		<?php echo lang('product_create_new_button'); ?>
	</a>

	<h3><?php echo lang('product_create_new'); ?></h3>

	<p><?php echo lang('product_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>Product</h2>
	<table>
		<thead>
			<tr>
			
		<th>SKU</th>
		<th>Price</th>
		<th>Special Price</th>
		<th>Special Price From Date</th>
		<th>Special Price To Date</th>
		<th>Cost</th>
		<th>Name</th>
		<th>Description</th>
		<th>Meta title</th>
		<th>Meta description</th>
		<th>Meta keywords</th>
		<th>Is new</th>
		<th>Visibility</th>
		<th>Weight</th>
		<th>URL</th>
		<th>Created</th>
		<th>Modified</th>
		
			<th><?php echo lang('product_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->product_sku?></td>
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
				<td><?php echo $record->updated_on?></td>
				<td><?php echo anchor(SITE_AREA .'/content/product/edit/'. $record->id, lang('product_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>