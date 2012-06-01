<div>
	<h1 class="page-header">Product</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table class="table table-striped table-bordered">
		<thead>
		
			
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