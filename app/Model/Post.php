<?php
class Post extends AppModel {

	public $belongsTo = array('Category','User','Picture');		// Categoryモデルからカテゴリーのデータを参照する。（アソシエーション）
																// Userモデルからユーザーのデータを参照する。（アソシエーション）
																// Pictureモデルから画像のファイル名を参照する
	public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }


    //検索のために追加
    public $actsAs = array('Search.Searchable');
	
	public $filterArgs = array(
			'keyword' => array('type'=>'like','field'=>array('Post.title','Post.body')),
		);



    


}

?>
