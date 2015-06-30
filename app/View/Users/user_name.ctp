

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
						<?php echo $this->Form->create('User'); ?>	
						<div class="col-md-6">

							<div class="text-left">
								<?php
								 echo $this->Form->label('name','現在のハンドルネーム', array('div'=>array('class'=>'form-group'),'class'=>''));
								?>
								<div class="text-center">	
									<h4><?php echo $userName ; ?></h4>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="text-left">
								<?php echo $this->Form->input('new_name', array('type'=>'text','label'=>'新しいハンドル名を入力して下さい','div'=>array('class'=>'form-group'),'class'=>'form-control','maxlength'=>'50','placeholder'=>'Please enter new username.'));	 
								?>
				
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
</div>