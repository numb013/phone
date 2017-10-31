<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <p>MySampleData Edit Form.</p>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <td>id</td>
        <td><?php echo $data['Genre']['id']; ?></td>
      </tr>
      <tr>
        <td>ジャンル名</td>
        <td><?php echo $data['Genre']['name']; ?></td>
      </tr>
    </table>
    <?php echo $this->Html->link('戻る', array('controller' => 'Genres', 'action' => 'index')); ?>
  </body>
</html>
