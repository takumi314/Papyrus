<?php
print_r($user);
?>

<!-- app/View/Users/register.ctp -->

	<div class="col-lg-9 col-md-9 dash-body">

		<div class="row">
			<div class="page-head">
				<div class="col-md-12">
					<h1>Account Settings</h1>
					<p class="lead">Manage your personal information, billing details and connected accounts.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form>
					<div class="row form-account">
						<div class="col-md-6">
							<div class="form-group">
								<h4>Photo</h4>
								<span><?php echo $user['User']['image']; ?></span>
								<?php echo $this->Html->Link('modify',array('controller' => 'users','action' => 'change_image')); ?>
							</div>
							<div class="form-group">
								<h4>Username</h4>
								<span><?php echo $user['User']['name']; ?></span>
								<?php echo $this->Html->Link('modify',array('controller' => 'users','action' => 'change_username')); ?>
							</div>
							<div class="form-group">
								<h4>Password</h4>
								<span><?php echo '************'; ?></span>
								<?php echo $this->Html->Link('modify',array('controller' => 'users','action' => 'change_password')); ?>
	                        </div>
							<div class="form-group">
								<h4>Email Preferences</h4>
								<span><?php echo $user['User']['email']; ?></span>
								<?php echo $this->Html->Link('modify',array('controller' => 'users','action' => 'change_email')); ?> 
							</div>
						</div>
						<div class="col-md-6">

	              		<!-- ACCOUNT TYPE CONTROLS -->
	              
							<!-- <div class="form-group account-type-container">
			  					<h4>Account Type</h4>
			  					<span><?php echo 'Basic member access'; ?></span>
								<?php echo $this->Html->Link('pgrade',array('controller' => 'users','action' => '')); ?>
							</div> -->
						</div>							
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class="media private-profile">
        <div class="media-body pulcambal-left" href="#">
            <?php echo $this->Html->image('/img/guest_photo.jpg',array('alt'=>'プロフィール画像')); ?>
        </div>
       	<div class="media-body pull-left">
            <div class="media-content">
                <h4>Kooffeeee</h4>
            </div>
        </div>                    
    </div>
    
