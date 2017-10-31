<?php echo $this->Form->create('Item', array('type' => 'file', 'url' => 'index')); ?>
<br>
<br>
<br>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td>ジャンル</td>
    <td>
      <?php
        echo $this->Form->input('item_genre', array(
          'options' => $item_genres,
          'label' => false,
          'div' => false,
          'empty' => '選択してください'
        ));
       ?>
    </td>
  </tr>
  <tr>
    <td>アイテム名</td>
    <td>
      <?php echo $this->Form->input('item_name', array('label' => false, 'div' => false)); ?>
    </td>
  </tr>
  <tr>
    <td>ジャンル</td>
    <td>
      <?php
        echo $this->Form->input('genre', array(
            'type' => 'select',
            'multiple' => 'checkbox',
            'label' => false,
            'div' => false,
            'options' => $genre,
            'legend'=>false,
            'class' => 'genre_check'
        ));
      ?>
    </td>
  </tr>
  <tr>
    <td>サイズ</td>
    <td>
      <?php
        echo $this->Form->input('size', array(
            'label' => false,
            'div' => false,
            'options' => $size,
            'empty' => '選択してください'
        ));
       ?>
    </td>
  </tr>
  <tr>
    <td>
      <?php echo $this->Form->end('検索'); ;?>
    </td>
  </tr>
</table>


<div class="col-md-12 text-center" style="background-color:#000; padding:0px;">
  <div class="col-md-12 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0 col-top-mar" style="padding:0px;">

    <div class="col-md-offset-0 text-center fh5co-heading job-box" style="clear: both;">
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

  <div class="col-md-offset-0 text-center fh5co-heading job-box" style="clear: both;">
    <?php foreach ($datas as $data): ?>
      <div class="job-memu">
        <a href="/ec/items/detail/<?php echo $data['Item']['id']; ?>">
          <div class="photo-cut">
            <?php echo $this->Html->image($data['Image'][0]['url'] ,array('width' => '100%' )); ?>
          </div>
            <p><?php echo $data['Item']['item_name'] ;?></p>
            <p><?php echo $data['Item']['price'] ;?></p>
            <p><?php echo $size[$data['Item']['size']] ;?></p>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="col-md-offset-0 text-center fh5co-heading job-box" style="clear: both; background:#000;">
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
</div>

