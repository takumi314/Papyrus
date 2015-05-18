<?php

// ./app/Controller/CategoriesController.php
class CategoriesController extends AppController {

    public $helpers = array('Html', 'Form','Session');            // helpersプロパティ
    public $components = array('Session');                        // componentsプロパティ

	public function index() {                                     // indexアクションを呼び出す。
		// set(); 'categories'という名前でViewにとばす処理を行う。
        $this->set('categories', $this->Category->find('all'));   // １番目の'cagtegories'は「View」内での変数名に、２番目の部分は実際のデータのデータとなる。
    }                                                             // モデルクラスが 'category' なので、アクション内の$this->Category->find('all') という記述によってモデルにアクセスする。

    //カテゴリーの追加を実行する処理を担う
    public function add() {
        if ($this->request->is('post')) {                           // CakeRequestクラスの機能へアクセスするための入り口、
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your Category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your Category.'));
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
