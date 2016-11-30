<?php
    class Product extends AppModel {
        public $validate = array(
            'name' => array(
                'require' => true,
                'rule' => array('minLength', '8'),
                'message' => "Minimum 8 characters long"
            ),
            'price' => array(
                'require' => true
            ),
            'category_id' => array(
                'require' => true,
                'rule' => 'notBlank'
            )
        );
        public $belongsTo = 'Category';
        public function isOwnedBy( $product, $user) {
            return $this->find('count', array('conditions' => array('Category.user_id' => $user, 'Product.id' => $product))) ? true : false;
        }
    }
?>