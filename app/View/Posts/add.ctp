<?php //print_r($categories_list); ?>

<!-- File: /app/View/Posts/add.ctp -->

<h1>記事の作成</h1>
<?php

	echo '<fieldset form-group>';	
	//echo $this->Html->image(); 					// userのプロフィール写真を表示
	echo '<h4>'.$userName.'</h4>' ;						// ユーザー名を表示
	//echo $howlong ;							// デブ歴を表示する（保留）
	echo '</fieldset form-group>';

	echo '<div class="form-group text-center">';
	//フォームを作成する
	echo $this->Form->create('Post', array('role'=>'form','type'=>'file', 'entype'=>'multipart/formdata', 'action'=>'add'));

	echo '<fieldset>';

	echo '<div class="text-left">';
	$categories = array('1' => 'グルメ','2' => 'アクティビティ','3' => 'ローカル','4' => '生活・留学');

	echo $this->Form->select( 'category_id', $categories, array('value'=>'0','height'=>'30px','empty'=>array('0'=>'-ここからカテゴリを選んで下さい-'))) ;		
	// 第１引数：Field名、第２引数：選択する項目リスト（連想配列）、第３引数：選択されている値、第４引数：selectタグのHTMLHTML属性の設定（配列）

	echo $this->Form->input('title', array('placeholder'=>'タイトルをお書き下さい','maxlength'=>' 50','size'=>'50','height'=>'30px'));
	//debug($categories_list['category']['category']);
	echo '</div>';

	echo '<div class="text-center">';
	echo $this->Form->file( 'photo_1' , array('type'=>'file', 'alt' => '投稿写真　その１','multiple', 'border' => '0', 'width' => ''));
	echo $this->Form->file( 'photo_2' , array('type'=>'file', 'alt' => '投稿写真　その２','multiple', 'border' => '0', 'width' => ''));
	echo '</div>';

	echo '<div class="text-center">';
	echo $this->Form->textarea('body', array('label'=>'本文','placeholder'=>'本文はこちらにお書き下さい','maxlength'=>' 50000','rows' => '30','cols'=>'85', 'wrap'=>'hard'));
	echo '</div>';
	
	//echo '<div class="text-center">';
	echo $this->Form->button('<span class=""></span>下書き保存' ,array('name'=>'data[submitBtn]','value' => 'save','type'=>'submit',
			'class'=>'btn btn-default btn-lg active form-group glyphicon glyphicon-ok' ,
			'label'=>false,'escape'=>false)					// escapeとは、第１引数のhtmlをそのまま出力するためのもの。
			);
	echo '</div>';

	echo '<div class="text-center">';
	echo '<span class=""></span>';
	echo $this->Form->button('<span class=""></span>投稿する' ,array('name'=>'data[submitBtn]','value' => 'post','type'=>'submit',
			'class'=>'btn btn-default btn-lg active form-group glyphicon glyphicon-ok' ,
			'label'=>false,'escape'=>false)					// escapeとは、第１引数のhtmlをそのまま出力するためのもの。
			);
	echo '</div>';

	echo $this->Form->end();

	echo '</div>'; 

	echo '</fieldset>';



?>


<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="..."></iframe>
</div>
