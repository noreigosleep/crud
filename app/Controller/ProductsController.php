<?php
/**
 * Created by PhpStorm.
 * User: khanhle
 * Date: 11/29/16
 * Time: 10:49 AM
 */
class ProductsController extends AppController {
    public function index() {
        $user = $this->Auth->user();
        $products = $this->Product->find('all', array('conditions' => array('Category.user_id' => $user['id'])));
        $this->set('products', $products);
    }
    public function view($id = null){
        if(!$id)
            throw new NotFoundException(__('Invalid Product.'));
        $product = $this->Product->findById($id);
        if(!$product)
            throw new NotFoundException(__('Invalid Product.'));
        $this->set('product', $product);
    }
    public function delete($id = null) {
        if($this->request->is('get'))
            throw new MethodNotAllowedException();
        if($this->Product->delete($id)){
            $this->Flash->success(__('Deleted product.'));
        } else {
            $this->Flash->error(__('Cound\'t delete product.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    public function add() {
        if($this->request->is('post')) {
            if($this->Product->save($this->request->data)) {
                $this->Flash->success(__('Saved Product!'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $categories = $this->Product->Category->find('list', array('conditions' => array('user_id' => $this->Auth->user('id'))));
        $this->set(compact('categories'));
    }
    public function edit($id = null) {
        if(!$id)
            throw new NotFoundException(__('Invalid Product'));
        $product = $this->Product->findById($id);
        if(!$product)
            throw new NotFoundException(__('Invalid Product'));
        if($this->request->is(array('post', 'put'))) {
            $this->Product->id = $id;
            if($this->Product->save($this->request->data)){
                $this->Flash->success(__('Your product has been saved!'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your product.'));
        }
        $categories = $this->Product->Category->find('list', array('conditions' => array('user_id' => $this->Auth->user('id'))));
        $this->set(compact('categories'));
        if(!$this->request->data) {
            $this->request->data = $product;
        }
    }
    public function isAuthorized($user){
        if(in_array($this->action, array('view', 'index', 'add')))
            return true;
        if(in_array($this->action, array('delete', 'edit'))){
            $productId = (int) $this->request->params['pass'][0];
            if($this->Product->isOwnedBy($productId, $user['id']))
                return true;
        }
        return parent::isAuthorized($user);
    }
}