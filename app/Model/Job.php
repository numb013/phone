<?php
App::uses('AppModel', 'Model');

class Job extends AppModel {

  public $actsAs = array(
      'Search.Searchable'
  );

  //function paginate() {
  //  $extra = func_get_arg(6);
  //	//$extra['type']に生SQLが格納されている。
  //	return $this->query($extra['type']);
  //}


  function paginate() {
      $extra = func_get_arg(6);
      //$limit = 8;
      $limit = 20;
      $page = func_get_arg(4);

//die(pr());

      $sql = $extra['type'];
      $sql .= ' LIMIT ' . $limit;
      if ($page > 1){
          $sql .= ' OFFSET ' . ($limit * ($page - 1));
      }

      return $this->query($sql);
  }

  function paginateCount() {
      $extra = func_get_arg(2);
      return count($this->query(
          preg_replace(
              '/LIMIT \d+ OFFSET \d+$/u',
              '',
              $extra['type']
          )
      ));
  }



  public $validate = array(
      'profession_name' => array(
          'between' => array(
              'allowEmpty' => true,
              'rule' => array('between', 1, 50),
              'message' => '3つ以上選択してください'
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
    'check_like' => array(
      'type' => 'query',
      'method' => 'CheckLike',
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
		if (!empty($data['check_like'])) {
			$r = array();
			foreach ($data['check_like'] as $val) {
				if (!empty($val)) {
					$r[] = 'FIND_IN_SET(\'' . $val . '\', Profession.check_like)';
				}
			}
			$r[] = 'check_like IS NULL ';
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
					$k[] = 'FIND_IN_SET(\'' . $val . '\', Profession.check_like)';
				}
			}
			//$r[] = 'check_like IS NULL ';
			$conditions[]['AND'] = $k;
		}
		return $conditions;
	}

}
