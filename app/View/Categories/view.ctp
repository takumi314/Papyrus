
 <!-- categories/view.ctp -->

<div class="col-md-8">

				<div class="text-right">
                <h1 class="page-header">
                    <?php echo $category['Category']['category'] ?>
                    <!-- <small>Secondary Text</small> -->
                </h1>
                </div>

                <!-- First Blog Post -->
                <!-- ここから繰り返す、同じカテゴリーの記事をすべて表示する  -->
                <?php foreach ($category_post as $post): ?>

                <h2>
                    <!-- <a href=""><?php echo $post['posts']['title']; ?></a> -->
                    <?php echo $this->Html->link('<span></span>'.$post['posts']['title'], array('controller' => 'posts', 'action' => 'view', $post['posts']['id']),array('escape' => false)); ?>
                </h2>
                <p class="lead">
                    by <a href=" <?php echo $post['User']['name']; ?> "></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php	echo 'Posted on '.date('F j, Y', strtotime($post['posts']['created'])).' at '.date('g:i A , D', strtotime($post['posts']['created'])); ?></p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <!-- イメージを加えるとき　　<img class="img-responsive" src="<?php echo h($post['Post']['image']); ?>" alt=""> -->
                <?php //echo $this->Html->image($post[][],array("alt" => "",'url' => array('controller' => 'Picture', 'action' => '', 6)))); ?>

                <hr>

                <!-- ここから本文がはじまる -->
                <p>
                	
                	<?php echo $this->Text->truncate( $post['posts']['body'], 100 , array('ending' => '...')) ;	?>
                	<?php //echo $this->Text->autoLink($post['posts']['body']); // 自動でリンクを生成できる ?>
                	<?php echo $this->Html->link('<span></span>Read More', array('class'=>'class="btn btn-primary active glyphicon glyphicon-chevron-right"','controller' => 'posts', 'action' => 'view', $post['posts']['id']),array('escape' => false)); ?>

	                <div class="text-right">	
	                	<!-- btn btn-primary active glyphicon glyphicon-thumbs-up -->
	                	<?php //echo $this->Html->link('<span></span>Read More', array('class'=>'class="btn btn-primary active glyphicon glyphicon-chevron-right"','controller' => 'posts', 'action' => 'view', $post['posts']['id']),array('escape' => false)); ?>
	                	<!-- <a class="btn btn-primary" href="">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

	                	<?php echo $this->Html->link('<span class="btn btn-primary active glyphicon glyphicon-inbox">あとで見る</span>', array('controller' => 'posts', 'action' => 'view', $post['posts']['id']),array('escape' => false)); ?>

	                	<?php
                        echo $this->Form->create();
                            echo $this->Form->button('<span class=""></span>後で見る' , array('name'=>'Afterlook','value' => 'afterlook','type'=>'submit',
                            'class'=>'class="btn btn-primary active glyphicon glyphicon-inbox',
                            'label'=>false,'escape'=>false)); 
                        echo $this->Form->end();
                    	?>
	                </div>
                </p>
                
                <!-- ここで本文がおわる -->

                

                <?php endforeach; ?>
                <!-- ここまでを繰り返す、同じカテゴリーの記事をすべて表示する -->

                <hr>

                <!-- Second Blog Post -->
               <!--  <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, quasi, fugiat, asperiores harum voluptatum tenetur a possimus nesciunt quod accusamus saepe tempora ipsam distinctio minima dolorum perferendis labore impedit voluptates!</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
 -->
                <hr>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

