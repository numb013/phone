<div class="row">
  <?php

  //echo pr($datas);
  //exit();

   ?>

  <div class="job-img">
      <div class="fh5co-copy col-md-12 img-responsive">
          <h1 class="item_title"><?php echo $datas['Item']['item_name']; ?></h1>
        <?php echo $this->Html->image($datas['Image'][0]['Image']['url'] ,array('width' => '100%', 'class' => "work-img")); ?>
        <?php echo $this->Html->image($datas['Image'][0]['Image']['url'] ,array('class' => "yoko")); ?>
      </div>
  </div>

  <div class="wapper">

    <div class="side">
      <div class="fh5co-copy col-md-12  text-center detail_tex">
        <h3 class="detail_title" style="text-align:left">詳細</h3>
        <div class="rofession_text">
          <p style="text-align:left">
            <?php echo nl2br($datas['Item']['item_text']); ?>
          </p>
        </div>
      </div>

        <?php echo $this->Form->create(array('type' => 'post', 'url' =>  '/carts/')); ?>
      <div class="fh5co-copy col-md-12  text-center detail_tex">
        <div class="container detail_container">
            <div class="col-md-3 col-sm-3 text-center item-block">
              <h3 class="detail_title">価格</h3>
              <p class="job_step">
                <?php echo nl2br($datas['Item']['price']); ?>
              </p>
            </div>
            <div class="col-md-3 col-sm-3 text-center item-block">
              <h3 class="detail_title">サイズ</h3>
              <p class="job_step">
                <?php echo $size[$datas['Item']['size']]; ?>
              </p>
            </div>
            <div class="col-md-3 col-sm-3 text-center item-block">
              <h3 class="detail_title">ジャンル</h3>
              <p class="job_step">
                <?php echo $genre[$datas['Item']['genre']]; ?>
              </p>
            </div>
            <div class="col-md-3 col-sm-3 text-center item-block">
              <h3 class="detail_title">個数</h3>
              <p class="job_step">
                <?php echo $this->Form->input('Item.count', array('type' => 'number', 'label' => false, 'div' => false, 'value' => 1)); ?>
              </p>
            </div>
        </div>
      </div>

    <div class="col-md-12 text-center" style="padding:0px; position: static;">
      <div class="set-btn">
        <?php echo $this->Form->input('カートへ', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit')); ?>
          <?php $token = rand(0, 9999); ?>
        <?php echo $this->Form->hidden('token', array('value' => $token)); ?>
        <?php echo $this->Form->hidden('Item.id', array('value' => $datas['Item']['id'])); ?>
      </div>
    </div>
    <?php echo $this->Form->end(); ?>

    <div class="fh5co-copy col-md-12  text-center detail_tex">
       <?php if (!empty($datas['write'])): ?>
         <?php foreach ($datas['write'] as $key => $value): ?>
           <div class='write_space'>
             <div class="write_img">
               <?php echo $this->Html->image('find_user.png', array('width' => '50', 'height' =>'50')); ?>
             </div>
             <div class='write_waku'>
               <ul class='write_title'>
                 <li>名前：<?php echo $value['WriteDown']['write_name']; ?></li>
                 <li>|</li>
                 <li><?php echo date("Y/m/d H:i", strtotime($value['WriteDown']['created'])); ?></li>
               </ul>
               <p class='write_text'>
                 <?php echo nl2br($value['WriteDown']['write_text']); ?>
               <p>
             </div>
           </div>
         <?php endforeach; ?>
       <?php endif; ?>
     </div>
    </div>
    <?php echo $this->element('side'); ?>
  </div>
	<?php echo $this->element('bottom'); ?>

<script type="text/javascript">
  $('.know_count').click(function() {
    var data = { Item: { id: $('.job_know').find('a').attr('id'), class: $('.job_know').find('a').attr('class')} };
    console.log(JSON.stringify(data));
    $.ajax({
      type: 'POST',
      url: '/items/know_count',
      data: data,
      dataType: 'json',
      cache: false,
      success: function(data) {
        if (data.status) {
          if (data.action === 'plus') {
            var know = parseInt($('span.count').text());
            var knowCount = know + 1;
            $('.count').text(knowCount);
            $('div').find('.know_count').attr('class','know_count minus');
            $('.know_count').css('color','#fff');
            $('.know_count').css('background-color','#369840');
          } else {
            var know = parseInt($('span.count').text());
            var knowCount = know - 1;
            $('.count').text(knowCount);
            $('div').find('.know_count').attr('class','know_count plus');
            $('.know_count').css('color','#369840');
            $('.know_count').css('background-color','#fff');

          }
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
      }
    });
    return false;
  });

$('.btn_write').click(function() {
  var name = $('#ItemDetailForm [name=write_name]').val();
  var text = $('#ItemDetailForm [name=write_text]').val();
  if (name.length == 0) {
    var name = '匿名';
  }
  if ((name.length < 25) && (text.length < 140) && (text.length > 0)) {
    var data = { wirte_down: {item_id: $('#ItemDetailForm [name=item_id]').val(), write_name: name, write_text: text, up_flag: '1'} };
    console.log(JSON.stringify(data));
    $.ajax({
      type: 'POST',
      url: '/WriteDowns/write_post',
      data: data,
      dataType: 'json',
      cache: false,
      success: function(data) {
        location.reload(true)
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          console.log(textStatus);
          console.log(errorThrown);
      }
    });
    return false;
    } else {
      if (name.length > 25) {
        alert('名前は25文字まで');
      } else if (text.length > 140) {
        alert('本文は140本文まで');
      } else if (text.length <= 0) {
        alert('本文を入力してください');
      }
    }
  });
</script>
