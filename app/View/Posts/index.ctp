<?php
//print_r($posts)
?>


<!-- File: /app/View/Post/index.ctp  (編集リンクを追加済み) -->

<h1>Blog posts</h1>
<p>
    <?php  
    echo $this->Html->link("Add Post", array('action' => 'add'));   // 指定されたタイトル（最初のパラメータ）とURL(二つ目のパラメータ)でHTMLリンクを生成する。
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

