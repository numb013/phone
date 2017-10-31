<html>
  <head>
  </head>
  <body>
    <?php echo $this->Html->link('新規作成', array('controller' => 'Genres', 'action' => 'add')); ?>
    <div class="job-count">
      <?php echo $this->Paginator->counter(array(
        'format' => '<p>全{:count}件中/{:start}-{:end}件ヒット</p>'
      ));?>
    </div>
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
        <th><?php echo $this->Paginator->sort('id', 'ID');?></th>
        <th><?php echo $this->Paginator->sort('genre', 'ジャンル名');?></th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($datas as $data): ?>
        <tr>
          <td><?php echo $data['Genre']['id']; ?></td>
          <td><?php echo $data['Genre']['name']; ?></td>
          <td><?php echo $this->Html->link('詳細', array('controller' => 'Genres', 'action' => 'admin_detail', $data['Genre']['id'])); ?></td>
          <td><?php echo $this->Html->link('編集', array('controller' => 'Genres', 'action' => 'admin_edit', $data['Genre']['id'])); ?></td>
          <td><?php echo $this->Html->link('削除', array('controller' => 'Genres', 'action' => 'admin_delete', $data['Genre']['id'])); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <div class="job-count">
      <?php echo $this->Paginator->counter(array(
        'format' => '<p>全{:count}件中/{:start}-{:end}件ヒット</p>'
      ));?>
    </div>
    <div class="job-page">
      <?php
        echo $this->Paginator->first('<< ');
        echo $this->Paginator->numbers(
          array('separator' => '/','modulus'=>2));
        echo $this->Paginator->last(' >>');
      ?>
    </div>
  </body>
</html>
