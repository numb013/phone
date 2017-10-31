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
    <?php echo $this->Form->create('Blog', array('type' => 'file', 'url' => 'add')); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>タイトル</th>
        <td>
          <?php echo $this->Form->input('title', array('label' => false, 'div' => false, 'style' => 'width:100%')); ?>
        </td>
      </tr>

      <tr>
        <th>
           画像
          <input type="button" value="追加" id="btn" onclick="addPhoto();">
        </th>
        <td id="txt">
          <?php echo $this->Form->input('Image.0', array('id' => 'idimage0', 'type' => 'file', 'label' => false, "class" => "imagclass")); ?>
            <span id="preview_area"></span>
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
        <th>テキスト１</th>
        <td><?php echo $this->Form->textarea('text_1', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th>テキスト２</th>
        <td><?php echo $this->Form->textarea('text_2', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th>テキスト３</th>
        <td><?php echo $this->Form->textarea('text_3', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th>テキスト４</th>
        <td><?php echo $this->Form->textarea('text_4', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th>公開フラグ</th>
        <td>
            <?php
                $options = array('0' => '未公開', '1' => '公開');
                $attributes = array('legend' => false);
                echo $this->Form->radio('release_flag', $options, $attributes);
            ?>
        </td>
      </tr>
    </table>
    <?php echo $this->Form->end('確認する'); ?>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Blogs', 'action' => 'admin_index')); ?>

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
              + '<?php echo $this->Form->input("Image.'  + todoNum +  '", array("id" => "idimage", "class" => "imagclass", "type" => "file", "label" => false)); ?>'
              + '<input type="button" value="削除" onclick="del(' + todoNum + ');">'
              + '<span id="preview_area"></span>'
              + '</div>';
              
         var $id = "idimage" + todoNum;
         var $preview_areaid = "preview_area" + todoNum;
         var txt = txt.replace("idimage", $id);
         var txt = txt.replace("preview_area", $preview_areaid);

          $('#show').append(txt);
          todoNum++;

          var number = (todoNum - 1);
          var imagID = "#idimage" + number;
          var preview_areaID = "#preview_area" + number;

        $(imagID).on('change', function(){ // 解説①
          var strFileInfo = $(imagID)[0].files[0]; // 解説②
          if(strFileInfo && strFileInfo.type.match('image.*')){ // 解説③

            var preview = "preview" + number;
            var previewid = "#preview" + number;
            var imgpreview = '<img id="preview" width="300" />'.replace("preview", preview);
            $(previewid).remove();  // 解説④
            $(preview_areaID).append(imgpreview); // 解説⑤

            fileReader = new FileReader(); // 解説⑥
            fileReader.onload = function(event){
              $(previewid).attr('src', event.target.result);
            }

            fileReader.readAsDataURL(strFileInfo); // 解説⑦
          }
        });

      }
      function del(todoNum) {
        var photodel = 'Image' + todoNum;
        var dom_obj=document.getElementById(photodel);
        var dom_obj_parent=dom_obj.parentNode;
        dom_obj_parent.removeChild(dom_obj);
      }

     $('#idimage0').on('change', function(){ // 解説①
       var strFileInfo = $('#idimage0')[0].files[0]; // 解説②
       if(strFileInfo && strFileInfo.type.match('image.*')){ // 解説③
 
         $('#preview').remove();  // 解説④
         $('#preview_area').append('<img id="preview" width="300" />'); // 解説⑤
 
         fileReader = new FileReader(); // 解説⑥
         fileReader.onload = function(event){
           $('#preview').attr('src', event.target.result);
         }
 
         fileReader.readAsDataURL(strFileInfo); // 解説⑦
       }
     });
    </script>
  </body>
</html>
