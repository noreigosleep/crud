<?php echo $this->Form->create('Product')?>
<?php echo $this->Form->input('name'); ?>
<?php echo $this->Form->input('price'); ?>
<?php echo $this->Form->input('description'); ?>
<?php echo $this->Form->input('category_id', array('type' => 'select'));
