<!-- File: /app/View/Post/category_view.ctp  (編集リンクを追加済み) -->

<h1><?php echo $categories['Category']['name']; ?></h1>

<h1><?php echo $categories['Category']['name']; ?></h1>

<p><?php echo $this->Html->link("Add Post", array('action' => 'add')); ?></p>




<p><?php echo $this->Html->link("Papyrus", array('action' => 'home')); ?></p>


<table>
    <tr>
        <th>Id</th>
        <th>Title</th> 
        <th>Category</th>
<!--    <th>Action</th>   -->
        <th>Posted</th>
    </tr>


<!-- $post配列をループして、投稿記事の情報を表示 -->


<?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td><?php echo $post['Category']['name']; ?></td>

<!--
	<td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
        </td>
-->

        <td>
            <?php echo $post['Post']['posted']; ?>
        </td>
    </tr>
<?php endforeach; ?>





</table>

