<html>
  <head>
  </head>
  <body>
    <?php echo $this->Html->link('新規作成', array('controller' => 'ItemGenres', 'action' => 'add')); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
          <th>ID</th>
        <th>アイテムジャンル名</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($datas as $data): ?>
        <tr>
          <td><?php echo $data['ItemGenre']['id']; ?></td>
          <td><?php echo $data['ItemGenre']['name']; ?></td>
          <td><?php echo $this->Html->link('詳細', array('controller' => 'ItemGenres', 'action' => 'detail', $data['ItemGenre']['id'])); ?></td>
          <td><?php echo $this->Html->link('編集', array('controller' => 'ItemGenres', 'action' => 'edit', $data['ItemGenre']['id'])); ?></td>
          <td><?php echo $this->Html->link('削除', array('controller' => 'ItemGenres', 'action' => 'delete', $data['ItemGenre']['id'])); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>
