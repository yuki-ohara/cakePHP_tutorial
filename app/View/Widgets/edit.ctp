<!-- File: /app/View/Widgets/edit.ctp -->

<div class="widgets edit form">
<?php echo $this->Form->create('Widget'); ?>
	<fieldset>
        <legend><?php echo __('Edit Widget'); ?></legend>
		<?php echo $this->Form->input('name'); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>

