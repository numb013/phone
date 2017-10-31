<?php echo $this->Form->create('Blog', array('type' => 'file', 'url' => 'index')); ?>
<!--<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td> 職業ジャンル</td>
    <td>
      <?php
        echo $this->Form->input('genre', array(
          'options' => $genre,
          'label' => false,
          'div' => false,
          'empty' => '選択してください'
        ));
       ?>
    </td>
  </tr>
  <tr>
    <td>職業名</td>
    <td>
      <?php echo $this->Form->input('blog_name', array('label' => false, 'div' => false)); ?>
    </td>
  </tr>


  <tr>
    <td>性格など</td>
    <td>
      <?php
        echo $this->Form->input('Blog.check_personal', array(
          'type' => 'select',
          'label' => false,
          'div' => false,
          'multiple'=> 'checkbox',
          'options' => $check_personals,
        ));
      ?>
    </td>
  </tr>
  <tr>
    <td>好きなこと</td>
    <td>
      <?php
        echo $this->Form->input('Blog.check_like', array(
          'type' => 'select',
          'label' => false,
          'div' => false,
          'multiple'=> 'checkbox',
          'options' => $check_likes,
        ));
      ?>
    </td>
  </tr>
  <tr>
    <td>コアレベル</td>
    <td>
      <?php
        echo $this->Form->input('core_status', array(
            'options' => array(0, 1, 2, 3, 4, 5),
            'label' => false,
            'div' => false,
            'empty' => '選択してください'
        ));
       ?>
    </td>
  </tr>




  <tr>
  <td>
    <?php echo $this->Form->end('検索'); ;?>
  </td>
  <td>
  </td>
  </tr>
</table>-->


    <?php echo $this->Html->link('新規作成', array('controller' => 'Blogs', 'action' => 'add')); ?>
    <?php echo $this->Paginator->counter(array(
      'format' => '<p>全{:count}件中/{:start}-{:end}件ヒット</p>'
    ));?>
    <div class="job-page">
      <?php
        echo $this->Paginator->first('<< ');
        echo $this->Paginator->numbers(
          array('separator' => '/','modulus'=>2));
        echo $this->Paginator->last(' >>');
      ?>
    </div>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>タイトル<?php echo $this->Paginator->sort('id');?></th>
        <th>内容</th>
        <th>公開</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($datas as $data): ?>
      <tr>
          <td><?php echo $data['Blog']['title']; ?></td>
          <td><?php echo $data['Blog']['text_1']; ?></td>
          <td>
              <?php if ($data['Blog']['release_flag'] == '1'): ?>
                公開
              <?php else: ?>
                未公開
              <?php endif; ?>
          </td>
          <td><?php echo $this->Html->link('詳細', array('controller' => 'Blogs', 'action' => 'detail', $data['Blog']['id'])); ?></td>
          <td><?php echo $this->Html->link('編集', array('controller' => 'Blogs', 'action' => 'edit', $data['Blog']['id'])); ?></td>
          <td><?php echo $this->Html->link('削除', array('controller' => 'Blogs', 'action' => 'delete', $data['Blog']['id'])); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <div class="job-page">
      <?php
        echo $this->Paginator->first('<< ');
        echo $this->Paginator->numbers(
          array('separator' => '/','modulus'=>2));
        echo $this->Paginator->last(' >>');
      ?>
    </div>
    <div class="job-page">
