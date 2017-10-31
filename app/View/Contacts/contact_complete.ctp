<!-- Main -->
        <div id="main">
            <?php echo $this->Form->create('Contact', array('type' => 'post', 'url' => '/Contacts/index')); ?>
            <article class="post" id='form_area'>
                <section>
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
                </section>                                                
            </article>
        </div>              
    <?php echo $this->element('side'); ?>