<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php // display welcome message from admin settings ?>
<?php echo $welcome_message; ?>

<div class="clearfix"></div>
<hr />

<p><?php echo lang('welcome content view_location'); ?></p>
<code>application/views/welcome.php</code>

<div class="clearfix"><br /></div>

<p><?php echo lang('welcome content controller_location'); ?></p>
<code>application/controllers/Welcome.php</code>

<div class="clearfix"><hr /></div>

<p><?php echo lang('welcome content ci_docs'); ?></p>

<div class="clearfix"><hr /></div>

<p><a href="<?php echo base_url('api/users'); ?>"><?php echo lang('welcome content click_here'); ?></a>: <?php echo lang('welcome content sample_api'); ?></p>

<div class="clearfix"><hr /></div>

<p><a href="<?php echo base_url('profile'); ?>"><?php echo lang('welcome content click_here'); ?></a>: <?php echo lang('welcome content sample_profile'); ?></p>
<p>
    <?php echo lang('welcome content username'); ?>: <strong>johndoe</strong><br />
    <?php echo lang('welcome content or_email'); ?>: <strong>john@doe.com</strong><br />
    <?php echo lang('welcome content password'); ?>: <strong>johndoe</strong>
</p>

<div class="clearfix"><hr /></div>

<p><a href="<?php echo base_url('admin'); ?>"><?php echo lang('welcome content click_here'); ?></a>: <?php echo lang('welcome content sample_admin'); ?></p>
<p>
    <?php echo lang('welcome content username'); ?>: <strong>admin</strong><br />
    <?php echo lang('welcome content or_email'); ?>: <strong>admin@admin.com</strong><br />
    <?php echo lang('welcome content password'); ?>: <strong>admin</strong>
</p>
