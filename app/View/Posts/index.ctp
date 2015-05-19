<?php
//print_r($posts)
?>


<!-- File: /app/View/Post/index.ctp  (編集リンクを追加済み) -->

<h1>Blog posts</h1>
<p><?php  echo $this->Html->link("Add Post", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Category</th>
        <th>Action</th>
        <th>Created</th>
    </tr>


<!-- $post配列をループして、投稿記事の情報を表示 -->


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
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>

