<?php
App::uses('AppModel', 'Model');

class Item extends AppModel {

  public $actsAs = array(
      'Search.Searchable'
  );

  public $hasMany = array(
      'Image' => array(
          'className' => 'Image',
          'conditions'=>array(
            'delete_flag'=>0,
            'partner_name'=> 'Item',
              ),
          'order' => '',
          'foreignKey' => 'partner_id',
          'dependent' => '',
          'exclusive' => '',
          'finderQuery' => '',
          'limit' => '',
        ),
    );

    //function paginate($data = null) {
    //  $this->log($data, LOG_DEBUG);
    //  if(empty($data)) {
    //    $extra = func_get_arg(6);
    //  	//$extra['type']に生SQLが格納されている。
    //  	return $this->query($extra['type']);
    //  }
    //}


  public $validate = array(
      'item_name' => array(
          'between' => array(
              'allowEmpty' => true,
              'rule' => array('between', 1, 50),
              'message' => 'タイトルは50文字以内'
          )
      ),
      'item_text' => array(
        'between' => array(
            'allowEmpty' => true,
            'rule' => array('between', 1, 1000),
            'message' => '本文は1000文字以内'
        )
      ),
  );

  public $filterArgs = array(
    'item_name' => array(
      'type' => 'like'
    ),
    'genre' => array(
      'type' => 'value'
    ),
    'core_status' => array(
      'type' => 'value'
    ),
    'check_sex' => array(
      'type' => 'query',
      'method' => 'CheckSex',
    ),
    'item_genre' => array(
      'type' => 'query',
      'method' => 'ItemGenre',
    ),
    'genre' => array(
      'type' => 'query',
      'method' => 'Genre',
    ),
    'personal_check' => array(
      'type' => 'query',
      'method' => 'PersonalCheck',
    ),
    'like_checks' => array(
      'type' => 'query',
      'method' => 'LikeCheck',
    ),

  );

  public function CheckSex($data = array()) {
		$conditions = array();
		// 案件カテゴリー
		if (!empty($data['check_sex'])) {
			$r = array();
			foreach ($data['check_sex'] as $val) {
				if (!empty($val)) {
					$r[] = 'FIND_IN_SET(\'' . $val . '\', Item.check_sex)';
				}
			}
			$r[] = 'check_sex IS NULL ';
			$conditions[]['OR'] = $r;
		}
		return $conditions;
	}

  public function ItemGenre($data = array()) {
		$conditions = array();
		// 案件カテゴリー
                if (!empty($data['item_genre'])) {
			$r = array();
                            if (!empty($data['item_genre'])) {
					$r[] = 'FIND_IN_SET(\'' . $data['item_genre'] . '\', Item.item_genre)';
				}
			$r[] = 'item_genre IS NULL ';
			$conditions[]['OR'] = $r;
		}
		return $conditions;
	}

  public function Genre($data = array()) {
		$conditions = array();
		// 案件カテゴリー
		if (!empty($data['genre'])) {
			$r = array();
			foreach ($data['genre'] as $val) {
				if (!empty($val)) {
					$r[] = 'FIND_IN_SET(\'' . $val . '\', Item.genre)';
				}
			}
			$r[] = 'genre IS NULL ';
			$conditions[]['OR'] = $r;
		}
		return $conditions;
	}

  public function PersonalCheck($data = array()) {
		$conditions = array();
		// 案件カテゴリー
		if (!empty($data['personal_check'])) {
			$r = array();
			foreach ($data['personal_check'] as $val) {
				if (!empty($val)) {
					$r[] = 'FIND_IN_SET(\'' . $val . '\', Item.item_genre)';
				}
			}
			//$r[] = 'item_genre IS NULL ';
			$conditions[]['AND'] = $r;
		}
		return $conditions;
	}

  public function LikeCheck($data = array()) {
		$conditions = array();
		// 案件カテゴリー
		if (!empty($data['genres'])) {
			$k = array();
			foreach ($data['like_checks'] as $val) {
				if (!empty($val)) {
					$k[] = 'FIND_IN_SET(\'' . $val . '\', Item.genre)';
				}
			}
			//$r[] = 'genre IS NULL ';
			$conditions[]['AND'] = $k;
		}
		return $conditions;
	}

}
