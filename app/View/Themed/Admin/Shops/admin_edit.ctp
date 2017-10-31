<html>
<?php

//echo pr($this->request->data);

?>
  <head>
    <title>性格</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
      <h1>Add Page</h1>
    <?php echo $this->Form->create('Shops', array('type' => 'file', 'url' => 'edit')); ?>
      <?php echo $this->Form->input('Shop.id'); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>店名</th>
        <td>
          <?php echo $this->Form->input('Shop.name', array('label' => false, 'div' => false)); ?>
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
          <?php foreach ($this->request->data['Image'] as $key => $photo): ?>
            <tr>
              <td> 画像</td>
              <td>
                <?php  echo $this->Html->image($photo['url'] ,array('width' => '15%' )); ?>
                <?php echo $this->Form->input('Check.'.$key.'.photo', array(
                  'id' => 'phpto'.$key,
                  'onclick'=> "photodelete('phpto".$key."')",
                  'type' => 'checkbox',
                  'label' => '削除2',
                  'div' => false,
                  'value' => $photo['url']
                  )); ?>
              </td>
            </tr>
            <?php echo $this->Form->hidden('Shop.BeforeImage]['.$key.'][id]', array('value' => $photo['id'])); ?>
            <?php echo $this->Form->hidden('Shop.BeforeImage]['.$key.'][url]', array('value' => $photo['url'])); ?>
          <?php endforeach; ?>
        <?php endif;?>
        </tr>
      <tr>
        <th>営業時間</th>
        <td>
        <?php
            echo $this->Form->input('Shop.business_hour_start', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'size',
                'options' => $business_hour,
            ));
          ?>
            ～
        <?php
            echo $this->Form->input('Shop.business_hour_end', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'size',
                'options' => $business_hour,
            ));
          ?>
        </td>
      </tr>
      <tr>
        <th>郵便番号</th>
        <td>
          <?php echo $this->Form->input('Shop.zip', array('name' => 'zip', 'label' => false, 'div' => false, 'onKeyUp' => "AjaxZip3.zip2addr(this,'','Shop.address1','Shop.address1')")); ?>
        </td>
      </tr>
      <tr>
        <th>住所1</th>
        <td>
          <?php echo $this->Form->input('Shop.address1', array('name' => 'Shop.address1', 'label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>住所2</th>
        <td>
          <?php echo $this->Form->input('Shop.address2', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>
          <?php echo $this->Form->input('Shop.tel', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>
          <?php echo $this->Form->input('Shop.mail_address', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>グーグルマップ<br>埋め込みURLのダブルクォーテーションの部分のみ</th>
        <td>
          <?php echo $this->Form->input('Shop.map_url', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>テキスト</th>
        <td>
          <?php echo $this->Form->input('Shop.text', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
    </table>
    <?php echo $this->Form->end('保存する'); ?>
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
