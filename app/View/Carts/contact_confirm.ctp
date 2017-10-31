<div class="row">
  <?php

  //echo pr($datas);
  //exit();

   ?>






  <?php echo $this->Form->create('contacts', array('type' => 'file', 'url' =>  'index')); ?>

  <div class="fh5co-contact animate-box">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="row">
            <h1 class="contact_title">お問い合わせ(確認画面)</h1>
            <div class="contact-btn-feeld" style="margin-bottom:20px;">
              <p>
                以下の内容に問題がなければ、送信ボタンを<br>
                クリックしてください。
              </p>
            </div>
            <div style="text-align:center;">
  						<div class="col-md-12">
  							<div class="form-group" style="margin-right:10px;">
                 <h3>名前</h3>
                  <?php echo $this->request->data['contacts']['name']; ?>
  							</div>
  						</div>
  						<div class="col-md-12">
  							<div class="form-group">
                  <h3>メールアドレス</h3>
                  <?php echo $this->request->data['contacts']['email']; ?>
  							</div>
  						</div>
  						<div class="col-md-12">
  							<div class="form-group">
                  <h3>本文</h3>
                  <?php echo $this->request->data['contacts']['body']; ?>
  							</div>
              </div>
            </div>
            <div>
              <div class="set-btn-contact animated fadeInUp">
                <?php echo $this->Form->button('戻る', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit_contact', 'name' => 'confirm', 'value' => 'revise')); ?>
                <?php echo $this->Form->end(); ?>
              </div>
              <div class="set-btn-contact animated fadeInUp">
                <?php echo $this->Form->hidden('contacts.name', array('value' => $this->request->data['contacts']['name'])); ?>
                <?php echo $this->Form->hidden('contacts.email', array('value' => $this->request->data['contacts']['email'])); ?>
                <?php echo $this->Form->hidden('contacts.body', array('value' => $this->request->data['contacts']['body'])); ?>
                <?php echo $this->Form->button('送信する', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit_contact', 'name' => 'confirm', 'value' => 'send')); ?>
                <?php echo $this->Form->end(); ?>
              </div>
            </div>
					</div>
				</div>
			</div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>




	<?php echo $this->element('bottom'); ?>
