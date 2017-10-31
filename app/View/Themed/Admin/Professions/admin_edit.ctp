<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('Profession', array('type' => 'file', 'url' => 'edit')); ?>
    <?php echo $this->Form->input('id'); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <td> 職業名</td>
        <td>
          <?php echo $this->Form->input('profession_name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <td> 職業ジャンル</td>
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
          <td>職業内容</td>
          <td><?php echo $this->Form->textarea('job_content', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
        </tr>
        <tr>
          <td>なりかた</td>
          <td><?php echo $this->Form->textarea('job_step', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:100%')); ?></td>
        </tr>
        <tr>
          <td>向いてる性格</td>
          <td><?php echo $this->Form->textarea('personality', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 5, 'style' => 'width:100%')); ?></td>
        </tr>
        <tr>
          <td>給料</td>
          <td><?php echo $this->Form->textarea('job_salary', array('type' => 'text', 'label' => false, 'div' => false, 'rows' => 5, 'style' => 'width:100%')); ?></td>
        </tr>
        <tr>
          <td> 性格など</td>
          <td>
            <?php
              echo $this->Form->input('Profession.check_personal', array(
                  'type' => 'select',
                  'label' => false,
                  'div' => false,
                  'multiple'=> 'checkbox',
                  'options' => $check_personals,
              ));
            ?>
          </td>
        </tr>
        <tr>
          <td> 好きなこと</td>
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
          <td>コアレベル</td>
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
          </td>
        </tr>
        <tr>
          <td id="show">
          </td>
        </tr>
        <tr>
          <td>
            動画
            <input type="button" value="追加" id="btn" onclick="addMovie();">
          </td>
          <td>
            <?php echo $this->Form->input('Movie.0.movie_url', array('type' => 'text', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->hidden('Movie.0.movie_uuid', array('value' => 'fast')); ?>
          </td>
        </tr>
        <tr>
          <td></td>
          <td id="movieshow">
          </td>
        </tr>
      <?php if(!empty($this->request->data['Movie'])):?>
        <?php foreach ($this->request->data['Movie'] as $key => $movie): ?>
          <?php if ($key != 0): ?>
            <tr>
              <td> 動画</td>
              <td>
                <div class="movie".$key>
                  <?php echo '<iframe width="200" height="120" src='.'https://www.youtube.com/embed/'.$movie['movie_url'].' frameborder="0" allowfullscreen></iframe>' ?>
                  <?php echo $this->Form->input('Check_Movie.'.$key.'.movie_uuid', array(
                    'id' => 'movie'.$key,
                    'onclick'=> "moviedelete('movie".$key."')",
                    'type' => 'checkbox',
                    'label' => '削除4',
                    'div' => false,
                    'value' => $movie['movie_uuid']
                  )); ?>
                </div>
              </td>
            </tr>
            <?php echo $this->Form->hidden('BeforeMovie]['.$key, array('value' => $movie['movie_url'])); ?>
          <?php endif;?>
         <?php endforeach; ?>
       <?php endif;?>
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
    if (!empty($this->request->data['movie_dele'])) {
      foreach ($this->request->data['movie_dele'] as $key => $MovieDele) {
        echo $this->Form->hidden('movie_dele]['.$key, array('value' => $MovieDele));
      }
    } elseif (!empty($this->request->data['Check_Movie'])) {
      foreach ($this->request->data['Check_Movie'] as $key => $CheckMovie) {
        echo $this->Form->hidden('movie_dele]['.$key, array('value' => $CheckMovie['movie_uuid']));
      }
    }
    ?>

    <div class="buttom_edit" style="float:left; margin-right:50px;">

      <?php echo $this->Form->end('submit') ;?>
    </div>

          <?php echo $this->Html->link('戻る', array('controller' => 'Professions', 'action' => 'index')); ?>
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
