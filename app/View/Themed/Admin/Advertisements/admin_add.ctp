<html>
  <head>
    <title>Index Page</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h1>Add Page</h1>
    <?php echo $this->Form->create('Advertisement', array('type' => 'file', 'url' => 'add')); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>表示フラグ</th>
        <td>
            <?php
                $options = array('0' => '非表示', '1' => '表示');
                $attributes = array('legend' => false);
                echo $this->Form->radio('display_flag', $options, $attributes);
            ?>
        </td>
      </tr>
      <tr>
        <th>広告名</th>
        <td>
          <?php echo $this->Form->input('name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th> テキストURL</th>
        <td>
            <?php echo $this->Form->input('text_url', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>
           画像
        </th>
        <td id="txt">
          <?php echo $this->Form->input('Image', array('type' => 'file', 'label' => false)); ?>
        </td>
      </tr>
      <?php if(!empty($this->request->data['Image'])):?>

          <tr>
            <th> 画像</th>
          <td>
            <?php  echo $this->Html->image($this->request->data['Image']['url'] ,array('width' => '15%' )); ?>
          </td>
        </tr>

       <?php endif;?>

    </table>
    <?php echo $this->Form->end('確認する'); ?>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Advertisements', 'action' => 'admin_index')); ?>
  </body>
</html>
