<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open('', array('role'=>'form')); ?>

    <?php // hidden id ?>
    <?php if (isset($user_id)) : ?>
        <?php echo form_hidden('id', $user_id); ?>
        <?php // echo form_hidden('', $email); ?>
    <?php endif; ?>

    <div class="row">
        <?php // category ?>
        <div class="form-group col-sm-4<?php echo form_error('categories') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('finance input catven category'), 'username', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'categories', 'value'=>set_value('categories', (isset($finance['categories']) ? $finance['categories'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // Type ?>
        <div class="form-group col-sm-3<?php echo form_error('locked') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('finance input enabled'), '', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <div class="radio">
                <label>
                    <?php echo form_radio(array('name'=>'locked', 'id'=>'radio-status-1', 'value'=>'1', 'checked'=>(( ! isset($finance['locked']) OR (isset($finance['locked']) && (int)$finance['locked'] == 1) OR $finance['id'] == 1) ? 'checked' : FALSE))); ?>
                    <?php echo lang('finance input category'); ?>
                </label>
            </div>
            <?php if ( ! $finance['id'] OR $finance['id'] > 1) : ?>
                <div class="radio">
                    <label>
                        <?php echo form_radio(array('name'=>'locked', 'id'=>'radio-status-2', 'value'=>'2', 'checked'=>((isset($finance['locked']) && (int)$finance['locked'] == 2) ? 'checked' : FALSE))); ?>
                        <?php echo lang('finance input vendor'); ?>
                    </label>
                </div>
			
            <?php endif; ?>
			
			<?php if ( ! $finance['id'] OR $finance['id'] > 1) : ?>
                <div class="radio">
                    <label>
                        <?php echo form_radio(array('name'=>'locked', 'id'=>'radio-status-3', 'value'=>'3', 'checked'=>((isset($finance['locked']) && (int)$finance['locked'] == 3) ? 'checked' : FALSE))); ?>
                        <?php echo lang('finance input fy'); ?>
                    </label>
                </div>
            <?php endif; ?>
			
			
			
        </div>
		
		

    </div>

    <?php // buttons ?>
    <div class="row pull-right">
        <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>

<?php echo form_close(); ?>
