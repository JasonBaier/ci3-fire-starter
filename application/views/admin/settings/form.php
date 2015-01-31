<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open('', array('role'=>'form')); ?>

    <?php foreach ($settings as $setting) : ?>

        <?php // prepare field settings
        $field_data = array(
            'name'  => $setting['name'],
            'id'    => $setting['name'],
            'class' => "form-control" . (($setting['show_editor']) ? " editor" : ""),
            'value' => $setting['value']
        );

        if ($setting['is_numeric'])
        {
            $field_data['type'] = "number";
            $field_data['step'] = "any";
        }

        if ($setting['options'])
        {
            $field_options = array();
            if ($setting['input_type'] == "dropdown")
            {
                $field_options[''] = lang('admin input select');
            }
            $lines = explode("\n", $setting['options']);
            foreach ($lines as $line)
            {
                $option = explode("|", $line);
                $field_options[$option[0]] = $option[1];
            }
        }

        switch ($setting['input_size'])
        {
            case "small":
                $col_size = "col-sm-3";
                break;
            case "medium":
                $col_size = "col-sm-6";
                break;
            case "large":
                $col_size = "col-sm-9";
                break;
            default:
                $col_size = "col-sm-6";
        }

        if ($setting['input_type'] == 'textarea')
        {
            $col_size = "col-sm-12";
        }
        ?>

        <div class="row">
            <div class="form-group <?php echo $col_size; ?><?php echo form_error($setting['name']) ? ' has-error' : ''; ?>">
                <?php echo form_label($setting['label'], $setting['name'], array('class'=>'control-label')); ?>
                <?php if (strpos($setting['validation'], 'required')) : ?>
                    <span class="required">*</span>
                <?php endif; ?>

                <?php // render the correct input method
                if ($setting['input_type'] == 'input')
                {
                    echo form_input($field_data);
                }
                elseif ($setting['input_type'] == 'textarea')
                {
                    echo form_textarea($field_data);
                }
                elseif ($setting['input_type'] == 'radio')
                {
                    echo "<br />";
                    foreach ($field_options as $value=>$label)
                    {
                        echo form_radio(array('name'=>$field_data['name'], 'id'=>$field_data['id'] . "-" . $value, 'value'=>$value, 'checked'=>(($value == $field_data['value']) ? 'checked' : FALSE)));
                        echo $label;
                    }
                }
                elseif ($setting['input_type'] == 'dropdown')
                {
                    echo form_dropdown($setting['name'], $field_options, $field_data['value'], 'id="' . $field_data['id'] . '" class="' . $field_data['class'] . '"');
                }
                elseif ($setting['input_type'] == 'timezones')
                {
                    echo "<br />";
                    echo timezone_menu($field_data['value']);
                }
                ?>

                <?php if ($setting['help_text']) : ?>
                    <span class="help-block"><?php echo $setting['help_text']; ?></span>
                <?php endif; ?>
            </div>
        </div>

    <?php endforeach; ?>

    <div class="row pull-right">
        <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>

<?php echo form_close(); ?>
