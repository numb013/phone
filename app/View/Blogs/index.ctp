<!-- Main -->


<div id="main">
                <!-- Post -->
                        <article class="post blog_index">
                            <header class="header_top">
                                        <div class="title_top">
                                                <h2><a href="#">Magna sed adipiscing</a></h2>
                                                <p class="top_text">Lorem ipsum dolor amet nullam consequat etiam feugiat</p>
                                        </div>
                                </header>
                                <section>
                                        <ul class="posts">
                                            <?php foreach ($datas as $key => $data): ?>
                                                <li>
                                                    <article>
                                                        <header class='blog_title'>
                                                            <a href="/phone/blogs/detail/<?php echo $data['Blog']['id']; ?>">
                                                                <h2><?php echo $data['Blog']['title']; ?></h2>
                                                                <time class="published" datetime="2015-10-15">October 15, 2015</time>
                                                            </a>
                                                        </header>
                                                        <a href="#" class="image img_blog"><?php echo $this->Html->image($data['Image'][0]['url'] ,array('width' => '100%' )); ?></a>
                                                    </article>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                </section>
                        </article>

                        <ul class="actions pagination">
                                <li><a href="" class="disabled button big previous">戻る</a></li>
                                <li><a href="#" class="button big next">次へ</a></li>
                        </ul>
      </div>              
    <?php echo $this->element('side'); ?>
