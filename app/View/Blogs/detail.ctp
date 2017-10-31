
<!-- Main -->
        <div id="main">

                <!-- Post -->
                        <article class="post">
                            <header class="header_top">
                                    <div class="title_top blog_title">
                                        <time class="published" datetime=<?php echo $datas['Blog']['modified']; ?>><?php echo date('Y-m-d ',  strtotime($datas['Blog']['modified'])); ?></time>
                                        <h1><?php echo $datas['Blog']['title']; ?></h1>
                                    </div>
                            </header>
                            <section class="blog_text">
                                <a href="#" class="image featured">
                                    <?php echo $this->Html->image($datas['Image'][0]['Image']['url'] ,array('width' => '100%' )); ?>
                                </a>
                                <p><?php echo nl2br($datas['Blog']['text_1']); ?></p>
                            </section>
                            <?php if(!empty($datas['Blog']['text_2'])): ?>
                                <section class="blog_text">
                                <a href="#" class="image featured">
                                    <?php echo $this->Html->image($datas['Image'][1]['Image']['url'] ,array('width' => '100%' )); ?>
                                </a>
                                <p><?php echo nl2br($datas['Blog']['text_2']); ?></p>
                                </section>
                            <?php endif; ?>
                            <?php if(!empty($datas['Blog']['text_3'])): ?>
                                <section class="blog_text">
                                <a href="#" class="image featured">
                                    <?php echo $this->Html->image($datas['Image'][2]['Image']['url'] ,array('width' => '100%' )); ?>
                                </a>
                                <p><?php echo nl2br($datas['Blog']['text_3']); ?></p>
                                </section>
                            <?php endif; ?>
                            <?php if(!empty($datas['Blog']['text_4'])): ?>
                                <section class="blog_text">
                                <a href="#" class="image featured">
                                    <?php echo $this->Html->image($datas['Image'][3]['Image']['url'] ,array('width' => '100%' )); ?>
                                </a>
                                <p><?php echo nl2br($datas['Blog']['text_4']); ?></p>
                                </section>
                            <?php endif; ?>
                            
                            <div class="blog_text">
                            【関連記事】<br>
                            ※ 3位下着1枚…「セックスレスをまねく妻の部屋着」男性大ブーイングの1位は？<br>
                            ※ ウゲッ…EDも!? セックスレスが続くと体に現れる「こわ～い症状」3つ<br>
                            ※ 掃除のプロがスバリ指摘！「夫婦仲がどんどん悪くなる」ダメ家の特徴3つ
                            </div>

                        </article>
      </div>              
    <?php echo $this->element('side'); ?>
