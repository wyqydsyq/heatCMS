<?php $this->load->helper('form'); ?>
<div id="setup_errors">
    <?php echo validation_errors(); ?>
</div>
<div id="setup_body">
    <?php echo lang('setup_desc'); ?>
    <?php echo lang('setup_dialogue_fields_required'); ?>
    <?php echo form_open('setup'); ?>
    <fieldset>
        <legend><?php echo lang('setup_dialogue_legend_system'); ?></legend>
        <ol>
            <li>
                <?php echo form_label(lang('setup_dialogue_name')); ?>
                <?php echo form_input('site_name', set_value('site_name')); ?>
            </li>
        </ol>
    </fieldset>
    <fieldset>
        <legend><?php echo lang('setup_dialogue_legend_admin'); ?></legend>
        <ol>
            <li>
                <?php echo form_label(lang('setup_dialogue_username')); ?>
                <?php echo form_input('username', set_value('username')); ?>
            </li>
            <li>
                <?php echo form_label(lang('setup_dialogue_password')); ?>
                <?php echo form_password('password', set_value('password')); ?>
            </li>
            <li>
                <?php echo form_label(lang('setup_dialogue_email')); ?>
                <?php echo form_input('email', set_value('email')); ?>
            </li>
        </ol>

        <input type="submit" value="<?php echo lang('setup_button_next'); ?>" class="form_submit" />
    </fieldset>
    <?php echo form_close(); ?>
</div>