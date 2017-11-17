
<!-- side -->
        <section id="sidebar">
                <!-- Mini Posts -->
                        <section>
                                <div class="mini-posts">
                                        <!-- Mini Post -->
                                                <article class="mini-post">
                                                        <header>
                                                                <h2><a href="blog.html">法人携帯専門家が教える<br>お得な法人携帯情報</a></h2>
                                                                <p class="top_text">corporate mobile information</p>
                                                        </header>
                                                </article>
                                                <?php foreach ($side_content as $key => $data): ?>
                                                    <a href="/blogs/detail/<?php echo $data['Blog']['id']; ?>">
                                                            <article class="mini-post">
                                                                    <header>
                                                                            <h3><?php echo $data['Blog']['title']; ?></h3>
                                                                            <time class="published" datetime=<?php echo $data['Blog']['modified']; ?>><?php echo date('Y-m-d ',  strtotime($data['Blog']['modified'])); ?></time>
                                                                    </header>
                                                                    <span class="image"><?php echo $this->Html->image($data['Image'][0]['url'] ,array('width' => '100%' )); ?></span>
                                                            </article>
                                                    </a>
                                                <?php endforeach; ?>
                                </div>
                        </section>

                <!-- Posts List -->
                        <section>
                                <ul class="posts">
                                    <?php foreach ($side_under_content as $key => $data): ?>
                                        <li>
                                            <a href="<?php echo $data['Rss']['url']; ?>" target=”_blank”>
                                                <article>
                                                        <header>
                                                                <h3><?php echo $data['Rss']['title']; ?></h3>
                                                                <time class="published" datetime=<?php echo $data['Rss']['modified']; ?>><?php echo date('Y-m-d ',  strtotime($data['Rss']['modified'])); ?></time>
                                                        </header>
                                                        <span class="image"><img class="sp-image" src=<?php echo $data['Rss']['img_url']; ?> /></span>
                                                </article>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                        </section>



                <!-- Footer
                        <section id="footer">
                                <ul class="icons">
                                        <li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
                                        <li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
                                        <li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
                                        <li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li>
                                        <li><a href="#" class="fa-envelope"><span class="label">Email</span></a></li>
                                </ul>
                                <p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a href="http://unsplash.com">Unsplash</a>.</p>
                        </section>
                 -->
        </section>


