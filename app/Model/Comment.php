<?php
class Comment extends AppModel {

	public $belongsTo = array('Post', 'User');		// PostモデルとUserモデルから投稿記事のデータよユーザー情報を参照する。（アソシエーション）

	public function isOwnedBy($post, $user) {
       return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }


}

?>
