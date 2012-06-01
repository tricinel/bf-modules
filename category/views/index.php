<div>
	<h1 class="page-header">Category</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table class="table table-striped table-bordered">
		<thead>
		
			
		<th>Category name</th>
		<th>Category products count</th>
		<th>Category URL</th>
		
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>

			<tr>
				<td><?php echo $record->category_name;?></td>
				<td><?php echo $record->category_products_count;?></td>
				<td><?php echo $record->category_url;?></td>
			</tr>

		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>