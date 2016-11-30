<?php
    class Product extends AppModel {
        public $belongsTo = 'Category';
        public function isOwnedBy( $product, $user) {
            return $this->find('count', array('conditions' => array('Category.user_id' => $user, 'Product.id' => $product))) ? true : false;
        }
    }
?>