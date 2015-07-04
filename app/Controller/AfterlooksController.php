<?php

// app/Controller/FavoritesController.php
class AfterlooksController extends AppController {


    public $helpers = array('Html', 'Form', 'Session','Time');
    //public $components = array('Session','Search.Prg');     //Prgコンポーネントを読み込む。
    public $uses = array('Afterlook','Post','User','History','Category');        // PostモデルとUserモデル　　　を指定する。
    //public $presetVars = true;                      // Prgコンポーネントのメソッドで利用される変数の事前設定


    public function beforeFilter() {
        parent::beforeFilter();                         // 
    // ユーザー自身による登録とログインを許可する
        $this->Auth->allow('register','login','acount','add');

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
                                                (SELECT COUNT(*) 
                                                    AS 'cnt', `histories`.`post_id` 
                                                    FROM `histories` 
                                                    GROUP BY `histories`.`post_id` 
                                                    ORDER BY `cnt` 
                                                    DESC LIMIT 0 , 10) 
                                            AS `populars` 
                                            RIGHT JOIN `posts` 
                                            ON `populars`.`post_id` = `posts`.`id` 
                                            limit 0,10) 
                                        AS `writer` 
                                        LEFT JOIN `users` 
                                        ON `users`.`id`=`writer`.`user_id` 
                                        LIMIT 0,5;");        

        $this->set('populars', $populars);


    }



   
    // public function favorite() {
    //     $this->User->recursive = 0;                     // [ ->recursive ]
    //     $this->set('users', $this->paginate());
    // }

    public function view($id = null) {
        $this->Afterlook->id = $id;
        if (!$this->Afterlook->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->Afterlook->read(null, $id));
    }


    public function add() {
        
        if ($this->request->is('post')) {
            // モデルを初期化する
            $this->Afterlook->create();
            // 「後で見る」を押したユーザーIDを取得する
            if (is_null($this->Auth->user('id'))) {
                $this->request->data['Afterlook']['user_id'] = 35;
            }else {
                $this->request->data['Afterlook']['user_id'] = $this->Auth->user('id');
            }

            // 「後で見る」を押した日時を取得する
            $this->request->data['Afterlook']['checked'] = date('Y-m-d-G-i-s');
            //debug($this->request->data);

            if ($this->Afterlook->save($this->request->data)) {                  
                $this->Session->setFlash(__('「後で見る」リストに追加されました'));
                $this->redirect($this->referer());
                //$this->redirect(array('Controller'=>'categories','action' => 'view',$this->request->data['Afterlook']['post_id']));
            } else {
                $this->Session->setFlash(__('「追加に失敗しましt。お手数ですが、もう一度試してみて下さい。'));
            }
        }
    }


    // public function delete($id = null) {
    //     $this->request->onlyAllow('post');

    //     $this->User->id = $id;
    //     if (!$this->User->exists()) {
    //         throw new NotFoundException(__('Invalid user'));
    //     }
    //     if ($this->User->delete()) {
    //         $this->Session->setFlash(__('User deleted'));
    //         $this->redirect(array('action' => 'index'));
    //     }
    //     $this->Session->setFlash(__('User was not deleted'));
    //     $this->redirect(array('action' => 'index'));
    // }

//    public function edit($id = null) {
//        $this->User->id = $id;
//        if (!$this->User->exists()) {
//            throw new NotFoundException(__('Invalid user'));
//        }
//        if ($this->request->is('post') || $this->request->is('put')) {
//            if ($this->User->save($this->request->data)) {
//                $this->Session->setFlash(__('The user has been saved'));
//                $this->redirect(array('action' => 'index'));
//            } else {
//                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
//            }
//        } else {
//            $this->request->data = $this->User->read(null, $id);
//            unset($this->request->data['User']['password']);
//        }
//    }

    


}

?>