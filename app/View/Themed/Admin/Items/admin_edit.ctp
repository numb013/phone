<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('Item', array('type' => 'file', 'url' => 'edit')); ?>
    <?php echo $this->Form->input('id'); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>アイテム名</th>
        <td>
          <?php echo $this->Form->input('item_name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>

      <tr>
        <th>価格</th>
        <td>
          <?php echo $this->Form->input('price', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>サイズ</th>
        <td>
          <?php
            echo $this->Form->input('Item.size', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'size',
                'options' => $size,
            ));
          ?>
        </td>
      </tr>


      <tr>
        <th>ジャンル</th>
        <td>
          <?php
            echo $this->Form->input('genre', array(
                'options' => $genre,
                'label' => false,
                'div' => false,
                'empty' => '選択してください'
            ));
           ?>
        </td>
      </tr>
      <tr>
        <tr>
          <td>
            画像
            <input type="button" value="追加" id="btn" onclick="addPhoto();">
          </td>
          <td id="txt">
            <?php echo $this->Form->input('Image.0', array('type' => 'file', 'label' => false)); ?>
          </td>
        </tr>
        <tr>
          <td></td>
          <td id="show">
          </td>
        </tr>
        <?php if(!empty($this->request->data['Image'])):?>
          <?php foreach ($this->request->data['Image'] as $key => $phot): ?>
            <tr>
              <td> 画像</td>
              <td>
                <?php  echo $this->Html->image($phot['url'] ,array('width' => '15%' )); ?>
                <?php echo $this->Form->input('Check.'.$key.'.photo', array(
                  'id' => 'phpto'.$key,
                  'onclick'=> "photodelete('phpto".$key."')",
                  'type' => 'checkbox',
                  'label' => '削除2',
                  'div' => false,
                  'value' => $phot['url']
                  )); ?>
              </td>
            </tr>
            <?php echo $this->Form->hidden('BeforeImage]['.$key.'][id]', array('value' => $phot['id'])); ?>
            <?php echo $this->Form->hidden('BeforeImage]['.$key.'][url]', array('value' => $phot['url'])); ?>
          <?php endforeach; ?>
        <?php endif;?>
        </tr>
      <tr>
        <th>テキスト</th>
        <td><?php echo $this->Form->textarea('Item.item_text', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 5, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th> アイテムジャンル</th>
        <td>
          <?php
            echo $this->Form->input('Item.item_genre', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'checkbox',
                'options' => $item_genres,
            ));
          ?>
        </td>
      </tr>
      <tr>
        <th> シーズン</th>
        <td>
          <?php
            echo $this->Form->input('Item.season', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'season',
                'options' => $seasons,
            ));
          ?>
        </td>
      </tr>

      <tr>
        <th>セール</th>
        <td>
            <?php
              $options = array('0' => 'なし', '1' => 'あり');
              echo $this->Form->input('Item.sale_flag', array(
                  'legend' => false,
                  'type' => 'radio',
                  'options' => $options,
                 'legend' => false,
                 'class' => 'sale_flag',
                  'div' => false
              ));
             ?>
        </td>
      </tr>      
      
      <tr class="discount_tr" style="display: none;">
          <td>割引</td>
          <td>
            <?php
                echo $this->Form->input('Item.discount', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'discount',
                'options' => $discounts,
            ));
          ?>
          </td>
        </tr>

    </table>
    <?php
    if (!empty($this->request->data['photo_dele'])) {
      foreach ($this->request->data['photo_dele'] as $key => $PhotoDele) {
        echo $this->Form->hidden('photo_dele]['.$key, array('value' => $PhotoDele));
      }
    } elseif (!empty($this->request->data['Check'])) {
        foreach ($this->request->data['Check'] as $key => $CheckPhoto) {
          echo $this->Form->hidden('photo_dele]['.$key, array('value' => $CheckPhoto['photo']));
        }
      }
    ?>

    <div class="buttom_edit" style="float:left; margin-right:50px;">
      <?php echo $this->Form->end('submit') ;?>
    </div>

    <?php echo $this->Html->link('戻る', array('controller' => 'Items', 'action' => 'index')); ?>

    <script type="text/javascript">
        var sale_flag = $(".sale_flag:checked").val();
        if (sale_flag == 1) {
            $('.discount_tr').css('display', 'block');
        }
        $('.sale_flag').click(function(){
            var value = $(this).val();
            if (value == 1) {
                $('.discount_tr').css('display', 'block');
            } else {
                $('.discount_tr').css('display', 'none');
            }
        });
    </script>

  </body>
</html>
