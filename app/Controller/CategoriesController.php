<?php

// ./app/Controller/CategoriesController.php
class CategoriesController extends AppController {

    public $helpers = array('Html', 'Form','Session','Text');            // helpersプロパティ
    public $uses = array('Post','Category','User','Picture','History'); 
    public $components = array('Session');                        // componentsプロパティ

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



	public function index() {                                     // indexアクションを呼び出す。
		// set(); 'categories'という名前でViewにとばす処理を行う。
        // $this->set('categories', $this->Category->find('all'));   // １番目の'cagtegories'は「View」内での変数名に、２番目の部分は実際のデータのデータとなる。
        //                                                           // モデルクラスが 'category' なので、アクション内の$this->Category->find('all') という記述によってモデルにアクセスする。

        // // ここからサイドビューの処理を行う。        
        // $user = $this->Post->query("SELECT * FROM 
        //                                     (SELECT * FROM `posts` 
        //                                         GROUP BY `posts`.`created` 
        //                                         DESC LIMIT 0,5) 
        //                                 AS `latest` 
        //                                 RIGHT JOIN `users` 
        //                                 ON `latest`.`user_id`=`users`.`id` 
        //                                 limit 0,5;");

        // $this->set('latest5post', $user ) ;        
                   
        // $populars = $this->Post->query( "SELECT * FROM 
        //                                     (SELECT * FROM 
        //                                         ( SELECT COUNT(*) 
        //                                             AS 'cnt', `histories`.`post_id` 
        //                                             FROM `histories` 
        //                                             GROUP BY `histories`.`post_id` 
        //                                             ORDER BY 'cnt' 
        //                                             DESC LIMIT 0,5) 
        //                                         AS `populars` 
        //                                         RIGHT JOIN `posts` 
        //                                         ON `populars`.`post_id` = `posts`.`id` 
        //                                         limit 0,5) 
        //                                     AS `writer` 
        //                                     LEFT JOIN `users` 
        //                                     ON `users`.`id`=`writer`.`user_id` 
        //                                     LIMIT 0,5;" 
        //                                 );        
        // //debug($populars);
        // $this->set('populars', $populars);

    }                                                             


     public function view($id = null) {
        
        //debug($this->Category->find('all','conditions' => array( 'Categories.id' => $id )));

        $this->set('category', $this->Category->find('first'));

        $sql_category = 'SELECT * FROM `posts` LEFT JOIN `categories` ON `posts`.`category_id` = `categories`.`id` where category_id ='.$id.';';
        //SELECT * FROM `posts` LEFT JOIN `categories` ON `posts`.`category_id` = `categories`.`id` where category_id = 4
        //$this->Category->query($sql_category);

        //debug($this->Category->query($sql_category));

        $this->set('category_post', $this->Category->query($sql_category));


        $sel_auther = '  ';







        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }

        $category = $this->Category->findById($id);
        if (!$category) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->set('category', $category);

    }



    //カテゴリーの追加を実行する処理を担う
    public function add() {
        if ($this->request->is('post')) {                           // CakeRequestクラスの機能へアクセスするための入り口、idメソットでpost送信を用いる。
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your Category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your Category.'));
        }
    }


    public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid category'));
    }

    $category = $this->Category->findById($id);                     // ModelのCategoryクラスから$idを呼び出して、$categoryに代入する。
    if (!$category) {
        throw new NotFoundException(__('Invalid category'));
    }

    if ($this->request->is(array('category', 'put'))) {
        $this->Category->id = $id;
        if ($this->Category->save($this->request->data)) {
    //var_dump($this->request->data);
            $this->Session->setFlash(__('Your category has been updated.'));
       
        }
        $this->Session->setFlash(__('Unable to update your category.'));
    }

        if (!$this->request->data) {
            $this->request->data = $category;
        }

    }




    public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();          // 
    }

    if ($this->Category->delete($id)) {
        $this->Session->setFlash(
            __('The post with id: %s has been deleted.', h($id))
        );
    } else {
        $this->Session->setFlash(
            __('The post with id: %s could not be deleted.', h($id))
        );
    }

    return $this->redirect(array('action' => 'index'));
}











}


?>
