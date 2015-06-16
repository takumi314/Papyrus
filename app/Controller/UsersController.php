<?php

// app/Controller/UsersController.php
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();                         // 
    // ユーザー自身による登録とログインを許可する
        $this->Auth->allow('register', 'login','categories','index','');
    }


    public function index() {
        $this->User->recursive = 0;                     // [ ->recursive ]
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();

            //$this->request->data['User']['year'];

            //$this->request->data['User']['month'];
            
            // Viewのフォームタグから送られてきたPOSTデータ（連想配列）、['User']['year']と['User']['month']を１つのカラムデータ['User']['start_date']として合体する。
            $this->request->data['User']['start_date'] = $this->request->data['User']['year'].'-'.$this->request->data['User']['month'].'-01';

            if ($this->User->save($this->request->data)) {                  
                $this->Session->setFlash(__('登録が完了しました。'));
                $this->redirect(array('action' => 'check'));
            } else {
                $this->Session->setFlash(__('登録に失敗しました。もう一度試して下さい。'));
            }
        }
    }


    public function check(){
    }


    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }


 

    public function login() {
       if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }

    public function logout() {
        $this->Auth->logout();
        $this->redirect('/users/index');
    }







}

?>