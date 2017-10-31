<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright Home.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class HomesController extends AppController {
	public $uses = array('Home', 'Image', 'CheckLike', 'CheckPersonal', 'WriteDown');
	public $components = array('Search.Prg', 'Session', 'Master');
	public $presetVars = true;
	public $paginate = array();


	public function index($para = null) {

		//echo pr($this->request->query);
		//echo pr($this->request->data);
		//exit();
		$param = (!empty($_SERVER['QUERY_STRING'])) ? '?'.$_SERVER['QUERY_STRING'] : '';

		//echo pr($param);
		if (!empty($this->request->query['param'])) {
			$replaceText = str_replace("?", "", $this->request->query['param']);

			$array1 = array();
			parse_str($replaceText,  $array1);
			//echo pr($array1);
			if (!empty($array1['personal_check'])) {
				foreach ($array1['personal_check'] as $key => $value) {
					$this->request->query['personal_check'][$key] = $value;
				}
			}
		}

    // レイアウト関係
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Home->parseCriteria($this->passedArgs);


		if (!empty($this->request->data)) {
			$back_flag = 1;
			$this->set('back_flag', $back_flag);
			$this->paginate['conditions']['home.delete_flag'] = '0';
			$this->paginate = array(
				'conditions' => $this->paginate['conditions'],
				'order' => array(
					'created' => 'DESC',
				),
				'limit' => 8,
			);

			//$personalCheck = '';
			//foreach ($this->request->data['Home']['personal_check'] as $key => $value) {
			//	if ($key == 0) {
			//		$Check[$key] = ' select * from homes T1 where T1.check_personal like "%,' . $value . ',%" or T1.check_personal like "'. $value . ',%" or T1.check_personal like "%,'. $value .'" AND T1.delete_flag = 0';
			//	} else {
			//		$Check[$key] = ' UNION ALL select * from homes T1 where T1.check_personal like "%,' . $value . ',%" or T1.check_personal like "'. $value . ',%" or T1.check_personal like "%,'. $value .'" AND T1.delete_flag = 0';
			//	}
			//	$personalCheck = $personalCheck . $Check[$key];
			//};
//
			//$sql = "select Home.*, Image.url from
			//(select v_hit.*, COUNT('X') as cnt
			//from
			// (".$personalCheck.") as v_hit GROUP BY v_hit.id ) As Home
			//	LEFT JOIN images As Image
			//	ON (Home.id = Image.partner_id)
			// where Home.cnt >= 3 AND Image.delete_flag = 0 GROUP BY Home.id";
//
			//$this->paginate = $sql; //$sqlの中身は生SQL

		} else {
			// 初期表示時
			$this->paginate = array(
				'conditions' => array(
				   'delete_flag' => '0'
				 ),
				'order' => array(
					'created' => 'DESC',
				),
				'limit' => 8,
			);
			$back_flag = 1;
			$flag = 1;
			$this->set(compact('flag', 'back_flag'));
		}

		$datas = $this->paginate('Home');
		$count = count($datas);


		//$datas = $this->paginate();
		//$count = count($datas);

		//echo pr($this->Home->getDataSource()->getLog());
		//exit();
		//echo pr($datas);
		//exit();

		$this->_getCheckParameter();
    $this->set(compact('datas', 'para', 'param', 'count'));
	}

  public function search_more($para = null) {
    $param = (!empty($_SERVER['QUERY_STRING'])) ? '?' . $_SERVER['QUERY_STRING'] : '';
		$this->_getCheckParameter();
		$back_flag = 1;
    $this->set(compact('datas', 'para', 'param', 'back_flag'));
	}



public function detail($id = null, $first = null) {
	//exit();
	//echo pr($id);
	// レイアウト関係
	$this->layout = "default";
	if (isset($id)) {
		$status = array(
		'conditions' =>
			array(
				'Home.id' => $id,
				'Home.delete_flag' => 0
			)
		);
		// 以下がデータベース関係
		$datas = $this->Home->find('first', $status);
	//echo pr($datas);
	//exit();
		if (!empty($datas['Home']['image_flag'])) {
			$id = $datas['Home']['id'];
			$status = array(
				'conditions' =>
				array(
					'partner_id' => $id,
					'partner_name' => 'Home',
					'delete_flag' => '0'
				)
			);
			$datas['Image'] = $this->Image->find('all', $status);
		}


	//echo pr($datas);
	//exit();

		if (!empty($datas['Home']['movie_flag'])) {
			$id = $datas['Home']['id'];
			$status = array(
				'conditions' =>
				array(
					'partner_id' => $id,
					'partner_name' => 'Home',
					'delete_flag' => '0'
				)
			);
			$datas['Movie'] = $this->Movie->find('all', $status);
		}

		$this->set('title_for_layout', $datas['Home']['home_name'].'の仕事内容・なりかた・給料・向いてる性格');
		$datas['title'] = $datas['Home']['home_name'].'の仕事内容・なりかた・給料・向いてる性格';
		$datas['Home']['check_personal'] = explode(",", $datas['Home']['check_personal']);
		$datas['Home']['check_like'] = explode(",", $datas['Home']['check_like']);
		$datas['Home']['related_home'] = explode(",", $datas['Home']['related_home']);

		$id = $datas['Home']['id'];
		$status = array(
			'conditions' =>
			array(
				'home_id' => $id,
				'up_flag' => 0,
				'delete_flag' => 0
			),
			'order' => array(
				'created' => 'DESC',
			),
		);
		$datas['write'] = $this->WriteDown->find('all', $status);

		$this->_getSideContent($datas);
		$this->_getCheckParameter();
		$know_flag = 1;
		//直接urlからきたら$first来たら来たらをviewにおくる
		if (empty($first)) {
			$first = 1;
			$this->set('first', $first);
		}
		$this->set(compact('datas', 'know_flag'));
	}
}



  public function admin_index() {
		$this->layout = 'default';
		$this->paginate = array(
			'limit' => 5,
		);
		$this->Prg->commonProcess();
                $this->paginate['conditions'] = $this->Home->parseCriteria($this->passedArgs);
		if (empty($this->request->data)) {
			// 初期表示時
			$this->paginate = array(
				'conditions' => array(
				   'delete_flag' => '0'
				 ),
				'order' => array(
					'modified' => 'DESC',
				),
			);
		} else {
			$this->paginate['conditions']['Home.delete_flag'] = '0';
		}
		$datas = $this->paginate();
		$this->set('datas',$datas);
  }

/**/
/*登録箇所
/*
/*
/*
/*
/*
/**/
  public function admin_add() {
    $this->layout = "default";
    if ($this->request->is(array('post', 'put'))) {
      $this->Home->set($this->request->data);
      // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
      if ($this->Home->validates()) {
        $this->set('data',$this->request->data);
        $this->render('/Homes/admin_confirm');
      } else {
        return false;
      }
    }
  }

  /**/
  /*登録DBに登録箇所
  /*
  /*
  /*
  /*
  /*
  /**/

  public function admin_regist() {
		$this->layout = "default";
    if ($this->request->is(array('post', 'put'))) {
        //戻るボタン
        if (isset($this->request->data['back'])) {
        $this->render('/Homes/admin_add');
    } elseif (isset($this->request->data['regist'])) {
        $data = $this->request->data;
        $this->Home->set($data);
        // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
        if ($this->Home->validates()) {
          $this->Home->save($data['Home']);
          return $this->redirect(
            array('controller' => 'Homes', 'action' => 'admin_index')
          );
        } else {
          $this->set('data',$data);
          $this->render('/Homes/admin_add');
        }
      }
    }
  }

/**/
/*編集箇所
/*
/*
/*
/*
/*
/**/
public function admin_edit($id = null){

	// レイアウト関係
	$this->layout = "default";
	//変更処理
  if ($this->request->is(array('post', 'put'))) {
      $this->Home->set($this->request->data);
      // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
      if ($this->Home->validates()) {
        $this->set('data',$this->request->data);
        $this->render('/Homes/admin_edit_confirm');
      } else {

        return false;
      }
    } else {
        //初期処理
      if (isset($id)) {
        $status = array(
        'conditions' =>
          array(
            'Home.id' => $id,
          )
        );
        // 以下がデータベース関係
        $this->request->data = $this->Home->find('first', $status);
      }
    }
  }


  public function admin_edit_regist(){
    // レイアウト関係
    $this->layout = "default";
    if ($this->request->is(array('post', 'put'))) {
    //戻るボタン
    if (isset($this->request->data['back'])) {
        $this->render('/Homes/admin_edit');
    } elseif (isset($this->request->data['regist'])) {
        $data = $this->request->data;
        $this->Home->set($data);
        // 2. モデル[ModelName]のvalidatesメソッドを使ってバリデーションを行う。
        if ($this->Home->validates()) {
          $this->Home->save($data['Home']);
          return $this->redirect( array('controller' => 'Homes', 'action' => 'admin_index'));
        } else {
          $this->set('data',$data);
          $this->render('/Homes/admin_add');
        }
      }
    }
  }

  /**/
  /*詳細箇所
  /*
  /*
  /*
  /*
  /*
  /**/

  public function admin_detail($id = null){
    // レイアウト関係
		$this->layout = "default";
    if (isset($id)) {
      $status = array(
      'conditions' =>
        array(
          'Home.id' => $id,
          'Home.delete_flag' => 0
        )
      );
      // 以下がデータベース関係
      $datas = $this->Home->find('first', $status);
      $this->set('data',$datas);
    }
  }

/**/
/*削除箇所
/*
/*
/*
/*
/*
/**/
  public function admin_delete($id = null){
		$this->layout = "default";
    $status = array(
      'delete_flag' => 1,
    );
    $conditions = array(
      'Home.id' => $id,
    );
    $this->Home->updateAll($status, $conditions);
    return $this->redirect( array('controller' => 'Homes', 'action' => 'admin_index'));
  }

	public function _getSideContent($datas = null) {
		//$status = array(
		//'conditions' => array(
		//	'image_flag' => '1'
		//),
		//'order' => array(
		//	'created' => 'DESC'
		//),
		//'limit' => 6,
		//);
		// 以下がデータベース関係
		//$new_content = $this->Home->find('all', $status);
		$status = array(
			'fields' => array(
				'Home.id', 'Home.home_name', 'job_salary', 'personality'
			),
			'conditions' =>
			array(
				'Home.id' => $datas['Home']['related_home'],
				'delete_flag' => 0
			),
			'recursive'  => -1
		);
		$related = $this->Home->find('all', $status);

		$status = array(
		'conditions' => array(
			'image_flag' => '1'
		),
		'order' => array(
			'core_status' => 'DESC',
		),
		'limit' => 6,
		);
		// 以下がデータベース関係
		$core_content = $this->Home->find('all', $status);
                shuffle($core_content);
                $this->set(compact("related", "core_content"));
        }

	public function _getCheckParameter() {
		$check_personals = $this->Master->getCheckPersonals();
		$check_likes = $this->Master->getCheckLikes();
		$like_checks = $this->Master->getLikeChecks();
		$genre = $this->Master->getGenre();
		$like_genre = $this->Master->getlikeGenre();
		$this->set(compact("check_likes", "check_personals", "genre", "like_genre", "like_checks"));
		return;
	}
}
