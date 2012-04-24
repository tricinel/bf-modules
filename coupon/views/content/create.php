
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($coupon) ) {
	$coupon = (array)$coupon;
}
$id = isset($coupon['id']) ? "/".$coupon['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($coupon['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $coupon['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Coupon code', 'coupon_code'); ?> <span class="required">*</span>
        <input id="coupon_code" type="text" name="coupon_code" maxlength="128" value="<?php echo set_value('coupon_code', isset($coupon['coupon_code']) ? $coupon['coupon_code'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Discount type', 'coupon_discount_type'); ?> <span class="required">*</span>

        <?php // Change the values in this array to populate your dropdown as required ?>
        
<?php $options = array(
				'percentage of total' => 'percentage of total',
				'fixed' => 'fixed',
); ?>

        <?php echo form_dropdown('coupon_discount_type', $options, set_value('coupon_discount_type', isset($coupon['coupon_discount_type']) ? $coupon['coupon_discount_type'] : ''))?>
</div>                                             
                        
<div>
        <?php echo form_label('Discount amount', 'coupon_discount_amount'); ?> <span class="required">*</span>
        <input id="coupon_discount_amount" type="text" name="coupon_discount_amount" maxlength="13" value="<?php echo set_value('coupon_discount_amount', isset($coupon['coupon_discount_amount']) ? $coupon['coupon_discount_amount'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Limit uses to', 'coupon_uses_limit'); ?>&nbsp;&nbsp;&nbsp;
        <input id="coupon_uses_limit" type="text" name="coupon_uses_limit" maxlength="11" value="<?php echo set_value('coupon_uses_limit', isset($coupon['coupon_uses_limit']) ? $coupon['coupon_uses_limit'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Limit customer uses to', 'coupon_uses_per_customer'); ?>&nbsp;&nbsp;&nbsp;
        <input id="coupon_uses_per_customer" type="text" name="coupon_uses_per_customer" maxlength="11" value="<?php echo set_value('coupon_uses_per_customer', isset($coupon['coupon_uses_per_customer']) ? $coupon['coupon_uses_per_customer'] : ''); ?>"  />
</div>

<div>
        <?php $options = array(
                1 => 'Yes',
                0 => 'No'
        ); ?>

        <?php echo form_label('Allow guests to use coupon', 'coupon_allowed_for_guests'); ?> <span class="required">*</span>
        <?php echo form_dropdown('coupon_allowed_for_guests', $options, set_value('coupon_allowed_for_guests', isset($coupon['coupon_allowed_for_guests']) ? $coupon['coupon_allowed_for_guests'] : ''))?>
</div>

<div>
        <?php echo form_label('Valid until', 'coupon_expiration_date'); ?>&nbsp;&nbsp;&nbsp;
			<script>head.ready(function(){$('#coupon_expiration_date').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});});</script>
        <input id="coupon_expiration_date" type="text" name="coupon_expiration_date"  value="<?php echo set_value('coupon_expiration_date', isset($coupon['coupon_expiration_date']) ? $coupon['coupon_expiration_date'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create Coupon" /> or <?php echo anchor(SITE_AREA .'/content/coupon', lang('coupon_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
