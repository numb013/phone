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
    <?php echo $this->Form->create('Profession', array('type' => 'file', 'url' => 'add')); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th> 職業名</th>
        <td>
          <?php echo $this->Form->input('profession_name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th> 職業ジャンル</th>
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
        <th> 職業内容</th>
        <td><?php echo $this->Form->textarea('job_content', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th>なり方</th>
        <td><?php echo $this->Form->textarea('job_step', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th>向いてる性格</th>
        <td><?php echo $this->Form->textarea('Profession.personality', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 5, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th>給料</th>
        <td><?php echo $this->Form->textarea('Profession.job_salary', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
      </tr>
      <tr>
        <th> 性格など</th>
        <td>
          <?php
            echo $this->Form->input('Profession.item_genre', array(
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
        <th> 好きなこと</th>
        <td>
          <?php
            echo $this->Form->input('Profession.genre', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'checkbox',
                'options' => $genres,
            ));
          ?>
        </td>
      </tr>

      <tr>
        <th>関連職業</th>
        <td>
          <?php
            echo $this->Form->input('Profession.related_profession', array(
                'type' => 'select',
                'label' => false,
                'div' => false,
                'multiple'=> 'checkbox',
                'options' => $related,
            ));
          ?>
        </td>
      </tr>
      <tr>
        <th> コアレベル</th>
        <td>
          <?php
            echo $this->Form->input('core_status', array(
                'options' => array(
                  '1' => '1',
                  '2' => '2',
                  '3' => '3',
                  '4' => '4',
                  '5' => '5'
                ),
                'label' => false,
                'div' => false,
                'empty' => '選択してください'
            ));
           ?>
          <div id="rateYo"></div>
        </td>
      </tr>
      <tr>
      <th>
        動画
        <input type="button" value="追加" id="btn" onclick="addMovie();">
      </th>
        <td>
          <?php echo $this->Form->input('Movie.0.movie_url', array('type' => 'text', 'label' => false, 'div' => false)); ?>
          <?php echo $this->Form->hidden('Movie.0.movie_uuid', array('value' => 'fast')); ?>
        </td>
      </tr>
      <tr>
        <th></th>
        <td id="movieshow">
        </td>
      </tr>
      <?php if(!empty($this->request->data['Movie'])):?>
        <?php foreach ($this->request->data['Movie'] as $key => $movie): ?>
          <?php if ($key != 0): ?>
            <tr>
              <th> 動画</th>
              <td>
                <div class="movie".$key>
                  <?php echo '<iframe width="200" height="120" src='.'https://www.youtube.com/embed/'.$movie['movie_url'].' frameborder="0" allowfullscreen></iframe>' ?>
                  <?php echo $this->Form->input('Check_Movie.'.$key.'.movie', array(
                    'id' => 'movie'.$key,
                    'onclick'=> "moviedelete('movie".$key."')",
                    'type' => 'checkbox',
                    'label' => '削除',
                    'div' => false,
                    'value' => $movie['movie_uuid']
                  )); ?>
                </div>
              </td>
            </tr>
          <?php endif;?>
         <?php endforeach; ?>
       <?php endif;?>
    </table>
    <?php echo $this->Form->end('Submit'); ?>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Professions', 'action' => 'admin_index')); ?>

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

      function moviedelete(chkID){
        Myid=document.getElementById(chkID);
        if(Myid.checked == true){
          myRet = confirm("動画を削除してもいいですか？");
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

      var movieNum = 1;
      function addMovie(){
          var movie = '<div id="'+ 'movie' + movieNum + '">'
              + '<?php echo $this->Form->input("Movie.'  + movieNum +  '.movie_url", array("type" => "text", "label" => false, "div" => false)); ?>'
              + '<?php echo $this->Form->hidden("Movie.'  + movieNum +  '.movie_uuid", array('value' => 'fast')); ?>'
              + '<input type="button" value="削除" onclick="delM(' + movieNum + ');">'
              + '</div>';
          document.getElementById('movieshow').innerHTML
              = document.getElementById('movieshow').innerHTML + movie;
          movieNum++;
      }
      function delM(movieNum) {
        var moviedel = 'movie' + movieNum;
        var dom_obj=document.getElementById(moviedel);
        var dom_obj_parent=dom_obj.parentNode;
        dom_obj_parent.removeChild(dom_obj);
      }
    </script>
  </body>
</html>
