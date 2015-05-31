<?php
print_r($data)
?>


<!-- File: /app/View/Post/index.ctp  (編集リンクを追加済み) -->

<h1>Blog results</h1>
<p><?php  echo $this->Html->link("Index", array('action' => 'index')); ?></p>

<?php 
    echo $this->Form->create('Post', array('action' => 'result', 'type' => 'post'));
    echo $this->Form->input('search_word');
    echo $this->Form->end('検索');
?>


<div class="container">
   <?php //  echo data;  ?>
</div>

<p><?php  echo $this->Html->Link("Logout", array('controller' => 'users','action' => 'logout')); ?></p>

