<html>
  <head>
    <title>性格</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
      <h1>Add Pagedddddd</h1>
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <tr>
            <th>職業名</th>
            <td><?php echo $data['Blog']['title']; ?></td>
            <?php echo $this->Form->hidden('Blog.title', array('value' => $data['Blog']['title'])); ?>
          </tr>
          <tr>
            <th>画像</th>
            <td>
              <?php if(!empty($data['Image'])):?>
                <?php foreach ($data['Image'] as $key => $photo): ?>
                  <?php if(!empty($photo)):?>
                    <?php echo $this->Html->image($photo['Image']['url'] ,array('width' => '15%' )); ?>
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
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Shops', 'action' => 'index')); ?>
  </body>
</html>
