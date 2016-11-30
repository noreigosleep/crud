<ul>
    <li><?php echo $this->Html->link('Add Category', array('action' => 'add'))?></li>
</ul>
<table>
    <?php
    foreach($categories as $category) {
        ?>
        <tr>
            <td><?php echo $category['Category']['name'] ?></td>
            <td><?php echo $this->Html->link('List Products', array('action' => 'list_products', $category['Category']['id'])); ?></td>
            <td><?php echo $this->Html->link('Edit', array('action' => 'edit', $category['Category']['id'])) ?></td>
            <td><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $category['Category']['id']), array('confirm' => 'Delete category will delete all products within the category. Are you sure?')); ?></td>
        </tr>
        <?php
    }
    ?>
</table>