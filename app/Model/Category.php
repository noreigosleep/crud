<?php
    class Category extends AppModel{
        public $hasMany = 'Product';
        public $validate = array(
            'name' => array(
                'require' => true,
                'rule' => array('minLength', 8),
                'message' => 'Minimum 8 characters long'
            )
        );

        public function isOwnedBy($category, $user) {
            return $this->field('id', array('id' => $category, 'user_id' => $user)) !== false;
        }
    }