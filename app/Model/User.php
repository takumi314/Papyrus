<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');               // lib内のクラスをインクルードする。


// app/Model/User.php
class User extends AppModel {

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();                     // 暗号化する関数"BlowfishPasswordHasher()"を
            $this->data[$this->alias]['password'] = $passwordHasher->hash(    
                $this->data[$this->alias]['password']
            );                                                                   // 別名のModelを指定して、
        }
        return true;
    }


    public $validate = array(                               // 各項目に対してバリデーションルールを作成する。
        'username' => array(                                // username項目にルールを設定する。
            'required' => array(                            // 
                'rule' => array('notEmpty'),                // 'rule' => array('notEmpty')
                'message' => 'A username is required'       // もしも false が返される場合には「A username is required」というメッセージが返される。 
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false　                     // false にする場合、値は nonempty または !empty($value) || is_numeric($value) と同義。 
            )
        )
    );

    

}


?>