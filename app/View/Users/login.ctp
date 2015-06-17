
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>

<?php echo $this->Form->create('User'); ?>		<!--  開始タグ<form>を出力する。create()には、対応するモデル(User.php)を設定する。  --> 
    <fieldset>
        <legend>
        	<?php echo __('ログインフォーム'); ?>
        </legend>
        	<?php 		
        		echo $this->Form->input('Email',array('label'=>'メールアドレス'));	
       			echo $this->Form->input('Password',array('label'=>'パスワード'));
        	?>
    </fieldset>
	<?php echo $this->Form->end(__('Login')); ?>	<!-- 終了タグ</form>を出力する。submitボタン(type="submit" value="Login")も同時に生成される。 -->
    <div class="" id="">
        <?php echo $this->Html->Link('新規登録', array('controller' => 'users', 'action' => 'register'), array('class'=>'btn btn-default btn-lg btn-block navbar-brand')) ; ?>
    </div>
</div>


