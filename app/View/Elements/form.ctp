<?php echo $this->Form->create('Contact', array('type' => 'post', 'url' => '/Contacts/index', 'novalidate' => true)); ?>
<article class="post" id='form_area'>
    <header class="header_top">
        <div class="title_top">
            <h2>お問合せ</h2>
            <p>
                ご入力いただいた情報をもとに、担当者より連絡いたします。
                「お問い合わせ内容」「お客様情報」をご入力の上、「確認」ボタンをクリックしてください。
                「必須」の項目は、必ず入力してください。
            </p>
        </div>
    </header>
    <section>
                    <table class="form_table">
                        <tr>
                            <th>会社名<span class='required'>必須</span></th>
                            <td><?php echo $this->Form->input('company_name', array('label' => false, 'div' => false, 'placeholder' => "会社名")); ?></td>
                        </tr>
                        <tr>
                            <th>担当者名<span class='required'>必須</span></th>
                            <td><?php echo $this->Form->input('contact_name', array('label' => false, 'div' => false, 'placeholder' => "担当者名")); ?></td>
                        </tr>
                            <th>都道府県<span class='required'>必須</span></th>
                            <td>
                                <?php
                                  echo $this->Form->input('prefecture', array(
                                      'options' => $prefectures,
                                      'label' => false,
                                      'div' => false,
                                      'empty' => '選択してください'
                                  ));
                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <th>電話番号<span class='required'>必須</span></th>
                            <td><?php echo $this->Form->input('phone_number', array('label' => false, 'div' => false, 'placeholder' => "電話番号")); ?></td>
                        </tr>
                            <th>メールアドレス<span class='required'>必須</span></th>
                            <td><?php echo $this->Form->input('mail_address', array('label' => false, 'div' => false, 'placeholder' => "メールアドレス")); ?></td>
                        </tr>
                        <tr>
                            <th>契約希望台数</th>
                            <td><?php echo $this->Form->input('desired_number', array('label' => false, 'div' => false, 'placeholder' => "契約希望台数")); ?></td>
                        </tr>
                            <th>お問合せ内容</th>
                            <td><?php echo $this->Form->textarea('text', array('label' => false, 'div' => false, 'placeholder' => "お問い合わせ内容")); ?></td>
                        </tr>
                    <!--    </tr>
                            <th>個人情報保護<span class='required'>必須</span></th>
                            <td>
                                <?php
                                  echo $this->Form->input('prefecture', array(
                                      'options' => $prefectures,
                                      'label' => false,
                                      'div' => false,
                                      'empty' => '選択してください'
                                  ));
                                 ?>
                            </td>
                        </tr>-->
                        <tr>
                            <td colspan="2"><?php echo $this->Form->submit('確認', array('name' => 'home', 'type' => 'submit', 'label' => false, 'div' => false, 'class' => 'form_conf')); ?></td>
                        </tr>
                    </table>
        <?php echo $this->Form->end(); ?>
    </section>                                                
</article>