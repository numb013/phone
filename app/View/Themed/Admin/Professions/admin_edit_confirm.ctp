<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <h1>Edit Page</h1>
    <?php echo $this->Form->create('Profession', array('type' => 'file', 'url' => 'edit_regist')); ?>
    <?php echo $this->Form->input('id'); ?>
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <tr>
            <td>職業名</td>
            <td><?php echo $data['Profession']['profession_name']; ?></td>
            <?php echo $this->Form->hidden('Profession.profession_name', array('value' => $data['Profession']['profession_name'])); ?>
          </tr>
          <tr>
            <td>職業ジャンル</td>
            <td><?php echo $data['Profession']['genre']; ?></td>
            <?php echo $this->Form->hidden('Profession.genre', array('value' => $data['Profession']['genre'])); ?>
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
            <td>職業内容</td>
            <td><?php echo $data['Profession']['job_content']; ?></td>
            <?php echo $this->Form->hidden('Profession.job_content', array('value' => $data['Profession']['job_content'])); ?>
          </tr>
          <tr>
            <td>なりかた</td>
            <td><?php echo $data['Profession']['job_step']; ?></td>
            <?php echo $this->Form->hidden('Profession.job_step', array('value' => $data['Profession']['job_step'])); ?>
          </tr>
          <tr>
            <td>向いてる性格</td>
            <td><?php echo $data['Profession']['personality']; ?></td>
            <?php echo $this->Form->hidden('Profession.personality', array('value' => $data['Profession']['personality'])); ?>
          </tr>
          <tr>
            <td>給料</td>
            <td><?php echo $data['Profession']['job_salary']; ?></td>
            <?php echo $this->Form->hidden('Profession.job_salary', array('value' => $data['Profession']['job_salary'])); ?>
          </tr>
          <tr>
            <td>性別</td>
            <td>
              <?php if(!empty($data['Profession']['check_sex'])):?>
                <?php $count = 0; ?>
                <?php foreach ($data['Profession']['check_sex'] as $key => $sex): ?>
                  <?php if ($count == '0') {  echo ''; } else { echo '/'; } ; ?>
                  <?php echo $check_sex[$sex]; ?>
                  <?php $count++ ; ?>
                  <?php echo $this->Form->hidden('check_sex][]', array('value' => $sex)); ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>性格</td>
            <td>
              <?php if(!empty($data['Profession']['check_personal'])):?>
                <?php $count = 0; ?>
                <?php foreach ($data['Profession']['check_personal'] as $key => $check_personal): ?>
                  <?php if ($count == '0') {  echo ''; } else { echo '/'; } ; ?>
                  <?php echo $check_personals[$check_personal]; ?>
                  <?php $count++ ; ?>
                  <?php echo $this->Form->hidden('check_personal][]', array('value' => $check_personal)); ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>好きなこと</td>
            <td>
              <?php if(!empty($data['Profession']['check_like'])):?>
                <?php $count = 0; ?>
                <?php foreach ($data['Profession']['check_like'] as $key => $check_like): ?>
                  <?php if ($count == '0') {  echo ''; } else { echo '/'; } ; ?>
                  <?php echo $check_likes[$check_like]; ?>
                  <?php $count++ ; ?>
                  <?php echo $this->Form->hidden('check_like][]', array('value' => $check_like)); ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <th>関連職業</th>
            <td>
              <?php if(!empty($data['Profession']['related_profession'])):?>
                <?php $count = 0; ?>
                <?php foreach ($data['Profession']['related_profession'] as $key => $related): ?>
                  <?php if ($count == '0') {  echo ''; } else { echo '/'; } ; ?>
                  <?php echo $relatedNmae[$related]; ?>
                  <?php $count++ ; ?>
                  <?php echo $this->Form->hidden('related_profession][]', array('value' => $related)); ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>コアレベル</td>
            <td><?php echo $data['Profession']['core_status']; ?></td>
            <?php echo $this->Form->hidden('Profession.core_status', array('value' => $data['Profession']['core_status'])); ?>
          </tr>
          <tr>
            <td>動画</td>
            <td>
              <?php if(!empty($data['Movie'])):?>
                <?php foreach ($data['Movie'] as $key => $movie): ?>
                  <?php if(!empty($movie['movie_url'])):?>
                    <?php echo '<iframe width="200" height="120" src='.'https://www.youtube.com/embed/'.$movie['movie_url'].' frameborder="0" allowfullscreen></iframe>' ?>
                    <?php if (empty($movie['id'])):?>
                      <?php echo $this->Form->hidden('Movie.'.$key.'.Movie.movie_uuid', array('value' => $movie['movie_uuid'])); ?>
                      <?php echo $this->Form->hidden('Movie.'.$key.'.Movie.movie_url', array('value' => $movie['movie_url'])); ?>
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
    </table>
    <?php
      if (!empty($data['Check'])) {
        foreach ($data['Check'] as $key => $CheckPhoto) {
          echo $this->Form->hidden('photo_dele.'.$key, array('value' => $CheckPhoto['photo']));
        }
      }
      if (!empty($data['Check_Movie'])) {
        foreach ($data['Check_Movie'] as $key => $CheckMovie) {
          echo $this->Form->hidden('movie_dele.'.$key, array('value' => $CheckMovie['movie_uuid']));
        }
      }
    ?>
    <div class="btn-area">
  			<div class="btn gray-b">
  				<?php echo $this->Form->submit('戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
  			</div>
  			<div class="btn">
  				<?php echo $this->Form->submit('登録', array('name' => 'regist', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
  			</div>
  	</div>
    <?php echo $this->Html->link('一覧', array('controller' => 'Professions', 'action' => 'index')); ?>

  </body>
</html>
