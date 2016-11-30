<?php
    class UsersController extends AppController {
        public function beforeFilter(){
            parent::beforeFilter();
            $this->Auth->allow(array('register', 'logout'));
        }
        public function isAuthorize($user){
            if($user['role']) {

            }
        }
        public function register() {
            if($this->request->is('post')) {
                if($this->User->save($this->request->data)) {
                    $this->Flash->success(__('Registered successfully!'));
                    if($this->Auth->login())
                        return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('Registered failed!'));
            }
        }

        public function login() {
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }

        public function logout() {
            return $this->redirect($this->Auth->logout());
        }
    }