<?php
class Post extends AppModel {

	public $belongsTo = 'Category';		// Categoryモデルからカテゴリーのデータを参照する。（アソシエーション）

	public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }


}

?>
