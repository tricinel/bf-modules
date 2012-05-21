
<div class="view split-view">
	
	<!-- Order List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['order_name']) ? $record['id'] : $record['order_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['order_description']) ? lang('order_edit_text') : $record['order_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('order_no_records'); ?> <?php echo anchor(SITE_AREA .'/reports/order/create', lang('order_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- Order Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/reports/order/create')?>"><?php echo lang('order_create_new_button');?></a>

				<h3><?php echo lang('order_create_new');?></h3>

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
<?php
foreach ($records as $record) : ?>
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
				<td><?php echo anchor(SITE_AREA .'/reports/order/edit/'. $record->id, lang('order_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
