
<div class="tab-pane active" id="home">
                <a href=""><img src="/papyrus/img/DSC05821.JPG" alt="Image" style="max-width: 780px; height: auto;"></a>
</div>
            



<div>
            <div class="tab-content body" style="margin-top: 85px;">
              <div class="tab-pane active" id="home">
                <a href="index.html"><img src="images/background.jpg" alt="Image" style="max-width: 780px; height: auto;"></a>
              </div>

                <ul>
                    <li class="current ">
                        <a href="blog.html"><img src="images/holi-turkey.jpg" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">グルメ</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="blog.html"><img src="images/fruits-and-bread.jpg" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">アクティビティ</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="blog.html"><img src="images/dessert.jpg" alt="Image"></a>
                        <div>
                            <h2><a href="blog.html">ローカル</a></h2>
                            <p>
                                This is just a place holder
                            </p>
                        </div>
                    </li>
                </ul>


            </div>

            <div class="footer ">
                <ul>
                    <li>
                        <h2><a href="featured.html">グルメ</a></h2>
                        <a href="featured.html"><img src="images/featured.jpg" alt="Image"></a>
                    </li>
                    <li>
                        <h2><a href="recipes.html">アクティビティ</a></h2>
                        <a href="recipes.html"><img src="images/a-z.jpg" alt="Image"></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <h2><a href="videos.html">ローカル</a></h2>
                        <a href="videos.html"><img src="images/videos.jpg" alt="Image"></a>
                    </li>
                    <li>
                        <h2><a href="blog.html">生活・留学</a></h2>
                        <a href="blog.html"><img src="images/blog.jpg" alt="Image"></a>
                    </li>
                </ul>
            </div>

            <div class="footer ">
                <ul>
                    <li>
                        <h2><a href="featured.html">Featured Recipes</a></h2>
                        <a href="featured.html"><img src="images/featured.jpg" alt="Image"></a>
                    </li>
                    <li>
                        <h2><a href="recipes.html">A to Z Recipes</a></h2>
                        <a href="recipes.html"><img src="images/a-z.jpg" alt="Image"></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <h2><a href="videos.html">Videos</a></h2>
                        <a href="videos.html"><img src="images/videos.jpg" alt="Image"></a>
                    </li>
                    <li>
                        <h2><a href="blog.html">Blog</a></h2>
                        <a href="blog.html"><img src="images/blog.jpg" alt="Image"></a>
                    </li>
                </ul>
            </div>


</div>







<!-- File: /app/View/Post/index.ctp  (編集リンクを追加済み) -->
<h1>Home</h1>
<p>
    <?php  
    echo $this->Html->link("記事を書く", array('action' => 'add'));   // 、指定されたタイトル（最初のパラメータ）とURL(二つ目のパラメータ)でHTMLリンクを生成する。
    echo $this->Html->link("お気に入り", array('action' => 'favorite'));
    ?>

</p> 

<?php 
    echo $this->Form->create('Post', array('action' => 'result', 'type' => 'post'));
    echo $this->Form->input('search_word');
    echo $this->Form->end('検索');
?>


<div class="container">
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Category</th>
            <th>Action</th>
            <th>Created</th>
        </tr>
    </thead>

<!-- $post配列をループして、投稿記事の情報を表示 -->

    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo $post['Post']['id']; ?></td>
            <td>
                <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id'])); ?>
            </td>
            <?php //debug($post); ?>
            <td><?php echo $this->Html->Link($post['Category']['name'], array('controller' => 'posts', 'action' => 'category_index', $post['Post']['category_id'])); ?></td>   
            <!--  ['controller' => 'posts']の部分は、この場合は省略が可能。 また、URLを作る情報がつまっている配列。  -->
    	<td>
                <?php echo $this->Form->postLink(
                    'Delete', 
                    array('controller' => 'posts','action' => 'delete', $post['Post']['id']), 
                    array('confirm' => 'Are you sure?'));
                    //var_dump($post['Post']['id']);
                ?>
                <?php echo $this->Html->link('Edit', array('controller' => 'posts','action' => 'edit', $post['Post']['id'])); ?>
            </td>
            <td>
                <?php echo $post['Post']['created']; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</div>

<p><?php  echo $this->Html->Link("Logout", array('controller' => 'users','action' => 'logout')); ?></p>

