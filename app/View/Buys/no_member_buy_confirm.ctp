<div class="row">
<?php echo $this->Form->create('Buys', array('type' => 'post', 'controller' => 'Buys', 'action' => 'buy_complete')); ?>
<div class="fh5co-contact animate-box">
    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <?php foreach ($datas as $value): ?>
                  <tr>
                    <td><?php echo $this->Html->image($value['Image'][0]['url'] ,array('width' => '30%' )); ?></td>
                    <td>
                        <p>アイテム名：<?php echo $value['Item']['id'] ;?>-<?php echo $value['Item']['item_name'] ;?></p>
                        <p>合計価格：<?php echo $value['Item']['total_price'] ;?>円</p>
                        <p>価格：<?php echo $value['Item']['price'] ;?></p>
                        <p>サイズ：<?php echo $value['Item']['size'] ;?></p>
                        <a href="/ec/carts/index/delete/<?php echo $value['Item']['id']; ?>" class="btn">削除</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                  <tr>
                      <th>合計数量</th>
                    <td>
                        <?php echo $total['count']; ?>個
                    </td>
                  </tr>
                  <tr>
                      <th>合計金額</th>
                    <td>
                        <?php echo $total['price']; ?>円
                    </td>
                  </tr>
            </table>


            <table class="table table-striped table-bordered table-hover" id="dataTables-example">  
                <tr>
                    <th>配送日時</th>
                    <td>
                        <?php if ($select['Buys']['shipoption'] == 0): ?>
                            指定なし
                            <?php echo $this->Form->hidden('Buys.shipoption', array('value' => $select['Buys']['shipoption'])); ?>
                        <?php else: ?>
                            <?php echo $select['Buys']['shipoption_date']; ?>
                            <?php echo $this->Form->hidden('Buys.shipoption_date', array('value' => $select['Buys']['shipoption_date'])); ?>
                        <?php endif; ?>
                    </td>
                </tr>
              </table>

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <tr>
                    <th>お支払方法</th>
                    <td>
                        <?php if ($select['Buys']['payment_type'] == 1): ?>
                            クレジット決済
                        <?php elseif ($select['Buys']['payment_type'] == 2): ?>
                            銀行振り込み
                        <?php else: ?>
                            代行
                        <?php endif; ?>
                    </td>
                  </tr>
              </table>

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
                    <th>都道府県</th>
                    <td><?php echo $data['User']['prefecture'][0]; ?></td>
                    <?php echo $this->Form->hidden('User.prefecture', array('value' => $data['User']['prefecture'][0])); ?>
                  </tr>
                  <tr>
                    <th>住所1</th>
                    <td><?php echo $data['User']['address_1']; ?></td>
                    <?php echo $this->Form->hidden('User.address_1', array('value' => $data['User']['address_1'])); ?>
                  </tr>
                  <tr>
                    <th>住所2</th>
                    <td><?php echo $data['User']['address_2']; ?></td>
                    <?php echo $this->Form->hidden('User.address_2', array('value' => $data['User']['address_2'])); ?>
                  </tr>
                  <tr>
                    <th>電話番号</th>
                    <td><?php echo $data['User']['tel']; ?></td>
                    <?php echo $this->Form->hidden('User.tel', array('value' => $data['User']['tel'])); ?>
                  </tr>
                  <tr>
                    <th>メールアドレス</th>
                    <td><?php echo $data['User']['mail_address']; ?></td>
                    <?php echo $this->Form->hidden('User.mail_address', array('value' => $data['User']['mail_address'])); ?>
                    <?php echo $this->Form->hidden('User.username', array('value' => $data['User']['mail_address'])); ?>
                  </tr>
              </table>
                <div class="btn-area">
                    <div class="btn gray-b">
                        <?php echo $this->Form->submit('戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="btn">
                        <?php echo $this->Form->hidden('Buys.payment_type', array('value' => $select['Buys']['payment_type'])); ?>
                        <?php if ($select['Buys']['payment_type'] == 1): ?>
                            <?php echo $this->Form->submit('クレジット購入へ', array('name' => 'credit', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
                        <?php else: ?>
                            <?php echo $this->Form->submit('購入する', array('name' => 'regist', 'type' => 'submit', 'label' => false, 'div' => false)); ?>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->element('bottom'); ?>
