<div class="users form">
<?php echo $this->Form->create('User', array('url' => 'add')); ?>
    <fieldset>
<br>
    <legend><?php echo __('Add User'); ?></legend>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr>
        <th>メールアドレス（ID）</th>
        <td>
          <?php echo $this->Form->input('mail_address', array('label' => false, 'div' => false)); ?>
        </td>
        <th>パスワード</th>
        <td>
          <?php echo $this->Form->input('password', array('label' => false, 'div' => false)); ?>
        </td>
      </tr>
      </table>



    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
