

<!-- app/View/Users/userEmail.ctp -->
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
									 echo $this->Form->label('start_date','現在の設定', array('div'=>array('class'=>'form-group'),'class'=>''));
									?>
									<div class="text-center">	
										<h4><?php echo $userStartDate; ?></h4>
									</div>
								</div>
								<!-- <span><?php // echo $user['User']['email']; ?></span> --> 
							<!-- </div> -->
						</div>

						<div class="col-md-6">

							<?php
								echo '<div class="text-left">';
								echo $this->Form->label('start_date','訪れた時期を選択して下さい', array('div'=>array('class'=>'form-group'),'class'=>''));
								echo '</div>';

								echo '<div class="form-group text-center">';
								echo '私は'.$this->Form->year('year', 1950 , date('Y'), array('label'=>'パスワード','div'=>array('class'=>'form-group text-center'),'class'=>'' )).'年';
							
								echo $this->Form->month('month', array('div'=>array('class'=>'form-group'),'class'=>'', 'monthNames' => false)).'月';
								echo $this->Form->day('day', array('div'=>array('class'=>'form-group'),'class'=>'', 'monthNames' => false)).'日にセブへ上陸しました。';
								echo '</div>'; 


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