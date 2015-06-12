<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Post</h1>
<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('title');
	echo $this->Form->input('body', array('rows' => '10'));
	$options = array('M' => 'Male', 'F' => 'Female');
	echo $this->Form->select('gender', $options);
	echo $this->Form->end('Save Post');
?>
