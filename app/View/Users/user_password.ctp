
<div class="container">

	<div class="col-lg-9 col-md-9 dash-body">

		<div class="row">
			<div class="page-head">
				<div class="col-md-12">
					<!-- <h1>変更画面</h1> -->
					<p class="lead">変更画面</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
					<div class="row form-account">
						<?php echo $this->Form->create('User'); ?>	
						<div class="col-md-6">
							<div class="form-group">
								<h5>現在のパスワードを入力して下さい。</h5>
								<?php echo $this->Form->input('old_password', array('type'=>'password','label'=>'現在のパスワード','div'=>array('class'=>'form-group'),'class'=>'form-control  text-center','maxlength'=>'50')); ?>								
								<!-- <span><?php // echo $user['User']['email']; ?></span> --> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<h5>新しいパスワードを入力して下さい。</h5>
								<?php echo $this->Form->input('new_password_1', array('type'=>'password','label'=>'新しいパスワード','div'=>array('class'=>'form-group'),'class'=>'form-control text-center','maxlength'=>'50'));	 ?>
							</div>
							<div >								
								<?php echo $this->Form->input('new_password_2', array('type'=>'password','label'=>'もう一度入力して下さい。','div'=>array('class'=>'form-group'),'class'=>'form-control  text-center','maxlength'=>'50','aria-describedby'=>'inputSuccess2Status')); ?>
							</div>
						
						
							<?php 
								echo '<div class="form-group text-center">';
								echo $this->Form->button('<span class=""></span>変更する' ,array('type'=>'submit',
										'class'=>'btn btn-default btn-lg active form-group glyphicon glyphicon-ok' ,
										'label'=>false,'escape'=>false)					// escapeとは、第１引数のhtmlをそのまま出力するためのもの。
										);
								echo '</div>'; 
							?>

						</div>
						<?php echo $this->Form->end(); ?>	
					</div>
				
			</div>
		</div>

	</div>
</div>