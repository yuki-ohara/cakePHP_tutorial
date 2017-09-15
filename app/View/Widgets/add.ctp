<!-- app/View/Widgets/add.ctp -->

<div class="widgets form">
<?php echo $this->Form->create('Widget'); ?>
    <fieldset>
        <legend><?php echo __('Add Widget'); ?></legend>
        <?php echo $this->Form->input('name'); ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>
