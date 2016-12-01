<?php
    App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
    class User extends  AppModel {
        public $validate = array(
            'username' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'A username is required'
                )
            ),
            'password' => array(
                'required' => array(
                    'rule'      => array('between', 8, 40),
                    'message' => 'Your password must be between 8 and 40 characters'
                )
            ),
            'role' => array(
                'valid' => array(
                    'rule' => array('inList', array('admin', 'business')),
                    'message' => 'Please enter a valid role',
                    'allowEmpty' => false
                )
            )
        );
        public function beforeSave($option = array()){
            if (isset($this->data[$this->alias]['password'])) {
                $passwordHasher = new BlowfishPasswordHasher();
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
            return true;
        }
    }