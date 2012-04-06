
<div class="view split-view">
	
	<!-- Product List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['product_name']) ? $record['id'] : $record['product_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['product_description']) ? lang('product_edit_text') : $record['product_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('product_no_records'); ?> <?php echo anchor(SITE_AREA .'/content/product/create', lang('product_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- Product Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/product/create')?>"><?php echo lang('product_create_new_button');?></a>

				<h3><?php echo lang('product_create_new');?></h3>

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
<?php
foreach ($records as $record) : ?>
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
				<td><?php echo anchor(SITE_AREA .'/content/product/edit/'. $record->id, lang('product_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
