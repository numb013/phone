<?php
App::uses('AppModel', 'Model');

class Profession extends AppModel {

  public $actsAs = array(
      'Search.Searchable'
  );

  public $hasMany = array(
      'Image' => array(
          'className' => 'Image',
          'conditions'=>array(
            'delete_flag'=>0,
            'partner_name'=> 'Profession',
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
      'profession_name' => array(
          'between' => array(
              'allowEmpty' => true,
              'rule' => array('between', 1, 50),
              'message' => 'タイトルは50文字以内'
          )
      ),
      '	job_content' => array(
        'between' => array(
            'rule' => array('between', 1, 1000),
            'message' => '本文は1000文字以内'
        )
      ),
      'job_step1' => array(
        'between' => array(
            'rule' => array('between', 1, 1000),
            'message' => '本文は1000文字以内'
        )
      ),
      'job_step2' => array(
        'between' => array(
            'rule' => array('between', 1, 1000),
            'message' => '本文は1000文字以内'
        )
      ),
      'job_step3' => array(
        'between' => array(
            'rule' => array('between', 1, 1000),
            'message' => '本文は1000文字以内'
        )
      ),
      'job_url' => array(
        'between' => array(
            'rule' => array('between', 1, 1000),
            'message' => '本文は1000文字以内'
        )
      ),
      'core_status' => array(
        'between' => array(
            'allowEmpty' => true,
            'rule' => array('between', 1, 1000),
            'message' => '本文は1000文字以内'
        )
      ),
  );

  public $filterArgs = array(
    'profession_name' => array(
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
    'check_personal' => array(
      'type' => 'query',
      'method' => 'CheckPersonal',
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
					$r[] = 'FIND_IN_SET(\'' . $val . '\', Profession.check_sex)';
				}
			}
			$r[] = 'check_sex IS NULL ';
			$conditions[]['OR'] = $r;
		}
		return $conditions;
	}

  public function CheckPersonal($data = array()) {
		$conditions = array();
		// 案件カテゴリー
		if (!empty($data['check_personal'])) {
			$r = array();
			foreach ($data['check_personal'] as $val) {
				if (!empty($val)) {
					$r[] = 'FIND_IN_SET(\'' . $val . '\', Profession.check_personal)';
				}
			}
			$r[] = 'check_personal IS NULL ';
			$conditions[]['OR'] = $r;
		}
		return $conditions;
	}

  public function CheckLike($data = array()) {
		$conditions = array();
		// 案件カテゴリー
		if (!empty($data['genre'])) {
			$r = array();
			foreach ($data['genre'] as $val) {
				if (!empty($val)) {
					$r[] = 'FIND_IN_SET(\'' . $val . '\', Profession.genre)';
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
					$r[] = 'FIND_IN_SET(\'' . $val . '\', Profession.check_personal)';
				}
			}
			//$r[] = 'check_personal IS NULL ';
			$conditions[]['AND'] = $r;
		}
		return $conditions;
	}

  public function LikeCheck($data = array()) {
		$conditions = array();
		// 案件カテゴリー
		if (!empty($data['like_checks'])) {
			$k = array();
			foreach ($data['like_checks'] as $val) {
				if (!empty($val)) {
					$k[] = 'FIND_IN_SET(\'' . $val . '\', Profession.genre)';
				}
			}
			//$r[] = 'genre IS NULL ';
			$conditions[]['AND'] = $k;
		}
		return $conditions;
	}

}
