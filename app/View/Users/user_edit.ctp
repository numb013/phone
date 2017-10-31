<div class="users form">
<?php echo $this->Form->create('User', array('type' => 'post', 'url' => 'user_edit')); ?>
    <fieldset>
<br>
    <legend><?php echo __('Add User'); ?></legend>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>お名前</th>
        <td>
          <?php echo $this->Form->input('full_name', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>お名前カナ</th>
        <td>
          <?php echo $this->Form->input('full_name_kana', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>郵便番号</th>
        <td>
          <?php echo $this->Form->input('zip', array('name' => 'zip', 'label' => false, 'div' => false, 'onKeyUp' => "AjaxZip3.zip2addr(this,'','address1','address1')")); ?>
        </td>
      </tr>
      <tr>
        <th>住所1</th>
        <td>
          <?php echo $this->Form->input('address1', array('name' => 'address1', 'label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>住所2</th>
        <td>
          <?php echo $this->Form->input('address2', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>
          <?php echo $this->Form->input('tel', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      <tr>
        <th>メールアドレス（ID）</th>
        <td>
          <?php echo $this->Form->input('mail_address', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      </table>
    <?php echo $this->Form->hidden('User.id', array('value' => $this->request->data['User']['id'])); ?>
    </fieldset>
<?php echo $this->Form->end(__('確認')); ?>
</div>
