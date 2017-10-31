<html>
  <head>
    <title>Index Page</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h1>Add Page</h1>
    <?php echo $this->Form->create('Rss', array('type' => 'file', 'url' => 'add')); ?>
    <table>
      <tr>
        <th>識別フラグ</th>
        <td>
            <?php
                $options = array('0' => '個別', '1' => 'RSS');
                $attributes = array('legend' => false);
                echo $this->Form->radio('rss_flag', $options, $attributes);
            ?>
        </td>
      </tr>
      <tr>
        <th>タイトル</th>
        <td>
          <?php echo $this->Form->input('title', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>URL</th>
        <td>
          <?php echo $this->Form->input('url', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>

      
    </table>
    <?php echo $this->Form->end('Submit'); ?>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Rsses', 'action' => 'index')); ?>
  </body>
</html>

