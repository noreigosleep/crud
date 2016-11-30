<?php
/**
 * Created by PhpStorm.
 * User: khanhle
 * Date: 11/29/16
 * Time: 9:41 AM
 */
class CategoriesController extends  AppController {
    public function index() {
        $this->set('categories', $this->Category->find('all', array('conditions' => array('Category.user_id' => $this->Auth->user('id')))));
    }
    public function add() {
        if($this->request->is('post')){
            $this->request->data['Category']['user_id'] = $this->Auth->user('id');
            if($this->Category->save($this->request->data)){
                $this->Flash->success(__('Your category has been saved!'));
                return $this->redirect(array('action'=>'index'));
            }
        }
    }
    public function view($id = null) {
        if(!$id)
            throw new NotFoundException(__('Invalid Category'));
        $category = $this->Category->findById($id);
        if(!$category)
            throw new NotFoundException(__('Invalid Category'));
        $this->set('category', $category);
    }

    public function edit($id = null) {
        if(!$id)
            throw new NotFoundException(__('Invalid Category'));
        $category = $this->Category->findById($id);
        if(!$category)
            throw new NotFoundException(__('Invalid Category'));
        if($this->request->is(array('post', 'put'))) {
            $this->Category->id = $id;
            if($this->Category->save($this->request->data)){
                $this->Flash->success(__('Your category has been saved!'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your category.'));
        }
        if(!$this->request->data) {
            $this->request->data = $category;
        }
    }

    public function delete($id = null) {
        if($this->request->is('get'))
            throw new MethodNotAllowedException();
        if($this->Category->delete($id, true)){
            $this->Flash->success(__('The Category id : %s has been delete', h($id)));
        } else {
            $this->Flash->error(__('Coudn\'t delete the Category %s', h($id)));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function list_products($id = null) {
        if(!$id)
            throw new NotFoundException(__('Invalid Product.'));
        $category = $this->Category->findById($id);
        if(!$category)
            throw new NotFoundException(__('Invalid Product.'));
        $this->set('category', $category);
    }


    public function isAuthorized($user) {
        if( in_array($this->action, array('index', 'add', 'list_products'))) return true;
        if (in_array($this->action, array('edit', 'delete'))) {
            $categoryId = (int) $this->request->params['pass'][0];
            if ($this->Category->isOwnedBy($categoryId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
}