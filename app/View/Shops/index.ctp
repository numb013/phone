<br>
<br>
<br>

<div class="col-md-12 text-center">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <tr>
          <th>店名</th>
          <td><?php echo $data['Shop']['name']; ?></td>
          <?php echo $this->Form->hidden('Shop.name', array('value' => $data['Shop']['name'])); ?>
        </tr>
        <tr>
          <th>画像</th>
          <td>
            <?php if(!empty($data['Image'])):?>
              <?php foreach ($data['Image'] as $key => $photo): ?>
                <?php echo $this->Html->image($photo['url'] ,array('width' => '15%' )); ?>
                <?php if(!empty($photo)):?>
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
        </tr>
        <tr>
          <th>郵便番号</th>
          <td><?php echo $data['Shop']['zip']; ?></td>
        </tr>
        <tr>
          <th>住所1</th>
          <td><?php echo $data['Shop']['address1']; ?></td>
        </tr>
        <tr>
          <th>住所2</th>
          <td><?php echo $data['Shop']['address2']; ?></td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td><?php echo $data['Shop']['tel']; ?></td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td><?php echo $data['Shop']['mail_address']; ?></td>
        </tr>
        <tr>
          <th>地図</th>
          <td><?php echo '<iframe src='.$data['Shop']['map_url'].'width="90%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'; ?></td>
        </tr>
        <tr>
          <th>テキスト</th>
          <td><?php echo $data['Shop']['text']; ?></td>
        </tr>
    </table>    
    
    
    
</div>


