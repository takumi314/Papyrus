<?php

// app/Controller/FavoritesController.php
class FavoritesController extends AppController {


    public $helpers = array('Html', 'Form', 'Session','Time');
    //public $components = array('Session','Search.Prg');     //Prgコンポーネントを読み込む。
    public $uses = array('Favorite','Post','User','History');        // PostモデルとUserモデル　　　を指定する。
    //public $presetVars = true;                      // Prgコンポーネントのメソッドで利用される変数の事前設定


    public function beforeFilter() {
        parent::beforeFilter();                         // 
    // ユーザー自身による登録とログインを許可する
        $this->Auth->allow('register','login','logout','delete','add');

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
        // ユーザーIDを渡す
        $id = $this->Auth->user('id');

        //フィールドが存在するかどうかを確認する
        // if (!$this->Favorite->exists()) {
        //     throw new NotFoundException(__('現在「お気に入り」はございません'));
        // }
        //debug($id);
        $sql = 'SELECT `myFposts`.`id`,`myFposts`.`post_id`, `myFposts`.`checked`,`myFposts`.`title`,`myFposts`.`user_id`,`users`.`name`, `users`.`image`,`myFposts`.`body`,`myFposts`.`created`, `myFposts`.`posted` 
                FROM (SELECT `myFavorites`.`id`,`myFavorites`.`post_id`, `myFavorites`.`checked`,`posts`.`title`,`posts`.`user_id`, `posts`.`body`,`posts`.`created`, `posts`.`posted` 
                        FROM (SELECT * FROM `favorites` 
                                where user_id = '.$id.' ) 
                        AS `myFavorites` 
                        LEFT JOIN `posts` 
                        ON `myFavorites`.`post_id` = `posts`.`id`) 
                AS `myFposts` 
                LEFT JOIN `users` 
                ON `myFposts`.`user_id` = `users`.`id`;';
        //debug($this->Favorite->query($sql));
        $this->set('favorites', $this->Favorite->query($sql));
        
    }



    public function add() {
        
        if ($this->request->is('post')) {
            // モデルを初期化する
            $this->Favorite->create();

            // お気に入りを押したユーザーIDを取得する
            if (is_null($this->Auth->user('id'))) {
                $this->request->data['Favorite']['user_id'] = 35;
            }else {
                $this->request->data['Favorite']['user_id'] = $this->Auth->user('id');
            }
            
            // お気に入りを押した日時を取得する
            $this->request->data['Favorite']['checked'] = date('Y-m-d-G-i-s');
            //debug($this->request->data);

            if ($this->Favorite->save($this->request->data)) {                  
                $this->Session->setFlash(__('「お気に入り」リストに追加されました'));
                $this->redirect($this->referer());
                //$this->redirect(array('Controller'=>'posts','action' => 'view'));
            } else {
                $this->Session->setFlash(__('「追加に失敗しましt。お手数ですが、もう一度試してみて下さい。'));
            }
        }
    }


    public function delete($favorite_id = null,$favorite_title) {

        $this->request->onlyAllow('post');
        //debug($favorite_id);
        
        $this->Favorite->id = $favorite_id;

        if (!$this->Favorite->exists()) {
            throw new NotFoundException(__('「'.$favorite_title.'」はリストにございません。'));
        }

        debug($this->Favorite->id);
        if ($this->Favorite->delete()) {
            $this->Session->setFlash(__('「'.$favorite_title.'」はリストから削除されました'));
            $this->redirect($this->referer());
        }else {

            $this->Session->setFlash(__('「'.$favorite_title.'」は削除されませんでした'));
            $this->redirect($this->referer());
        }

    }

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

    
    public function isAuthorized($user) {
       // 登録済ユーザーは変更できる
        if ($this->action === 'view') {
            return true;
        }


            return parent::isAuthorized($user);
    
    }


}

?>