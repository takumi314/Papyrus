<?php
print_r($categories)
?>


<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- First Blog Post -->
        <h2>
            <a href="#">Blog Post Title</a>
        </h2>
        <p class="lead">
            by <a href="index.php">Start Bootstrap</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
        <hr>
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

        <!-- Second Blog Post -->
        <h2>
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

        <hr>

        <!-- Third Blog Post -->
        <h2>
            <a href="#">Blog Post Title</a>
        </h2>
        <p class="lead">
            by <a href="index.php">Start Bootstrap</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
        <hr>
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, voluptates, voluptas dolore ipsam cumque quam veniam accusantium laudantium adipisci architecto itaque dicta aperiam maiores provident id incidunt autem. Magni, ratione.</p>
        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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
</div>



<!-- File: /app/View/Category/index.ctp  (編集リンクを追加済み) -->

<h1>Blog categories</h1>
<p><?php echo $this->Html->link("Add Category", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>



<!-- $post配列をループして、投稿記事の情報を表示 -->


<?php foreach ($categories as $category): ?>
    <tr>
        <td><?php echo $category['Category']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($category['Category']['name'], array('action' => 'view', $category['Category']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $category['Category']['id']), array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $category['Category']['id'])); ?>
        </td>
        <td>
            <?php echo $category['Category']['created'];  ?>
        </td>   
        <td>
            <?php echo $category['Category']['modified'];  ?>
        </td>   
   

<?php endforeach; ?>


</table>
