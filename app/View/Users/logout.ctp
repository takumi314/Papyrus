
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>		<!--  開始タグ<form>を出力する。create()には、対応するモデル(User.php)を設定する。  --> 
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>	<!-- 終了タグ</form>を出力する。submitボタン(type="submit" value="Login")も同時に生成される。 -->
</div>


