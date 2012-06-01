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
if( isset($category) ) {
    $category = (array)$category;
}
$id = isset($category['id']) ? $category['id'] : '';
?>
<div class="admin-box">
    <h3>Category</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('category_name') ? 'error' : ''; ?>">
            <?php echo form_label('Category name'. lang('bf_form_label_required'), 'category_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="category_name" type="text" name="category_name" maxlength="128" value="<?php echo set_value('category_name', isset($category['category_name']) ? $category['category_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('category_name'); ?></span>
        </div>


        </div>
       
        <?php echo form_dropdown('category_is_active', $bool, set_value('category_is_active', isset($category['category_is_active']) ? $category['category_is_active'] : ''), 'Category is active'. lang('bf_form_label_required'))?>

         <?php if( isset($categories) && !empty($categories) ):
            $cats = array();
            $cats['0'] = 'None';
            $category = (isset($category)) ? $category : false;

            if(count($categories) > 0) {
                foreach($categories as $cat):
                    if($cat->category_name != $category['category_name']) $cats[$cat->id] = $cat->category_name;
                endforeach;
            }

            echo form_dropdown('category_parent_id', $cats, set_value('category_parent_id', isset($category['category_parent_id']) ? $category['category_parent_id'] : ''), 'Parent category');
        
        endif;?>

        
        <div class="control-group <?php echo form_error('category_meta_title') ? 'error' : ''; ?>">
            <?php echo form_label('Category meta title', 'category_meta_title', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="category_meta_title" type="text" name="category_meta_title" maxlength="250" value="<?php echo set_value('category_meta_title', isset($category['category_meta_title']) ? $category['category_meta_title'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('category_meta_title'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('category_meta_description') ? 'error' : ''; ?>">
            <?php echo form_label('Category meta description', 'category_meta_description', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'category_meta_description', 'id' => 'category_meta_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('category_meta_description', isset($category['category_meta_description']) ? $category['category_meta_description'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('category_meta_description'); ?></span>
        </div>

        </div>
        <div class="control-group <?php echo form_error('category_meta_keywords') ? 'error' : ''; ?>">
            <?php echo form_label('Category meta keywords', 'category_meta_keywords', array('class' => "control-label") ); ?>
            <div class='controls'>
            <?php echo form_textarea( array( 'name' => 'category_meta_keywords', 'id' => 'category_meta_keywords', 'rows' => '5', 'cols' => '80', 'value' => set_value('category_meta_keywords', isset($category['category_meta_keywords']) ? $category['category_meta_keywords'] : '') ) )?>
            <span class="help-inline"><?php echo form_error('category_meta_keywords'); ?></span>
        </div>

        </div>
        <div class="control-group <?php echo form_error('category_url') ? 'error' : ''; ?>">
            <?php echo form_label('Category URL', 'category_url', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="category_url" type="text" name="category_url" maxlength="255" value="<?php echo set_value('category_url', isset($category['category_url']) ? $category['category_url'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('category_url'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="submit" class="btn btn-primary" value="Edit Category" />
            or <?php echo anchor(SITE_AREA .'/content/category', lang('category_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Category.Content.Delete')) : ?>

            or <a class="btn btn-danger" id="delete-me" href="/<?php echo SITE_AREA .'/content/category/delete/'. $id;?>" onclick="return confirm('<?php echo lang('category_delete_confirm'); ?>')" name="delete-me">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('category_delete_record'); ?>
            </a>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
