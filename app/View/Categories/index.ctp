<ul>
    <li><?php echo $this->Html->link('Add Category', array('action' => 'add'))?></li>
</ul>
<table>
    <?php
    foreach($categories as $category) {
        ?>
        <tr>
            <td><?php echo $this->Html->link($category['Category']['name'], array('action' => 'view', $category['Category']['id']))?></td>
            <td><?php echo $this->Html->link('List Products', array('action' => 'list_products', $category['Category']['id'])); ?></td>
            <td><?php echo $this->Html->link('Edit', array('action' => 'edit', $category['Category']['id'])) ?></td>
            <td><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $category['Category']['id']), array('confirm' => 'Are you sure?')); ?></td>
        </tr>
        <?php
    }
    ?>
</table>