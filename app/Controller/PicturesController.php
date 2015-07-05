<?php

// app/Controller/PicturesController.php
class UsersController extends AppController {






    public function beforeFilter() {
//        parent::beforeFilter();                         // 
    // ユーザー自身による登録とログインを許可する
//        $this->Auth->allow('add', 'login');
    }

}

?>