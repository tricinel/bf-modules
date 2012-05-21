
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($order) ) {
	$order = (array)$order;
}
$id = isset($order['id']) ? "/".$order['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($order['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $order['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Grand total', 'order_grand_total'); ?> <span class="required">*</span>
        <input id="order_grand_total" type="text" name="order_grand_total" maxlength="13" value="<?php echo set_value('order_grand_total', isset($order['order_grand_total']) ? $order['order_grand_total'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Shipping cost', 'order_subtotal_shipping'); ?> <span class="required">*</span>
        <input id="order_subtotal_shipping" type="text" name="order_subtotal_shipping" maxlength="13" value="<?php echo set_value('order_subtotal_shipping', isset($order['order_subtotal_shipping']) ? $order['order_subtotal_shipping'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Discount applied', 'order_discount_applied'); ?>
        <input id="order_discount_applied" type="text" name="order_discount_applied" maxlength="13" value="<?php echo set_value('order_discount_applied', isset($order['order_discount_applied']) ? $order['order_discount_applied'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Status', 'order_status'); ?> <span class="required">*</span>

        <?php // Change the values in this array to populate your dropdown as required ?>
        
<?php $options = array(
				'pending' => 'pending',
				'completed' => 'completed',
				'canceled' => 'canceled',
); ?>

        <?php echo form_dropdown('order_status', $options, set_value('order_status', isset($order['order_status']) ? $order['order_status'] : ''))?>
</div>                                             
                        
<div>
        <?php echo form_label('Sales comments', 'order_comment'); ?>
	<?php echo form_textarea( array( 'name' => 'order_comment', 'id' => 'order_comment', 'rows' => '5', 'cols' => '80', 'value' => set_value('order_comment', isset($order['order_comment']) ? $order['order_comment'] : '') ) )?>
</div>
<div>
        <?php echo form_label('Customer ID', 'order_customer_id'); ?> <span class="required">*</span>
        <input id="order_customer_id" type="text" name="order_customer_id" maxlength="11" value="<?php echo set_value('order_customer_id', isset($order['order_customer_id']) ? $order['order_customer_id'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('First name', 'order_customer_first_name'); ?> <span class="required">*</span>
        <input id="order_customer_first_name" type="text" name="order_customer_first_name" maxlength="255" value="<?php echo set_value('order_customer_first_name', isset($order['order_customer_first_name']) ? $order['order_customer_first_name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Last name', 'order_customer_last_name'); ?> <span class="required">*</span>
        <input id="order_customer_last_name" type="text" name="order_customer_last_name" maxlength="255" value="<?php echo set_value('order_customer_last_name', isset($order['order_customer_last_name']) ? $order['order_customer_last_name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Email', 'order_customer_email'); ?> <span class="required">*</span>
        <input id="order_customer_email" type="text" name="order_customer_email" maxlength="255" value="<?php echo set_value('order_customer_email', isset($order['order_customer_email']) ? $order['order_customer_email'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Phone', 'order_customer_phone'); ?>
        <input id="order_customer_phone" type="text" name="order_customer_phone" maxlength="255" value="<?php echo set_value('order_customer_phone', isset($order['order_customer_phone']) ? $order['order_customer_phone'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Billing Address', 'order_customer_billing_address'); ?> <span class="required">*</span>
	<?php echo form_textarea( array( 'name' => 'order_customer_billing_address', 'id' => 'order_customer_billing_address', 'rows' => '5', 'cols' => '80', 'value' => set_value('order_customer_billing_address', isset($order['order_customer_billing_address']) ? $order['order_customer_billing_address'] : '') ) )?>
</div>
<div>
        <?php echo form_label('Shipping Address', 'order_customer_shipping_address'); ?> <span class="required">*</span>
	<?php echo form_textarea( array( 'name' => 'order_customer_shipping_address', 'id' => 'order_customer_shipping_address', 'rows' => '5', 'cols' => '80', 'value' => set_value('order_customer_shipping_address', isset($order['order_customer_shipping_address']) ? $order['order_customer_shipping_address'] : '') ) )?>
</div>
<div>
        <?php echo form_label('Customer comments', 'order_customer_comment'); ?>
	<?php echo form_textarea( array( 'name' => 'order_customer_comment', 'id' => 'order_customer_comment', 'rows' => '5', 'cols' => '80', 'value' => set_value('order_customer_comment', isset($order['order_customer_comment']) ? $order['order_customer_comment'] : '') ) )?>
</div>
<div>
        <?php echo form_label('Is guest', 'order_is_guest'); ?> <span class="required">*</span>
        <input id="order_is_guest" type="text" name="order_is_guest" maxlength="1" value="<?php echo set_value('order_is_guest', isset($order['order_is_guest']) ? $order['order_is_guest'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create Order" /> or <?php echo anchor(SITE_AREA .'/reports/order', lang('order_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
