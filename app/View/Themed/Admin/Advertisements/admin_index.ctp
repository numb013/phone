<?php echo $this->Form->create('Advertisement', array('type' => 'file', 'url' => 'index')); ?>

    <?php echo $this->Html->link('新規作成', array('controller' => 'Advertisements', 'action' => 'add')); ?>
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
        <th>表示</th>
        <th>広告名</th>
        <th>URL</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($datas as $data): ?>      
      　<tr>
            <td>
                <?php 
                    if ($data['Advertisement']['display_flag'] == 0) {
                        echo '非表示';
                    } else {
                        echo '表示';
                    }
                ?>
            </td>
            <td><?php echo $data['Advertisement']['name']; ?></td>
            <td><?php echo $data['Advertisement']['text_url']; ?></td>
            <td><?php echo $this->Html->link('詳細', array('controller' => 'Advertisements', 'action' => 'detail', $data['Advertisement']['id'])); ?></td>
            <td><?php echo $this->Html->link('編集', array('controller' => 'Advertisements', 'action' => 'edit', $data['Advertisement']['id'])); ?></td>
            <td><?php echo $this->Html->link('削除', array('controller' => 'Advertisements', 'action' => 'delete', $data['Advertisement']['id'])); ?></td>
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
