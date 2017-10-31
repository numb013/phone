<div class="row">
<?php echo $this->Form->create('Buys', array('type' => 'post', 'controller' => 'Buys', 'action' => 'no_member_buy_confirm')); ?>
<div class="fh5co-contact animate-box">
    <div class="container">
        <div class="row">

            <h4>配送日時を指定しますか</h4>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <tr>
                  <th>配送日時指定</th>
                  <td>
                      <?php
                        $options = array('0' => '指定しない', '1' => '指定する');
                        echo $this->Form->input('shipoption', array(
                            'legend' => false,
                            'type' => 'radio',
                            'value' => 0,
                            'options' => $options,
                           'legend' => false,
                           'class' => 'radio_btn',
                            'div' => false
                        ));
                       ?>
                  </td>
                </tr>    
                <tr class='shipoption_select'>
                  <th>配送日時選択</th>
                  <td>
                    <?php echo $this->Form->input('month', array('label' => false, 'div' => false)); ?>
                    <?php echo $this->Form->input('date', array('label' => false, 'div' => false)); ?>
                  </td>
                </tr>
              </table>

            
            <h4>お支払方法を選択してください</h4>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <tr>
                    <th>お支払方法</th>
                    <td>
                        <?php
                          $options = array('1' => 'クレジット', '2' => '銀行振込', '3' => '代金代行');
                          echo $this->Form->input('payment_type', array(
                              'legend' => false,
                              'type' => 'radio',
                              'value' => 1,
                              'options' => $options,
                             'legend' => false,
                              'div' => false
                          ));
                         ?>
                    </td>
                  </tr>
              </table>

            
            
            
            <h4>お客様の情報を入力してください</h4>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <tr>
                    <th>お名前</th>
                    <td>
                      <?php echo $this->Form->input('User.full_name', array('label' => false, 'div' => false)); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>お名前カナ</th>
                    <td>
                      <?php echo $this->Form->input('User.full_name_kana', array('label' => false, 'div' => false)); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>郵便番号</th>
                    <td>
                      <?php echo $this->Form->input('User.zip', array('type' => 'text', 'label' => false, 'div' => false)); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>都道府県</th>
                    <td>
                      <?php
                        echo $this->Form->input('User.prefecture', array(
                            'type' => 'select',
                            'label' => false,
                            'div' => false,
                            'multiple'=> 'size',
                            'options' => $prefectures,
                        ));
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <th>住所1</th>
                    <td>
                      <?php echo $this->Form->input('User.address_1', array('label' => false, 'div' => false)); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>住所2</th>
                    <td>
                      <?php echo $this->Form->input('User.address_2', array('label' => false, 'div' => false)); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>電話番号</th>
                    <td>
                      <?php echo $this->Form->input('User.tel', array('label' => false, 'div' => false)); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>メールアドレス</th>
                    <td>
                      <?php echo $this->Form->input('User.mail_address', array('label' => false, 'div' => false)); ?>
                    </td>
                  </tr>
                  </table>
                <div class="btn-area">
                    <div class="btn gray-b">
                        <?php echo $this->Form->submit('カートへ戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="btn">
                        <?php echo $this->Form->submit('確認画面へ', array('name' => 'confirm', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->element('bottom'); ?>


<script type="text/javascript">

$('.radio_btn').click(function(){
    var value = $(this).val();
    if (value == 1) {
        $('.shipoption_select').css('display', 'block');
    } else {
        $('.shipoption_select').css('display', 'none');
    }


});

</script>