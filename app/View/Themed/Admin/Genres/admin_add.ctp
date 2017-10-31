<html>
  <head>
    <title>Index Page</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h1>Add Page</h1>
    <?php echo $this->Form->create('Genre', array('type' => 'file', 'url' => 'add')); ?>
    <table>
      <tr>
        <th>ジャンル名</th>
        <td>
          <?php echo $this->Form->input('name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
    </table>
    <?php echo $this->Form->end('保存'); ?>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Genres', 'action' => 'index')); ?>
  </body>
</html>
