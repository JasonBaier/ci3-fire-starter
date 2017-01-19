<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3 class="panel-title"><?php echo lang('contact title messages_list'); ?></h3>
            </div>
            <div class="col-md-6 text-right">
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover-warning">
        <thead>

            <?php // sortable headers ?>
            <tr>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col message_id'); ?></a>
                    <?php if ($sort == 'id') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=name&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col name'); ?></a>
                    <?php if ($sort == 'name') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=email&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col email'); ?></a>
                    <?php if ($sort == 'email') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=title&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col title'); ?></a>
                    <?php if ($sort == 'title') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=created&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col created'); ?></a>
                    <?php if ($sort == 'created') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td class="pull-right">
                    <?php echo lang('admin col actions'); ?>
                </td>
            </tr>

            <?php // search filters ?>
            <tr>
                <?php echo form_open("{$this_url}?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                    <th>
                    </th>
                    <th<?php echo ((isset($filters['name'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'name', 'id'=>'name', 'class'=>'form-control input-sm', 'placeholder'=>lang('contact input name'), 'value'=>set_value('name', ((isset($filters['name'])) ? $filters['name'] : '')))); ?>
                    </th>
                    <th<?php echo ((isset($filters['email'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'email', 'id'=>'email', 'class'=>'form-control input-sm', 'placeholder'=>lang('contact input email'), 'value'=>set_value('email', ((isset($filters['email'])) ? $filters['email'] : '')))); ?>
                    </th>
                    <th<?php echo ((isset($filters['last_name'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'title', 'id'=>'title', 'class'=>'form-control input-sm', 'placeholder'=>lang('contact input title'), 'value'=>set_value('title', ((isset($filters['title'])) ? $filters['title'] : '')))); ?>
                    </th>
                    <th<?php echo ((isset($filters['created'])) ? ' class="has-success"' : ''); ?>>
                        <div class="input-group date" data-date="<?php echo date('m-d-Y'); ?>" data-date-format="mm-dd-yyyy">
                            <?php echo form_input(array('name'=>'created', 'id'=>'created', 'class'=>'form-control input-sm', 'readonly'=>'readonly', 'placeholder'=>lang('contact input created'), 'value'=>set_value('created', ((isset($filters['created'])) ? $filters['created'] : '')))); ?>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </th>
                    <th>
                        <div class="text-right">
                            <a href="<?php echo $this_url; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-refresh"></span> <?php echo lang('core button reset'); ?></a>
                            <button type="submit" name="submit" value="<?php echo lang('core button filter'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-filter"></span> <?php echo lang('core button filter'); ?></button>
                        </div>
                    </th>
                <?php echo form_close(); ?>
            </tr>

        </thead>
        <tbody>

            <?php // data rows ?>
            <?php if ($total) : ?>
                <?php foreach ($messages as $message) : ?>
                    <tr>
                        <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                            <?php echo $message['id']; ?>
                        </td>
                        <td<?php echo (($sort == 'name') ? ' class="sorted"' : ''); ?>>
                            <?php echo $message['name']; ?>
                        </td>
                        <td<?php echo (($sort == 'email') ? ' class="sorted"' : ''); ?>>
                            <?php echo $message['email']; ?>
                        </td>
                        <td<?php echo (($sort == 'title') ? ' class="sorted"' : ''); ?>>
                            <?php echo $message['title']; ?>
                        </td>
                        <td<?php echo (($sort == 'created') ? ' class="sorted"' : ''); ?>>
                            <?php echo $message['created']; ?>
                        </td>
                        <td>
                            <div class="text-right">
                                <div class="btn-group">
                                    <?php if ($message['read']) : ?>
                                        <a href="#modal-<?php echo $message['id']; ?>" data-toggle="modal" data-read="true" class="btn btn-default" title="<?php echo lang('contact button read'); ?>"><span class="glyphicon glyphicon-envelope"></span></a>
                                    <?php else : ?>
                                        <a href="#modal-<?php echo $message['id']; ?>" data-toggle="modal" data-read="false" class="btn btn-primary" title="<?php echo lang('contact button read'); ?>"><span class="glyphicon glyphicon-envelope"></span></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">
                        <?php echo lang('core error no_results'); ?>
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>

    <?php // list tools ?>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-2 text-left">
                <label><?php echo sprintf(lang('admin label rows'), $total); ?></label>
            </div>
            <div class="col-md-2 text-left">
                <?php if ($total > 10) : ?>
                    <select id="limit" class="form-control">
                        <option value="10"<?php echo ($limit == 10 || ($limit != 10 && $limit != 25 && $limit != 50 && $limit != 75 && $limit != 100)) ? ' selected' : ''; ?>>10 <?php echo lang('admin input items_per_page'); ?></option>
                        <option value="25"<?php echo ($limit == 25) ? ' selected' : ''; ?>>25 <?php echo lang('admin input items_per_page'); ?></option>
                        <option value="50"<?php echo ($limit == 50) ? ' selected' : ''; ?>>50 <?php echo lang('admin input items_per_page'); ?></option>
                        <option value="75"<?php echo ($limit == 75) ? ' selected' : ''; ?>>75 <?php echo lang('admin input items_per_page'); ?></option>
                        <option value="100"<?php echo ($limit == 100) ? ' selected' : ''; ?>>100 <?php echo lang('admin input items_per_page'); ?></option>
                    </select>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php echo $pagination; ?>
            </div>
            <div class="col-md-2 text-right">
                <?php if ($total) : ?>
                    <a href="<?php echo $this_url; ?>/export?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?><?php echo $filter; ?>" class="btn btn-success"><span class="glyphicon glyphicon-export"></span> <?php echo lang('admin button csv_export'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php // messages modal ?>
<?php if ($total) : ?>
    <?php foreach ($messages as $message) : ?>
        <div class="modal fade" id="modal-<?php echo $message['id']; ?>" data-id="<?php echo $message['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-<?php echo $message['id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="modal-label-<?php echo $message['id']; ?>"><?php echo $message['title']; ?></h4>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $message['message']; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-inverse" data-dismiss="modal"><?php echo lang('core button close'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
