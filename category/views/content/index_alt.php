
<div class="view split-view">
	
	<!-- Category List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['category_name']) ? $record['id'] : $record['category_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['category_description']) ? lang('category_edit_text') : $record['category_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('category_no_records'); ?> <?php echo anchor(SITE_AREA .'/content/category/create', lang('category_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- Category Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/category/create')?>"><?php echo lang('category_create_new_button');?></a>

				<h3><?php echo lang('category_create_new');?></h3>

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
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->category_name?></td>
				<td><?php echo $record->category_is_active?></td>
				<td><?php echo $record->category_parent_id?></td>
				<td><?php echo $record->category_products_count?></td>
				<td><?php echo $record->category_meta_title?></td>
				<td><?php echo $record->category_meta_description?></td>
				<td><?php echo $record->category_url?></td>
				<td><?php echo anchor(SITE_AREA .'/content/category/edit/'. $record->id, lang('category_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
