<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('ItemGenres', array('type' => 'file', 'url' => 'edit')); ?>
    <?php echo $this->Form->hidden('ItemGenre.id', array('value' => $this->request->data['ItemGenre']['id'])); ?>
    <table>
      <tr>
        <th>アイテムジャンル名</th>
        <td>
          <?php echo $this->Form->input('ItemGenre.name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
    </table>
    <?php echo $this->Form->end('submit'); ;?>
    <?php echo $this->Html->link('戻る', array('controller' => 'ItemGenres', 'action' => 'index')); ?>
  </body>
</html>
