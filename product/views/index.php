<div class="box create rounded">

	<h3>Product</h3>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table>
		<thead>
		
			
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
		
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
			<?php foreach($record as $field => $value) : ?>
				
				<?php if ($field != 'id') : ?>
					<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('product_true') : lang('product_false')) : $value; ?></td>
				<?php endif; ?>
				
			<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>