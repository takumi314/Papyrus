<!-- File: /app/View/Posts/mypost.ctp -->


<ul id="blog">
	<li>
		<a href="">これまでに投稿した記事</a>
		<span class="date">＊＊＊＊＊＊</span>
	</li>
</ul>




<div class="container">
<table class="table table-striped ">
    <thead>
        <tr>
            <th>記事No</th>
            <th>タイトル</th>
            <!-- <th>投稿者</th> -->
            <th>作成日</th>
            <th>投稿日</th>
            <th></th>
        </tr>
    </thead>

<!-- 配列をループして、投稿記事の情報を表示 -->



    <tbody>
    <?php foreach ($myposts as $mypost): ?>
        <tr>
        	<!-- <div class="btn-group btn-group-justified" role="group" aria-label="..."> -->
	            <!-- <div class="btn-group" role="group"> -->
	            <td><?php echo 'No'.$mypost['posts']['id']; ?></td>
	            <!-- </div> -->
	           <!--  <div class="btn-group" role="group"> -->
	            	<td>
	            	<!-- <button type="button" class="btn btn-default">Left</button> -->
	                <?php echo $this->Html->link($mypost['posts']['title'], array('controller' => 'posts','action' => 'view', $mypost['posts']['id'])); ?>
	            	</td>
	           <!--  </div> -->
	        
		       <!--  <div class="btn-group" role="group">                --> 
		            <td>
		                <?php echo $mypost['posts']['created']; ?>
		            </td>
		      <!--   </div> -->
		       <!--  <div class="btn-group" role="group">             -->    
		            <td>
		                <?php echo $mypost['posts']['posted']; ?>
		            </td>
		      <!--   </div> -->
		      <!--   <div class="btn-group" role="group"> -->
		            <td>
		            	<?php 
		            			$mypost_id = $mypost['posts']['id'];
		            			$mypost_title = $mypost['posts']['title'];
		            			echo $this->form->postLink('delete ×  ', 
		            			array('action' => 'delete', $mypost_id ,$mypost_title), 
		            			array(), 
		            			'Are you sure?'); 
		            	
		            			echo $this->Html->link('Edit', 
		            			array('action' => 'edit', $mypost_id), 
		            			array()); 
		            	?>



		            </td>
		      <!--   </div>     -->
	       <!--  </dvi> -->
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</div>

