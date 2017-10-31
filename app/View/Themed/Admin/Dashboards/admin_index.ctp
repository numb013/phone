<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <p>MySampleData Index View.</p>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>ホームテキスト</th>
        <td><?php echo $this->Html->link('一覧リンク', array('controller' => 'Homes', 'action' => 'index')); ?></td>
      </tr>
      <tr>
        <th>ブログ</th>
        <td><?php echo $this->Html->link('一覧リンク', array('controller' => 'Blogs', 'action' => 'index')); ?></td>
      </tr>
    <tr>
        <th>Rss</th>
        <td><?php echo $this->Html->link('一覧リンク', array('controller' => 'Rsses', 'action' => 'index')); ?></td>
    </tr>
    <tr>
        <th>お問い合わせ</th>
        <td><?php echo $this->Html->link('一覧リンク', array('controller' => 'Cotracts', 'action' => 'index')); ?></td>
    </tr>
    </table>
  </body>
</html>
