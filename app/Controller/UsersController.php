<?php

// app/Controller/UsersController.php
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();                         // 
    // ユーザー自身による登録とログインを許可する
        $this->Auth->allow('register','login','categories','index','user_email','acount','user_start_date','user_password','user_image','user_name');
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
            //debug($this->request->data);

            if ($this->User->save($this->request->data)) {                  
                $this->Session->setFlash(__('登録が完了しました。'));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('登録に失敗しました。もう一度試して下さい。'));
            }
        }

    }


    public function acount(){
        // $this->User->id = $id;
        // $this->set('user', $this->User->find($this->Session->read('id')));
    }

    public function user_name() {

    }

    public function user_password() {

        // debug($this->request->is('post'));
        // debug($this->request->query['new_password_1']);
        // debug($this->request->query['new_password_2']);

    }

    public function user_email($id = null) {
        debug($this->Auth->user());         
        // if (!$this->User->exists()) {
        //     throw new NotFoundException(__('Invalid user'));
        // }

        if ($this->request->data['User']['new_email_1'] == $this->request->data['User']['new_email_2']){

                $new_email = $this->request->data['User']['new_email_1'] ;

            debug( $this->User->findById('email') );

            // if (!($this->User->findById($email))) {
            //     throw new NotFoundException(__('サーバー上にあなたの情報が存在しません'));
            // }

            //debug($this->request->data)

            if ($this->request->is('post') || $this->request->is('put')) {
                if ( $this->User->save(array('User' => array('id' => $this->Auth->user('id'),
                                                     'email' => $new_email ) ),
                                            false,
                                            array('email')
                                        )
                ) {
                     $this->Session->setFlash(__('メールアドレスの再設定が完了しました'));
                     $this->redirect(array('Controller' => 'Users','action' => 'acount'));
                } else {
                     $this->Session->setFlash(__('保存に失敗しました。再度入力しなおして下さい'));
                }
            } else {
            //     //$this->request->data = $this->User->read(null, $id);
            //     //unset($this->request->data['User']['password']);
            }

        } else {
           $this->Session->setFlash(__('2つのメールアドレスが一致しません'));         // アラートを表示する
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
                $this->Session->setFlash(__('再設定が完了しました'));
                $this->redirect(array('Controller' => 'Users','action' => 'acount'));
            } else {
                $this->Session->setFlash(__('保存に失敗しました。再度入力しなおして下さい'));
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