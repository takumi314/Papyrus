

<!-- app/View/Users/userEmail.ctp -->
<div class="container">

	<div class="col-lg-9 col-md-9 dash-body">

		<div class="row">
			<div class="page-head">
				<div class="col-md-12 text-center">
					<!-- <h1>変更画面</h1> -->
					<p class="lead">メールアドレスを変更する</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
				<div class="row form-account">
														
					<div class="col-md-6">
							
						<?php echo $this->Form->create('User');?>	

							<div class="form-group">
								<h5>現在のメールアドレス</h5>
								<div class="text-center">
									<h4><?php echo $userEmail; ?></h4>
								<!-- <span><?php // echo $user['User']['email']; ?></span> --> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<?php echo $this->Form->input('new_email_1', array('type'=>'email','label'=>'新しいメールアドレス','div'=>array('class'=>'form-group'),'class'=>'form-control','maxlength'=>'50','placeholder'=>'Please enter new email here'));	 ?>
								</div>
								<div>								
									<?php echo $this->Form->input('new_email_2', array('type'=>'email','label'=>'もう一度入力して下さい','div'=>array('class'=>'form-group'),'class'=>'form-control','maxlength'=>'50','placeholder'=>'Please enter again'));	 ?>
								</div>
							</div>
								<?php
									echo '<div class="form-group text-center">';
									echo $this->Form->button('<span class=""></span>変更する' ,array('type'=>'submit',
										'class'=>'btn btn-default btn-lg active form-group glyphicon glyphicon-ok' ,
										'label'=>false,'escape'=>false)					// escapeとは、第１引数のhtmlをそのまま出力するためのもの。
										);
									echo '</div>'; 
								?>

						<?php echo $this->Form->end(); ?>
						
					</div>
				</div>	
			
			</div>
		</div>

	</div>
</div>
