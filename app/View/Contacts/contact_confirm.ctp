<!-- Main -->
        <div id="main">
            <article class="post" id='form_area'>
                <header class="header_top">
                    <div class="title_top">
                        <h2>お問合せ:確認画面</h2>
                        <p>
                            以下の内容で間違いがなければ、「送信する」ボタンを押してください。
                        </p>
                    </div>
                </header>
                <section>
                    <?php echo $this->Form->create('Contact', array('type' => 'post', 'url' => '/Contacts/regist')); ?>
                    <table>
                        <tr>
                            <th>会社名</th>
                            <td><?php echo $this->request->data['Contact']['company_name']; ?></td>
                            <?php echo $this->Form->hidden('Contact.company_name', array('value' => $this->request->data['Contact']['company_name'])); ?>
                        </tr>
                        <tr>
                            <th>担当者名</th>
                            <td><?php echo $this->request->data['Contact']['contact_name']; ?></td>
                            <?php echo $this->Form->hidden('Contact.contact_name', array('value' => $this->request->data['Contact']['contact_name'])); ?>
                        </tr>
                            <th>都道府県</th>
                            <td><?php echo $prefectures[$this->request->data['Contact']['prefecture']]; ?></td>
                            <?php echo $this->Form->hidden('Contact.prefecture', array('value' => $this->request->data['Contact']['prefecture'])); ?>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><?php echo $this->request->data['Contact']['phone_number']; ?></td>
                            <?php echo $this->Form->hidden('Contact.phone_number', array('value' => $this->request->data['Contact']['phone_number'])); ?>
                        </tr>
                            <th>メールアドレス</th>
                            <td><?php echo $this->request->data['Contact']['mail_address']; ?></td>
                            <?php echo $this->Form->hidden('Contact.mail_address', array('value' => $this->request->data['Contact']['mail_address'])); ?>
                        </tr>
                        <tr>
                            <th>契約希望台数</th>
                            <td><?php echo $this->request->data['Contact']['desired_number']; ?></td>
                            <?php echo $this->Form->hidden('Contact.desired_number', array('value' => $this->request->data['Contact']['desired_number'])); ?>
                        </tr>
                            <th>お問合せ内容</th>
                            <td><?php echo $this->request->data['Contact']['text']; ?></td>
                            <?php echo $this->Form->hidden('Contact.text', array('value' => $this->request->data['Contact']['text'])); ?>
                        </tr>
                    </table>
                    <table>
                    <!--    </tr>
                            <th>個人情報保護</th>
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
                            <td colspan="2"><?php echo $this->Form->submit('戻る', array('name' => 'back', 'type' => 'submit', 'label' => false, 'div' => false, 'class' => 'form_conf')); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $this->Form->submit('送信', array('name' => 'regist', 'type' => 'submit', 'label' => false, 'div' => false, 'class' => 'form_conf')); ?></td>
                        </tr>
                    </table>
                    <?php echo $this->Form->end(); ?>
                </section>                                                
            </article>
        </div>              
    <?php echo $this->element('side'); ?>