<div class="row">
  <?php

  //echo pr($datas);
  //exit();

   ?>






  <?php echo $this->Form->create('contacts', array('type' => 'file', 'url' =>  'index')); ?>

  <div class="animate-box" style="padding:70px 0px 30px 0px;">
		<div class="container">
			<div class="row">
				<div style="text-align:center">
         <h2>Thank You!</h2>
           <p>
           お問い合わせありがとうございます。<br>
           担当者より折り返しご連絡させていただきますので<br>
           今しばらくお待ちくださいませ。<br>
           その他ご不明な点、ご相談等ございましたら<br>
           お気軽にお問い合わせください。
           </p>
				</div>
			</div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>




	<?php echo $this->element('bottom'); ?>
