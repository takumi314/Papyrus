<ul id="blog">
	<li>
		<a href="">This is just a place holder, so you can see what the site would look like.</a>
		<span class="date">Jan 9, by Liza</span>
	</li>

	<?php foreach ($Populars as $popular): ?>
		<li>
			<?php echo $this->Html->Link($popular['Category']['name'], array('controller' => 'posts', 'action' => 'category_index', $popular['Post']['category_id'])); ?>

			<span class="date"><?php echo $popular['Post']['created']; ?></span>
		</li>
	<?php endforeach; ?>
</ul>




        

