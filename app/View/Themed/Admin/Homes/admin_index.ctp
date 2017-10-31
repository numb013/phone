<?php echo $this->Form->create('Home', array('type' => 'file', 'url' => 'index')); ?>
    <?php echo $this->Html->link('新規作成', array('controller' => 'Homes', 'action' => 'add')); ?>
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
        <th>タイトル１<?php echo $this->Paginator->sort('id');?></th>
        <th>タイトル２</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($datas as $data): ?>
      <tr>
          <td><?php echo $data['Home']['title1']; ?></td>
          <td><?php echo $data['Home']['title2']; ?></td>
          <td><?php echo $this->Html->link('詳細', array('controller' => 'Homes', 'action' => 'detail', $data['Home']['id'])); ?></td>
          <td><?php echo $this->Html->link('編集', array('controller' => 'Homes', 'action' => 'edit', $data['Home']['id'])); ?></td>
          <td><?php echo $this->Html->link('削除', array('controller' => 'Homes', 'action' => 'delete', $data['Home']['id'])); ?></td>
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
