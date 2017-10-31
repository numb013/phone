<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('Rsses', array('type' => 'file', 'url' => 'edit')); ?>
    <?php echo $this->Form->hidden('Rss.id', array('value' => $this->request->data['Rss']['id'])); ?>

<?php

//echo '<pre>';
//print_r($this->request->data);
//echo '</pre>';


?>


    <table>
      <tr>
        <th>識別フラグ</th>
        <td>
            <?php
                $options = array('0' => '個別', '1' => 'RSS');
                $attributes = array('value' => $this->request->data['Rss']['rss_flag']);
                echo $this->Form->radio('Rss.rss_flag', $options, $attributes);
            ?>
        </td>
      </tr>
        <tr>
        <th>タイトル</th>
        <td>
          <?php echo $this->Form->input('Rss.title', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>URL</th>
        <td>
          <?php echo $this->Form->input('Rss.url', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
    </table>
    <?php echo $this->Form->end('submit'); ;?>
    <?php echo $this->Html->link('戻る', array('controller' => 'Rsses', 'action' => 'index')); ?>
  </body>
</html>
