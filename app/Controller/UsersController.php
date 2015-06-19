<?php

// app/Controller/UsersController.php
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();                         // 
    // ユーザー自身による登録とログインを許可する
        $this->Auth->allow('register','login','categories','index','acount','user_email','user_start_date','user_password','user_image','user_name');
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

        debug($this->request->is('post'));
        if ($this->request->is('post')) {
            $this->User->create();

            // Viewのフォームタグから送られてきたPOSTデータ（連想配列）、['User']['year']と['User']['month']を１つのカラムデータ['User']['start_']として合体する。
            $this->request->data['User']['start_date'] = $this->request->data['User']['year']['year'].'-'.$this->request->data['User']['month']['month'].'-01';
            //$this->request->data['User']['created'] = '2015-06-17 00:00:00';
            //$this->request->data['User']['modified'] = '2015-06-17 00:00:00';

            debug($this->request->data);

            if ($this->User->save($this->request->data)) {                  
                $this->Session->setFlash(__('登録が完了しました。'));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('登録に失敗しました。もう一度試して下さい。'));
            }
        }

    }


    public function acount($id = null){
        // $this->User->id = $id;
        // $this->set('user', $this->User->find($this->Session->read('id')));
    }

    public function user_name() {

    }

    public function user_password() {

        debug($this->request->is('post'));
        debug($this->request->query['new_password_1']);
        debug($this->request->query['new_password_2']);

    }

    public function user_email($email=null) {
        $this->User->email = $email;         
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        //debug($this->request->is('get'));
        //debug($this->request->data['User']['new_email_1']);
        //debug($this->request->data['User']['new_email_2']);

        if ($this->request->data['User']['new_email_1'] == $this->request->data['User']['new_email_2']) {
            $this->request->data['User']['email'] = $this->request->data['User']['new_email_1'];

            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('保存に失敗しました。再度入力しなおして下さい'));
                }
            } else {
                //$this->request->data = $this->User->read(null, $id);
                //unset($this->request->data['User']['password']);
            }

        } else {
           $this->Session->setFlash(__('2つのメールアドレスが一致しません。もう一度入力しなおして下さい'));         // アラートを表示する
        }

    }


    public function user_image() {
    }

    public function user_start_date() {
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

        debug($this->Auth->login());

            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect(array('controller' => 'Posts', 'action' => 'index')));
            } else {
                $this->Session->setFlash(__('メールアドレスとパスワードが一致しません。再度試して下さい。'));
            }
        }
    }


    public function logout() {
        $this->Auth->logout();
        //$this->Session->destroy();
        $this->redirect(array('controller' => 'Posts', 'action' => 'index'));
    }







}

?>