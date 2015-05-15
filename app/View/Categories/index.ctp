<?php
print_r($posts)
?>



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
   
   

<?php endforeach; ?>


</table>
