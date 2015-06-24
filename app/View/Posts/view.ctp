<!-- File: /app/View/Posts/view.ctp -->

<!-- <h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>

<h1>投稿記事</h1> -->

<div>
	<div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo h($post['Post']['title']); ?></h1>

                <!-- Author -->
                <p class="lead">
                by <a href="#"><?php echo h($post['User']['name']); ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span><?php	echo 'Posted on '.date('F j, Y', strtotime($post['Post']['created'])).' at '.date('g:i A , D', strtotime($post['Post']['created'])); ?></p>
                											
                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php //echo  ;?>" alt="投稿画像" style="height: 300px; width: 900px;">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post['Post']['body']; ?></p>
                <p></p>
                <p></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <?php echo $this->Form->create('comment', array('role'=>'form','type'=>'post','Controller'=>'Comments','action'=>'add')); ?>
                    	<?php echo $this->Form->hidden('post_id',array('value'=>$post['Post']['id']) ); ?>							
                        <!-- 投稿記事IDをhiddenを使って、Commentsにpost_idの情報をPOST送信する -->
                        <!-- <div class="form-group"> -->
                            <!-- <textarea class="form-control" rows="3"></textarea> -->
                        <?php echo $this->Form->textarea('comment', array( 'placeholder' => '"'.$post['Post']['title'].'" に関する新しい情報はございませんか？','maxlength'=>' 5000','rows' => '5','cols'=>'85','wrap'=>'hard',array('div'=>'form-group'))); ?>
                        <!-- </div> -->
                        <!-- <button type="submit" class="btn btn-primary">コメントする</button> -->
                        <?php echo $this->Form->button('<span class=""></span>コメントする' ,array('name'=>'Comment','value' => 'comment','type'=>'submit',
							'class'=>'btn btn-primary active',
							'label'=>false,'escape'=>false)); 
						?>
                    <?php echo $this->Form->end(); ?>
                </div>

                <hr>





                <!-- Posted Comments -->

                <!-- Comment -->

                <div class="media">
                	<?php foreach ($comments as $comment): ?>	<!-- ここから繰り返す -->
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?php   ?>" alt="プロフィール画像">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment['User']['name'] ; ?>
                            <small>
                            	<?php echo 'Posted on '.date('F j, Y', strtotime($comment['Comment']['created'])).' at '.date('g:i A , D', strtotime($comment['Comment']['created'])); ?>
                            </small>
                        </h4>
                        <?php 	//　ここからコメントの表示
                        	$comment['Comment']['comment'];
                        ?>
                    </div>
                <?php endforeach; ?>	<!-- 最初に戻る -->
                </div>



                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        <?php 	//　ここからコメントの表示

                        ?>
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

    </div>
</div>
