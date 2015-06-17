<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');               // lib内のクラスをインクルードする。


// app/Model/User.ctp
class User extends AppModel {

    public $helpers = array('Html', 'Form');

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();                     // 暗号化する関数"BlowfishPasswordHasher()"を
            $this->data[$this->alias]['password'] = $passwordHasher->hash(    
                $this->data[$this->alias]['password']
            );                                                                   // 別名のModelを指定して、
        }
        return true;
    }


    // public $validate = array(                               // 各項目に対してバリデーションルールを作成する。
    //     'name' => array(                                // username項目にルールを設定する。
    //         'required' => array(                            // 
    //             'rule' => array('notEmpty'),                // 'rule' => array('notEmpty')
    //             'message' => 'ユーザー名を入力して下さい。'       // もしも false が返される場合には「A username is required」というメッセージが返される。 
    //         )
    //     ),
    //     'password' => array(
    //         'required' => array(
    //             'rule' => array('notEmpty'),
    //             'message' => 'パスワードを入力して下さい。'
    //         )
    //     ),
    //     'email' => array(
    //         'required' => array(
    //             'rule' => array('notEmpty'),
    //             'message' => 'メールアドレスを忘れていませんか？' // false にする場合、値は nonempty または !empty($value) || is_numeric($value) と同義。                  
    //         )
    //     ),
        
    //     'year' => array(                                    // date項目にルールを設定する。
    //         'required' => array(
    //             'rule' => array('notEmpty'),
    //             'message' => 'はじめてセブに来たのはいつですか？。'            
    //         )
    //     ),
    //     'month' => array(                                    // date項目にルールを設定する。
    //         'required' => array(
    //             'rule' => array('notEmpty'),
    //             'message' => 'はじめてセブに来たのはいつですか？。'            
    //         )
    //     ),
    //     'image' => array(                                    // date項目にルールを設定する。
    //         'required' => array(
    //             'message' => 'プロフィール写真をアップロードしてみよう。',
    //             'allowEmpty' => True
    //         )
    //     )
    // );

    

}


?>