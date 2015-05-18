<?php
class Post extends AppModel {

	public $belongsTo = 'Category';		// Categoryモデルからカテゴリーのデータを参照する。（アソシエーション）

}

?>
