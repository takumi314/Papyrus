<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array(
        'Session',
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
    );

    public $components = array(
        'DebugKit.Toolbar',			// 　←　DebugKitの追加
        'Session',
        'Auth' => array(
            'flash' => array(   
                'element' => 'alert',
                'key' => 'auth',
                'params' => array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                )
            ),
            'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'authenticate' => array('Form' => array('passwordHasher' => 'Blowfish',
                                                    'fields'=>array('username'=>'email',            // ログインのユーザーネームをEメールに変更
                                                                    'password'=>'password'          // ログインのパスワードはデフォルト
                                                                    ) 
                                                    )
                                    ),
            'authorize' => array('Controller') // この行を追加しました
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('index', 'login','logout','categories','index','user_email','user_password','user_start_date','user_image','user_name');
    
        
        if (is_null($this->Auth->user('name'))) {                    // $this->Auth->user('name')がnullかどうかを判別する
            $this->set('userName','ゲスト');                          // ログアウト中ならば、「ゲスト」をビューに受け渡す
        }else {         
            $this->set('userName', $this->Auth->user('name'));       // ログイン中ならば、「$userName」をすべてのビューに受け渡す    
        }

        $this->set('userEmail',$this->Auth->user('email'));      // ユーザー情報emailをすべtのビューに受け渡す
  
        if ($this->Auth->user('image') == '-1') {
            $this->set('userImage','プロフィール写真');
        } else {
            $this->set('userImage',$this->Auth->user('image'));      // ユーザー情報imageをすべてのビューに受け渡す
        }
        
        $this->set('userStartDate',$this->Auth->user('start_date')); 
                      
        $this->set('userPassword',$this->Auth->user('password')); 

        

    }



    public function isAuthorized($user) {
        // if (isset($user['role']) && $user['role'] === 'admin') {
        //     return true;
        // }

        // // デフォルトは拒否
        // return false;

    }

}

