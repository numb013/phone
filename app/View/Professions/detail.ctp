<div class="row">
  <?php

  //echo pr($datas);
  //exit();

   ?>

  <div class="job-img">
      <div class="fh5co-copy col-md-12 img-responsive">
          <h1 class="profession_title"><?php echo $datas['Profession']['profession_name']; ?></h1>
        <?php echo $this->Html->image($datas['Image'][0]['Image']['url'] ,array('width' => '100%', 'class' => "work-img")); ?>
        <?php echo $this->Html->image($datas['Image'][0]['Image']['url'] ,array('class' => "yoko")); ?>
      </div>
  </div>

  <div class="wapper">

    <div class="side">
      <div class="fh5co-copy col-md-12  text-center detail_tex">
        <h3 class="detail_title" style="text-align:left">仕事内容・詳細</h3>
        <div class="rofession_text">
          <p style="text-align:left">
            <?php echo nl2br($datas['Profession']['job_content']); ?>
          </p>
        </div>
      </div>

      <div class="fh5co-copy col-md-12  text-center detail_tex">
        <h3 class="detail_title" style="text-align:left"><?php echo $datas['Profession']['profession_name']; ?>のなりかた</h3>
        <div class="rofession_text">
          <p style="text-align:left">
            <?php echo nl2br($datas['Profession']['job_step']); ?>
          </p>
        </div>
      </div>

      <?php if(!empty($datas['Image'][1])): ?>
        <div class="fh5co-copy col-md-12  text-center detail_tex">
          <div class="rofession_text">
            <div class="fh5co-copy col-md-12">
              <?php echo $this->Html->image($datas['Image'][1]['Image']['url'] ,array('width' => '100%', 'class' => "work-img")); ?>
              <?php echo $this->Html->image($datas['Image'][1]['Image']['url'] ,array('class' => "yoko_img")); ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="fh5co-copy col-md-12  text-center detail_tex">
        <div class="container detail_container">
            <div class="col-md-4 col-sm-4 text-center item-block">
              <h3 class="detail_title">向いてる性格</h3>
              <p class="job_step">
                <?php echo nl2br($datas['Profession']['personality']); ?>
              </p>
            </div>
            <div class="col-md-4 col-sm-4 text-center item-block">
              <h3 class="detail_title"><?php echo $datas['Profession']['profession_name']; ?>のお給料</h3>
              <p class="job_step">
                <?php echo nl2br($datas['Profession']['job_salary']); ?>
              </p>
            </div>
            <div class="col-md-4 col-sm-4 text-center item-block">
              <h3 class="detail_title">興味が出たら</h3>
                              <p>興味が出たらクリックしてね</p>
              <div class="job_know">
                <a href="javascript:void(0);" class='know_count plus' id="<?php echo $datas['Profession']['id'];?>">興味が出た : <span class="count"><?php echo $datas['Profession']['know_count']; ?></span>
                </a>
              </div>
            </div>
        </div>
      </div>
      <div class="fh5co-copy col-md-12  text-center detail_tex">
        <div class="container detail_container">
          <div class="col-md-4 col-sm-4 text-center item-block">
            <h3 class="detail_title">関連動画</h3>
            <?php echo '<iframe width="95%" height="165" src='.'https://www.youtube.com/embed/'.$datas['Movie'][0]['Movie']['movie_url'].' frameborder="0" allowfullscreen></iframe>' ?>
          </div>
          <div class="col-md-4 col-sm-4 text-center item-block">
            <div class="Advertisement">
                  <script language="javascript" src="//ad.jp.ap.valuecommerce.com/servlet/jsbanner?sid=3342556&pid=884790659"></script><noscript><a href="//ck.jp.ap.valuecommerce.com/servlet/referral?sid=3342556&pid=884790659" target="_blank" rel="nofollow"><img src="//ad.jp.ap.valuecommerce.com/servlet/gifbanner?sid=3342556&pid=884790659" border="0"></a></noscript>
              </div>
          </div>
          <div class="col-md-4 col-sm-4 text-center item-block">
            <div class="Advertisement">
                <script language="javascript" src="//ad.jp.ap.valuecommerce.com/servlet/jsbanner?sid=3342556&pid=884790657"></script><noscript><a href="//ck.jp.ap.valuecommerce.com/servlet/referral?sid=3342556&pid=884790657" target="_blank" rel="nofollow"><img src="//ad.jp.ap.valuecommerce.com/servlet/gifbanner?sid=3342556&pid=884790657" border="0"></a></noscript>
            </div>
          </div>
        </div>
      </div>

      <div class="fh5co-copy col-md-12  text-center detail_tex">
        <h3 class="detail_title" style="text-align:left">ご意見・ご感想</h3>
        <div class="rofession_text">
          <?php echo $this->Form->create('Profession', array('type' => 'post', 'url' => 'write_post')); ?>
          <div class="col-md-12">
            <p style=color:red;>
              <?php
                if (!empty($error['name'][0])) {
                  echo $error['name'][0];
                };
              ?>
            </p>
            <div class="form-group">
                <?php echo $this->Form->input('name', array('name' => 'write_name', 'type' => 'name', 'label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => "名前")); ?>
            </div>
          </div>
          <div class="col-md-12">
            <p style=color:red;>
              <?php
                if (!empty($error['text'][0])) {
                  echo $error['text'][0];
                };
              ?>
            </p>
            <div class="form-group">
              <?php echo $this->Form->input('text', array('name' => 'write_text', 'type' => 'textarea', 'rows' => 4, 'label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => "本文")); ?>
            </div>
          </div>
          <div>
            <?php echo $this->Form->hidden('profession_id', array('name' => 'profession_id', 'value' => $datas['Profession']['id'])); ?>
            <div class="set-btn">
              <?php echo $this->Form->button('投稿する', array('type' => 'button', 'label' => false, 'div' => false, 'class' => 'btn_write')); ?>
            </div>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>

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
    var data = { Profession: { id: $('.job_know').find('a').attr('id'), class: $('.job_know').find('a').attr('class')} };
    console.log(JSON.stringify(data));
    $.ajax({
      type: 'POST',
      url: '/professions/know_count',
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
  var name = $('#ProfessionDetailForm [name=write_name]').val();
  var text = $('#ProfessionDetailForm [name=write_text]').val();
  if (name.length == 0) {
    var name = '匿名';
  }
  if ((name.length < 25) && (text.length < 140) && (text.length > 0)) {
    var data = { wirte_down: {profession_id: $('#ProfessionDetailForm [name=profession_id]').val(), write_name: name, write_text: text, up_flag: '1'} };
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
