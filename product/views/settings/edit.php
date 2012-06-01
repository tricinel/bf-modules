
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($product) ) {
    $product = (array)$product;
}
$id = isset($product['id']) ? $product['id'] : '';
?>
<div class="admin-box">
    <h3>Product</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('product_sku') ? 'error' : ''; ?>">
            <?php echo form_label('Product Sku'. lang('bf_form_label_required'), 'product_sku', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_sku" type="text" name="product_sku" maxlength="64" value="<?php echo set_value('product_sku', isset($product['product_sku']) ? $product['product_sku'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_sku'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_price') ? 'error' : ''; ?>">
            <?php echo form_label('Product Price'. lang('bf_form_label_required'), 'product_price', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_price" type="text" name="product_price" maxlength="13" value="<?php echo set_value('product_price', isset($product['product_price']) ? $product['product_price'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_price'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_special_price') ? 'error' : ''; ?>">
            <?php echo form_label('Product Special Price', 'product_special_price', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_special_price" type="text" name="product_special_price" maxlength="13" value="<?php echo set_value('product_special_price', isset($product['product_special_price']) ? $product['product_special_price'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_special_price'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_special_price_from_date') ? 'error' : ''; ?>">
            <?php echo form_label('Product Special Price From Date', 'product_special_price_from_date', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_special_price_from_date" type="text" name="product_special_price_from_date"  value="<?php echo set_value('product_special_price_from_date', isset($product['product_special_price_from_date']) ? $product['product_special_price_from_date'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_special_price_from_date'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_special_price_to_date') ? 'error' : ''; ?>">
            <?php echo form_label('Product Special Price To Date', 'product_special_price_to_date', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_special_price_to_date" type="text" name="product_special_price_to_date"  value="<?php echo set_value('product_special_price_to_date', isset($product['product_special_price_to_date']) ? $product['product_special_price_to_date'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_special_price_to_date'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_cost') ? 'error' : ''; ?>">
            <?php echo form_label('Product Cost'. lang('bf_form_label_required'), 'product_cost', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_cost" type="text" name="product_cost" maxlength="13" value="<?php echo set_value('product_cost', isset($product['product_cost']) ? $product['product_cost'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_cost'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_name') ? 'error' : ''; ?>">
            <?php echo form_label('Product Name'. lang('bf_form_label_required'), 'product_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_name" type="text" name="product_name" maxlength="250" value="<?php echo set_value('product_name', isset($product['product_name']) ? $product['product_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_name'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_description') ? 'error' : ''; ?>">
            <?php echo form_label('Product Description'. lang('bf_form_label_required'), 'product_description', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'product_description', 'id' => 'product_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('product_description', isset($product['product_description']) ? $product['product_description'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('product_description'); ?></span>
        </div>

        </div>
        <div class="control-group <?php echo form_error('product_meta_title') ? 'error' : ''; ?>">
            <?php echo form_label('Product Meta Title', 'product_meta_title', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_meta_title" type="text" name="product_meta_title" maxlength="250" value="<?php echo set_value('product_meta_title', isset($product['product_meta_title']) ? $product['product_meta_title'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_meta_title'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_meta_description') ? 'error' : ''; ?>">
            <?php echo form_label('Product Meta Description', 'product_meta_description', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'product_meta_description', 'id' => 'product_meta_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('product_meta_description', isset($product['product_meta_description']) ? $product['product_meta_description'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('product_meta_description'); ?></span>
        </div>

        </div>
        <div class="control-group <?php echo form_error('product_meta_keywords') ? 'error' : ''; ?>">
            <?php echo form_label('Product Meta Keywords', 'product_meta_keywords', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'product_meta_keywords', 'id' => 'product_meta_keywords', 'rows' => '5', 'cols' => '80', 'value' => set_value('product_meta_keywords', isset($product['product_meta_keywords']) ? $product['product_meta_keywords'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('product_meta_keywords'); ?></span>
        </div>

        </div>
        <div class="control-group <?php echo form_error('product_is_new') ? 'error' : ''; ?>">
            <?php echo form_label('Product Is New'. lang('bf_form_label_required'), 'product_is_new', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_is_new" type="text" name="product_is_new" maxlength="1" value="<?php echo set_value('product_is_new', isset($product['product_is_new']) ? $product['product_is_new'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_is_new'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_is_active') ? 'error' : ''; ?>">
            <?php echo form_label('Product Is Active'. lang('bf_form_label_required'), 'product_is_active', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_is_active" type="text" name="product_is_active" maxlength="1" value="<?php echo set_value('product_is_active', isset($product['product_is_active']) ? $product['product_is_active'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_is_active'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_weight') ? 'error' : ''; ?>">
            <?php echo form_label('Product Weight'. lang('bf_form_label_required'), 'product_weight', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_weight" type="text" name="product_weight" maxlength="13" value="<?php echo set_value('product_weight', isset($product['product_weight']) ? $product['product_weight'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_weight'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('product_url') ? 'error' : ''; ?>">
            <?php echo form_label('Product Url', 'product_url', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="product_url" type="text" name="product_url" maxlength="255" value="<?php echo set_value('product_url', isset($product['product_url']) ? $product['product_url'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('product_url'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="submit" class="btn btn-primary" value="Edit Product" />
            or <?php echo anchor(SITE_AREA .'/settings/product', lang('product_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Product.Settings.Delete')) : ?>

            or <a class="btn btn-danger" id="delete-me" href="/<?php echo SITE_AREA .'/settings/product/delete/'. $id;?>" onclick="return confirm('<?php echo lang('product_delete_confirm'); ?>')" name="delete-me">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('product_delete_record'); ?>
            </a>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
