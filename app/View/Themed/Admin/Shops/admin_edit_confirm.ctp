<html>
  <head>
    <title>性格</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
<?php
echo pr($data);

?>
    <h1>Add Pagedddddd</h1>
    <?php echo $this->Form->create('Shops', array('type' => 'file', 'url' => 'edit_regist')); ?>
    <?php echo $this->Form->input('Shop.id'); ?>
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
                    <?php //echo $this->Html->image("top/comp25.jpg", array('width' => '15%')); ?>
                    <?php if (!empty($photo['name'])):?>
                      <?php echo $this->Form->hidden('Image.'.$key.'.Image.name', array('value' => $photo['name'])); ?>
                      <?php echo $this->Form->hidden('Image.'.$key.'.Image.type', array('value' => $photo['type'])); ?>
                      <?php echo $this->Form->hidden('Image.'.$key.'.Image.tmp_name', array('value' => $photo['tmp_name'])); ?>
                      <?php echo $this->Form->hidden('Image.'.$key.'.Image.error', array('value' => $photo['error'])); ?>
                      <?php echo $this->Form->hidden('Image.'.$key.'.Image.size', array('value' => $photo['size'])); ?>
                      <?php echo $this->Form->hidden('Image.'.$key.'.Image.url', array('value' => $photo['url'])); ?>
                    <?php endif; ?>
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
    <div class="btn-area">
        <div class="btn gray-b">
                <?php echo $this->Form->submit('戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
        </div>
        <div class="btn">
                <?php echo $this->Form->submit('登録', array('name' => 'regist', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
        </div>
    </div>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Shops', 'action' => 'index')); ?>


    <script type="text/javascript">
      function photodelete(chkID){
        Myid=document.getElementById(chkID);
        if(Myid.checked == true){
          myRet = confirm("画像を削除してもいいですか？");
          if ( myRet == true ){
             Myid.parentNode.style.display = 'none';
          }　else {
            Myid.checked = false;
          }
        }
      }

      var todoNum = 1;
      function addPhoto(){
          var txt = '<div id="'+ 'Image' + todoNum + '">'
              + '<?php echo $this->Form->input("Image.'  + todoNum +  '", array("type" => "file", "label" => false)); ?>'
              + '<input type="button" value="削除" onclick="del(' + todoNum + ');">'
              + '</div>';
          document.getElementById('show').innerHTML
              = document.getElementById('show').innerHTML + txt;
          todoNum++;
      }
      function del(todoNum) {
        var photodel = 'Image' + todoNum;
        var dom_obj=document.getElementById(photodel);
        var dom_obj_parent=dom_obj.parentNode;
        dom_obj_parent.removeChild(dom_obj);
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
