<?php echo $this->Form->create('User')?>
<?php echo $this->Form->input('username')?>
<?php echo $this->Form->input('password')?>
<?php echo $this->Form->input('role', array('options' => array('admin' => 'Admin', 'business' => 'Store Owner'))); ?>
<?php echo $this->Form->end('Register')?>
