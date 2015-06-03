<?php
class PostsController extends AppController {
    
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','Search.Prg');     //Prgコンポーネントを読み込む。
    public $uses = array('Post','Category');        // POSTモデルとCategoryモデルを指定する。
    public $presetVars = true;                      // Prgコンポーネントのメソッドで利用される変数の事前設定

    public function index() {
		// set(); 'posts'という名前でViewにとばす処理を行う。
        $this->set('posts', $this->Post->find('all'));
    }
    
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));   // 実在するレコードにアクセスすることを保証するために少しだけエラーチェックを行います。
        }

        $post = $this->Post->findById($id);                    // ひとつの投稿記事の情報しか必要としないため、findById()を使用している。
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));   // 実在するレコードにアクセスすることを保証するために少しだけエラーチェックを行います。
        }
        $this->set('post', $post);
    }

 //   public function add() {
 //       if ($this->request->is('post')) {
 //           $this->Post->create();
 //           if ($this->Post->save($this->request->data)) {
 //               $this->Session->setFlash(__('Your post has been saved.'));
 //               return $this->redirect(array('action' => 'index'));
 //           }
 //           $this->Session->setFlash(__('Unable to add your post.'));
 //       }
 //   }

    // app/Controller/PostsController.php
    public function add() {
        if ($this->request->is('post')) {       // リクエストが HTTP or POST かどうかの確認にCakeRequest::is()メソッドを使用している。
            $this->request->data['Post']['user_id'] = $this->Auth->user('id'); //Added this line
            //$this->set('categories_list',$this->Category->find['list']);
            var_dump($this->Category->find['list']);
            if ($this->Post->save($this->request->data)) {                  
                // ユーザがフォームを使ってデータをPOSTした場合、その情報は、$this->request->data の中に入る。 
                $this->Session->setFlash(__('Your post has been saved.'));
                //  Session->setFlash() メソッドを使ってセッション変数にメッセージをセットすることによって、リダイレクト後のページでこれを表示します。
                $this->redirect(array('action' => 'index'));
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
        $posts = $this->Post->find('all', array('conditions' => array('category_id' => $category_id)));        
        $categories = $this->Category->find('first', array('conditions' => array('id' => $category_id)));
      //$categories = $this->Category->findById($category_id);    // どちらでもOK!!

        $this->set(compact('posts','categories'));       // 上記の$postとcompact('posts')が関連付けされる。

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
            $conditions = $this->Post->parseCriteria($this->passedArgs);

            $this->paginate = array(  
                'conditions' => $conditions,  
                'limit' => 20,
                'order' => array(
                'id' => 'desc'
                )
            );
            $this->set('data', $this->paginate('Post'));
        }
    }



}

?>
