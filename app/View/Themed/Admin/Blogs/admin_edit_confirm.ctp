<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
      <h1>Edit Page</h1>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('Blog', array('type' => 'file', 'url' => 'edit_regist')); ?>
        <?php echo $this->Form->input('id'); ?>
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <tr>
            <th>職業名</th>
            <td><?php echo $data['Blog']['title']; ?></td>
            <?php echo $this->Form->hidden('Blog.title', array('value' => $data['Blog']['title'])); ?>
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
            <th>テキスト１</th>
            <td><?php echo $data['Blog']['text_1']; ?></td>
            <?php echo $this->Form->hidden('Blog.text_1', array('value' => $data['Blog']['text_1'])); ?>
          </tr>
          <tr>
            <th>テキスト２</th>
            <td><?php echo $data['Blog']['text_2']; ?></td>
            <?php echo $this->Form->hidden('Blog.text_2', array('value' => $data['Blog']['text_2'])); ?>
          </tr>
          <tr>
            <th>テキスト３</th>
            <td><?php echo $data['Blog']['text_3']; ?></td>
            <?php echo $this->Form->hidden('Blog.text_3', array('value' => $data['Blog']['text_3'])); ?>
          </tr>
          <tr>
            <th>テキスト４</th>
            <td><?php echo $data['Blog']['text_4']; ?></td>
            <?php echo $this->Form->hidden('Blog.text_4', array('value' => $data['Blog']['text_4'])); ?>
          </tr>
          <tr>
            <th>公開</th>
            <td>
                <?php if($data['Blog']['release_flag'] == '1'): ?>
                    公開する
                <?php else: ?>
                    公開しない
                <?php endif; ?>
            </td>
            <?php echo $this->Form->hidden('Blog.release_flag', array('value' => $data['Blog']['release_flag'])); ?>
          </tr>
      </table>
    <?php
      if (!empty($data['Check'])) {
        foreach ($data['Check'] as $key => $CheckPhoto) {
          echo $this->Form->hidden('photo_dele.'.$key, array('value' => $CheckPhoto['photo']));
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
    <?php echo $this->Html->link('一覧', array('controller' => 'Blogs', 'action' => 'admin_index')); ?>
  </body>
</html>
