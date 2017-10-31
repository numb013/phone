
<?php if(!empty($flag)): ?>
<aside id="fh5co-hero" clsas="js-fullheight">
  <div class="flexslider js-fullheight">
    <div>
      <div class="col-md-12 text-center js-fullheight" style="padding:0px;">
        <div class="slider-checkbox-inner">
          <div class="checkbox-title">当てはまる項目を3つ以上チェックしてください</div>
          <?php echo $this->Form->create('Profession', array('type' => 'file', 'url' =>  'index')); ?>
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
        <div class="set-btn animated fadeInUp">
          <?php echo $this->Form->input('診断する', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit')); ?>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
</aside>


<?php elseif(!empty($datas)): ?>

<div class="col-md-12 text-center animate-box" style="background-color:#000; padding:0px;">
  <div class="col-md-12 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0 col-top-mar" style="padding:0px;">
    <div class="serch-frame">
      <div class="sort-search"><?php echo $this->Paginator->sort('core_status', 'コアレベル順');?></div>
      <div class="more-search">
        <?php echo $this->Form->create('Profession', array('url' => array( 'controller' => 'Professions', 'action' => 'search_more' . $param),'type' => 'post')); ?>
    		<?php echo $this->Form->submit('さらに絞り込む▼', array('div' => false, 'class' => 'more-search')); ?>
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
          echo $this->Paginator->first('<< ');
          echo $this->Paginator->numbers(
            array('separator' => '/','modulus'=>2));
          echo $this->Paginator->last(' >>');
        ?>
      </div>
    </div>
  </div>

  <div class="col-md-offset-0 text-center fh5co-heading animate-box job-box" style="clear: both;">

    <?php foreach ($datas as $data): ?>
      <div class="job-memu">
        <a href="/ec/professions/detail/<?php echo $data['Profession']['id']; ?>">
          <div class="photo-cut">
            <?php echo $this->Html->image($data['Image'][0]['url'] ,array('width' => '100%' )); ?>
          </div>
          <p><?php echo $data['Profession']['profession_name'] ;?></p>
          <p>
            マニアック度:
            <?php
            for ($i = 0; $i < $data['Profession']['core_status']; $i++) {
              echo '★';
            };
            ?>
          </p>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="col-md-offset-0 text-center fh5co-heading animate-box job-box" style="clear: both; background:#000;">
    <div class="job-count">
      <?php echo $this->Paginator->counter(array(
        'format' => '<p>全{:count}件中/{:start}-{:end}件ヒット</p>'
      ));?>
    </div>
    <div class="job-page">
      <?php
        echo $this->Paginator->first('<< ');
        echo $this->Paginator->numbers(
          array('separator' => '/','modulus'=>2));
        echo $this->Paginator->last(' >>');
      ?>
    </div>
  </div>
</div>


<?php endif; ?>

</div>
