<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3 class="panel-title"><?php echo lang('finance title manage'); ?></h3>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-success tooltips" href="<?php echo base_url('admin/finance/catven'); ?>" title="<?php echo lang('finance tooltip add_new_catven') ?>" data-toggle="tooltip"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo lang('finance button add_new_catven'); ?></a>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover-warning">
        <thead>

            <?php // sortable headers ?>
            <tr>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('finance col catven_id'); ?></a>
                    <?php if ($sort == 'id') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=categories&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('finance col categories'); ?></a>
                    <?php if ($sort == 'categories') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo current_url(); ?>?sort=locked&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('finance col group'); ?></a>
                    <?php if ($sort == 'locked') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </td>
            </tr>

            <?php // search filters ?>
            <tr>
                <?php echo form_open("{$this_url}/manage?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                    <th>
                    </th>
                    <th<?php echo ((isset($filters['categories'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'categories', 'id'=>'categories', 'class'=>'form-control input-sm', 'placeholder'=>lang('finance input vendor'), 'value'=>set_value('categories', ((isset($filters['categories'])) ? $filters['categories'] : '')))); ?>
                    </th>
                    <th<?php echo ((isset($filters['category'])) ? ' class="has-success"' : ''); ?>>
																		
<select name="locked" id="category-list-dropdown" class="form-control chosen-select" data-placeholder="Choose a Category...">
<option value="">None</option>
<option value="1">1 - Categories</option>
<option value="2">2 - Vendors / Suppliers</option>
<option value="3">3 - Financial Year</option>
</select>
						<?php 						
						// echo form_dropdown('category', $category_list, $this->input->get('category'),'id="category-list-dropdown" class="form-control chosen-select" data-placeholder="Choose a Category..."');
						
						?>
						
						
                    </th>

                    <th colspan="3">
                        <div class="text-right">
                            <a href="<?php echo $this_url; ?>/manage" class="btn btn-danger tooltips" data-toggle="tooltip" title="<?php echo lang('admin tooltip filter_reset'); ?>"><span class="glyphicon glyphicon-refresh"></span> <?php echo lang('core button reset'); ?></a>
                            <button type="submit" name="submit" value="<?php echo lang('core button filter'); ?>" class="btn btn-success tooltips" data-toggle="tooltip" title="<?php echo lang('admin tooltip filter'); ?>"><span class="glyphicon glyphicon-filter"></span> <?php echo lang('core button filter'); ?></button>
                        </div>
                    </th>
					
					 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>chosen.jquery.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>	
					
                <?php echo form_close(); ?>
            </tr>

        </thead>
        <tbody>

            <?php // data rows ?>
            <?php if ($total) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                            <?php echo $user['id']; ?>
                        </td>
                        <td<?php echo (($sort == 'title') ? ' class="sorted"' : ''); ?>>
                            <?php echo $user['categories']; ?>
                        </td>
                        <td<?php echo (($sort == 'category') ? ' class="sorted"' : ''); ?>>
                            <?php echo $user['locked'] . ' - ';
							$cats = array("","Categories", "Vendors / Suppliers", "Financial Year");
							echo $cats[$user['locked']]; ?>
                        </td>
 <!--                        <td<?php echo (($sort == 'value') ? ' class="sorted"' : ''); ?>>
                            
							<php if ($user['value'] > 0): ?>

							<php echo '<span class="active">$' . $user['value'] . '</span>'; ?>

							<php else: ?>

							<php echo '<span class="inactive">$' . $user['value'] . '</span>'; ?>

							<php endif; ?>
							
                        </td>
                        <td<php echo (($sort == 'assigned_user') ? ' class="sorted"' : ''); ?>>
                            <php echo ($user['assigned_user']) ? lang('core text yes') : lang('core text no'); ?>
                        </td> -->
                        <td>
                            <div class="text-right">
                                <div class="btn-group">
                                    <?php if ($user['id'] > 1) : ?>
                                        <a href="#modal-<?php echo $user['id']; ?>" data-toggle="modal" class="btn btn-danger" title="<?php echo lang('admin button delete'); ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                    <?php endif; ?>
                                    <a href="<?php echo $this_url; ?>/manage_form/<?php echo $user['id']; ?>" class="btn btn-warning" title="<?php echo lang('admin button edit'); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">
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
                        <option value="10"<?php echo ($limit == 10 OR ($limit != 10 && $limit != 25 && $limit != 50 && $limit != 75 && $limit != 100)) ? ' selected' : ''; ?>>10 <?php echo lang('admin input items_per_page'); ?></option>
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
                    <a href="<?php echo $this_url; ?>/export?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?><?php echo $filter; ?>" class="btn btn-success tooltips" data-toggle="tooltip" title="<?php echo lang('admin tooltip csv_export'); ?>"><span class="glyphicon glyphicon-export"></span> <?php echo lang('admin button csv_export'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php // delete modal ?>
<?php if ($total) : ?>
    <?php foreach ($users as $user) : ?>
        <div class="modal fade" id="modal-<?php echo $user['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-<?php echo $user['id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;0</button>
                        <h4 id="modal-label-<?php echo $user['id']; ?>"><?php echo lang('finance title finance_delete');  ?></h4>
                    </div>
                    <div class="modal-body">
                        <p><?php echo sprintf(lang('finance msg delete_confirm'), $user['categories'] . "."); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('core button cancel'); ?></button>
                        <button type="button" class="btn btn-primary btn-delete-catven" data-id="<?php echo $user['id']; ?>"><?php echo lang('admin button delete'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
