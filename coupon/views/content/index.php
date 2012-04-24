<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/content/coupon/create'); ?>">
		<?php echo lang('coupon_create_new_button'); ?>
	</a>

	<h3><?php echo lang('coupon_create_new'); ?></h3>

	<p><?php echo lang('coupon_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>Coupon</h2>
	<table>
		<thead>
			<tr>
			
		<th>Coupon code</th>
		<th>Discount type</th>
		<th>Discount amount</th>
		<th>Limit uses to</th>
		<th>Limit customer uses to</th>
		<th>Allow guests to use coupon</th>
		<th>Valid until</th>
		<th>Times used</th>
		<th>Created</th>
		
			<th><?php echo lang('coupon_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->coupon_code?></td>
				<td><?php echo $record->coupon_discount_type?></td>
				<td><?php echo $record->coupon_discount_amount?></td>
				<td><?php echo $record->coupon_uses_limit?></td>
				<td><?php echo $record->coupon_uses_per_customer?></td>
				<td><?php echo $record->coupon_allowed_for_guests?></td>
				<td><?php echo $record->coupon_expiration_date?></td>
				<td><?php echo $record->coupon_times_used?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo anchor(SITE_AREA .'/content/coupon/edit/'. $record->id, lang('coupon_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>