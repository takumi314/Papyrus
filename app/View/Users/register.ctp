

<!-- app/View/Users/register.ctp -->
<div class="container">

	<div class="page-header text-center">
		<h1>登録画面</h1>
	</div>

	<div class="well">
	<?php 
		echo $this->Form->create('User', array('role'=>'form','type'=>'file', 'entype'=>'multipart/formdata', 'action'=>'login'));
		//echo $this->Form->input('group-id', array('div'=>array('class'=>'form-group'),'class'=>'form-control','option'=>$groups));

		echo $this->Form->file('imageimage', array('type'=>'file','label'=>'プロフィール写真','multiple','div'=>array('class'=>'form-group'),'class'=>''));
	    
		echo $this->Form->input('name', array('type'=>'text','label'=>'ハンドルネーム','div'=>array('class'=>'form-group'),'class'=>'form-control','maxlength'=>'50', 'placeholder'=>'Name'));

		echo $this->Form->input('email', array('type'=>'email','label'=>'メールアドレス','div'=>array('class'=>'form-group'),'class'=>'form-control','maxlength'=>'50', 'placeholder'=>'Email'));	

		echo $this->Form->input('password', array('type'=>'password','label'=>'パスワード','div'=>array('class'=>'form-group'),'class'=>'form-control','maxlength'=>'50', 'placeholder'=>'Password'));

		//echo $this->Form->label('cebu_history','セブでの滞在期間<br>',array());
		echo $this->Form->label('start_date','初めてセブに来た日はいつですか？', array('div'=>array('class'=>'form-group'),'class'=>''));
		echo '<div class="form-group">';
		echo '私は'.$this->Form->year('year', 1950 , date('Y'), array('label'=>'パスワード','div'=>array('class'=>'form-group'),'class'=>'' )).'年';
					
		echo $this->Form->month('month', array('div'=>array('class'=>'form-group'),'class'=>'', 'monthNames' => false)).'月にセブへ上陸しました。'.'</br>';
		echo '</div>'; 
		//ここにセブ上陸時期を選択によって入力を促すフォーム  //date()から今年の西暦を取得する。

		//	echo $this->Form->hidden('Image.0.model', array('value'=>'Person'));
		//	echo $this->Form->input('Image.0.photo_user', array('type'=>'file'));
		echo '<div class="form-group text-center">';
		echo $this->Form->button('<span class=""></span>Save User' ,
								array('type'=>'submit',
										'class'=>'btn btn-default btn-lg active form-group glyphicon glyphicon-ok' ,
										'label'=>false,'escape'=>false)
								);
		echo '</div>'; 
		//echo $this->Form->button( '<span class="glyphicon glyphicon-ok"></span> Save User' ,array('type'=>'submit','class'=>'btn btn-primary','label'=>false,'escape'=>false));

		echo $this->Form->end(); 

	?>	
	<!-- 終了タグ</form>を出力する。submitボタン(type="submit" value="Login")も同時に生成される。 -->

	</div>
	</div>