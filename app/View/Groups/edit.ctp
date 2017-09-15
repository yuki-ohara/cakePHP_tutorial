<!-- File: /app/View/Group/edit.ctp -->

<div class="groups edit form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
        <legend><?php echo __('Edit Group'); ?></legend>
		<?php echo $this->Form->input('name'); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>

