<div class="users form">
<?php echo $this->Form->create('User', array('type' => 'post', 'url' => 'user_regist')); ?>
    <fieldset>
<br>
    <legend><?php echo __('Add User'); ?></legend>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <tr>
            <th>お名前</th>
            <td><?php echo $data['User']['full_name']; ?></td>
            <?php echo $this->Form->hidden('User.full_name', array('value' => $data['User']['full_name'])); ?>
          </tr>
          <tr>
            <th>お名前カナ</th>
            <td><?php echo $data['User']['full_name_kana']; ?></td>
            <?php echo $this->Form->hidden('User.full_name_kana', array('value' => $data['User']['full_name_kana'])); ?>
          </tr>
          <tr>
            <th>郵便番号</th>
            <td><?php echo $data['User']['zip']; ?></td>
            <?php echo $this->Form->hidden('User.zip', array('value' => $data['User']['zip'])); ?>
          </tr>
          <tr>
            <th>住所1</th>
            <td><?php echo $data['User']['address1']; ?></td>
            <?php echo $this->Form->hidden('User.address1', array('value' => $data['User']['address1'])); ?>
          </tr>
          <tr>
            <th>住所2</th>
            <td><?php echo $data['User']['address2']; ?></td>
            <?php echo $this->Form->hidden('User.address2', array('value' => $data['User']['address2'])); ?>
          </tr>
          <tr>
            <th>電話番号</th>
            <td><?php echo $data['User']['tel']; ?></td>
            <?php echo $this->Form->hidden('User.tel', array('value' => $data['User']['tel'])); ?>
          </tr>
          <tr>
            <th>メールアドレス（ID）</th>
            <td><?php echo $data['User']['mail_address']; ?></td>
            <?php echo $this->Form->hidden('User.mail_address', array('value' => $data['User']['mail_address'])); ?>
            <?php echo $this->Form->hidden('User.username', array('value' => $data['User']['mail_address'])); ?>
          </tr>
      </table>
        <?php echo $this->Form->hidden('User.id', array('value' => $data['User']['id'])); ?>
    </fieldset>
    <div class="btn-area">
  			<div class="btn gray-b">
  				<?php echo $this->Form->submit('戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
  			</div>
  			<div class="btn">
  				<?php echo $this->Form->submit('登録', array('name' => 'regist', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
  			</div>
  	</div>
</div>
