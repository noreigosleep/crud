<?php echo $this->Form->create('Category'); ?>
<?php echo $this->Form->input('name'); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
<?php echo $this->Form->end('Save Category'); ?>
