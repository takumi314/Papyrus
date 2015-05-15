<?php

class CategoryController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

	public function index() {
		// set(); 'categories'という名前でViewにとばす処理を行う。
        $this->set('categories', $this->Category->find('all'));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your Category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your Category.'));
        }
    }


}


?>
