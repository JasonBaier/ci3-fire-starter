<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($ok_to_login) : ?>

    <?php echo form_open('', array('class'=>'form-signin')); ?>
        <?php echo form_input(array('name'=>'username', 'id'=>'username', 'class'=>'form-control', 'placeholder'=>lang('users input username_email'), 'maxlength'=>256)); ?>
        <?php echo form_password(array('name'=>'password', 'id'=>'password', 'class'=>'form-control', 'placeholder'=>lang('users input password'), 'maxlength'=>72, 'autocomplete'=>'off')); ?>
        <?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-lg btn-success btn-block'), lang('core button login')); ?>
        <p><br /><a href="<?php echo base_url('user/forgot'); ?>"><?php echo lang('users link forgot_password'); ?></a></p>
        <p><a href="<?php echo base_url('user/register'); ?>"><?php echo lang('users link register_account'); ?></a></p>
    <?php echo form_close(); ?>

<?php else : ?>

    <div class="alert alert-danger clearfix" role="alert">
        <div class="col-md-9">
            <?php echo sprintf(lang('users error too_many_login_attempts'), $this->config->item('login_max_time')); ?>
        </div>
        <div class="col-md-3 text-right">
            <a href="<?php echo base_url('login'); ?>" class="btn btn-danger"><?php echo lang('users button login_try_again'); ?></a>
        </div>
    </div>

<?php endif; ?>
