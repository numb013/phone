<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('Advertisement', array('type' => 'file', 'url' => 'edit')); ?>
    <?php echo $this->Form->input('id'); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>識別フラグ</th>
        <td>
            <?php
                $options = array('0' => '非表示', '1' => '表示');
                $attributes = array('value' => $this->request->data['Advertisement']['display_flag']);
                echo $this->Form->radio('Advertisement.display_flag', $options, $attributes);
            ?>
        </td>
      </tr>
      <tr>
        <td>広告名</td>
        <td>
          <?php echo $this->Form->input('name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <td>テキストURL</td>
        <td>
            <?php echo $this->Form->input('text_url', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <tr>
          <td>
            画像
          </td>
          <td id="txt">
            <?php echo $this->Form->input('Image', array('type' => 'file', 'label' => false)); ?>
          </td>
        </tr>
        <?php if(!empty($this->request->data['Image'])):?>

            <tr>
              <td> 画像</td>
              <td>
                <?php  echo $this->Html->image($this->request->data['Image']['url'] ,array('width' => '15%' )); ?>
              </td>
            </tr>
            <?php echo $this->Form->hidden('BeforeImage][url]', array('value' => $this->request->data['Image']['url'])); ?>

        <?php endif;?>
       </tr>
    </table>
    <div class="buttom_edit" style="float:left; margin-right:50px;">
      <?php echo $this->Form->end('submit') ;?>
    </div>
      <?php echo $this->Html->link('戻る', array('controller' => 'Advertisements', 'action' => 'index')); ?>
  </body>
</html>
