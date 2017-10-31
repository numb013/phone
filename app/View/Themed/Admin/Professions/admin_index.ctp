<?php echo $this->Form->create('Profession', array('type' => 'file', 'url' => 'index')); ?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
      <?php echo $this->Form->input('profession_name', array('label' => false, 'div' => false)); ?>
    </td>
  </tr>



<!--
  <tr>
    <td>性格など</td>
    <td>
      <?php
        echo $this->Form->input('Profession.check_personal', array(
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
        echo $this->Form->input('Profession.check_like', array(
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
-->



  <tr>
  <td>
    <?php echo $this->Form->end('検索'); ;?>
  </td>
  <td>
  </td>
  </tr>
</table>
    <?php echo $this->Html->link('新規作成', array('controller' => 'Professions', 'action' => 'add')); ?>
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
        <th>職業名<?php echo $this->Paginator->sort('id');?></th>
        <th>職業ジャンル</th>
        <th>動画</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>


      
      <?php foreach ($datas as $data): ?>


      
      
      <tr>
          <td><?php echo $data['Profession']['profession_name']; ?></td>
          <td><?php echo $genre[$data['Profession']['genre']]; ?></td>
          <td>
              <?php if ($data['Profession']['movie_flag'] == '1'): ?>
              <?php echo '<iframe width="120" height="100" src='.'https://www.youtube.com/embed/'.$data['Movie'][0]['movie_url'].' frameborder="0" allowfullscreen></iframe>' ?>
              <?php else: ?>
              なし
              <?php endif; ?>
          </td>
          <td><?php echo $this->Html->link('詳細', array('controller' => 'Professions', 'action' => 'detail', $data['Profession']['id'])); ?></td>
          <td><?php echo $this->Html->link('編集', array('controller' => 'Professions', 'action' => 'edit', $data['Profession']['id'])); ?></td>
          <td><?php echo $this->Html->link('削除', array('controller' => 'Professions', 'action' => 'delete', $data['Profession']['id'])); ?></td>
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
