<html>
  <head>
    <title>性格</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h1>Add Page</h1>
    <?php echo $this->Form->create('ItemGenre', array('type' => 'file', 'url' => 'add')); ?>
    <table>
      <tr>
        <th>アイテムジャンル名</th>
        <td>
          <?php echo $this->Form->input('name', array('label' => false, 'div' => false)); ?>
        </td>
    </table>
    <?php echo $this->Form->end('Submit'); ?>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Professions', 'action' => 'index')); ?>
  </body>
</html>
