<ul id="blog">
	<li>
		<div>
           
            <?php 
                foreach ($latest5post as $post){

                //echo $this->Html->image('recipes.html', array('alt'=>'Image','url' => '/papyrus/images/sandwich.jpg')) ;

                //echo $this->Html->image($post['Picture']['name'], array('alt'=>'Image','url' => array('controller' => 'posts', 'action' => 'latest5post', 6))) ; 

                //echo $this->Html->link('画像を表示する', array('controller' => 'picture', 'action' => 'view', 1, '?' => array('height' => 75, 'width' => 75)));
                
                echo $this->Html->link($post['latest']['title'] , array('controller' => 'posts', 'action' => 'view', $post['latest']['id']));    

                //echo $this->Html->link('This is just a place holder, so you can see what the site would look like.' , array( 'url' => 'hblog.html', $post['Post']['id'])); 
                
            
                echo '<span class="date">';
                 
                    $posted_date = substr($post['latest']['created'],0,4).'年'.substr($post['latest']['created'],5,2).'月'.substr($post['latest']['created'],8,2).'日';     // 日付データを「　年　月　日」の形式に書き換える。
                    echo $posted_date.' by '.$post['users']['name'];     // 投稿日時と筆者名を表示する。
                
                echo '</span>';

            } // ここまでがforeach文の範囲

            ?>  
        </div>
	</li>
</ul>



