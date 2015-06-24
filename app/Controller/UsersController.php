<?php

// app/Controller/UsersController.php
class UsersController extends AppController {

    public $uses = array('Post','Category','Afterlook','User','Picture'); 

    public function beforeFilter() {
        parent::beforeFilter();                         // 
    // ユーザー自身による登録とログインを許可する
        $this->Auth->allow('register','login','categories','index','acount','user_image','view');


        // ここからサイドビューを表示する
        $user = $this->Post->query("SELECT * FROM 
                                            (SELECT * FROM `posts` 
                                                GROUP BY `posts`.`created` 
                                                DESC LIMIT 0,5) 
                                        AS `latest` 
                                        RIGHT JOIN `users` 
                                        ON `latest`.`user_id`=`users`.`id` 
                                        limit 0,5;");

        $this->set('latest5post', $user ) ;        
             
        $populars = $this->Post->query( "SELECT * FROM 
                                            (SELECT * FROM 
                                                ( SELECT COUNT(*) 
                                                    AS 'cnt', `histories`.`post_id` 
                                                    FROM `histories` 
                                                    GROUP BY `histories`.`post_id` 
                                                    ORDER BY 'cnt' 
                                                    DESC LIMIT 0,5) 
                                                AS `populars` 
                                                RIGHT JOIN `posts` 
                                                ON `populars`.`post_id` = `posts`.`id` 
                                                limit 0,5) 
                                            AS `writer` 
                                            LEFT JOIN `users` 
                                            ON `users`.`id`=`writer`.`user_id` 
                                            LIMIT 0,5;" 
                                        );        

        $this->set('populars', $populars);


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

            if ($this->request->is('post') || $this->request->is('put')) {
                    
                //debug($userName);

                if ( $this->User->save(array('User' => array('id' => $this->Auth->user('id'),
                                                     'name' => $this->request->data['User']['new_name'] ) ),
                                            false,
                                            array('name')
                                        )
                ) {
                     $this->Session->setFlash(__('名前の再設定が完了しました'));
                     $this->redirect(array('Controller' => 'Users','action' => 'acount'));
                } else {
                     $this->Session->setFlash(__('保存に失敗しました。再度入力しなおして下さい'));
                }
            } else {
            //     //$this->request->data = $this->User->read(null, $id);
            //     //unset($this->request->data['User']['password']);
            }
     
    }

    public function user_password() {            
                
                if ($this->request->is('post') || $this->request->is('put')) {

                    if (isset($this->request->data['User']['new_password_1']) && !empty($this->request->data['User']['new_password_1'])) {
                       
                        if ($this->request->data['User']['new_password_1'] == $this->request->data['User']['new_password_2']){

                            $new_password = $this->request->data['User']['new_password_1'] ;

                            //debug( $this->User->findById('password') );
                            //debug($userPassword);
                            //debug($this->request->data['User']['old_password']);

                            // 実行前に現在のパスワードを要求する 
                            //if ( $userPassword == $passwordHasher->hash($this->request->data['User']['old_password']) ) {

                                if ( $this->User->save(array('User' => array('id' => $this->Auth->user('id'),
                                                                     'password' => $new_password ) ),
                                                            false,
                                                            array('password')
                                                        )
                                ) {
                                     $this->Session->setFlash(__('パスワードの再設定が完了しました'));
                                     $this->redirect(array('Controller' => 'Users','action' => 'acount'));
                                } else {
                                     $this->Session->setFlash(__('保存に失敗しました。再度入力しなおして下さい'));
                                }

                            //} else {
                                $this->Session->setFlash(__('現在のパスワードが正しくありません。もう一度入力してください'));
                            //}
                        } else {
                           $this->Session->setFlash(__('2つのメールアドレスが一致しません'));         // アラートを表示する
                        }
                    } else {
                        $this->Session->setFlash(__('パスワードを入力してください'));                        
                    }
                        

                } else {
                //     //$this->request->data = $this->User->read(null, $id);
                //     //unset($this->request->data['User']['password']);
                }

                       
    }


    public function user_email($id = null) {
        //debug($this->Auth->user());         
        // if (!$this->User->exists()) {
        //     throw new NotFoundException(__('Invalid user'));
        // }
         if ($this->request->is('post') || $this->request->is('put')) {   

            if ($this->request->data['User']['new_email_1'] == $this->request->data['User']['new_email_2']){

                $new_email = $this->request->data['User']['new_email_1'] ;

            //debug( $this->User->findById('email') );

            // if (!($this->User->findById($email))) {
            //     throw new NotFoundException(__('サーバー上にあなたの情報が存在しません'));
            // }
            //debug($this->request->data)

            
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
           $this->Session->setFlash(__('2つのメールアドレスが一致しません'));         // アラートを表示する
            }

        } else {
        //     //$this->request->data = $this->User->read(null, $id);
        //     //unset($this->request->data['User']['password']);
        }
        

    }

    public function user_image() {

        debug($this->Auth->user('id'));

        if ($this->request->is('post') || $this->request->is('put')) {
                if ( $this->User->save(array('User' => array('id' => $this->Auth->user('id'),
                                                     'image' => $changed_image ) ),
                                            false,
                                            array('image')
                                        )
                ) {
                     $this->Session->setFlash(__('プロフィール写真が変更されました'));
                     $this->redirect(array('Controller' => 'Users','action' => 'acount'));
                } else {
                     $this->Session->setFlash(__('変更に失敗しました。再度試してみてください'));
                }
            } else {
            //     //$this->request->data = $this->User->read(null, $id);
            //     //unset($this->request->data['User']['password']);
            }

    }

    public function user_start_date() {

            if ($this->request->is('post') || $this->request->is('put')) {

                 if (!($this->request->data['User']['year']['year'])) {
                    $this->Session->setFlash(__('年が選択されていません'));
                } else if(!($this->request->data['User']['month']['month'])) {
                    $this->Session->setFlash(__('月が選択されていません'));
                } else if(!($this->request->data['User']['day']['day'])) {
                    $this->Session->setFlash(__('日が選択されていません'));
                } else{

                    
                    $new_start_date = $this->request->data['User']['year']['year'].
                                        '-'.$this->request->data['User']['month']['month'].         
                                        '-'.$this->request->data['User']['day']['day'];

                    if ($this->request->is('post') || $this->request->is('put')) {
                        if ( $this->User->save(array('User' => array('id' => $this->Auth->user('id'),
                                                             'start_date' => $new_start_date ) ),
                                                    false,
                                                    array('start_date')
                                                )
                        ) {
                             $this->Session->setFlash(__('再設定が完了しました'));
                             $this->redirect(array('Controller' => 'Users','action' => 'acount'));
                        } else {
                             $this->Session->setFlash(__('保存に失敗しました。再度入力しなおして下さい'));
                        }
                    } else {    break;
                    //     //$this->request->data = $this->User->read(null, $id);
                    //     //unset($this->request->data['User']['password']);
                    }                    
                }

            } else {    }

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

    // アカウントの削除処理
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

    // ログイン処理
    public function login() {

       if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect(array('controller' => 'Posts', 'action' => 'index')));
            } else {
                $this->Session->setFlash(__('メールアドレスとパスワードが一致しません。再度試して下さい。'));
            }
        }
    }

    // ログアウト処理
    public function logout() {
        $this->Auth->logout();
        
        $this->redirect(array('controller' => 'Posts', 'action' => 'index'));
    }







}

?>