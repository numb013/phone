<h3>投稿ページ</h3>
<?php echo $this->Form->create('Post', array('type' => 'file', 'url' => 'post')); ?>
    <?php echo $this->Form->input('Post.title', array('label' => 'タイトル')); ?>
    <?php echo $this->Form->input('Post.body', array('label' => '本文')); ?>
    <?php echo $this->Form->input('Post.photo', array('type' => 'file', 'label' => '投稿画像')); ?>
    <?php echo $this->Form->input('Post.photo_dir', array('type' => 'hidden')); ?>
<?php echo $this->Form->end('Submit'); ?>
