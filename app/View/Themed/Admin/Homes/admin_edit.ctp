<html>
  <head>
    <title>Index Page</title>
    <?php echo $this->Html->script( 'jquery-2.2.3.min.js'); ?>
    <link href="jquery.rateyo.min.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h1>Add Page</h1>
    <?php echo $this->Form->create('Home', array('type' => 'post', 'url' => 'edit')); ?>
    <?php echo $this->Form->input('id'); ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>トップタイトル</th>
        <td>
          <?php echo $this->Form->input('title1', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>ミニタイトル</th>
        <td>
          <?php echo $this->Form->input('min_text1', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>中タイトル１</th>
        <td>
          <?php echo $this->Form->input('title2', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>負担１</th>
        <td>
          <?php echo $this->Form->input('word1', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>負担２</th>
        <td>
          <?php echo $this->Form->input('word2', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>負担３</th>
        <td>
          <?php echo $this->Form->input('word3', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>中タイトル２</th>
        <td>
          <?php echo $this->Form->input('title3', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>ポイント１</th>
        <td>
          <?php echo $this->Form->input('description1', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>ポイント２</th>
        <td>
          <?php echo $this->Form->input('description2', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>ポイント３</th>
        <td>
          <?php echo $this->Form->input('description3', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>中タイトル３</th>
        <td>
          <?php echo $this->Form->input('title4', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>ミニタイトル３</th>
        <td>
          <?php echo $this->Form->input('min_text4', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>ステップ１</th>
        <td>
          <?php echo $this->Form->input('step_text1', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>ステップ２</th>
        <td>
          <?php echo $this->Form->input('step_text2', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>ステップ３</th>
        <td>
          <?php echo $this->Form->input('step_text3', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>ステップ４</th>
        <td>
          <?php echo $this->Form->input('step_text4', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>ステップ備考</th>
        <td>
          <?php echo $this->Form->input('step_description', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
      <tr>
        <th>中タイトル4</th>
        <td>
          <?php echo $this->Form->input('title5', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>職業名１</th>
        <td>
          <?php echo $this->Form->input('introduction_title1', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>職業テキスト１</th>
        <td>
          <?php echo $this->Form->input('introduction_text1', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>職業名２</th>
        <td>
          <?php echo $this->Form->input('introduction_title2', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>職業テキスト２</th>
        <td>
          <?php echo $this->Form->input('introduction_text2', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>職業名３</th>
        <td>
          <?php echo $this->Form->input('introduction_title3', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>

      <tr>
        <th>職業テキスト３</th>
        <td>
          <?php echo $this->Form->input('introduction_text3', array('label' => false, 'div' => false, 'style' => 'width:50%')); ?>
        </td>
      </tr>
    </table>
     <?php echo $this->Form->end('保存する'); ?>
    <?php echo $this->Html->link('一覧へ', array('controller' => 'Homes', 'action' => 'admin_index')); ?>
  </body>
</html>
