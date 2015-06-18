
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>

<?php echo $this->Form->create('User'); ?>		<!--  開始タグ<form>を出力する。create()には、対応するモデル(User.php)を設定する。  --> 
    <fieldset>
        <legend class="text-center">
        	<?php echo __('ログインフォーム'); ?>
        </legend>
        	<?php 		
        		echo $this->Form->input('email',array('type'=>'email','label'=>'メールアドレス','class'=>'form-control active','maxlength'=>'50','placeholder'=>'Email'));
       			echo $this->Form->input('password',array('type'=>'password','label'=>'パスワード','class'=>'form-control active','maxlength'=>'50', 'placeholder'=>'Password'));
        	
                echo '<div class="form-group text-center">';
                echo $this->Form->button('<span class=""></span>Login' ,
                                array('type'=>'submit',
                                        'class'=>'btn btn-default btn-lg active form-group glyphicon glyphicon-ok' ,
                                        'label'=>false,'escape'=>false)
                                );
                echo '</div>'; 
           ?>

            <?php echo $this->Form->end(); ?>
    
        <div>
            <h5><span>はじめての方は、最初にユーザー登録を行って下さい。</span></h5>
        </div>
        <legend class="text-center" id="">
        <?php echo $this->Html->Link('新規登録', array('controller' => 'users', 'action' => 'register'), array('class'=>'btn btn-default btn-lg active')) ; ?>
        </legend>

    </fieldset>

	    	<!-- 終了タグ</form>を出力する。submitボタン(type="submit" value="Login")も同時に生成される。 -->
    
</div>


