<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/reports/order/create'); ?>">
		<?php echo lang('order_create_new_button'); ?>
	</a>

	<h3><?php echo lang('order_create_new'); ?></h3>

	<p><?php echo lang('order_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>Order</h2>
	<table>
		<thead>
			<tr>
			
		<th>Grand total</th>
		<th>Shipping cost</th>
		<th>Discount applied</th>
		<th>Status</th>
		<th>Sales comments</th>
		<th>Customer ID</th>
		<th>First name</th>
		<th>Last name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Billing Address</th>
		<th>Shipping Address</th>
		<th>Customer comments</th>
		<th>Is guest</th>
		<th>Created</th>
		<th>Modified</th>
		
			<th><?php echo lang('order_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->order_grand_total?></td>
				<td><?php echo $record->order_subtotal_shipping?></td>
				<td><?php echo $record->order_discount_applied?></td>
				<td><?php echo $record->order_status?></td>
				<td><?php echo $record->order_comment?></td>
				<td><?php echo $record->order_customer_id?></td>
				<td><?php echo $record->order_customer_first_name?></td>
				<td><?php echo $record->order_customer_last_name?></td>
				<td><?php echo $record->order_customer_email?></td>
				<td><?php echo $record->order_customer_phone?></td>
				<td><?php echo $record->order_customer_billing_address?></td>
				<td><?php echo $record->order_customer_shipping_address?></td>
				<td><?php echo $record->order_customer_comment?></td>
				<td><?php echo $record->order_is_guest?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/order/edit/'. $record->id, lang('order_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>