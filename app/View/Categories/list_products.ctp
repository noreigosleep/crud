<h1><?=$category['Category']['name']?></h1>
<table>
<?php
    if(!$category['Product']) echo "No product found!";
    foreach($category['Product'] as $product) {
?>
        <tr>
            <td><?=$product['name']?></td>
            <td><?=$product['price']?></td>
            <td><?=$product['description']?></td>
            <td><?php echo $this->Html->link('View Product', array('controller' => 'products', 'action' => 'view', $product['id'])); ?></td>
        </tr>
<?php
    }
?></table>
