<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <h1>Edit Page</h1>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <tr>
          <td >アイテム名</td>
          <td><?php echo $data['Item']['item_name']; ?></td>
        </tr>
        <tr>
          <td >価格</td>
          <td><?php echo $data['Item']['price']; ?></td>
        </tr>
        <tr>
          <td>サイズ</td>
          <td>
              <?php echo $size[$data['Item']['size']]; ?>
          </td>
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
          <td>ジャンル</td>
          <td><?php echo $genre[$data['Item']['genre'][0]]; ?></td>
        </tr>
        <tr>
          <td>テキスト</td>
          <td><?php echo $data['Item']['item_text']; ?></td>
        </tr>
        <tr>
          <td>アイテムジャンル</td>
          <td>
            <?php if(!empty($data['Item']['item_genre'])):?>
              <?php $count = 0; ?>
              <?php foreach ($data['Item']['item_genre'] as $key => $personal): ?>
              <?php if ($count == '0') {  echo ''; } else { echo '/'; } ; ?>
              <?php echo $item_genres[$personal]; ?>
              <?php $count++ ; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td>シーズン</td>
          <td>
              <?php echo $seasons[$data['Item']['season']]; ?>
          </td>
        </tr>
        <tr>
          <td>セール</td>
          <td>
            <?php
                echo $data['Item']['sale_flag'] == 0 ? 'なし':'あり';
            ?>
          </td>
        </tr>
        <?php if ($data['Item']['sale_flag'] != 0): ?>
            <tr>
              <td>割引</td>
              <td>
                <?php
                    echo $data['Item']['discount'][0] != '' ? $discounts[$data['Item']['discount'][0]] :'なし';
                ?>
              </td>
            </tr>
        <?php endif; ?>
        <tr>
          <td>編集</td>
          <td><?php echo $this->Html->link('編集', array('controller' => 'Items', 'action' => 'edit', $data['Item']['id'])); ?></td>
        </tr>
    </table>
    <?php echo $this->Html->link('戻る', array('controller' => 'Items', 'action' => 'index')); ?>
  </body>
</html>
