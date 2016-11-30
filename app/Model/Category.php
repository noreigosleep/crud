<?php
    class Category extends AppModel{
        public $hasMany = array(
            'Product' => array('dependent'=> true)
        );

        public $validate = array(
            'name' => array(
                'require' => true,
                'rule' => array('minLength', 3),
                'message' => 'Minimum 3 characters long'
            )
        );

        public function isOwnedBy($category, $user) {
            return $this->field('id', array('id' => $category, 'user_id' => $user)) !== false;
        }
    }