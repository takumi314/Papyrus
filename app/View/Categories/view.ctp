<!-- File: /app/View/Categories/view.ctp -->

<!-- <h1><?php echo h($category['Category']['name']); ?></h1>

<p><small>Created: <?php echo $category['Category']['created']; ?></small></p>

<p><?php echo h($category['Category']['id']); ?></p>
 -->

<div class="col-md-8">

				<div class="text-right">
                <h1 class="page-header">
                    <?php echo $category['Category']['category'] ?>
                    <!-- <small>Secondary Text</small> -->
                </h1>
                </div>

                <!-- First Blog Post -->
                <?php foreach ($category_post as $post): ?>

                <h2>
                    <a href="#"><?php echo $post['posts']['title'] ?></a>
                </h2>
                <p class="lead">
                    by <a href=" <?php echo $post['User']['name'] ?> "></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php	echo 'Posted on '.date('F j, Y', strtotime($post['posts']['created'])).' at '.date('g:i A , D', strtotime($post['posts']['created'])); ?></p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <!-- <img class="img-responsive" src="<?php echo h($post['Post']['image']); ?>" alt=""> -->
                <hr>
                <!-- ここから本文がはじまる -->
                <p>
                	<?php echo $post['posts']['body']; ?>
                	<?php //$this->Form->Link('Read More', array('Controller'=>'post',''=>'')); ?>
                	<?php echo $this->Html->link('<span class="btn active glyphicon glyphicon-chevron-right">Read More</span>', array('controller' => 'posts', 'action' => 'view', $post['posts']['id']),array('escape' => false)); ?>
                	<!-- <a class="btn btn-primary" href="">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->
                </p>
                
                <!-- ここで本文がおわる -->

                

                <?php endforeach; ?>
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

