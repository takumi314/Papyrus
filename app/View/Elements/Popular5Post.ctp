<ul id="blog">
            
	<?php foreach ($populars as $popular): ?>
	<li>
	    <?php echo $this->Html->Link($popular['writer']['title'], array('controller' => 'posts', 'action' => 'view', $popular['writer']['id'])).'('.$popular['writer']['cnt'].')'; ?>

	    <span class="date">
	    <?php 

	        $posted_date = substr($popular['writer']['created'],0,4).'年'.substr($popular['writer']['created'],5,2).'月'.substr($popular['writer']['created'],8,2).'日';     // 日付データを「　年　月　日」の形式に書き換える。
	        echo $posted_date.' by '.$popular['users']['name'];     // 投稿日時と筆者名を表示する。
	        //date('Y年n月j日', strtotime($popular['posts']['created'])).' by '.$post['users']['name']; 
	    ?>
	    </span>
	</li>
	<?php endforeach; ?>
</ul>


        

