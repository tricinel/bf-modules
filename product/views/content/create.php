
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($product) ) {
	$product = (array)$product;
}
$id = isset($product['id']) ? "/".$product['id'] : '';
?>
<?php echo form_open_multipart($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($product['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $product['id'];?>"  /><?php endif;?>

<div id="tabs">
	<ul>
		<li><a href="#general-tab">General</a></li>
		<li><a href="#media-tab">Images</a></li>
		<li><a href="#pricing-tab">Pricing</a></li>
		<li><a href="#meta-tab">Meta information</a></li>
	</ul>

	<!-- General -->
	<div id="general-tab">

		<div>
			<?php echo form_label('Name', 'product_name'); ?> <span class="required">*</span>
			<input id="product_name" type="text" name="product_name" maxlength="250" value="<?php echo set_value('product_name', isset($product['product_name']) ? $product['product_name'] : ''); ?>"  />
		</div>

		<div>
        	<?php echo form_label('Description', 'product_description'); ?> <span class="required">*</span>
				<script type="text/javascript">
					head.ready(function(){
						//<![CDATA[
						if( !('product_description' in CKEDITOR.instances)) {
							CKEDITOR.replace( 'product_description' );
						}
						//]]>
					});
				</script>
			<?php echo form_textarea( array( 'name' => 'product_description', 'id' => 'product_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('product_description', isset($product['product_description']) ? $product['product_description'] : '') ) )?>
		</div>

		<div>
	        <?php echo form_label('SKU', 'product_sku'); ?> <span class="required">*</span>
	        <input id="product_sku" type="text" name="product_sku" maxlength="64" value="<?php echo set_value('product_sku', isset($product['product_sku']) ? $product['product_sku'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('Set as new', 'product_is_new'); ?> &nbsp;

			<?php // Change the values in this array to populate your dropdown as required ?>
		        
			<?php $options = array(
						1 => 'Yes',
						0 => 'No'
			); ?>

			<?php echo form_dropdown('product_is_new', $options, set_value('product_is_new', isset($product['product_is_new']) ? $product['product_is_new'] : ''))?>
		</div>                                             
		                        
		<div>
			<?php echo form_label('Visibility', 'product_is_active'); ?> &nbsp;

			<?php // Change the values in this array to populate your dropdown as required ?>
		        
			<?php $options = array(
						1 => 'Store frontend and backend',
						0 => 'Store backend only'
			); ?>

			<?php echo form_dropdown('product_is_active', $options, set_value('product_is_active', isset($product['product_is_active']) ? $product['product_is_active'] : ''))?>
		</div>                                             
		                        
		<div>
			<?php echo form_label('Weight', 'product_weight'); ?> <span class="required">*</span>
			<input id="product_weight" type="text" name="product_weight" maxlength="13" value="<?php echo set_value('product_weight', isset($product['product_weight']) ? $product['product_weight'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('URL', 'product_url'); ?> &nbsp;
			<input id="product_url" type="text" name="product_url" maxlength="255" value="<?php echo set_value('product_url', isset($product['product_url']) ? $product['product_url'] : ''); ?>"  />
		</div>

	</div>

	<!-- Images -->
	<div id="media-tab">
		<div>
			<?php echo form_label('Image', 'product_image'); ?> &nbsp;
			<input type="file" id="product_image" name="product_image" multiple />

			<a href="#" class="button good" id="doupload">Upload images</a>
			<a href="#" class="button" id="dodelete">Cancel upload</a>
		</div>

	</div>

	<!-- Pricing -->
	<div id="pricing-tab">

		<div>
        	<?php echo form_label('Price', 'product_price'); ?> <span class="required">*</span>
        	<input id="product_price" type="text" name="product_price" maxlength="13" value="<?php echo set_value('product_price', isset($product['product_price']) ? $product['product_price'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('Special Price', 'product_special_price'); ?> &nbsp;
			<input id="product_special_price" type="text" name="product_special_price" maxlength="13" value="<?php echo set_value('product_special_price', isset($product['product_special_price']) ? $product['product_special_price'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('Special Price From Date', 'product_special_price_from_date'); ?> &nbsp;
			<script>head.ready(function(){$('#product_special_price_from_date').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});});</script>
			<input id="product_special_price_from_date" type="text" name="product_special_price_from_date"  value="<?php echo set_value('product_special_price_from_date', isset($product['product_special_price_from_date']) ? $product['product_special_price_from_date'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('Special Price To Date', 'product_special_price_to_date'); ?> &nbsp;
			<script>head.ready(function(){$('#product_special_price_to_date').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});});</script>
			<input id="product_special_price_to_date" type="text" name="product_special_price_to_date"  value="<?php echo set_value('product_special_price_to_date', isset($product['product_special_price_to_date']) ? $product['product_special_price_to_date'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('Cost', 'product_cost'); ?> <span class="required">*</span>
			<input id="product_cost" type="text" name="product_cost" maxlength="13" value="<?php echo set_value('product_cost', isset($product['product_cost']) ? $product['product_cost'] : ''); ?>"  />
		</div>

	</div>

	<!-- Meta information -->
	<div id="meta-tab">
		<div>
        	<?php echo form_label('Meta title', 'product_meta_title'); ?>
        	<input id="product_meta_title" type="text" name="product_meta_title" maxlength="250" value="<?php echo set_value('product_meta_title', isset($product['product_meta_title']) ? $product['product_meta_title'] : ''); ?>"  />
		</div>

		<div>
	        <?php echo form_label('Meta description', 'product_meta_description'); ?>
			<?php echo form_textarea( array( 'name' => 'product_meta_description', 'id' => 'product_meta_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('product_meta_description', isset($product['product_meta_description']) ? $product['product_meta_description'] : '') ) )?>
		</div>
		<div>
        	<?php echo form_label('Meta keywords', 'product_meta_keywords'); ?>
			<?php echo form_textarea( array( 'name' => 'product_meta_keywords', 'id' => 'product_meta_keywords', 'rows' => '5', 'cols' => '80', 'value' => set_value('product_meta_keywords', isset($product['product_meta_keywords']) ? $product['product_meta_keywords'] : '') ) )?>
		</div>
	</div>

</div>

<div class="text-right">
	<br/>
	<input type="submit" name="submit" value="Create Product" onclick="javascript:CKEDITOR.instances.product_description.destroy();CKEDITOR.instances.product_meta_description.destroy();CKEDITOR.instances.product_meta_keywords.destroy();" /> or <?php echo anchor(SITE_AREA .'/content/product', lang('product_cancel')); ?>
</div>
<?php echo form_close(); ?>

<script>
head.ready(function(){
	
	$( "#tabs" ).tabs();
	
});
</script>