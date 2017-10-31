<div class="row">
<?php echo $this->Form->create('Buys', array('type' => 'post', 'controller' => 'Buys', 'action' => 'buy_confirm')); ?>
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
<?php

echo pr($member);

?>
            
            
            
            <h4>配送先はコチラでよろしいでしょうか</h4>
            <p><a href='/ec/users/user_edit'>変更する</a></p>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <tr>
                    <th>お名前</th>
                    <td><?php echo $member['full_name']; ?></td>
                  </tr>
                  <tr>
                    <th>お名前カナ</th>
                    <td><?php echo $member['full_name_kana']; ?></td>
                  </tr>
                  <tr>
                    <th>郵便番号</th>
                    <td><?php echo $member['zip']; ?></td>
                  </tr>
                  <tr>
                    <th>都道府県</th>
                    <td><?php echo $prefectures[$member['prefecture'][0]]; ?></td>
                  </tr>
                  <tr>
                    <th>住所1</th>
                    <td><?php echo $member['address_1']; ?></td>
                  </tr>
                  <tr>
                    <th>住所2</th>
                    <td><?php echo $member['address_2']; ?></td>
                  </tr>
                  <tr>
                    <th>電話番号</th>
                    <td><?php echo $member['tel']; ?></td>
                  </tr>
                  <tr>
                    <th>メールアドレス</th>
                    <td><?php echo $member['mail_address']; ?></td>
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