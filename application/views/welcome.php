<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo $welcome_message; ?>

<div class="clearfix"></div>
<hr />

<p>If you would like to edit this page you'll find the View located at:</p>
<code>application/views/welcome.php</code>

<div class="clearfix"><br /></div>

<p>The corresponding Controller for this page is found at:</p>
<code>application/controllers/Welcome.php</code>

<div class="clearfix"><hr /></div>

<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="http://www.codeigniter.com/userguide3/index.html" target="_blank">User Guide</a>.</p>

<div class="clearfix"><hr /></div>

<p>Click <a href="<?php echo base_url('api/users'); ?>">HERE</a> to view sample API output of users. This is for demo purposes only! Be sure to remove the users API before putting your site in a production environment.</p>

<div class="clearfix"><hr /></div>

<p>Click <a href="<?php echo base_url('profile'); ?>">HERE</a> to view a sample user profile.</p>
<p>
    Username: <strong>johndoe</strong><br />
    OR Email: <strong>john@doe.com</strong><br />
    Password: <strong>johndoe</strong>
</p>

<div class="clearfix"><hr /></div>

<p>Click <a href="<?php echo base_url('admin'); ?>">HERE</a> to view the admin interface.</p>
<p>
    Username: <strong>admin</strong><br />
    OR Email: <strong>admin@admin.com</strong><br />
    Password: <strong>admin</strong>
</p>
