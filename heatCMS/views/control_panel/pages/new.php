<?php $this->load->helper('form'); ?>
<?php echo lang('cpnl_new_page_description'); ?>
<?php echo form_open('control_panel/pages/new'); ?>
<fieldset>
    <legend><?php echo lang('cpnl_new_page_legend'); ?></legend>
    <ol>
        <li>
            <?php echo form_label(lang('name')); ?>
            <?php echo form_input('page_name', set_value('page_name')); ?>
        </li>
        <li>
            <?php echo form_label(lang('order')); ?>
            <?php echo form_input('page_order', '0'); ?>
        </li>
        <li>
            <?php echo form_label(lang('path')); ?>
            /<?php echo form_input('page_path', set_value('page_path')); ?>
        </li>
        <li>
            <?php echo form_label(lang('content')); ?>
            <?php echo form_textarea('page_content', set_value('page_content')); ?>
        </li>
    </ol>
    <?php echo form_submit('submit', lang('save')); ?>
</fieldset>
<?php echo form_close(); ?>