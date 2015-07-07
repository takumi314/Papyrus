<ul id="blog">
	<li>
		<a href="">お気に入りリスト</a>
		<span class="date">＊＊＊＊＊＊</span>
	</li>
</ul>




<div class="container">
<table class="table table-striped ">
    <thead>
        <tr>
            <th>記事No</th>
            <th>タイトル</th>
            <th>投稿者</th>
            <th>チェックした日</th>
            <th></th>
        </tr>
    </thead>

<!-- 配列をループして、投稿記事の情報を表示 -->



    <tbody>
    <?php foreach ($favorites as $favorite): ?>
        <tr>
        	<!-- <div class="btn-group btn-group-justified" role="group" aria-label="..."> -->
	            <!-- <div class="btn-group" role="group"> -->
	            <td><?php echo 'No'.$favorite['myFposts']['post_id']; ?></td>
	            <!-- </div> -->
	            <div class="btn-group" role="group">
	            	<td>
	            	<!-- <button type="button" class="btn btn-default">Left</button> -->
	                <?php echo $this->Html->link($favorite['myFposts']['title'], array('controller' => 'posts','action' => 'view', $favorite['myFposts']['post_id'])); ?>
	            	</td>
	            </div>
	            <div class="btn-group" role="group">
		            <td>
		            	<?php echo $this->Html->link($favorite['users']['name'], array('controller' => 'users','action' => 'view', $favorite['myFposts']['user_id'])); ?>
		            </td>
		        </div>
		        <div class="btn-group" role="group">                
		            <td>
		                <?php echo $favorite['myFposts']['checked']; ?>
		            </td>
		        </div>
		        <div class="btn-group" role="group">
		            <td>
		            	<?php 
		            			$favorite_id = $favorite['myFposts']['id'];
		            			$favorite_title = $favorite['myFposts']['title'];
		            			echo $this->form->postLink('×', 
		            			array('action' => 'delete', $favorite_id ,$favorite_title), 
		            			array(), 
		            			'Are you sure?'); ?>
		            </td>
		        </div>    
	       <!--  </dvi> -->
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</div>



<!-- 
<div class="container">
<?php foreach ($favorites as $favorite): ?>
 	<div class="btn-group btn-group-justified" role="group" aria-label="Justified button group with nested dropdown">
      	<a href=" <?php echo $this->html->url(array('controller'=>'posts', 
      												'action'=>'view',$favorite['myFposts']['post_id'])
      												); 
					?>" 
			class="btn btn-default" 
			role="button" 
			style="width: 340px; float:left; text-align: left;">
      		<?php echo 'No'.$favorite['myFposts']['post_id']; ?>　<?php echo $favorite['myFposts']['title']; ?>
      	</a>
     	<a href="#" class="btn btn-default text-left" role="button" style="width: 226px; float:left; text-align: left;">
      		<?php echo 'by '.$favorite['users']['name']; ?>　<?php echo $favorite['myFposts']['checked']; ?>
	    </a>
	    <div class="btn-group" role="group" style="wwidth: 200px; float:left; margin-top: 0px;padding-left: 0px;padding-right: 0px;height: 30px;">
	        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	          Dropdown <span class="caret"></span>
	        </a>
	        <ul class="dropdown-menu">
				<li><a href="#">すでに行った</a></li>
				<li><a href="#">これから行く</a></li>
				<li><a href="#">行きたくない</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">削除</a></li>
	        </ul>
      	</div>
    </div>
<?php endforeach; ?>
</div>
 -->

