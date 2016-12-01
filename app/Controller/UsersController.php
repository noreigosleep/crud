<?php
    class UsersController extends AppController {
        public function beforeFilter(){
            parent::beforeFilter();
            $this->Auth->allow(array('register', 'logout'));
        }
        public function isAuthorize($user){
            if( in_array($this->action, array('index', 'add'))) return true;
            if (in_array($this->action, array('edit', 'delete'))) {
                $productId = (int) $this->request->params['pass'][0];
                if ($this->Product->isOwnedBy($productId, $user['id'])) {
                    return true;
                }
            }
            return parent::isAuthorized($user);

        }
        public function register() {
            if($this->request->is('post')) {
                $registerData = $this->request->data;
                $registerData['User']['role'] = "business";
                if($this->User->save($registerData)) {
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