<?php if($this->input->get('from') != false){$from='?from='.$this->input->get('from');}else{$from='';} ?>
<div class="form_errors">
<?php echo validation_errors(); ?>
</div>
<?php echo form_open('login'.$from); ?>
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
    <input type="submit" value="<?php echo lang("button_login"); ?>" class="form_submit" />
</fieldset>
<?php echo form_close(); ?>