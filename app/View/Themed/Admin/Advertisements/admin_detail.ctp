<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <h1>Edit Page</h1>

    <?php

    //echo pr($this->request->data);
    //exit();

     ?>

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <tr>
            <th>表示</th>
            <td>
                <?php 
                    if ($data['Advertisement']['display_flag'] == 0) {
                        echo '非表示';
                    } else {
                        echo '表示';
                    }
                ?>
            </td>
          </tr>
        <tr>
          <td >広告名</td>
          <td><?php echo $data['Advertisement']['name']; ?></td>
        </tr>
        <tr>
          <td>画像</td>
          <td>
            <?php if(!empty($data['Image'])):?>
              <?php foreach ($data['Image'] as $key => $image): ?>
                <?php if(!empty($image['Image'])):?>
                  <?php echo $this->Html->image($image['Image']['url'] ,array('width' => '15%' )); ?>
                <?php else: ?>
                  なし
                <?php endif; ?>
              <?php endforeach; ?>
            <?php else: ?>
              なし
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td>編集</td>
          <td><?php echo $this->Html->link('編集', array('controller' => 'Advertisements', 'action' => 'edit', $data['Advertisement']['id'])); ?></td>
        </tr>
    </table>
    <?php echo $this->Html->link('戻る', array('controller' => 'Advertisements', 'action' => 'index')); ?>
  </body>
</html>
