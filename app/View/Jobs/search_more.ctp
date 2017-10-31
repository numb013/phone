<script type="text/javascript">
jQuery(function($) {
var nav = $('#fixedBox'),
		offset = nav.offset();
	$(window).scroll(function () {
		if($(window).scrollTop() > offset.top) {
			nav.addClass('fixed');

			if ($(document).height() < $(window).scrollTop() + $(window).height() + 230) {
				$('.nav').css("display","none");
			} else {
				$('.nav').css("display","block");
			}
		}
	});
});
</script>
<div id="fixedBox" class="nav">
  <?php echo $this->Form->create('Profession', array('type' => 'file', 'url' =>  'index')); ?>
  <div class="col-md-12 text-center">
    <p class="search_count">該当職業 :<?php echo $searchCounts; ?>件</p>
    <div class="set-btn-popup">
      <?php echo $this->Form->input('診断する', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit')); ?>
    </div>
  </div>
</div>
<div class="col-md-12 text-center animate-box" style="background-color:#000; padding:0px;">
  <div class="col-md-12 col-sm-12 col-sm-push-0 col-xs-push-0 more-search-bar">
    <div class="good-search">こだわり検索</div>
    <div class="fh5co-services" style="padding:0px;">

      <?php foreach ($like_checks as $key => $data): ?>
        <div class="col-md-4 text-center wrap_search">
          <div class="search-title"><?php echo $like_genre[$key] ;?></div>
          <div class="list_search">
            <ul class="float list_none">
              <li>
                <?php
                $active = $this->Form->input('Profession.like_checks', array(
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'legend' => false,
                    'options' => $data,
                    'hiddenField' => false,
                    'label' => false,
                    ));
                echo preg_replace('/<div class="checkbox">(.+)<label[^>]+>(.+)<\/label><\/div>/', '<label class="checkbox">$1$2</label>', $active);
                ?>
              </li>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="col-md-12 text-center" style="padding:0px; position: static;">
    <p class="search_count">該当職業 :<?php echo $searchCounts; ?>件</p>
    <div class="set-btn">
      <?php echo $this->Form->input('診断する', array('type' => 'submit', 'label' => false, 'div' => false, 'class' => 'btn_submit')); ?>
      <?php echo $this->Form->hidden('param', array('value' => $param)); ?>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>
</div>
</div>

<script>
$(function () {
  $('.checkbox').change(function(){
  	if ($(this).children('input').is(':checked')) {
      var data = { like_checks: $(this).children('input').val() };
        $.ajax({
        type: 'POST',
        url: '/jobs/search_ajax',
        data: data,
        dataType: 'json',
        cache: false,
        success: function(data) {
          console.log(data);
          var number = data.count;
          $('.search_count').text('該当職業 :' + number + '件');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert(textStatus);
          alert(errorThrown);
        }
      });
  	} else {
      var data1 = { like_checks: $(this).children('input').val(), off:'off' };
        $.ajax({
        type: 'POST',
        url: '/jobs/search_ajax',
        data: data1,
        dataType: 'json',
        cache: false,
        success: function(data) {
          console.log(data);
          var number = data.count;
          $('.search_count').text('該当職業 :' + number + '件');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          console.log(textStatus);
          console.log(errorThrown);
          alert(textStatus);
          alert(errorThrown);
        }
      });
  	}
  });
});
</script>
