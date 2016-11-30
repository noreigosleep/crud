<?php echo $this->Html->link('Add Product', array('action' => 'add')); ?>
<table>
    <?php foreach($products as $product) {
    ?>
        <tr><td><?=$product['Product']['name']?></td><td><?=$product['Product']['price']?></td><td><?=$product['Category']['name']?></td><td><?=$this->Html->link('Edit Product', array('action' => 'edit', $product['Product']['id']))?></td><td><?php echo $this->Form->postLink('Delete', array('action'=>'delete', $product['Product']['id']), array('confirm' => 'Are you sure?'))?></td></tr>
    <?php
    }?>
</table>