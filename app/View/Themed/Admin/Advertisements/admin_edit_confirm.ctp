<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <h1>Edit Page</h1>
    <?php echo $this->Form->create('Advertisement', array('type' => 'file', 'url' => 'edit_regist')); ?>
    <?php echo $this->Form->input('id'); ?>
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
            <?php echo $this->Form->hidden('Advertisement.display_flag', array('value' => $data['Advertisement']['display_flag'])); ?>
          </tr>
          <tr>
            <td>広告名</td>
            <td><?php echo $data['Advertisement']['name']; ?></td>
            <?php echo $this->Form->hidden('Advertisement.name', array('value' => $data['Advertisement']['name'])); ?>
          </tr>
          <tr>
            <td>テキストURL</td>
            <td><?php echo $data['Advertisement']['text_url']; ?></td>
            <?php echo $this->Form->hidden('Advertisement.text_url', array('value' => $data['Advertisement']['text_url'])); ?>
          </tr>
          <tr>
            <td>画像</td>
            <td>
              <?php if(!empty($data['Image'])):?>
                    <?php echo $this->Html->image($data['Image']['url'] ,array('width' => '15%' )); ?>
                    <?php if (!empty($data['Image']['name'])):?>
                      <?php echo $this->Form->hidden('Image.name', array('value' => $data['Image']['name'])); ?>
                      <?php echo $this->Form->hidden('Image.type', array('value' => $data['Image']['type'])); ?>
                      <?php echo $this->Form->hidden('Image.tmp_name', array('value' => $data['Image']['tmp_name'])); ?>
                      <?php echo $this->Form->hidden('Image.error', array('value' => $data['Image']['error'])); ?>
                      <?php echo $this->Form->hidden('Image.size', array('value' => $data['Image']['size'])); ?>
                      <?php echo $this->Form->hidden('Image.url', array('value' => $data['Image']['url'])); ?>
                    <?php endif; ?>
              <?php else: ?>
                なし
              <?php endif; ?>
            </td>
          </tr>
        </table>
        <div class="btn-area">
        <div class="btn gray-b">
                <?php echo $this->Form->submit('戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
        </div>
        <div class="btn">
                <?php echo $this->Form->submit('登録', array('name' => 'regist', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
        </div>
  	</div>
    <?php echo $this->Html->link('一覧', array('controller' => 'Advertisements', 'action' => 'index')); ?>
  </body>
</html>
