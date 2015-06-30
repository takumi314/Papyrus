

<!-- app/View/Users/userName.ctp -->
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
								<h5>現在のプロフィール画像</h5>
								<?php //echo $this->Form->label('post_username',$userName, array('div'=>array('class'=>''),'class'=>''));　?>
								<!-- <span><?php // echo $user['User']['email']; ?></span> --> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<?php echo $this->Form->file('changed_image', array('type'=>'file','label'=>'プロフィール写真','multiple','div'=>array('class'=>'form-group'),'class'=>''));	?>

								<?php //echo $this->Form->input('name', array('type'=>'text','label'=>'新','div'=>array('class'=>'form-group'),'class'=>'form-control','maxlength'=>'50'));	 ?>
							</div> 
						</div>
						<?php echo $this->Form->end(__('変更する')); ?>
					</div>
				
			</div>
		</div>

	</div>
</div>