<h1>投稿記事</h1> 
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
                <?php foreach ($pictures as $pic): ?>
                <img class="img-responsive" src="<?php echo '/papyrus/img/post_picture/'.$pic['pictures']['name'] ;?>" alt="投稿画像" style="">
                <?php endforeach; ?>

                <hr>

                <!-- Post Content -->
                <!-- <pre>タグが改行やスペースも反映させている -->
                <p class="lead"><pre><?php echo $this->Text->autoLink($post['Post']['body']); ?></pre></p>


                <p></p>

                <div class="text-right">
                    <?php
                        echo $this->Form->create('Favorite', array('url' => array('controller' => 'favorites', 'action' => 'add')));
                            echo $this->Form->button('<span class=""></span>お気に入り' ,array('name'=>'','value' => '','type'=>'submit',
                            'class'=>'btn btn-primary active glyphicon glyphicon-thumbs-up',
                            'label'=>false,'escape'=>false)); 
                            //echo $this->Form->hidden('post_id',array('value' => '1')); 
                            echo $this->Form->hidden('post_id',array('value' => $post['Post']['id'])); 
                        echo $this->Form->end();
                    ?>
                </div>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <?php echo $this->Form->create('Comment', array('role'=>'form','type'=>'post','Controller'=>'Comments','action'=>'add')); ?>
                    	<?php echo $this->Form->hidden('post_id',array('value'=>$post['Post']['id']) ); ?>							
                        <!-- 投稿記事IDをhiddenを使って、Commentsにpost_idの情報をPOST送信する -->
                        <!-- <div class="form-group"> -->
                            <!-- <textarea class="form-control" rows="3"></textarea> -->
                        <?php echo $this->Form->textarea('comment', array( 'placeholder' => '"'.$post['Post']['title'].'" に関する新しい情報はございませんか？','maxlength'=>' 5000','rows' => '5','cols'=>'85','wrap'=>'hard',array('div'=>'form-group'))); ?>
                        <!-- </div> -->
                        <!-- <button type="submit" class="btn btn-primary">コメントする</button> -->
                        <?php echo $this->Form->button('<span class=""></span>コメントする' ,array('name'=>'Comment_button','value' => 'save','type'=>'submit',
							'class'=>'btn btn-primary active',
							'label'=>false,'escape'=>false)); 
						?>
                    <?php echo $this->Form->end(); ?>
                </div>

                <hr>





                <!-- Posted Comments -->

                <!-- Comment -->

                <!-- ここから繰り返す -->
                <?php foreach ($comments as $comment){
                echo '<div class="media">';
                
                    echo '<a class="pull-left" href="">';
                        echo $this->Html->image( 'profile_img'.DS.$comment['users']['image'], array('url' => '', 'alt' => 'プロフィール画像', 'class' => 'media-object img-responsive img-circle', 'style' => array('width: 74px; height:74px;')));
                        //echo '<img class="media-object img-responsive" src="'.'リンク先'.'"  alt="プロフィール画像">';
                    echo '</a>';
                    echo '<div class="media-body">';

                    if(is_null($comment['users']['name'])){ $comment['users']['name'] = 'Guest'; }

                        echo '<h4 class="media-heading">'.$comment['users']['name'].'<small>さん</small>　' ;
                        echo    '<small>';
                            echo date('F j, Y', strtotime($comment['comment_user']['created'])).' '.date('g:i A , D', strtotime($comment['comment_user']['created'])); 
                        echo '</small>';
                        echo '</h4>';
                        //　ここからコメントの表示
                        echo $this->Text->autoLink($comment['comment_user']['comment']);
                        
                    echo '</div>';
                
                  

                echo '</div>';
                
                }

                ?>  
                <!-- 最初に戻る -->


                <!-- Comment -->
              <!--   <div class="media">
                    <a class="pull-left" href="">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4> -->
                        <?php 	//　ここからコメントの表示?>
                        <!-- Nested Comment -->
                        <!-- <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div> -->
                        <!-- End Nested Comment -->
                    <!-- </div> -->
                <!-- </div> -->

    </div>
</div>