<html>
  <head>
    <title>性格</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h1>Add Pagedddddd</h1>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <tr>
          <th>職業名</th>
          <td><?php echo $data['Shop']['name']; ?></td>
          <?php echo $this->Form->hidden('Shop.name', array('value' => $data['Shop']['name'])); ?>
        </tr>
          <tr>
            <td>画像</td>
            <td>
              <?php if(!empty($data['Image'])):?>
                <?php foreach ($data['Image'] as $key => $photo): ?>
                  <?php if(!empty($photo)):?>
                    <?php echo $this->Html->image($photo['url'] ,array('width' => '15%' )); ?>
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
          <th>営業時間</th>
          <td><?php echo $business_hour[$data['Shop']['business_hour_start'][0]].'～'.$business_hour[$data['Shop']['business_hour_end'][0]]; ?></td>
          <?php echo $this->Form->hidden('Shop.business_hour_start', array('value' => $data['Shop']['business_hour_start'][0])); ?>
          <?php echo $this->Form->hidden('Shop.business_hour_end', array('value' => $data['Shop']['business_hour_end'][0])); ?>
        </tr>
        <tr>
          <th>郵便番号</th>
          <td><?php echo $data['Shop']['zip']; ?></td>
          <?php echo $this->Form->hidden('Shop.zip', array('value' => $data['Shop']['zip'])); ?>
        </tr>
        <tr>
          <th>住所1</th>
          <td><?php echo $data['Shop']['address1']; ?></td>
          <?php echo $this->Form->hidden('Shop.address1', array('value' => $data['Shop']['address1'])); ?>
        </tr>
        <tr>
          <th>住所2</th>
          <td><?php echo $data['Shop']['address2']; ?></td>
          <?php echo $this->Form->hidden('Shop.address2', array('value' => $data['Shop']['address2'])); ?>
        </tr>
        <tr>
          <th>電話番号</th>
          <td><?php echo $data['Shop']['tel']; ?></td>
          <?php echo $this->Form->hidden('Shop.tel', array('value' => $data['Shop']['tel'])); ?>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td><?php echo $data['Shop']['mail_address']; ?></td>
          <?php echo $this->Form->hidden('Shop.mail_address', array('value' => $data['Shop']['mail_address'])); ?>
        </tr>
        <tr>
          <th>グーグルマップ</th>
          <td><?php echo $data['Shop']['map_url']; ?></td>
          <?php echo $this->Form->hidden('Shop.map_url', array('value' => $data['Shop']['map_url'])); ?>
        </tr>
        <tr>
          <th>地図</th>
          <td><?php echo '<iframe src='.$data['Shop']['map_url'].'width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'; ?></td>
        </tr>
        <tr>
          <th>テキスト</th>
          <td><?php echo $data['Shop']['text']; ?></td>
          <?php echo $this->Form->hidden('Shop.text', array('value' => $data['Shop']['text'])); ?>
        </tr>
    </table>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Shops', 'action' => 'index')); ?>
  </body>
</html>
