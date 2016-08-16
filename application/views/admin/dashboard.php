<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> Control Panel</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <a href="<?php echo base_url('/admin/users'); ?>" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>
						  <a href="<?php echo base_url('/admin/finance'); ?>" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Finance</a>
                          <a href="<?php echo base_url('/admin/contact'); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Messages</a>

                        </div>
                        <div class="col-xs-6 col-md-6">
                          <!-- <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Bookmarks</a>
                          <a href="#" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Notes</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Photos</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a> -->
                          <a href="<?php echo base_url('/admin/settings'); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Settings</a>
                        </div>
						<div class="col-xs-6 col-md-6">
                          <!-- <a href="#" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>
                          <a href="#" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Notes</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Photos</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a> -->
                        </div>
                    </div>
                    <!-- <a href="http://www.jquery2dotnet.com/" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> Website</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <p><?php echo lang('admin dashboard text welcome'); ?></p>

<br />
<button id="jsi18n-sample" type="button" class="btn btn-primary"><?php echo lang('admin dashboard btn demo'); ?></button> --> 
