<?php
    //set up some default options to use in the form
    $bool = array(
        1 => 'Yes',
        0 => 'No'
    );
?>

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

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#general-tab">General</a></li>
        <li><a data-toggle="tab" href="#meta-tab">Meta information</a></li>
        <li><a data-toggle="tab" href="#categories-tab">Categories</a></li>
        <li><a data-toggle="tab" href="#media-tab">Images</a></li>
        <li><a data-toggle="tab" href="#pricing-tab">Pricing</a></li>
        <li><a data-toggle="tab" href="#stock-tab">Stock management</a></li>
    </ul>

    <fieldset>

        <div class="tab-content">

            <!-- General -->
            <div class="tab-pane active" id="general-tab">

                <div class="control-group <?php echo form_error('product_name') ? 'error' : ''; ?>">
                    <?php echo form_label('Name'. lang('bf_form_label_required'), 'product_name', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_name" type="text" name="product_name" maxlength="250" value="<?php echo set_value('product_name', isset($product['product_name']) ? $product['product_name'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_name'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('product_description') ? 'error' : ''; ?>">
                    <?php echo form_label('Description'. lang('bf_form_label_required'), 'product_description', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <?php echo form_textarea( array( 'name' => 'product_description', 'id' => 'product_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('product_description', isset($product['product_description']) ? $product['product_description'] : '') ) )?>
                        <span class="help-inline"><?php echo form_error('product_description'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('product_sku') ? 'error' : ''; ?>">
                    <?php echo form_label('SKU'. lang('bf_form_label_required'), 'product_sku', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_sku" type="text" name="product_sku" maxlength="64" value="<?php echo set_value('product_sku', isset($product['product_sku']) ? $product['product_sku'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_sku'); ?></span>
                    </div>
                </div>

                <?php echo form_dropdown('product_is_new', $bool, set_value('product_is_new', isset($product['product_is_new']) ? $product['product_is_new'] : ''), 'Product is new'. lang('bf_form_label_required'))?>

                <?php echo form_dropdown('product_is_active', $bool, set_value('product_is_active', isset($product['product_is_active']) ? $product['product_is_active'] : ''), 'Product is active'. lang('bf_form_label_required'))?>

                <div class="control-group <?php echo form_error('product_weight') ? 'error' : ''; ?>">
                    <?php echo form_label('Weight'. lang('bf_form_label_required'), 'product_weight', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_weight" type="text" name="product_weight" maxlength="13" value="<?php echo set_value('product_weight', isset($product['product_weight']) ? $product['product_weight'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_weight'); ?></span>
                    </div>
                </div>

            </div>

            <!-- Meta information -->
            <div class="tab-pane" id="meta-tab">

                <div class="control-group <?php echo form_error('product_meta_title') ? 'error' : ''; ?>">
                    <?php echo form_label('Meta Title', 'product_meta_title', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_meta_title" type="text" name="product_meta_title" maxlength="250" value="<?php echo set_value('product_meta_title', isset($product['product_meta_title']) ? $product['product_meta_title'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_meta_title'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('product_meta_description') ? 'error' : ''; ?>">
                    <?php echo form_label('Meta Description', 'product_meta_description', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <?php echo form_textarea( array( 'name' => 'product_meta_description', 'id' => 'product_meta_description', 'rows' => '5', 'cols' => '280', 'value' => set_value('product_meta_description', isset($product['product_meta_description']) ? $product['product_meta_description'] : '') ) )?>
                        <span class="help-inline"><?php echo form_error('product_meta_description'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('product_meta_keywords') ? 'error' : ''; ?>">
                    <?php echo form_label('Meta Keywords', 'product_meta_keywords', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <?php echo form_textarea( array( 'name' => 'product_meta_keywords', 'id' => 'product_meta_keywords', 'rows' => '5', 'cols' => '280', 'value' => set_value('product_meta_keywords', isset($product['product_meta_keywords']) ? $product['product_meta_keywords'] : '') ) )?>
                        <span class="help-inline"><?php echo form_error('product_meta_keywords'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('product_url') ? 'error' : ''; ?>">
                    <?php echo form_label('URL', 'product_url', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_url" type="text" name="product_url" maxlength="255" value="<?php echo set_value('product_url', isset($product['product_url']) ? $product['product_url'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_url'); ?></span>
                    </div>
                </div>

            </div>

             <!-- Categories -->
            <div class="tab-pane" id="categories-tab">

                <input type="hidden" name="category_url" id="category_url" value=""/>
                <input type="hidden" name="category_id" id="category_id" value=""/>

                <div id="cats" class="jstree-apple" style="min-height:200px;"></div>

            </div>

            <!-- Images -->
            <div class="tab-pane" id="media-tab">

                <div id="dropbox">
                    <input type="hidden" name="images_count" id="images_count" value=""/>
                    <span class="message">Drop images here to upload.</span>
                </div>

            </div>

            <!-- Pricing -->
            <div class="tab-pane" id="pricing-tab">

                <div class="control-group <?php echo form_error('product_price') ? 'error' : ''; ?>">
                    <?php echo form_label('Price'. lang('bf_form_label_required'), 'product_price', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_price" type="text" name="product_price" maxlength="13" value="<?php echo set_value('product_price', isset($product['product_price']) ? $product['product_price'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_price'); ?></span>
                    </div>
                </div>

                 <div class="control-group <?php echo form_error('product_special_price') ? 'error' : ''; ?>">
                    <?php echo form_label('Special Price', 'product_special_price', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_special_price" type="text" name="product_special_price" maxlength="13" value="<?php echo set_value('product_special_price', isset($product['product_special_price']) ? $product['product_special_price'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_special_price'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('product_special_price_from_date') ? 'error' : ''; ?>">
                    <?php echo form_label('Special Price From Date', 'product_special_price_from_date', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_special_price_from_date" type="text" name="product_special_price_from_date"  value="<?php echo set_value('product_special_price_from_date', isset($product['product_special_price_from_date']) ? $product['product_special_price_from_date'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_special_price_from_date'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('product_special_price_to_date') ? 'error' : ''; ?>">
                    <?php echo form_label('Special Price To Date', 'product_special_price_to_date', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_special_price_to_date" type="text" name="product_special_price_to_date"  value="<?php echo set_value('product_special_price_to_date', isset($product['product_special_price_to_date']) ? $product['product_special_price_to_date'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_special_price_to_date'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('product_cost') ? 'error' : ''; ?>">
                    <?php echo form_label('Cost'. lang('bf_form_label_required'), 'product_cost', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_cost" type="text" name="product_cost" maxlength="13" value="<?php echo set_value('product_cost', isset($product['product_cost']) ? $product['product_cost'] : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_cost'); ?></span>
                    </div>
                </div>

            </div>

            <!-- Stock management -->
            <div class="tab-pane" id="stock-tab">

                <?php echo form_dropdown('manage_stock', $bool, set_value('manage_stock', isset($product['manage_stock']) ? $product['manage_stock'] : ''), 'Manage stock'. lang('bf_form_label_required'))?>

                <div class="control-group <?php echo form_error('qty') ? 'error' : ''; ?>">
                    <?php echo form_label('Quantity'. lang('bf_form_label_required'), 'qty', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="qty" type="text" name="qty" maxlength="11" value="<?php echo set_value('qty', isset($product['qty']) ? $product['qty'] : '0'); ?>"  />
                        <span class="help-inline"><?php echo form_error('qty'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('low_stock_qty') ? 'error' : ''; ?>">
                    <?php echo form_label('Low stock quantity'. lang('bf_form_label_required'), 'low_stock_qty', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="low_stock_qty" type="text" name="low_stock_qty" maxlength="11" value="<?php echo set_value('low_stock_qty', isset($product['low_stock_qty']) ? $product['low_stock_qty'] : '0'); ?>"  />
                        <span class="help-inline"><?php echo form_error('low_stock_qty'); ?></span>
                    </div>
                </div>

                <?php echo form_dropdown('is_in_stock', $bool, set_value('is_in_stock', isset($product['is_in_stock']) ? $product['is_in_stock'] : ''), 'Is in stock'. lang('bf_form_label_required'))?>

            </div>

        </div>
        <!-- end tabs-->

        <div class="form-actions">
            <br/>
            <input type="submit" name="submit" class="btn btn-primary" value="Create Product" />
            or <?php echo anchor(SITE_AREA .'/content/product', lang('product_cancel'), 'class="btn btn-warning"'); ?>

        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
