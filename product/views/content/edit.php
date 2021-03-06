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

            <!-- Images -->
            <div class="tab-pane" id="media-tab">

                <div id="upload_list">
                    <!-- some hidden input fields -->
                    <input type="hidden" name="images_count" value="<?php echo isset($images) ? count($images) : '0'?>"/>

                    <table id="images" class="table table-striped">
                        <thead>
                            <tr>
                                <td>Preview</td>
                                <td>Label</td>
                                <td>Set as thumbnail</td>
                                <td>Set as small image</td>
                                <td>Set as default</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="radio" name="is_thumb" value="1" onclick="setImageProperty(this)" checked></td>
                                <td><input type="radio" name="is_small_image" value="1" onclick="setImageProperty(this)" checked></td>
                                <td><input type="radio" name="is_default" value="1" onclick="setImageProperty(this)" checked></td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php if(isset($images) && is_array($images) && count($images) > 0) :
                                $i = 0;
                                foreach($images as $image):?>
                            <tr id="image_<?php echo $i?>" data-index="<?php echo $i?>">
                                <td>
                                    <input type="hidden" name="image_src_<?php echo $i?>" value="<?php echo $image->image_path?>"/>
                                    <input type="hidden" name="is_thumb_<?php echo $i?>" value="<?php echo $image->image_is_thumb?>"/>
                                    <input type="hidden" name="is_small_image_<?php echo $i?>" value="<?php echo $image->image_is_small_image?>"/>
                                    <input type="hidden" name="is_default_<?php echo $i?>" value="<?php echo $image->image_is_default?>"/>
                                    <img src="<?php echo site_url("images/".$image->image_path."?assets=media/catalog&size=50")?>"/>
                                </td>
                                <td>
                                    <input type="text" name="image_label_<?php echo $i?>" class="input-large" value="<?php echo $image->image_label?>"/>
                                </td>
                                <td>
                                    <input type="radio" name="is_thumb" value="<?php echo $image->image_is_thumb?>" onclick="setImageProperty(this)" <?php echo ($image->image_is_thumb) ? 'checked' : ''?>>
                                </td>
                                <td>
                                    <input type="radio" name="is_small_image" value="<?php echo $image->image_is_small_image?>" onclick="setImageProperty(this)" <?php echo ($image->image_is_small_image) ? 'checked' : ''?>>
                                </td>
                                <td>
                                    <input type="radio" name="is_default" value="<?php echo $image->image_is_default?>" onclick="setImageProperty(this)" <?php echo ($image->image_is_default) ? 'checked' : ''?>>
                                </td>
                                <td>
                                    <a href="#" title="Delete" class="btn btn-danger remove"><i class="icon-trash icon-white"></i></a>
                                </td>
                            </tr>
                                <?php $i++;
                                endforeach;
                            endif;?>
                            <!-- Files uploaded will be listed here -->
                        </tbody>
                    </table>
                </div>

                <div class="control-group">
                    <div class="control-label"><label for="file_input">Browse images:</label></div>
                    <div class="controls"><input id="file_input" type="file" multiple></div>
                </div>

                <div id="file_list" class="control-group">
                    <div class="control-label"><label>Images to upload</label></div>
                    <div class="controls">
                        <ul><!-- Files to be uploaded will be listed here --></ul>
                        <p>
                            <a title="Start upload" id="upload_btn" class="disabled btn btn-success btn-mini">Start upload</a>
                            <a title="Cancel" id="cancel_btn" class="disabled btn btn-danger btn-mini">Cancel upload</a>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Pricing -->
            <div class="tab-pane" id="pricing-tab">

                <div class="control-group <?php echo form_error('product_price') ? 'error' : ''; ?>">
                    <?php echo form_label('Price'. lang('bf_form_label_required'), 'product_price', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_price" type="text" name="product_price" maxlength="13" value="<?php echo set_value('product_price', isset($product['product_price']) ? money_format('%!.2n',$product['product_price']) : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_price'); ?></span>
                    </div>
                </div>

                 <div class="control-group <?php echo form_error('product_special_price') ? 'error' : ''; ?>">
                    <?php echo form_label('Special Price', 'product_special_price', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="product_special_price" type="text" name="product_special_price" maxlength="13" value="<?php echo set_value('product_special_price', isset($product['product_special_price']) ? money_format('%!.2n',$product['product_special_price']) : ''); ?>"  />
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
                        <input id="product_cost" type="text" name="product_cost" maxlength="13" value="<?php echo set_value('product_cost', isset($product['product_cost']) ? money_format('%!.2n',$product['product_cost']) : ''); ?>"  />
                        <span class="help-inline"><?php echo form_error('product_cost'); ?></span>
                    </div>
                </div>

            </div>

            <!-- Stock management -->
            <div class="tab-pane" id="stock-tab">

                <?php echo form_dropdown('manage_stock', $bool, $stock['manage_stock'], 'Manage stock'. lang('bf_form_label_required'))?>

                <div class="control-group <?php echo form_error('qty') ? 'error' : ''; ?>">
                    <?php echo form_label('Quantity'. lang('bf_form_label_required'), 'qty', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="qty" type="text" name="qty" maxlength="11" value="<?php echo set_value('qty', isset($stock['qty']) ? $stock['qty'] : '0'); ?>"  />
                        <span class="help-inline"><?php echo form_error('qty'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('low_stock_qty') ? 'error' : ''; ?>">
                    <?php echo form_label('Low stock quantity'. lang('bf_form_label_required'), 'low_stock_qty', array('class' => "control-label") ); ?>
                    <div class='controls'>
                        <input id="low_stock_qty" type="text" name="low_stock_qty" maxlength="11" value="<?php echo set_value('low_stock_qty', isset($stock['low_stock_qty']) ? $stock['low_stock_qty'] : '0'); ?>"  />
                        <span class="help-inline"><?php echo form_error('low_stock_qty'); ?></span>
                    </div>
                </div>

                <?php echo form_dropdown('is_in_stock', $bool, set_value('is_in_stock', isset($stock['is_in_stock']) ? $stock['is_in_stock'] : ''), 'Is in stock'. lang('bf_form_label_required'))?>

        </div>

    </div>
    <!-- end tabs-->



        <div class="form-actions">
            <br/>
            <input type="submit" name="submit" class="btn btn-primary" value="Edit Product" />
            or <?php echo anchor(SITE_AREA .'/content/product', lang('product_cancel'), 'class="btn btn-warning"'); ?>


    <?php if ($this->auth->has_permission('Product.Content.Delete')) : ?>

            or <a class="btn btn-danger" id="delete-me" href="<?php echo site_url(SITE_AREA . '/content/product/delete/'. $id);?>" onclick="return confirm('<?php echo lang('product_delete_confirm'); ?>')" name="delete-me">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('product_delete_record'); ?>
            </a>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
