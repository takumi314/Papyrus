<ul id="blog">
	<li>
		<a href="">お気に入り・リスト</a>
		<span class="date">＊＊＊＊＊＊</span>
	</li>

	<?php foreach ($Favorites as $Favorite): ?>
		<tr>
            <td><?php echo $favorite['Post']['id']; ?></td>
            <td>
                <?php echo $this->Html->link($favorite['Post']['title'], array('action' => 'view', $favorite['Post']['id'])); ?>
            </td>
            <?php //debug($post); ?>
            <td><?php echo $this->Html->Link($favorite['Category']['name'], array('controller' => 'posts', 'action' => 'category_index', $favorite['Post']['category_id'])); ?></td>   
            <!--  ['controller' => 'posts']の部分は、この場合は省略が可能。 また、URLを作る情報がつまっている配列。  -->
    	<td>
                <?php echo $this->Form->postLink(
                    'Delete', 
                    array('controller' => 'posts','action' => 'delete', $favorite['Post']['id']), 
                    array('confirm' => 'Are you sure?'));
                    //var_dump($post['Post']['id']);
                ?>
                <?php echo $this->Html->link('Edit', array('controller' => 'posts','action' => 'edit', $favorite['Post']['id'])); ?>
            </td>
            <td>
                <?php echo $favorite['Post']['created']; ?>
            </td>
        </tr>
	<?php endforeach; ?>
</ul>



