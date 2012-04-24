
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($category) ) {
	$category = (array)$category;
}
$id = isset($category['id']) ? "/".$category['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($category['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $category['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Name', 'category_name'); ?> <span class="required">*</span>
        <input id="category_name" type="text" name="category_name" maxlength="128" value="<?php echo set_value('category_name', isset($category['category_name']) ? $category['category_name'] : ''); ?>"  />
</div>

<div>
        <?php $options = array(
                1 => 'Yes',
                0 => 'No'
        ); ?>
        
        <?php echo form_label('Is active', 'category_is_active'); ?> <span class="required">*</span>
        <?php echo form_dropdown('category_is_active', $options, set_value('category_is_active', isset($category['category_is_active']) ? $category['category_is_active'] : ''))?>
</div>

<?php if( isset($categories) && !empty($categories) ):
    $cats = array();
    $cats['0'] = 'None';
    
    if(count($categories) > 0) {
        foreach($categories as $cat):
            $cats[$cat->id] = $cat->category_name;
        endforeach;
    }
    
    echo '<div>';
    echo form_label('Parent', 'category_parent_id').'&nbsp;&nbsp;&nbsp;';
    echo form_dropdown('category_parent_id', $cats, set_value('category_parent_id', isset($category['category_parent_id']) ? $category['category_parent_id'] : ''));
    echo '</div>';

endif;?>

<div>
        <?php echo form_label('Meta title', 'category_meta_title'); ?> &nbsp;
        <input id="category_meta_title" type="text" name="category_meta_title" maxlength="250" value="<?php echo set_value('category_meta_title', isset($category['category_meta_title']) ? $category['category_meta_title'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Meta description', 'category_meta_description'); ?> &nbsp;
	<?php echo form_textarea( array( 'name' => 'category_meta_description', 'id' => 'category_meta_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('category_meta_description', isset($category['category_meta_description']) ? $category['category_meta_description'] : '') ) )?>
</div>
<div>
        <?php echo form_label('Url', 'category_url'); ?> &nbsp;
        <input id="category_url" type="text" name="category_url" maxlength="255" value="<?php echo set_value('category_url', isset($category['category_url']) ? $category['category_url'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create Category" /> or <?php echo anchor(SITE_AREA .'/content/category', lang('category_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
