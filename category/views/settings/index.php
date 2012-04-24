<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/settings/category/create'); ?>">
		<?php echo lang('category_create_new_button'); ?>
	</a>

	<h3><?php echo lang('category_create_new'); ?></h3>

	<p><?php echo lang('category_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>Category</h2>
	<table>
		<thead>
			<tr>
			
		<th>Name</th>
		<th>Is active</th>
		<th>Parent</th>
		<th>Products count</th>
		<th>Meta title</th>
		<th>Meta description</th>
		<th>Url</th>
		
			<th><?php echo lang('category_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->category_name?></td>
				<td><?php echo $record->category_is_active?></td>
				<td><?php echo $record->category_parent_id?></td>
				<td><?php echo $record->category_products_count?></td>
				<td><?php echo $record->category_meta_title?></td>
				<td><?php echo $record->category_meta_description?></td>
				<td><?php echo $record->category_url?></td>
				<td><?php echo anchor(SITE_AREA .'/settings/category/edit/'. $record->id, lang('category_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>