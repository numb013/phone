<html>
  <head>
  </head>
  <body>
    <?php echo $this->Html->link('新規作成', array('controller' => 'Rsses', 'action' => 'add')); ?>
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
        <th>種類</th>
        <th>タイトル</th>
        <th>URL</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($datas as $data): ?>
        <tr>
          <td><?php echo $data['Rss']['id']; ?></td>
          <td>
              <?php if ($data['Rss']['rss_flag'] == 1): ?>
                まとめ
              <?php else: ?>
                個別
              <?php endif; ?>
          </td>
          <td><?php echo $data['Rss']['title']; ?></td>
          <td><?php echo $data['Rss']['url']; ?></td>
          <td><?php echo $this->Html->link('編集', array('controller' => 'Rsses', 'action' => 'admin_edit', $data['Rss']['id'])); ?></td>
          <td><?php echo $this->Html->link('削除', array('controller' => 'Rsses', 'action' => 'admin_delete', $data['Rss']['id'])); ?></td>
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
