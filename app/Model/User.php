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

    // 何かデータが保存されたら必ず実行される
    public function afterSave($created, $options = array()){
    
        parent::afterSave($created,$options);
     
        //updating authentication session
        App::uses('CakeSession', 'Model/Datasource');
        CakeSession::write('Auth',$this->findById(AuthComponent::user('id')));
     
        return true;

    }



    public $validate = array(                               // 各項目に対してバリデーションルールを作成する。
        'name' => array(                                // username項目にルールを設定する。
            'required' => array(                            // 
                'rule' => array('notEmpty'),                // 'rule' => array('notEmpty')
                'message' => 'ユーザー名を入力して下さい。'       // もしも false が返される場合には「A username is required」というメッセージが返される。 
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'パスワードを入力して下さい。'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'メールアドレスを忘れていませんか？' // false にする場合、値は nonempty または !empty($value) || is_numeric($value) と同義。                  
            )
        ),        
        // 'year' => array(                                    // date項目にルールを設定する。
        //     'required' => array(
        //         'rule' => array('notEmpty'),
        //         'message' => 'はじめてセブに来たのはいつですか？。'            
        //     )
        // ),
        // 'month' => array(                                    // date項目にルールを設定する。
        //     'required' => array(
        //         'rule' => array('notEmpty'),
        //         'message' => 'はじめてセブに来たのはいつですか？。'            
        //     )
        // ),
        'imageimage'=>array(
             'rule1' => array(
                //拡張子の指定
                'rule' => array('extension',array('jpg','jpeg','gif','png')),
                'message' => '画像ではありません。',
                 'allowEmpty' => true,
            ),
             'rule2' => array(
                //画像サイズの制限
                'rule' => array('fileSize', '<=', '2000000'),
                'message' => '画像サイズは2MB以下でお願いします',
            )     
        ),

        // 'imageimage' => array(                                    // date項目にルールを設定する。
        //     'required' => array(
        //         'message' => 'プロフィール写真をアップロードしてみよう。',
        //         'allowEmpty' => True
        //     )
        // )
    );
    // ここまでがvalidate  //
}


?>