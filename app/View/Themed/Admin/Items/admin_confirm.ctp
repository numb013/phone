<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>


      
      
    <h1>Edit Page</h1>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('Item', array('type' => 'file', 'url' => 'regist')); ?>
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <tr>
            <th>アイテム名</th>
            <td><?php echo $data['Item']['item_name']; ?></td>
            <?php echo $this->Form->hidden('Item.item_name', array('value' => $data['Item']['item_name'])); ?>
          </tr>
          <tr>
            <th>価格</th>
            <td><?php echo $data['Item']['price']; ?></td>
            <?php echo $this->Form->hidden('Item.price', array('value' => $data['Item']['price'])); ?>
          </tr>
          <tr>
            <th>サイズ</th>
            <td><?php echo $data['Item']['size'][0]; ?></td>
            <?php echo $this->Form->hidden('Item.size', array('value' => $data['Item']['size'][0])); ?>
          </tr>
          <tr>
            <th>ジャンル</th>
            <td><?php echo $data['Item']['genre']; ?></td>
            <?php echo $this->Form->hidden('Item.genre', array('value' => $data['Item']['genre'])); ?>
          </tr>
          <tr>
            <th>画像</th>
            <td>
              <?php if(!empty($data['Image'])):?>
                <?php foreach ($data['Image'] as $key => $photo): ?>
                  <?php if(!empty($photo)):?>
                    <?php echo $this->Html->image($photo['url'] ,array('width' => '15%' )); ?>
                    <?php echo $this->Form->hidden('Image.'.$key.'.name', array('value' => $photo['name'])); ?>
                    <?php echo $this->Form->hidden('Image.'.$key.'.type', array('value' => $photo['type'])); ?>
                    <?php echo $this->Form->hidden('Image.'.$key.'.tmp_name', array('value' => $photo['tmp_name'])); ?>
                    <?php echo $this->Form->hidden('Image.'.$key.'.error', array('value' => $photo['error'])); ?>
                    <?php echo $this->Form->hidden('Image.'.$key.'.size', array('value' => $photo['size'])); ?>
                    <?php echo $this->Form->hidden('Image.'.$key.'.url', array('value' => $photo['url'])); ?>
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
            <th>テキスト</th>
            <td><?php echo $data['Item']['item_text']; ?></td>
            <?php echo $this->Form->hidden('Item.item_text', array('value' => $data['Item']['item_text'])); ?>
          </tr>
          <tr>
            <th>アイテムジャンル</th>
            <td>
              <?php if(!empty($data['Item']['item_genre'])):?>
                <?php foreach ($data['Item']['item_genre'] as $key => $item_genre): ?>
                  <?php echo '/'; ?>
                  <?php echo $item_genres[$item_genre]; ?>
                  <?php echo $this->Form->hidden('item_genre][]', array('value' => $item_genre)); ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </td>
          </tr>

          <tr>
            <th>シーズン</th>
            <td><?php echo $data['Item']['season'][0]; ?></td>
            <?php echo $this->Form->hidden('Item.season', array('value' => $data['Item']['season'][0])); ?>
          </tr>
          <tr>
            <th>セール</th>
            <td>
                <?php
                    echo $data['Item']['sale_flag'] == 0 ? 'なし':'あり';
                ?>
            </td>
            <?php echo $this->Form->hidden('Item.sale_flag', array('value' => $data['Item']['sale_flag'])); ?>
          </tr>
          <?php if ($data['Item']['sale_flag'] == 1): ?>
            <tr>
               <th>割引</th>
               <td><?php echo $discounts[$data['Item']['discount'][0]]; ?></td>
               <?php echo $this->Form->hidden('Item.discount', array('value' => $data['Item']['discount'][0])); ?>
            </tr>
           <?php endif; ?>      
      </table>
    <div class="btn-area">
        <div class="btn gray-b">
                <?php echo $this->Form->submit('戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
        </div>
        <div class="btn">
                <?php echo $this->Form->submit('登録', array('name' => 'regist', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
        </div>
    </div>
    <?php echo $this->Html->link('一覧', array('controller' => 'Items', 'action' => 'admin_index')); ?>
  </body>
</html>
