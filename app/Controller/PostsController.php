<?php
class PostsController extends AppController {
    
    public $helpers = array('Html', 'Form', 'Session','Time');
    public $components = array('Session','Search.Prg');     //Prgコンポーネントを読み込む。
    public $uses = array('Post','Category','Afterlook','User','Picture','Comment','History');        // POSTモデルとCategoryモデルを指定する。
    public $presetVars = true;                      // Prgコンポーネントのメソッドで利用される変数の事前設定


    public function beforeFilter() {
        parent::beforeFilter();                         // 
    // ユーザー自身による登録とログインを許可する
        $this->Auth->allow('register','login','index','view');


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



    public function index() {
		// set(); 'posts'という名前でViewにとばす処理を行う。
        $this->set('posts', $this->Post->find('all'));

    }
    

    public function view($id = null) {

        // 投稿記事へのコメントを表示
        $sql = "SELECT * FROM (SELECT * FROM `comments`) AS `comment_user` LEFT JOIN `users` ON `comment_user`.`user_id`=`users`.`id` where post_id =".$id;        
        $this->set('comments',$this->Comment->query($sql));
        
        // 各投稿記事の閲覧履歴を記録する。
        $userId = 35;        // ゲストのデフォルト値をID=35とする

        if (!is_null($this->Auth->user('id'))) {
            $userId = $this->Auth->user('id');
        }

        $save_array = array('post_id' => $id,
                            'user_id' => $userId
                            );
        $this->History->save($save_array);

        // 投稿写真を呼び出す
        //debug($id);
        $pc_sql = 'SELECT * FROM `pictures` where post_id = '.$id.';'; 
        $pictures = $this->Picture->query($pc_sql);

       
        // POSTのエラーチェック
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));   // 実在するレコードにアクセスすることを保証するために少しだけエラーチェックを行います。
        }

        $post = $this->Post->findById($id);                    // ひとつの投稿記事の情報しか必要としないため、findById()を使用している。
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));   // 実在するレコードにアクセスすることを保証するために少しだけエラーチェックを行います。
        }


        $this->set('post', $post);
        $this->set('pictures', $pictures);

    }


    // app/Controller/PostsController.php
    public function add() {

        $this->set('categories_list', $this->Category->find('all'));    // カテゴリーの一覧を表示させるために$this->set()を行う。

        // リクエストが HTTP or POST かどうかの確認にCakeRequest::is()メソッドを使用している。
        if ($this->request->is('post')) {       
            // ユーザーIDと観覧履歴を代入
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');      // ユーザーidを代入する
            $this->request->data['Post']['view_count'] = 0;                         // 観覧履歴は０に設定にセット

            // 下書き:1  公開:2
            if ($this->request->data['submitBtn'] == 'post') {
                $this->request->data['Post']['status'] = 2;  
            } else {
                $this->request->data['Post']['status'] = 1;  
            } 

            // photo1の画像を保存する
            if (!is_null($this->request->data['Post']['photo1'])) {
                // 画像の処理
                $img_1 = $this->request->data['Post']['photo1'];
                //debug($img_1);
                
                //イメージ保存先パス
                $img_save_path = IMAGES.DS.'post_picture' ;       //  papyrus/img/profile_img/イメージファイル名

                //イメージの保存処理
                move_uploaded_file($img_1['tmp_name'], $img_save_path.DS.$img_1['name']);
                // 画像メモリを解放
                //imagedestroy($img_1);
            }

            // photo2の画像を保存する
            if (!is_null($this->request->data['Post']['photo2'])) {
                
                $img_2 = $this->request->data['Post']['photo2'];
                //debug($img_2);
                
                //イメージ保存先パス
                $img_save_path = IMAGES.DS.'post_picture' ;       //  papyrus/img/profile_img/イメージファイル名

                //イメージの保存処理
                move_uploaded_file($img_2['tmp_name'], $img_save_path.DS.$img_2['name']);
                // 画像メモリを解放
                //imagedestroy($img_2);
            }


            if ($this->Post->save($this->request->data)) {

                $last_id = $this->Post->getLastInsertID();   // 挿入されたレコードのIDを入手。つまり、postテーブルから最新の投稿記事IDを取得する。

                // 画像１データの保存処理を行う 
                if (isset($this->request->data['Post']['photo1'])) {

                    $save_array1 = array('post_id' => $last_id, 
                                        'name' => $this->request->data['Post']['photo1']['name'],
                                        'image_title' => $this->request->data['Post']['photo1title']
                                        );

                    $this->Picture->save($save_array1);        // Pictureテーブルに保存する。
                
                }

                // 画像２データの保存処理を行う
                if (isset($this->request->data['Post']['photo2'])) {

                    $save_array2 = array('id' => false,                 // 前回のIDを初期化する。 
                                        'post_id' => $last_id, 
                                        'name' => $this->request->data['Post']['photo2']['name'],
                                        'image_title' => $this->request->data['Post']['photo2title']
                                        );
                    
                    //$this->Picture->create(false);          // 2週目からはモデルが同じidをひきずるため、ここで初期化をおこなう。
                    $this->Picture->save($save_array2);

                }

                // ユーザがフォームを使ってデータをPOSTした場合、その情報は、$this->request->data の中に入る。 
                $this->Session->setFlash(__('投稿が完了しました'));
                //  Session->setFlash() メソッドを使ってセッション変数にメッセージをセットすることによって、リダイレクト後のページでこれを表示します。
                $this->redirect(array('action' => 'index'));

            } else {
                $this->Session->setFlash(__('投稿に失敗しました'));
            }
        
        }

    }


    
    public function mypost($auther = null) {

        //if (isset($this->Auth->user('id'))) {
            $auther =  $this->Auth->user('id');
        //}

        // POSTのエラーチェック
        // if (!$id) {
        //     throw new NotFoundException(__('これより先はログインが必要です。'));   // 実在するレコードにアクセスすることを保証するために少しだけエラーチェックを行います。
        // }

        $sql = 'SELECT * FROM `posts` WHERE user_id = '.$auther.' ORDER BY `posts`.`modified` DESC;';
        $post = $this->Post->query($sql);

        //$post = $this->Post->find('all',array('conditons'=>array('user_id' => $id ) )); 

        if (!$post) {
            throw new NotFoundException(__('記事が投稿されておりません'));   // 実在するレコードにアクセスすることを保証するために少しだけエラーチェックを行います。
        }

        //debug($post);
        // ビューに渡す
        $this->set('myposts', $post);

    }



    public function edit($id = null) {
        
        // 変更画面に記事データを渡す
        if (isset($id)) {
            // 投稿データ参照
            $post = $this->Post->findById($id);
            // 投稿画像を参照
            //$pic = $this->Picture->findById($id);
            $pc_sql = 'SELECT * FROM `pictures` where post_id = '.$id.';'; 
            $pic = $this->Picture->query($pc_sql);
            
            //debug($post);
            //ビューに渡す
            $this->set('post', $post);
            $this->set('pic', $pic);

            // if (isset($pic)) {
            //     $this->set('pic', $pic);
            // }
        }
       


        //リクエストが HTTP or POST かどうかの確認にCakeRequest::is()メソッドを使用している。
        if ($this->request->is(array('post', 'put'))) {

            // 投稿ID
            $id = $this->request->data['Post']['id'];

            //debug($id);
            // ユーザーIDと観覧履歴を代入
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');      // ユーザーidを代入する
            $this->request->data['Post']['view_count'] = 0;                         // 観覧履歴は０に設定にセット

            // ステータス； 下書き:1  公開:2
            if ($this->request->data['submitBtn'] == 'post') {
                $this->request->data['Post']['status'] = 2;  
            } else {
                $this->request->data['Post']['status'] = 1;  
            }


            // photo1の画像・タイトルを変更する
            if (isset($this->request->data['Post']['photo1']) || isset($this->request->data['Post']['photo1title']) ) {
                // 画像の処理
                $img_1 = $this->request->data['Post']['photo1'];
                
                //イメージ保存先パス
                $img_save_path = IMAGES.'post_picture' ;       //  papyrus/img/profile_img/イメージファイル名

                //元のイメージ１を削除する
                if (isset($pic[0]['pictures']['name'])) {
                    // 元の画像ファイル名をサーバーから取得
                    $pc_sql = 'SELECT * FROM `pictures` where post_id = '.$id.';'; 
                    $pic = $this->Picture->query($pc_sql);
                    // 削除処理を実行
                    unlink($img_save_path.DS.$pic[0]['pictures']['name']);
                }

                // 新規 or 変更
                if ( $this->request->data['Post']['photo1id'] =='' ) {
                    
                        //イメージの保存処理
                        move_uploaded_file($img_1['tmp_name'], $img_save_path.DS.$img_1['name']);
                       
                        //画像１データの保存処理を行う 
                        $save_array1 = array('id' => false,
                                                'post_id' => $id,
                                                'user_id' => $this->request->data['Post']['user_id'],
                                                'image_title' => $this->request->data['Post']['photo1title'], 
                                                'name' => $this->request->data['Post']['photo1']['name'],
                                                //'image_title' => $this->request->data['Post']['photo1title']
                                            );

                        $this->Picture->save($save_array1);        // Pictureテーブルに保存する。  

                } else {

                    // イメージ１の差し替え
                    if ($img_1['name'] !='' ) {
                        //イメージの保存処理
                        move_uploaded_file($img_1['tmp_name'], $img_save_path.DS.$img_1['name']);
                       

                        //画像１データの保存処理を行う 
                        $save_array1 = array('id' => $this->request->data['Post']['photo1id'],
                                                'post_id' => $id,
                                                'user_id' => $this->request->data['Post']['user_id'],
                                                //'image_title' => $this->request->data['Post']['photo1title'], 
                                                'name' => $this->request->data['Post']['photo1']['name'],
                                                //'image_title' => $this->request->data['Post']['photo1title']
                                            );

                        $this->Picture->save($save_array1);        // Pictureテーブルに保存する。              
                    }

                    // イメージ名の変更
                    if (isset($this->request->data['Post']['photo1title'])) {

                        //画像１タイトルの保存処理を行う 
                        $save_array1 = array('id' => $this->request->data['Post']['photo1id'],
                                                'post_id' => $id,
                                                'user_id' => $this->request->data['Post']['user_id'],  
                                                //'name' => $this->request->data['Post']['photo1']['name'],
                                                'image_title' => $this->request->data['Post']['photo1title']
                                            );

                        $this->Picture->save($save_array1);        // Pictureテーブルに保存する。                
                    }

                }

                //画像メモリを解放
                imagedestroy($img_1);

            }


            // photo2の画像・タイトルを変更する
            if (isset($this->request->data['Post']['photo2']) || isset($this->request->data['Post']['photo2title']) ) {
                // 画像の処理
                $img_2 = $this->request->data['Post']['photo2'];
                
                //イメージ保存先パス
                $img_save_path = IMAGES.'post_picture' ;       //  papyrus/img/profile_img/イメージファイル名

                //元のイメージ２を削除する
                if (isset($pic[1]['pictures']['name'])) {
                    // 元の画像ファイル名をサーバーから取得
                    $pc_sql = 'SELECT * FROM `pictures` where post_id = '.$id.';'; 
                    $pic = $this->Picture->query($pc_sql);
                    // 削除処理を実行
                    unlink($img_save_path.DS.$pic[1]['pictures']['name']);
                } 
                    
                // 新規 or 変更
                if ( $this->request->data['Post']['photo2id'] == '' ) {
                
                        //イメージの保存処理
                        move_uploaded_file($img_2['tmp_name'], $img_save_path.DS.$img_2['name']);
                       
                        //画像１データの保存処理を行う 
                        $save_array2 = array('id' => false,
                                                'post_id' => $id,
                                                'user_id' => $this->request->data['Post']['user_id'],
                                                'image_title' => $this->request->data['Post']['photo1title'], 
                                                'name' => $this->request->data['Post']['photo2']['name'],
                                                //'image_title' => $this->request->data['Post']['photo1title']
                                            );

                        $this->Picture->save($save_array2);        // Pictureテーブルに保存する。

                } else {
                    
                    // イメージ２の差し替え
                    if ($img_2['name'] !='' ) {
                        //イメージの保存処理
                        move_uploaded_file($img_2['tmp_name'], $img_save_path.DS.$img_2['name']);
                       
                        //画像１データの保存処理を行う 
                        $save_array2 = array('id' => $this->request->data['Post']['photo2id'],
                                                'post_id' => $id,
                                                'user_id' => $this->request->data['Post']['user_id'],
                                                //'image_title' => $this->request->data['Post']['photo1title'], 
                                                'name' => $this->request->data['Post']['photo2']['name'],
                                                //'image_title' => $this->request->data['Post']['photo1title']
                                            );

                        $this->Picture->save($save_array2);        // Pictureテーブルに保存する。
                    
                    }

                    // イメージ名の変更
                    if (isset($this->request->data['Post']['photo2title'])) {

                        //画像２タイトルの保存処理を行う 
                        $save_array2 = array('id' => $this->request->data['Post']['photo2id'],
                                                'post_id' => $id,
                                                'user_id' => $this->request->data['Post']['user_id'],  
                                                //'name' => $this->request->data['Post']['photo2']['name'],
                                                'image_title' => $this->request->data['Post']['photo2title']
                                            );

                        $this->Picture->save($save_array2);        // Pictureテーブルに保存する。
                    
                    }
                }
                //画像メモリを解放
                imagedestroy($img_2);
            }


            //     if (isset($this->request->data['Post']['photo2title'])) {
            //         //イメージの保存処理
            //         move_uploaded_file($img_2['tmp_name'], $img_save_path.DS.$img_2['name']);
            //         //画像メモリを解放
            //         imagedestroy($img_2);

            //         //画像２データの保存処理を行う
            //         $save_array2 = array('id' => false,                 // 前回のIDを初期化する。 
            //                             'post_id' => $id, 
            //                             'user_id' => $this->request->data['Post']['user_id'],  
            //                             'name' => $this->request->data['Post']['photo2']['name'],
            //                             'image_title' => $this->request->data['Post']['photo2title']
            //                             );                    
            //         //$this->Picture->create(false);          // 2週目からはモデルが同じidをひきずるため、ここで初期化をおこなう。
            //         $this->Picture->save($save_array2);
            //     }
            // }


            //debug($this->request->data['Post']['user_id']);
            
            // 更新する内容を設定
            // $data = array('Post' => array('id' => $id , 
            //                                 'title' => $this->request->data['Post']['title'],                                            
            //                                 'body' => $this->request->data['Post']['body'],
            //                                 'category_id' => $this->request->data['Post']['category_id'],
            //                                 'modified' => date('Y-m-d-G-i-s'),
            //                                 'status' => $this->request->data['Post']['status'],                                           
            //                                 )
            //                 );
            // 更新する項目（フィールド指定）
            //$fields = array('id','title','body','category_id','modified','status');
             
            $this->request->data['Post']['modified'] = date('Y-m-d-G-i-s');

            // 投稿記事を更新する
            if ($this->Post->save($this->request->data)) {
                // 挿入されたレコードのIDを入手。つまり、postテーブルから最新の投稿記事IDを取得する。
                //$last_id = $this->Post->getLastInsertID();   

                // ユーザがフォームを使ってデータをPOSTした場合、その情報は、$this->request->data の中に入る。 
                $this->Session->setFlash(__('変更されました'));
                //  Session->setFlash() メソッドを使ってセッション変数にメッセージをセットすることによって、リダイレクト後のページでこれを表示します。
                $this->redirect(array('Controller' =>'posts','action' => 'view',$id));

            } else {
                $this->Session->setFlash(__('変更に失敗しました'));
                $this->redirect($this->referer());
            }    
        }


    }
        // if (!$post) {
        //     throw new NotFoundException(__('Invalid post'));
        // }


        // if ($this->request->is(array('post', 'put'))) {

        //     $this->Post->id = $id;

        //     if ($this->Post->save($this->request->data)) {                      // 
    	   //     //var_dump($this->request->data);
        //         $this->Session->setFlash(__('Your post has been updated.'));
        //         return $this->redirect(array('action' => 'index'));
        //     }
        //     $this->Session->setFlash(__('Unable to update your post.'));
            
        // }

        // if (!$this->request->data) {
        //     $this->request->data = $post;
        // }

    

    



    // public function delete($id) {
    //     if ($this->request->is('get')) {
    //         throw new MethodNotAllowedException();          // 
    //     }

    //     if ($this->Post->delete($id)) {
    //         $this->Session->setFlash(
    //             __('The post with id: %s has been deleted.', h($id))
    //         );
    //     } else {
    //         $this->Session->setFlash(
    //             __('The post with id: %s could not be deleted.', h($id))
    //         );
    //     }

    //     return $this->redirect(array('action' => 'index'));
        
    // }



    // public function category_index($category_id = null) {
    //     // set(); 'posts'という名前でViewにとばす処理を行う。
    //     $posts = $this->Post->find('all', array('conditions' => array('category_id' => $category_id, 
    //                                                                     'picture_id' => $picture_id,
    //                                                                     'category_id' => $user_id )
    //                                            )
    //                                 );        

    //     $categories = $this->Category->find('first', array('conditions' => array('id' => $category_id)));
    //     $pictures = $this->Picture->find('first', array('conditions' => array('id' => $picture_id)));
    //     $users = $this->User->find('first', array('conditions' => array('id' => $user_id)));    

    // //$categories = $this->Category->findById($category_id);    // どちらでもOK!!

    //     $this->set(compact('posts','categories','user','pictures'));       // 上記の$postとcompact('posts')が関連付けされる。

    // }

    // public function picture_index($picgture_id = null) {
    //     // set(); 'posts'という名前でViewにとばす処理を行う。
    //     $posts = $this->Post->find('all', array('conditions' => array('picture_id' => $picture_id)));        
    //     $pictures = $this->Picture->find('first', array('conditions' => array('id' => $picture_id)));
    //   //$Pictures = $this->Picture->findById($picture_id);    // どちらでもOK!!

    //     $this->set(compact('posts','pictures'));       // 上記の$postとcompact('posts')が関連付けされる。

    // }

    // public function user_index($user_id = null) {
    //     // set(); 'posts'という名前でViewにとばす処理を行う。
    //     $posts = $this->Post->find('all', array('conditions' => array('user_id' => $user_id)));        
    //     $users = $this->User->find('first', array('conditions' => array('id' => $user_id)));
    //   //$Pictures = $this->Picture->findById($picture_id);    // どちらでもOK!!

    //     $this->set(compact('posts','users'));       // 上記の$postとcompact('posts')が関連付けされる。

    // }




    public function isAuthorized($user) {
       // 登録済ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }

        if ($this->action === 'edit') {
            return true;
        }

        if ($this->action === 'mypost') {
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
