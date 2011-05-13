<div class="form_errors">
<?php echo validation_errors(); ?>
</div>
<?php echo form_open('login'); ?>
<fieldset>
    <legend><?php echo lang("page_login"); ?></legend>
    <ol>
        <li>
            <?php echo form_label(lang("setup_dialogue_username")); ?>
            <?php echo form_input("username", set_value("username")); ?>
        </li>
        <li>
            <?php echo form_label(lang("setup_dialogue_password")); ?>
            <?php echo form_password("password", set_value("password")); ?>
        </li>
    </ol>
    <input type="submit" value="<?php echo lang("setup_button_next"); ?>" class="form_submit" />
</fieldset>
<?php echo form_close(); ?>