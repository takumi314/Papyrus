

<!-- app/View/Users/register.ctp -->
<div class="container">

	<div class="page-header">
		<h1>登録画面</h1>
	</div>

	<div class="well">
	<?php 
	echo $this->Form->create('User', array('role'=>'form','type'=>'file', 'action'=>'check'));
	//echo $this->Form->input('group-id', array('div'=>array('class'=>'form-group'),'class'=>'form-control','option'=>$groups));

	echo $this->Form->file('image', array('div'=>array('class'=>'form-group'),'class'=>''));
    
	echo $this->Form->input('name', array('div'=>array('class'=>'form-group'),'class'=>'form-control'));

	echo $this->Form->input('email', array('div'=>array('class'=>'form-group'),'class'=>'form-control'));	

	echo $this->Form->input('password', array('div'=>array('class'=>'form-group'),'class'=>'form-control'));

	echo $this->Form->label('cebu_history','セブでの滞在期間<br>',array());

	echo '私は'.$this->Form->year('year', 1950 , date('Y'), array('div'=>array('class'=>'form-group'),'class'=>'' ))
				.'年'.$this->Form->month('month', array('div'=>array('class'=>'form-group'),
					'class'=>'', 'monthNames' => false)).'月にセブへ上陸しました。'.'</br>'; 
	//ここにセブ上陸時期を選択によって入力を促すフォーム  //date()から今年の西暦を取得する。

	//	echo $this->Form->hidden('Image.0.model', array('value'=>'Person'));
	//	echo $this->Form->input('Image.0.photo_user', array('type'=>'file'));

	echo $this->Form->button('<span class="glyphicon glyphicon-ok"></span>Save User' ,
							array('type'=>'submit',
									'class'=>'btn btn-primary',
									'label'=>false,'escape'=>false)
							);
	//echo $this->Form->button( '<span class="glyphicon glyphicon-ok"></span> Save User' ,array('type'=>'submit','class'=>'btn btn-primary','label'=>false,'escape'=>false));

	echo $this->Form->end(); 

	?>	
	<!-- 終了タグ</form>を出力する。submitボタン(type="submit" value="Login")も同時に生成される。 -->

	</div>
	</div>