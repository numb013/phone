<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <h1>Edit Page</h1>
    <p>MySampleData Edit Form.</p>
    <?php echo $this->Form->create('Home', array('type' => 'post', 'url' => 'edit_regist')); ?>
    <?php echo $this->Form->input('id'); ?>
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <tr>
            <th>トップタイトル</th>
            <td><?php echo $data['Home']['title1']; ?></td>
            <?php echo $this->Form->hidden('Home.title1', array('value' => $data['Home']['title1'])); ?>
          </tr>
          <tr>
            <th>ミニタイトル</th>
            <td><?php echo $data['Home']['min_text1']; ?></td>
            <?php echo $this->Form->hidden('Home.min_text1', array('value' => $data['Home']['min_text1'])); ?>
          </tr>
          <tr>
            <th>中タイトル１</th>
            <td><?php echo $data['Home']['title2']; ?></td>
            <?php echo $this->Form->hidden('Home.title2', array('value' => $data['Home']['title2'])); ?>
          </tr>
          <tr>
            <th>負担１</th>
            <td><?php echo $data['Home']['word1']; ?></td>
            <?php echo $this->Form->hidden('Home.word1', array('value' => $data['Home']['word1'])); ?>
          </tr>
          <tr>
            <th>負担２</th>
            <td><?php echo $data['Home']['word2']; ?></td>
            <?php echo $this->Form->hidden('Home.word2', array('value' => $data['Home']['word2'])); ?>
          </tr>
          <tr>
            <th>負担３</th>
            <td><?php echo $data['Home']['word3']; ?></td>
            <?php echo $this->Form->hidden('Home.word3', array('value' => $data['Home']['word3'])); ?>
          </tr>
          <tr>
            <th>中タイトル２</th>
            <td><?php echo $data['Home']['title3']; ?></td>
            <?php echo $this->Form->hidden('Home.title3', array('value' => $data['Home']['title3'])); ?>
          </tr>
          <tr>
            <th>ポイント１</th>
            <td><?php echo $data['Home']['description1']; ?></td>
            <?php echo $this->Form->hidden('Home.description1', array('value' => $data['Home']['description1'])); ?>
          </tr>
          <tr>
            <th>ポイント２</th>
            <td><?php echo $data['Home']['description2']; ?></td>
            <?php echo $this->Form->hidden('Home.description2', array('value' => $data['Home']['description2'])); ?>
          </tr>
          <tr>
            <th>ポイント３</th>
            <td><?php echo $data['Home']['description3']; ?></td>
            <?php echo $this->Form->hidden('Home.description3', array('value' => $data['Home']['description3'])); ?>
          </tr>
          <tr>
            <th>中タイトル３</th>
            <td><?php echo $data['Home']['title4']; ?></td>
            <?php echo $this->Form->hidden('Home.title4', array('value' => $data['Home']['title4'])); ?>
          </tr>
          <tr>
            <th>ミニタイトル３</th>
            <td><?php echo $data['Home']['min_text4']; ?></td>
            <?php echo $this->Form->hidden('Home.min_text4', array('value' => $data['Home']['min_text4'])); ?>
          </tr>
          <tr>
            <th>ステップ１</th>
            <td><?php echo $data['Home']['step_text1']; ?></td>
            <?php echo $this->Form->hidden('Home.step_text1', array('value' => $data['Home']['step_text1'])); ?>
          </tr>
          <tr>
            <th>ステップ２</th>
            <td><?php echo $data['Home']['step_text2']; ?></td>
            <?php echo $this->Form->hidden('Home.step_text2', array('value' => $data['Home']['step_text2'])); ?>
          </tr>
          <tr>
            <th>ステップ３</th>
            <td><?php echo $data['Home']['step_text3']; ?></td>
            <?php echo $this->Form->hidden('Home.step_text3', array('value' => $data['Home']['step_text3'])); ?>
          </tr>
          <tr>
            <th>ステップ４</th>
            <td><?php echo $data['Home']['step_text4']; ?></td>
            <?php echo $this->Form->hidden('Home.step_text4', array('value' => $data['Home']['step_text4'])); ?>
          </tr>
          <tr>
            <th>ステップ備考</th>
            <td><?php echo $data['Home']['step_description']; ?></td>
            <?php echo $this->Form->hidden('Home.step_description', array('value' => $data['Home']['step_description'])); ?>
          </tr>
          <tr>
            <th>中タイトル4</th>
            <td><?php echo $data['Home']['title5']; ?></td>
            <?php echo $this->Form->hidden('Home.title5', array('value' => $data['Home']['title5'])); ?>
          </tr>
          <tr>
            <th>職業名１</th>
            <td><?php echo $data['Home']['introduction_title1']; ?></td>
            <?php echo $this->Form->hidden('Home.introduction_title1', array('value' => $data['Home']['introduction_title1'])); ?>
          </tr>
          <tr>
            <th>職業テキスト１</th>
            <td><?php echo $data['Home']['introduction_text1']; ?></td>
            <?php echo $this->Form->hidden('Home.introduction_text1', array('value' => $data['Home']['introduction_text1'])); ?>
          </tr>
          <tr>
            <th>職業名２</th>
            <td><?php echo $data['Home']['introduction_title2']; ?></td>
            <?php echo $this->Form->hidden('Home.introduction_title2', array('value' => $data['Home']['introduction_title2'])); ?>
          </tr>
          <tr>
            <th>職業テキスト２</th>
            <td><?php echo $data['Home']['introduction_text2']; ?></td>
            <?php echo $this->Form->hidden('Home.introduction_text2', array('value' => $data['Home']['introduction_text2'])); ?>
          </tr>
          <tr>
            <th>職業３</th>
            <td><?php echo $data['Home']['introduction_title3']; ?></td>
            <?php echo $this->Form->hidden('Home.introduction_title3', array('value' => $data['Home']['introduction_title3'])); ?>
          </tr>
          <tr>
            <th>職業テキスト３</th>
            <td><?php echo $data['Home']['introduction_text3']; ?></td>
            <?php echo $this->Form->hidden('Home.introduction_text3', array('value' => $data['Home']['introduction_text3'])); ?>
          </tr>
    </table>
    <div class="btn-area">
        <div class="btn gray-b">
                <?php echo $this->Form->submit('戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
        </div>
        <div class="btn">
                <?php echo $this->Form->submit('登録', array('name' => 'regist', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
        </div>
  	</div>
    <?php echo $this->Html->link('一覧', array('controller' => 'Homes', 'action' => 'admin_index')); ?>
  </body>
</html>
