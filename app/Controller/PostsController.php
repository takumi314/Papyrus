<?php
class PostsController extends AppController {
    
    public $helpers = array('Html', 'Form', 'Session','Time');
    public $components = array('Session','Search.Prg');     //Prgコンポーネントを読み込む。
    public $uses = array('Post','Category','Afterlook','User','Picture','Comment');        // POSTモデルとCategoryモデルを指定する。
    public $presetVars = true;                      // Prgコンポーネントのメソッドで利用される変数の事前設定


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
		// set(); 'posts'という名前でViewにとばす処理を行う。
        $this->set('posts', $this->Post->find('all'));

    }
    

    public function view($id = null) {

        // コメントの表示
//        $id = $post[][]
        $sql = "SELECT * FROM (SELECT * FROM `comments`) AS `comment_user` LEFT JOIN `users` ON `comment_user`.`user_id`=`users`.`id` where post_id =".$id;
//        $all_comments = $this->Comment->query($sql) ;
        $this->set('comments',$this->Comment->query($sql));
        

       // debug($all_comments['']);


        //$this->set('comments',$this->Comment->find('all'));

        if (!$id) {
            throw new NotFoundException(__('Invalid post'));   // 実在するレコードにアクセスすることを保証するために少しだけエラーチェックを行います。
        }

        $post = $this->Post->findById($id);                    // ひとつの投稿記事の情報しか必要としないため、findById()を使用している。
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));   // 実在するレコードにアクセスすることを保証するために少しだけエラーチェックを行います。
        }
        $this->set('post', $post);

    }


    // app/Controller/PostsController.php
    public function add() {

        $this->set('categories_list', $this->Category->find('all'));

        if ($this->request->is('post')) {       // リクエストが HTTP or POST かどうかの確認にCakeRequest::is()メソッドを使用している。
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');      // ユーザーidを代入する
            $this->request->data['Post']['view_count'] = 0;                         // 観覧履歴は０に設定にセット

            //var_dump($this->Category->find['list']);
            //debug($this->request->data);
            //$this->set('categories_list',$this->Category->find['list']);
            if ($this->request->data['submitBtn'] == 'post') {
                $this->request->data['Post']['status'] = 2;  
            } else {
                $this->request->data['Post']['status'] = 1;  
            } 

            //debug($this->request->data);
            //var_dump($this->request->data);

            if ($this->Post->save($this->request->data)) {                  
                // ユーザがフォームを使ってデータをPOSTした場合、その情報は、$this->request->data の中に入る。 
                $this->Session->setFlash(__('投稿が完了しました'));
                //  Session->setFlash() メソッドを使ってセッション変数にメッセージをセットすることによって、リダイレクト後のページでこれを表示します。
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('投稿に失敗しました'));
            }
        }

    }



    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

    $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;

            if ($this->Post->save($this->request->data)) {                      // 
    	       //var_dump($this->request->data);
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
            
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }


    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();          // 
        }

        if ($this->Post->delete($id)) {
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



    public function category_index($category_id = null) {
        // set(); 'posts'という名前でViewにとばす処理を行う。
        $posts = $this->Post->find('all', array('conditions' => array('category_id' => $category_id, 
                                                                        'picture_id' => $picture_id,
                                                                        'category_id' => $user_id )
                                               )
                                    );        

        $categories = $this->Category->find('first', array('conditions' => array('id' => $category_id)));
        $pictures = $this->Picture->find('first', array('conditions' => array('id' => $picture_id)));
        $users = $this->User->find('first', array('conditions' => array('id' => $user_id)));    

    //$categories = $this->Category->findById($category_id);    // どちらでもOK!!

        $this->set(compact('posts','categories','user','pictures'));       // 上記の$postとcompact('posts')が関連付けされる。

    }

    public function picture_index($picgture_id = null) {
        // set(); 'posts'という名前でViewにとばす処理を行う。
        $posts = $this->Post->find('all', array('conditions' => array('picture_id' => $picture_id)));        
        $pictures = $this->Picture->find('first', array('conditions' => array('id' => $picture_id)));
      //$Pictures = $this->Picture->findById($picture_id);    // どちらでもOK!!

        $this->set(compact('posts','pictures'));       // 上記の$postとcompact('posts')が関連付けされる。

    }

    public function user_index($user_id = null) {
        // set(); 'posts'という名前でViewにとばす処理を行う。
        $posts = $this->Post->find('all', array('conditions' => array('user_id' => $user_id)));        
        $users = $this->User->find('first', array('conditions' => array('id' => $user_id)));
      //$Pictures = $this->Picture->findById($picture_id);    // どちらでもOK!!

        $this->set(compact('posts','users'));       // 上記の$postとcompact('posts')が関連付けされる。

    }




    public function isAuthorized($user) {
       // 登録済ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }

        // 投稿のオーナーは編集や削除ができる
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

            return parent::isAuthorized($user);
    
    }
    




    //検索結果
    public function result() {
    // 検索条件設定  
    $this->Prg->commonProcess();
        
        if (isset($this->passedArgs['search_word'])) {
        //条件を生成
            $conditions = $this->Post->parseCriteria($this->passedArgs);        // 

            $this->paginate = array(  
                'conditions' => $conditions,  
                'limit' => 20,
                'order' => array(
                'id' => 'desc'
                )

            //posts

            );
            $this->set(compact('data', $this->paginate('Post')));
        }
    }



}

?>
