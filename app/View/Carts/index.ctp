<div class="row">
<?php echo $this->Form->create('Buys', array('type' => 'post', 'controller' => 'Buys', 'action' => 'menber_buy')); ?>
<div class="fh5co-contact animate-box">
    <div class="container">
        <div class="row">
<?php if(!empty($datas)): ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-offset-0 text-center fh5co-heading" style="clear: both;">
                  <?php foreach ($datas as $data): ?>
                    <div class="job-memu">
                      <a href="/ec/items/detail/<?php echo $data['Item']['id']; ?>">
                        <div class="photo-cut">
                          <?php echo $this->Html->image($data['Image'][0]['url'] ,array('width' => '50%' )); ?>
                        </div>
                          <div class="part">
                            <p>アイテム名：<?php echo $data['Item']['id'] ;?>-<?php echo $data['Item']['item_name'] ;?></p>
                            <p>合計価格：<?php echo $data['Item']['total_price'] ;?>円</p>
                          </div>
                          <div class="part">
                            <p>価格：<?php echo $data['Item']['price'] ;?></p>
                            <p>サイズ：<?php echo $size[$data['Item']['size']] ;?></p>
                          </div>
                      </a>
                          <div class="part">
                            <p class="job_step">
                              <?php echo $this->Form->input('Item.count', array(
                                  'type' => 'select',
                                  'label' => false,
                                  'div' => false,
                                  'class' => 'buy_count',
                                  'id' => $data['Item']['id'],
                                  'value' => $data['Item']['count'],
                                  'options' => array(
                                        '1' =>'1',
                                        '2' =>'2',
                                        '3' =>'3',
                                        '4' =>'4',
                                        '5' =>'5',
                                        '6' =>'6',
                                        '7' =>'7',
                                        '8' =>'8',
                                        '9' =>'9',
                                        '10' =>'10',
                                        '11' =>'11',
                                        '12' =>'12',
                                      )
                               )); ?>
                            </p>
                          </div>
                        <a href="/ec/carts/index/delete/<?php echo $data['Item']['id']; ?>" class="btn">削除</a>
                    </div>
                  <?php endforeach; ?>
                </div>                
            </div>
                <p>合計:<span class="total_count"><?php echo $total['count']; ?></span>個</p>
                <p>合計金額:<span class="total_price"><?php echo $total['price']; ?></span>円</p>

                <?php echo $this->Form->hidden('Item.id', array('value' => $data['Item']['id'])); ?>
                <?php if (!empty($member)): ?>
                    <?php echo $this->Form->input('購入へ', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit')); ?>
                <?php else: ?>
                    <?php echo $this->Form->input('ログインして購入へ', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit')); ?>
                <?php endif; ?>
                <br>
                <?php echo $this->Form->end(); ?>
                <?php if (empty($member)): ?>
                    <?php echo $this->Form->create('Buys', array('type' => 'post', 'controller' => 'Buys', 'action' => 'no_menber_buy')); ?>
                    <?php echo $this->Form->input('ログインせず購入へ', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit')); ?>
                    <?php echo $this->Form->hidden('Item.id', array('value' => $data['Item']['id'])); ?>
                    <?php echo $this->Form->end(); ?>
                <?php endif; ?>
            <?php else: ?>
                <p>かーとありません</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<?php echo $this->element('bottom'); ?>


<script type="text/javascript">
  $('.buy_count').change(function() {
    var data = { Item: { id: $(this).attr('id'), count: $(this).val()} };
    console.log(JSON.stringify(data));
    $.ajax({
      type: 'POST',
      url: '/ec/carts/buy_count',
      data: data,
      dataType: 'json',
      cache: false,
      success: function(data) {
$('.total_price').text(data.price);
$('.total_count').text(data.count);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown, data) {
      }
    });
    return false;
  });
</script>