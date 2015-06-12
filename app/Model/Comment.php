<?php
class Comment extends AppModel {

	public $belongsTo = 'Post';		// Postモデルから投稿記事のデータを参照する。（アソシエーション）

	public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }


}

?>
