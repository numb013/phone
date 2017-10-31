<html>
  <head>
    <title>Index Page</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <?php

//echo pr($related);
//echo pr($item_genres);


     ?>
    <h1>Add Page</h1>
    <?php echo $this->Form->create('Item', array('type' => 'file', 'url' => 'add')); ?>
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
        <?php foreach ($this->request->data['Image'] as $key => $phot): ?>
          <tr>
            <th> 画像</th>
          <td>
            <?php  echo $this->Html->image($phot['url'] ,array('width' => '15%' )); ?>
            <?php echo $this->Form->input('Check.'.$key.'.photo', array(
              'id' => 'phpto'.$key,
              'onclick'=> "photodelete('phpto".$key."')",
              'type' => 'checkbox',
              'label' => '削除',
              'div' => false,
              'class' => 'phptos',
              'value' => $phot['url']
            )); ?>
          </td>
        </tr>
         <?php endforeach; ?>
       <?php endif;?>
      <tr>
        <th>テキスト</th>
        <td><?php echo $this->Form->textarea('item_text', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
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
              echo $this->Form->input('sale_flag', array(
                  'legend' => false,
                  'type' => 'radio',
                  'value' => 0,
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
    <?php echo $this->Form->end('Submit'); ?>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Items', 'action' => 'admin_index')); ?>

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
