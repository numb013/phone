<div class="users form">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('ユーザーネームとパスワードを入力してください'); ?>
        </legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
<a href="/ec/users/add">新規登録</a>
