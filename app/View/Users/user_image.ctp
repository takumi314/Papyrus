

<!-- app/View/Users/userName.ctp -->
<div class="container">

	<div class="col-lg-9 col-md-9 dash-body">

		<div class="row">
			<div class="page-head">
				<div class="col-md-12">
					<!-- <h1>変更画面</h1> -->
					<p class="lead text-center">変更画面</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
					<div class="row form-account">
						
						<div class="col-md-6">
							<div class="form-group text-center">
								<h5>現在のプロフィール画像</h5>

								<?php echo $this->Html->image( '/img/profile_img/'.$userImage ,array('width'=>'180','height'=>'180', 'alt'=>'プロフィール画像', 'class'=>'text-center')); ?>	

								<?php //echo $this->Form->label('post_username',$userName, array('div'=>array('class'=>''),'class'=>''));　?>
								<!-- <span><?php // echo $user['User']['email']; ?></span> --> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group text-center">
								<?php echo $this->Form->create('User', array('role'=>'form','type'=>'file', 'entype'=>'multipart/formdata')); ?>	
								<?php echo $this->Form->file('changed_image', 
																array('type'=>'file',
																		'label'=>'プロフィール写真',
																		'multiple',
																		'div'=>array('class'=>'form-group'),
																		'class'=>''));	
								?>
								<?php //echo $this->Form->input('name', array('type'=>'text','label'=>'新','div'=>array('class'=>'form-group'),'class'=>'form-control','maxlength'=>'50'));	 
									echo '<div class="form-group text-center">';
									echo $this->Form->button('<span class=""></span>変更する' ,
															array('type'=>'submit',
																'class'=>'btn btn-default btn-lg active form-group glyphicon glyphicon-ok' ,
																'label'=>false,'escape'=>false)													// escapeとは、第１引数のhtmlをそのまま出力するためのもの。
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
</div>