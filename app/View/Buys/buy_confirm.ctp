<div class="row">
<?php echo $this->Form->create('Buys', array('type' => 'post', 'controller' => 'Buys', 'action' => 'buy_complete')); ?>
<div class="fh5co-contact animate-box">
    <div class="container">
        <div class="row">

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <?php foreach ($datas as $data): ?>
                  <tr>
                    <td><?php echo $this->Html->image($data['Image'][0]['url'] ,array('width' => '30%' )); ?></td>
                    <td>
                            <p>アイテム名：<?php echo $data['Item']['id'] ;?>-<?php echo $data['Item']['item_name'] ;?></p>
                            <p>合計価格：<?php echo $data['Item']['total_price'] ;?>円</p>
                            <p>価格：<?php echo $data['Item']['price'] ;?></p>
                            <p>サイズ：<?php echo $data['Item']['size'] ;?></p>
                            <a href="/ec/carts/index/delete/<?php echo $data['Item']['id']; ?>" class="btn">削除</a>
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
                    <td><?php echo $member['prefecture'][0]; ?></td>
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
