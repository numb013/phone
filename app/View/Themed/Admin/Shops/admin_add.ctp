<html>
  <head>
    <title>性格</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
      <h1>Add Page</h1>
    <?php echo $this->Form->create('Shops', array('type' => 'file', 'url' => 'add')); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>店名</th>
        <td>
          <?php echo $this->Form->input('name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>
           画像
          <input type="button" value="追加" id="btn" onclick="addPhoto();">
        </th>
        <td id="txt">
          <?php echo $this->Form->input('Image.0', array('type' => 'file', 'label' => false)); ?>
        </td>
      </tr>
      <tr>
        <th></th>
        <td id="show">
        </td>
      </tr>
      <?php if(!empty($this->request->data['Image'])):?>
        <?php foreach ($this->request->data['Image'] as $key => $photo): ?>
          <tr>
            <th> 画像</th>
          <td>
            <?php  echo $this->Html->image($photo['url'] ,array('width' => '15%' )); ?>
            <?php echo $this->Form->input('Check.'.$key.'.photo', array(
              'id' => 'phpto'.$key,
              'onclick'=> "photodelete('phpto".$key."')",
              'type' => 'checkbox',
              'label' => '削除',
              'div' => false,
              'class' => 'phptos',
              'value' => $photo['url']
            )); ?>
          </td>
        </tr>
         <?php endforeach; ?>
       <?php endif;?>
      <tr>
        <th>営業時間</th>
        <td>
        <?php
            echo $this->Form->input('business_hour_start', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'size',
                'options' => $business_hour,
            ));
          ?>
            ～
        <?php
            echo $this->Form->input('business_hour_end', array(
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
          <?php echo $this->Form->input('zip', array('name' => 'zip', 'label' => false, 'div' => false, 'onKeyUp' => "AjaxZip3.zip2addr(this,'','address1','address1')")); ?>
        </td>
      </tr>
      <tr>
        <th>住所1</th>
        <td>
          <?php echo $this->Form->input('address1', array('name' => 'address1', 'label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>住所2</th>
        <td>
          <?php echo $this->Form->input('address2', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>
          <?php echo $this->Form->input('tel', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>
          <?php echo $this->Form->input('mail_address', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>グーグルマップ<br>埋め込みURLのダブルクォーテーションの部分のみ</th>
        <td>
          <?php echo $this->Form->input('map_url', array('type' => 'textarea', 'label' => false, 'div' => false, 'escape' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>テキスト</th>
        <td>
          <?php echo $this->Form->input('text', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
    </table>
    <?php echo $this->Form->end('Submit'); ?>
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
