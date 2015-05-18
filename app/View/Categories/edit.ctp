<!-- File: /app/View/Posts/edit.ctp -->

<h1>Edit Category</h1>
<?php
echo $this->Form->create('Category');     // Modeo[Category]
echo $this->Form->input('name');
//echo $this->Form->input('body', array('rows' => '1'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Category');
?>

