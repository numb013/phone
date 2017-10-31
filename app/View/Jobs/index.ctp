
<?php if(!empty($flag)): ?>
<aside id="fh5co-hero" clsas="js-fullheight">
  <?php
  //echo '<br>';
  //echo '<br>';
  //echo '<br>';
  //echo '<br>';
  //echo '<br>';
  //echo '<br>';
  //echo '<br>';
  //echo pr($this->request->data);
  //echo pr($data);
//$this->request->data['Profession']['personal_check'] = '1'
   ?>
    <div>
      <div class="col-md-12 text-center" style="padding:0px;background:#000;">
        <div class="slider-checkbox-inner">
          <?php if(empty($error)): ?>
          <div class="checkbox-title">当てはまる項目を3つ以上チェックしてください</div>
        <?php else: ?>
          <div class="checkbox-title error_text">当てはまる項目を3つ以上チェックしてください</div>
        <?php endif; ?>

          <?php echo $this->Form->create('jobs', array('type' => 'file', 'url' =>  'index')); ?>
          <div class="check-group clearfix ">
            <?php
              echo $this->Form->input('Profession.personal_check', array(
                  'type' => 'select',
                  'label' => false,
                  'multiple'=> 'checkbox',
                  'options' => $check_personals,
              ));
            ?>
          </div>
        </div>
        <?php echo $this->Form->hidden('like_checks', array('value' => $para)); ?>
        <div class="set-btn-diagnosis animated fadeInUp">
          <?php echo $this->Form->input('診断する', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit')); ?>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
</aside>

<?php elseif(!empty($datas)): ?>

<div class="col-md-12 text-center animate-box" style="background-color:#000; padding:0px;">
  <div class="col-md-12 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0 col-top-mar" style="padding:0px;">
    <div class="serch-frame">
      <div class="sort-search" style="color:#274b28; letter-spacing:-2px;"><?php echo $this->Paginator->sort('core_status', 'コアレベル順');?></div>
      <div class="more-search">
        <?php echo $this->Form->create('jobs', array('url' => array( 'controller' => 'jobs', 'action' => 'search_more'),'type' => 'post')); ?>
        <?php echo $this->Form->hidden('param', array('value' => $param)); ?>
        <?php echo $this->Form->hidden('searchCounts', array('value' => $searchCounts)); ?>
    		<?php echo $this->Form->submit('さらに絞り込む▼', array('div' => false, 'class' => 'more-search', 'style' => 'width: 97%;')); ?>
    		<?php echo $this->Form->end(); ?>
      </div>
    </div>
    <div class="col-md-offset-0 text-center fh5co-heading animate-box job-box" style="clear: both;">
      <div class="job-count">
        <?php echo $this->Paginator->counter(array(
          'format' => '<p>全{:count}件中/{:start}-{:end}件ヒット</p>'
        ));?>
      </div>
      <div class="job-page">
        <?php
          echo $this->Paginator->first('◂');
          echo $this->Paginator->numbers(
            array('separator' => '','modulus'=>2));
          echo $this->Paginator->last('▸');
        ?>
      </div>
    </div>
  </div>

  <div class="col-md-offset-0 text-center fh5co-heading animate-box job-box" style="clear: both;">



  <?php if ($datas == 'notdata'): ?>
    <div class="job-notdata">
      <p>該当する職業がございません</p>
      <?php echo $this->Html->image("gomen.jpg", array('width'=> '100%', 'alt' => 'ごめん猫')); ?>
    </div>
  <?php else: ?>
    <?php foreach ($datas as $data): ?>
      <div class="job-memu animate-box sss">

        <?php if ($_SERVER['DOCUMENT_ROOT'] == 'C:/xampp/htdocs'): ?>
          <a href="/ec/professions/detail/<?php echo $data['Profession']['id']; ?>/1">
        <?php else: ?>
          <a href="/professions/detail/<?php echo $data['Profession']['id']; ?>/1">
        <?php endif; ?>


          <div class="photo-cut">
            <?php echo $this->Html->image($data['Image']['url'] ,array('width' => '100%' )); ?>
          </div>
          <h2  class="professions_title"><?php echo $data['Profession']['profession_name'] ;?></h2>
          <ul class="core_list">
            <?php
              $text_none = mb_strlen($data['Profession']['profession_name']);
            ?>
            <?php if($text_none > '11'): ?>
            <li class="core_text text_none">
                      <?php else: ?>
                        <li class="core_text">
                        <?php endif; ?>
              <?php echo $genre[$data['Profession']['genre']] ;?>
            </li>

              <li class="core_text">
              コアレベル:<span class="core_status">
              <?php
              for ($i = 0; $i < $data['Profession']['core_status']; $i++) {
                echo '★';
              };
              ?>
              </span>
            </li>
          </ul>
        </a>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
  </div>
  <div class="col-md-offset-0 text-center fh5co-heading animate-box job-box" style="clear: both; background:#000;">
    <div class="job-count">
      <?php echo $this->Paginator->counter(array(
        'format' => '<p>全{:count}件中/{:start}-{:end}件ヒット</p>'
      ));?>
    </div>
    <div class="job-page">
      <?php
        echo $this->Paginator->first('◂');
        echo $this->Paginator->numbers(
          array('separator' => '','modulus'=>2));
        echo $this->Paginator->last('▸');
      ?>
    </div>
  </div>
</div>


<?php endif; ?>

</div>
