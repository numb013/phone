<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('Genres', array('type' => 'file', 'url' => 'edit')); ?>
    <?php echo $this->Form->hidden('Genre.id', array('value' => $this->request->data['Genre']['id'])); ?>
    <table>
      <tr>
        <th>ジャンル名</th>
        <td>
          <?php echo $this->Form->input('Genre.name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
    </table>
    <?php echo $this->Form->end('submit'); ;?>
    <?php echo $this->Html->link('戻る', array('controller' => 'Genres', 'action' => 'index')); ?>
  </body>
</html>
